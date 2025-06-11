<?php
session_start();
require_once('connection.php');
require_once('protected.php');

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$car_id = $_GET['id'];
$user_email = $_SESSION['email'];

// Get car details
$sql_car = "SELECT * FROM cars WHERE CAR_ID='$car_id' AND AVAILABLE='Y'";
$car_result = mysqli_query($con, $sql_car);
$car_data = mysqli_fetch_assoc($car_result);

if (!$car_data) {
    header('Location: cardetails.php');
    exit();
}

// Get user details
$sql_user = "SELECT * FROM users WHERE EMAIL='$user_email'";
$user_result = mysqli_query($con, $sql_user);
$user_data = mysqli_fetch_assoc($user_result);

// Handle form submission
if (isset($_POST['book_now'])) {
    $pickup_location = mysqli_real_escape_string($con, $_POST['pickup_location']);
    $booking_date = $_POST['booking_date'];
    $duration = (int)$_POST['duration'];
    $destination = mysqli_real_escape_string($con, $_POST['destination']);
    $take_method = $_POST['take_method'];
    $address = mysqli_real_escape_string($con, $_POST['address']);

    // Calculate return date and total price
    $return_date = date('Y-m-d', strtotime($booking_date . ' + ' . $duration . ' days'));
    $total_price = $car_data['PRICE'] * $duration;

    // Store booking data in session
    $_SESSION['booking_data'] = array(
        'car_id' => $car_id,
        'car_name' => $car_data['CAR_NAME'],
        'pickup_location' => $pickup_location,
        'booking_date' => $booking_date,
        'duration' => $duration,
        'destination' => $destination,
        'return_date' => $return_date,
        'total_price' => $total_price,
        'daily_price' => $car_data['PRICE'],
        'take_method' => $take_method,
        'address' => $address
    );

    // Redirect to payment processing
    header('Location: payment_process.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Car - Car Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to top, rgba(255, 255, 255, 0.750)50%), url("./images/carbg2.jpg");
            background-position: center;
            background-size: cover;
        }

        .booking-form {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="booking-form">
                    <h2 class="text-center mb-4">Book Your Car</h2>

                    <!-- Car Details -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="images/<?php echo $car_data['CAR_IMG']; ?>"
                                        class="img-fluid rounded" alt="<?php echo $car_data['CAR_NAME']; ?>">
                                </div>
                                <div class="col-md-8">
                                    <h4><?php echo $car_data['CAR_NAME']; ?></h4>
                                    <p><strong>Fuel Type:</strong> <?php echo $car_data['FUEL_TYPE']; ?></p>
                                    <p><strong>Capacity:</strong> <?php echo $car_data['CAPACITY']; ?> persons</p>
                                    <p><strong>Price per Day:</strong> Rp <?php echo number_format($car_data['PRICE'], 0, ',', '.'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Form -->
                    <form method="POST" id="bookingForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="pickup_location" class="form-label">Pickup Location</label>
                                <!-- <input type="text" class="form-control" id="pickup_location"
                                    name="pickup_location" required> -->
                                <select class="form-control" name="pickup_location" id="pickup_location"></select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="destination" class="form-label">Destination</label>
                                <!-- <input type="text" class="form-control" id="destination"
                                    name="destination" required> -->
                                <select class="form-control" name="destination" id="destination"></select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="booking_date" class="form-label">Pickup Date</label>
                                <input type="date" class="form-control" id="booking_date"
                                    name="booking_date" min="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="duration" class="form-label">Duration (Days)</label>
                                <input type="number" class="form-control" id="duration"
                                    name="duration" min="1" max="30" required onchange="calculateTotal()">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="take_method" class="form-label">Pickup Method</label>
                                <select class="form-select" id="take_method" name="take_method" required>
                                    <option value="">Choose...</option>
                                    <option value="pickup">Pickup at Location</option>
                                    <option value="delivery">Home Delivery</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="2" required></textarea>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <strong>Return Date:</strong> <span id="return_date">Please select pickup date and duration</span><br>
                            <strong>Total Price:</strong> Rp <span id="total_price">0</span>
                        </div>

                        <div class="text-center">
                            <button type="submit" name="book_now" class="btn btn-primary btn-lg">
                                Proceed to Payment
                            </button>
                            <a href="cardetails.php" class="btn btn-secondary btn-lg ms-3">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        fetch('getkota.php')
            .then(response => response.json())
            .then(data => {
                console.log(data[0]['nama_kota']);
                opt = ''
                for(i = 0;i < data.length;i++){
                    opt += '<option value="'+data[i]['nama_kota']+'">'+data[i]['nama_kota']+'</option>'
                    
                    document.getElementById("pickup_location").innerHTML = opt;
                    document.getElementById("destination").innerHTML = opt;
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });

        function calculateTotal() {
            const duration = document.getElementById('duration').value;
            const bookingDate = document.getElementById('booking_date').value;
            const pricePerDay = <?php echo $car_data['PRICE']; ?>;

            if (duration && bookingDate) {
                const totalPrice = duration * pricePerDay;
                document.getElementById('total_price').textContent = totalPrice.toLocaleString('id-ID');

                // Calculate return date
                const pickup = new Date(bookingDate);
                const returnDate = new Date(pickup);
                returnDate.setDate(pickup.getDate() + parseInt(duration));

                document.getElementById('return_date').textContent = returnDate.toISOString().split('T')[0];
            }
        }

        // Trigger calculation when booking date changes
        document.getElementById('booking_date').addEventListener('change', calculateTotal);
    </script>
</body>

</html>