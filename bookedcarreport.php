<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$con = mysqli_connect('localhost', 'root', '', 'carproject');
if (!$con) {
    echo 'Please check your database connection';
}

$sql = "
    SELECT 
      c.CAR_ID,
      c.CAR_NAME,
      COUNT(b.BOOK_ID) AS total_bookings
    FROM booking b
    JOIN cars c ON b.CAR_ID = c.CAR_ID
    GROUP BY b.CAR_ID
    ORDER BY total_bookings DESC
    LIMIT 5
";

$result = mysqli_query($con, $sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
