<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKING STATUS</title>
</head>
<body>
<style>
* {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
    box-sizing: border-box;
}

body {
    background: url("images/carbg2.jpg");
    background-position: center;
    background-size: cover;
    background-attachment: fixed;
    min-height: 100vh;
    padding: 20px;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(255, 255, 255, 0.95);
    padding: 1rem 2rem;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    flex-wrap: wrap;
    gap: 1rem;
}

.home-button {
    background: #ff7200;
    border: none;
    padding: 12px 24px;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    color: white;
    font-weight: bold;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
}

.home-button:hover {
    background: #e55a00;
    transform: translateY(-2px);
}

.return-button {
    background: #28a745;
    border: none;
    padding: 12px 24px;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    color: white;
    font-weight: bold;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
}

.return-button:hover {
    background: #218838;
    transform: translateY(-2px);
}

.return-button:disabled {
    background: #6c757d;
    cursor: not-allowed;
    transform: none;
}

.returned-badge {
    background: #dc3545;
    border: none;
    padding: 12px 24px;
    font-size: 16px;
    border-radius: 8px;
    color: white;
    font-weight: bold;
    cursor: not-allowed;
}

.user-name {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
}

.booking-card {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 248, 248, 0.95) 100%);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    padding: 2rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    margin-bottom: 1.5rem;
}

.card-content {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 2rem;
    align-items: start;
}

.car-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.booking-details {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.details-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
}

.detail-item {
    background: rgba(255, 255, 255, 0.7);
    padding: 1rem;
    border-radius: 12px;
    border-left: 4px solid #ff7200;
}

.detail-label {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0.5rem;
    font-weight: normal;
}

.detail-value {
    font-size: 1.3rem;
    font-weight: bold;
    color: #333;
    margin: 0;
}

.status-item {
    background: rgba(255, 255, 255, 0.7);
    padding: 1.5rem;
    border-radius: 12px;
    text-align: center;
    border: 2px solid #ff7200;
}

.status-value {
    font-size: 1.5rem;
    font-weight: bold;
    color: #ff7200;
    margin: 0;
    text-transform: uppercase;
}

.status-value.returned {
    color: #dc3545;
}

.status-value.confirmed {
    color: #28a745;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 1.5rem;
}

.no-bookings {
    text-align: center;
    background: rgba(255, 255, 255, 0.95);
    padding: 3rem;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.no-bookings h2 {
    color: #ff7200;
    margin-bottom: 1rem;
}

.no-bookings p {
    color: #666;
    font-size: 1.1rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .header {
        flex-direction: column;
        text-align: center;
    }
    
    .card-content {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .car-image {
        height: 250px;
    }
    
    .details-row {
        grid-template-columns: 1fr;
    }
    
    .user-name {
        font-size: 1.2rem;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: center;
    }
}

@media (max-width: 480px) {
    body {
        padding: 10px;
    }
    
    .booking-card {
        padding: 1rem;
    }
    
    .header {
        padding: 1rem;
    }
}
</style>

<?php
    require_once('connection.php');
    $email = $_SESSION['email'];

    // Get user information
    $sql_user = "SELECT * FROM users WHERE EMAIL='$email'";
    $user_result = mysqli_query($con, $sql_user);
    $user_data = mysqli_fetch_assoc($user_result);

    // Get all bookings for the user, ordered by most recent first
    $sql_bookings = "SELECT * FROM booking WHERE EMAIL='$email' ORDER BY BOOK_ID DESC";
    $bookings_result = mysqli_query($con, $sql_bookings);
    
    if(mysqli_num_rows($bookings_result) == 0) {
?>
        <div class="container">
            <div class="header">
                <a href="cardetails.php" class="home-button">Go to Home</a>
                <div class="user-name"><?php echo $user_data['FNAME']." ".$user_data['LNAME']?> - No Bookings</div>
            </div>
            
            <div class="no-bookings">
                <h2>No Cars Booked</h2>
                <p>You haven't made any car bookings yet. Start by browsing our available cars!</p>
                <br>
                <a href="cardetails.php" class="home-button">Browse Cars</a>
            </div>
        </div>
<?php
    } else {
?>
        <div class="container">
            <div class="header">
                <a href="cardetails.php" class="home-button">Go to Home</a>
                <div class="user-name"><?php echo $user_data['FNAME']." ".$user_data['LNAME']?> - All Bookings</div>
            </div>
            
            <?php
            while($booking = mysqli_fetch_assoc($bookings_result)) {
                $car_id = $booking['CAR_ID'];
                $book_id = $booking['BOOK_ID'];
                
                // Get car details
                $sql_car = "SELECT * FROM cars WHERE CAR_ID='$car_id'";
                $car_result = mysqli_query($con, $sql_car);
                $car_data = mysqli_fetch_assoc($car_result);
                
                // Check if car is returned
                $sql_return_check = "SELECT * FROM car_returns WHERE BOOK_ID='$book_id'";
                $return_result = mysqli_query($con, $sql_return_check);
                $is_returned = mysqli_num_rows($return_result) > 0;
                
                // Determine if user can return the car
                $can_return = ($booking['BOOK_STATUS'] == 'CONFIRMED' && !$is_returned);
                
                // Get return details if returned
                $return_data = null;
                if($is_returned) {
                    $return_data = mysqli_fetch_assoc($return_result);
                }
            ?>
            
            <div class="booking-card">
                <div class="card-content">
                    <img src="images/<?php echo $car_data['CAR_IMG']?>" 
                         class="car-image" 
                         alt="<?php echo $car_data['CAR_NAME']?>">
                    
                    <div class="booking-details">
                        <div class="details-row">
                            <div class="detail-item">
                                <div class="detail-label">Booking ID</div>
                                <h2 class="detail-value">#<?php echo $booking['BOOK_ID']?></h2>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Car Name</div>
                                <h2 class="detail-value"><?php echo $car_data['CAR_NAME']?></h2>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Duration</div>
                                <h2 class="detail-value"><?php echo $booking['DURATION']?> Days</h2>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Price</div>
                                <h2 class="detail-value">Rp <?php echo number_format($booking['PRICE'])?></h2>
                            </div>
                        </div>
                        
                        <div class="details-row">
                            <div class="detail-item">
                                <div class="detail-label">Book Date</div>
                                <h2 class="detail-value"><?php echo date('M d, Y', strtotime($booking['BOOK_DATE']))?></h2>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Return Date</div>
                                <h2 class="detail-value"><?php echo date('M d, Y', strtotime($booking['RETURN_DATE']))?></h2>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Pickup Location</div>
                                <h2 class="detail-value"><?php echo $booking['BOOK_PLACE']?></h2>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Destination</div>
                                <h2 class="detail-value"><?php echo $booking['DESTINATION']?></h2>
                            </div>
                        </div>
                        
                        <div class="status-item">
                            <div class="detail-label">Booking Status</div>
                            <h2 class="status-value <?php echo $is_returned ? 'returned' : ($booking['BOOK_STATUS'] == 'CONFIRMED' ? 'confirmed' : ''); ?>">
                                <?php echo $is_returned ? 'RETURNED' : $booking['BOOK_STATUS']?>
                            </h2>
                        </div>
                        
                        <?php if($is_returned && $return_data): ?>
                        <div class="detail-item">
                            <div class="detail-label">Return Information</div>
                            <h2 class="detail-value">
                                Returned on: <?php echo date('M d, Y H:i', strtotime($return_data['RETURN_DATE']))?><br>
                                Condition: <?php echo $return_data['RETURN_CONDITION']?><br>
                                Status: <?php echo $return_data['STATUS']?>
                            </h2>
                        </div>
                        <?php endif; ?>
                        
                        <div class="action-buttons">
                            <?php if($can_return): ?>
                                <a href="returncar.php?book_id=<?php echo $book_id?>" class="return-button">Return Car</a>
                            <?php elseif($is_returned): ?>
                                <span class="returned-badge">Car Returned</span>
                            <?php else: ?>
                                <button class="return-button" disabled>Return Not Available</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php } ?>
        </div>
<?php
    }
?>
    
</body>
</html>