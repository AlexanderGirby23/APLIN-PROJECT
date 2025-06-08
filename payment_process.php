<?php
session_start();
require_once('connection.php');
require_once('midtrans_config.php');

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

// Get booking data from session or POST
if (!isset($_SESSION['booking_data'])) {
    header('Location: cardetails.php');
    exit();
}

$booking_data = $_SESSION['booking_data'];
$user_email = $_SESSION['email'];

// Get user data
$sql_user = "SELECT * FROM users WHERE EMAIL='$user_email'";
$user_result = mysqli_query($con, $sql_user);
$user_data = mysqli_fetch_assoc($user_result);

// Generate unique order ID
$order_id = 'CAR-' . time() . '-' . rand(1000, 9999);

// Prepare transaction details
$transaction_details = array(
    'order_id' => $order_id,
    'gross_amount' => $booking_data['total_price']
);

// Customer details
$customer_details = array(
    'first_name' => $user_data['FNAME'],
    'last_name' => $user_data['LNAME'],
    'email' => $user_data['EMAIL'],
    'phone' => $user_data['PHONE_NUMBER']
);

// Item details
$item_details = array(
    array(
        'id' => 'car_' . $booking_data['car_id'],
        'price' => $booking_data['daily_price'],
        'quantity' => $booking_data['duration'],
        'name' => $booking_data['car_name'] . ' - Car Rental (' . $booking_data['duration'] . ' days)'
    )
);

// Transaction data
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details
);

try {
    // Get Snap Token
    $snapToken = \Midtrans\Snap::getSnapToken($transaction);
    
    // Insert booking into database with pending status
    $insert_booking = "INSERT INTO booking (
        CAR_ID, EMAIL, BOOK_PLACE, BOOK_DATE, DURATION, 
        PHONE_NUMBER, DESTINATION, RETURN_DATE, PRICE, 
        BOOK_STATUS, TAKE_METHOD, ADDRESS, TRANSACTION_ID, 
        PAYMENT_STATUS, SNAP_TOKEN
    ) VALUES (
        '{$booking_data['car_id']}', 
        '$user_email', 
        '{$booking_data['pickup_location']}', 
        '{$booking_data['booking_date']}', 
        '{$booking_data['duration']}',
        '{$user_data['PHONE_NUMBER']}', 
        '{$booking_data['destination']}', 
        '{$booking_data['return_date']}', 
        '{$booking_data['total_price']}',
        'PENDING PAYMENT', 
        '{$booking_data['take_method']}', 
        '{$booking_data['address']}',
        '$order_id',
        'pending',
        '$snapToken'
    )";
    
    if (mysqli_query($con, $insert_booking)) {
        $booking_id = mysqli_insert_id($con);
        $_SESSION['current_booking_id'] = $booking_id;
        $_SESSION['snap_token'] = $snapToken;
        $_SESSION['order_id'] = $order_id;
    } else {
        throw new Exception('Failed to create booking: ' . mysqli_error($con));
    }
    
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Car Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo MIDTRANS_CLIENT_KEY; ?>"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Payment Confirmation</h3>
                    </div>
                    <div class="card-body">
                        <h5>Booking Details:</h5>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Car:</span>
                                <strong><?php echo $booking_data['car_name']; ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Duration:</span>
                                <strong><?php echo $booking_data['duration']; ?> days</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Pickup Date:</span>
                                <strong><?php echo $booking_data['booking_date']; ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Return Date:</span>
                                <strong><?php echo $booking_data['return_date']; ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total Amount:</span>
                                <strong>Rp <?php echo number_format($booking_data['total_price'], 0, ',', '.'); ?></strong>
                            </li>
                        </ul>
                        
                        <div class="text-center">
                            <button id="pay-button" class="btn btn-primary btn-lg">
                                Pay Now with Midtrans
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('pay-button').onclick = function() {
            snap.pay('<?php echo $snapToken; ?>', {
                onSuccess: function(result) {
                    console.log(result);
                    // Send result to your server
                    window.location.href = 'payment_success.php?order_id=<?php echo $order_id; ?>&status=success';
                },
                onPending: function(result) {
                    console.log(result);
                    window.location.href = 'payment_success.php?order_id=<?php echo $order_id; ?>&status=pending';
                },
                onError: function(result) {
                    console.log(result);
                    alert('Payment failed!');
                    window.location.href = 'payment_success.php?order_id=<?php echo $order_id; ?>&status=failed';
                }
            });
        };
    </script>
</body>
</html>