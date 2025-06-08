<?php
require_once('connection.php');
require_once('midtrans_config.php');

// Read the notification body
$json_result = file_get_contents('php://input');
$result = json_decode($json_result);

if (empty($result)) {
    http_response_code(400);
    exit('Invalid JSON');
}

$order_id = $result->order_id;
$status_code = $result->status_code;
$gross_amount = $result->gross_amount;
$transaction_status = $result->transaction_status;
$fraud_status = $result->fraud_status ?? '';

// Log the notification for debugging
error_log("Midtrans Notification: " . $json_result);

try {
    // Verify the notification
    $notification = new \Midtrans\Notification();
    
    $order_id = $notification->order_id;
    $transaction_status = $notification->transaction_status;
    $fraud_status = $notification->fraud_status;
    
    // Determine the booking status
    $book_status = '';
    $payment_status = '';
    
    if ($transaction_status == 'capture') {
        if ($fraud_status == 'challenge') {
            $book_status = 'UNDER REVIEW';
            $payment_status = 'challenge';
        } else if ($fraud_status == 'accept') {
            $book_status = 'CONFIRMED';
            $payment_status = 'paid';
        }
    } else if ($transaction_status == 'settlement') {
        $book_status = 'CONFIRMED';
        $payment_status = 'paid';
    } else if ($transaction_status == 'pending') {
        $book_status = 'PENDING PAYMENT';
        $payment_status = 'pending';
    } else if ($transaction_status == 'deny') {
        $book_status = 'PAYMENT DENIED';
        $payment_status = 'denied';
    } else if ($transaction_status == 'expire') {
        $book_status = 'PAYMENT EXPIRED';
        $payment_status = 'expired';
    } else if ($transaction_status == 'cancel') {
        $book_status = 'CANCELLED';
        $payment_status = 'cancelled';
    } else {
        $book_status = 'UNDER PROCESSING';
        $payment_status = 'unknown';
    }
    
    // Update booking status in database
    $update_sql = "UPDATE booking SET 
                   BOOK_STATUS = '$book_status',
                   PAYMENT_STATUS = '$payment_status',
                   UPDATED_AT = CURRENT_TIMESTAMP
                   WHERE TRANSACTION_ID = '$order_id'";
    
    if (mysqli_query($con, $update_sql)) {
        // Insert or update payment record
        $payment_check = "SELECT * FROM payment WHERE BOOK_ID = (SELECT BOOK_ID FROM booking WHERE TRANSACTION_ID = '$order_id')";
        $payment_result = mysqli_query($con, $payment_check);
        
        if (mysqli_num_rows($payment_result) > 0) {
            // Update existing payment record
            $update_payment = "UPDATE payment SET 
                              PAYMENT_STATUS = '$payment_status',
                              TRANSACTION_ID = '$order_id'
                              WHERE BOOK_ID = (SELECT BOOK_ID FROM booking WHERE TRANSACTION_ID = '$order_id')";
            mysqli_query($con, $update_payment);
        } else {
            // Insert new payment record
            $booking_data_sql = "SELECT BOOK_ID, PRICE FROM booking WHERE TRANSACTION_ID = '$order_id'";
            $booking_data_result = mysqli_query($con, $booking_data_sql);
            $booking_data = mysqli_fetch_assoc($booking_data_result);
            
            if ($booking_data) {
                $insert_payment = "INSERT INTO payment (
                                  BOOK_ID, PRICE, PAYMENT_STATUS, TRANSACTION_ID, PAYMENT_METHOD
                                  ) VALUES (
                                  '{$booking_data['BOOK_ID']}',
                                  '{$booking_data['PRICE']}',
                                  '$payment_status',
                                  '$order_id',
                                  'midtrans'
                                  )";
                mysqli_query($con, $insert_payment);
            }
        }
        
        // Log successful update
        error_log("Booking status updated successfully for order: $order_id");
        
        // Send success response
        http_response_code(200);
        echo "OK";
    } else {
        error_log("Failed to update booking status: " . mysqli_error($con));
        http_response_code(500);
        echo "Database update failed";
    }
    
} catch (Exception $e) {
    error_log("Midtrans webhook error: " . $e->getMessage());
    http_response_code(500);
    echo "Error: " . $e->getMessage();
}
?>
        