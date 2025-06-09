<?php
require_once('connection.php');
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$email = $_SESSION['email'];
$book_id = isset($_GET['book_id']) ? $_GET['book_id'] : '';

if (empty($book_id)) {
    echo '<script>alert("Invalid booking ID.")</script>';
    echo '<script>window.location.href = "bookinstatus.php";</script>';
    exit();
}

// Verify booking belongs to user and is confirmed
$sql = "SELECT b.*, c.CAR_NAME, c.CAR_IMG, u.FNAME, u.LNAME 
        FROM booking b 
        JOIN cars c ON b.CAR_ID = c.CAR_ID 
        JOIN users u ON b.EMAIL = u.EMAIL 
        WHERE b.BOOK_ID = '$book_id' AND b.EMAIL = '$email' AND b.BOOK_STATUS = 'CONFIRMED'";
$result = mysqli_query($con, $sql);
$booking = mysqli_fetch_assoc($result);

if (!$booking) {
    echo '<script>alert("Booking not found or not eligible for return.")</script>';
    echo '<script>window.location.href = "bookinstatus.php";</script>';
    exit();
}

// Check if already returned
$check_return = "SELECT * FROM car_returns WHERE BOOK_ID = '$book_id'";
$return_result = mysqli_query($con, $check_return);
if (mysqli_num_rows($return_result) > 0) {
    echo '<script>alert("Car has already been returned.")</script>';
    echo '<script>window.location.href = "bookinstatus.php";</script>';
    exit();
}

// Handle form submission
if ($_POST) {
    $return_condition = mysqli_real_escape_string($con, $_POST['return_condition']);
    $additional_notes = mysqli_real_escape_string($con, $_POST['additional_notes']);
    $return_date = date('Y-m-d H:i:s');
    
    // Handle file uploads
    $user_photo = '';
    $car_photo = '';
    $upload_dir = 'uploads/returns/';
    
    // Create directory if it doesn't exist
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    // Upload user photo
    if (isset($_FILES['user_photo']) && $_FILES['user_photo']['error'] == 0) {
        $user_photo_name = 'user_' . $book_id . '_' . time() . '.' . pathinfo($_FILES['user_photo']['name'], PATHINFO_EXTENSION);
        $user_photo_path = $upload_dir . $user_photo_name;
        
        if (move_uploaded_file($_FILES['user_photo']['tmp_name'], $user_photo_path)) {
            $user_photo = $user_photo_name;
        }
    }
    
    // Upload car photo
    if (isset($_FILES['car_photo']) && $_FILES['car_photo']['error'] == 0) {
        $car_photo_name = 'car_' . $book_id . '_' . time() . '.' . pathinfo($_FILES['car_photo']['name'], PATHINFO_EXTENSION);
        $car_photo_path = $upload_dir . $car_photo_name;
        
        if (move_uploaded_file($_FILES['car_photo']['tmp_name'], $car_photo_path)) {
            $car_photo = $car_photo_name;
        }
    }
    
    // Insert return record
    $insert_sql = "INSERT INTO car_returns (BOOK_ID, RETURN_DATE, RETURN_CONDITION, USER_PHOTO, CAR_PHOTO, ADDITIONAL_NOTES, STATUS) 
                   VALUES ('$book_id', '$return_date', '$return_condition', '$user_photo', '$car_photo', '$additional_notes', 'PENDING_VERIFICATION')";
    
    if (mysqli_query($con, $insert_sql)) {
        // Update booking status
        $update_booking = "UPDATE booking SET BOOK_STATUS = 'RETURNED' WHERE BOOK_ID = '$book_id'";
        mysqli_query($con, $update_booking);
        
        echo '<script>alert("Car return submitted successfully! Please wait for verification.")</script>';
        echo '<script>window.location.href = "bookinstatus.php";</script>';
        exit();
    } else {
        echo '<script>alert("Error submitting return. Please try again.")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Car - <?php echo $booking['CAR_NAME']; ?></title>
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
            max-width: 800px;
            margin: 0 auto;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 248, 248, 0.95) 100%);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #ff7200;
        }

        .header h1 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .booking-info {
            background: rgba(255, 255, 255, 0.7);
            padding: 1.5rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 1.5rem;
            align-items: center;
        }

        .car-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .booking-details h3 {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .booking-details p {
            color: #666;
            margin-bottom: 0.3rem;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #ff7200;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .photo-upload {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .upload-section {
            background: rgba(255, 255, 255, 0.5);
            padding: 1.5rem;
            border-radius: 10px;
            border: 2px dashed #ff7200;
            text-align: center;
        }

        .upload-section input[type="file"] {
            margin-top: 1rem;
        }

        .upload-section p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #ff7200;
            color: white;
        }

        .btn-primary:hover {
            background: #e55a00;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #545b62;
            transform: translateY(-2px);
        }

        .required {
            color: #dc3545;
        }

        @media (max-width: 768px) {
            .booking-info {
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            .photo-upload {
                grid-template-columns: 1fr;
            }
            
            .button-group {
                flex-direction: column;
                align-items: center;
            }
            
            .container {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Return Car</h1>
            <p>Please provide the required information and photos to complete the car return process</p>
        </div>

        <div class="booking-info">
            <img src="images/<?php echo $booking['CAR_IMG']; ?>" alt="<?php echo $booking['CAR_NAME']; ?>" class="car-image">
            <div class="booking-details">
                <h3><?php echo $booking['CAR_NAME']; ?></h3>
                <p><strong>Booking ID:</strong> #<?php echo $booking['BOOK_ID']; ?></p>
                <p><strong>Customer:</strong> <?php echo $booking['FNAME'] . ' ' . $booking['LNAME']; ?></p>
                <p><strong>Book Date:</strong> <?php echo date('M d, Y', strtotime($booking['BOOK_DATE'])); ?></p>
                <p><strong>Expected Return:</strong> <?php echo date('M d, Y', strtotime($booking['RETURN_DATE'])); ?></p>
                <p><strong>Duration:</strong> <?php echo $booking['DURATION']; ?> days</p>
            </div>
        </div>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="return_condition">Car Condition <span class="required">*</span></label>
                <select name="return_condition" id="return_condition" required>
                    <option value="">Select car condition</option>
                    <option value="EXCELLENT">Excellent - No damage</option>
                    <option value="GOOD">Good - Minor wear and tear</option>
                    <option value="FAIR">Fair - Some noticeable issues</option>
                    <option value="POOR">Poor - Significant damage</option>
                </select>
            </div>

            <div class="form-group">
                <label>Photo Evidence <span class="required">*</span></label>
                <div class="photo-upload">
                    <div class="upload-section">
                        <h4>Your Photo</h4>
                        <p>Please upload a clear photo of yourself for verification</p>
                        <input type="file" name="user_photo" accept="image/*" required>
                    </div>
                    <div class="upload-section">
                        <h4>Car Photo</h4>
                        <p>Upload a photo showing the current condition of the car</p>
                        <input type="file" name="car_photo" accept="image/*" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="additional_notes">Additional Notes</label>
                <textarea name="additional_notes" id="additional_notes" placeholder="Any additional comments about the car condition, issues encountered, or other relevant information..."></textarea>
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">Submit Return</button>
                <a href="bookinstatus.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        // Preview uploaded images
        document.querySelector('input[name="user_photo"]').addEventListener('change', function(e) {
            previewImage(e.target, 'User Photo');
        });

        document.querySelector('input[name="car_photo"]').addEventListener('change', function(e) {
            previewImage(e.target, 'Car Photo');
        });

        function previewImage(input, label) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Remove existing preview if any
                    const existingPreview = input.parentNode.querySelector('.image-preview');
                    if (existingPreview) {
                        existingPreview.remove();
                    }
                    
                    // Create new preview
                    const preview = document.createElement('img');
                    preview.src = e.target.result;
                    preview.className = 'image-preview';
                    preview.style.cssText = 'width: 100%; height: 100px; object-fit: cover; margin-top: 10px; border-radius: 5px;';
                    input.parentNode.appendChild(preview);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const userPhoto = document.querySelector('input[name="user_photo"]').files[0];
            const carPhoto = document.querySelector('input[name="car_photo"]').files[0];
            
            if (!userPhoto || !carPhoto) {
                e.preventDefault();
                alert('Please upload both user photo and car photo.');
                return false;
            }
            
            // Check file size (max 5MB each)
            if (userPhoto.size > 5 * 1024 * 1024 || carPhoto.size > 5 * 1024 * 1024) {
                e.preventDefault();
                alert('Please ensure each photo is smaller than 5MB.');
                return false;
            }
        });
    </script>
</body>
</html>