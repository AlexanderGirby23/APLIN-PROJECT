<?php
session_start();
require_once('connection.php');

$order_id = $_GET['order_id'] ?? '';
$status = $_GET['status'] ?? '';

if (!$order_id) {
    header('Location: cardetails.php');
    exit();
}

// Update booking status based on payment result
$new_status = '';
$payment_status = '';

switch ($status) {
    case 'success':
        $new_status = 'CONFIRMED';
        $payment_status = 'paid';
        break;
    case 'pending':
        $new_status = 'PENDING PAYMENT';
        $payment_status = 'pending';
        break;
    case 'failed':
        $new_status = 'PAYMENT FAILED';
        $payment_status = 'failed';
        break;
    default:
        $new_status = 'UNDER PROCESSING';
        $payment_status = 'unknown';
}

// Update booking status
$update_sql = "UPDATE booking SET 
               BOOK_STATUS = '$new_status', 
               PAYMENT_STATUS = '$payment_status',
               UPDATED_AT = CURRENT_TIMESTAMP
               WHERE TRANSACTION_ID = '$order_id'";

mysqli_query($con, $update_sql);

// Get booking details
$booking_sql = "SELECT b.*, c.CAR_NAME, c.CAR_IMG, u.FNAME, u.LNAME 
                FROM booking b 
                JOIN cars c ON b.CAR_ID = c.CAR_ID 
                JOIN users u ON b.EMAIL = u.EMAIL 
                WHERE b.TRANSACTION_ID = '$order_id'";
$booking_result = mysqli_query($con, $booking_sql);
$booking_data = mysqli_fetch_assoc($booking_result);

// Clear booking session data
unset($_SESSION['booking_data']);
unset($_SESSION['current_booking_id']);
unset($_SESSION['snap_token']);
unset($_SESSION['order_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Result - Car Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to top, rgba(255, 255, 255, 0.750)50%), url("./images/carbg2.jpg");
            background-position: center;
            background-size: cover;
        }
        .result-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="result-card">
                    <?php if ($status == 'success'): ?>
                        <div class="text-center mb-4">
                            <div class="alert alert-success">
                                <h2><i class="fas fa-check-circle"></i> Payment Successful!</h2>
                                <p>Your booking has been confirmed.</p>
                            </div>
                        </div>
                    <?php elseif ($status == 'pending'): ?>
                        <div class="text-center mb-4">
                            <div class="alert alert-warning">
                                <h2><i class="fas fa-clock"></i> Payment Pending</h2>
                                <p>Your payment is being processed. Please wait for confirmation.</p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center mb-4">
                            <div class="alert alert-danger">
                                <h2><i class="fas fa-times-circle"></i> Payment Failed</h2>
                                <p>Your payment could not be processed. Please try again.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($booking_data): ?>
                        <div class="card">
                            <div class="card-header">
                                <h4>Booking Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="images/<?php echo $booking_data['CAR_IMG']; ?>" 
                                             class="img-fluid rounded" alt="<?php echo $booking_data['CAR_NAME']; ?>">
                                    </div>
                                    <div class="col-md-8">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Booking ID:</span>
                                                <strong>#<?php echo $booking_data['BOOK_ID']; ?></strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Transaction ID:</span>
                                                <strong><?php echo $booking_data['TRANSACTION_ID']; ?></strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Car:</span>
                                                <strong><?php echo $booking_data['CAR_NAME']; ?></strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Customer:</span>
                                                <strong><?php echo $booking_data['FNAME'] . ' ' . $booking_data['LNAME']; ?></strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Pickup Date:</span>
                                                <strong><?php echo $booking_data['BOOK_DATE']; ?></strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Return Date:</span>
                                                <strong><?php echo $booking_data['RETURN_DATE']; ?></strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Duration:</span>
                                                <strong><?php echo $booking_data['DURATION']; ?> days</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Total Amount:</span>
                                                <strong>Rp <?php echo number_format($booking_data['PRICE'], 0, ',', '.'); ?></strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Status:</span>
                                                <strong class="<?php echo ($status == 'success') ? 'text-success' : (($status == 'pending') ? 'text-warning' : 'text-danger'); ?>">
                                                    <?php echo $booking_data['BOOK_STATUS']; ?>
                                                </strong>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="text-center mt-4">
                        <a href="bookinstatus.php" class="btn btn-primary">View My Bookings</a>
                        <a href="cardetails.php" class="btn btn-secondary ms-3">Back to Cars</a>
                        <?php if ($status == 'failed'): ?>
                            <a href="booking.php?id=<?php echo $booking_data['CAR_ID']; ?>" class="btn btn-warning ms-3">Try Again</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>