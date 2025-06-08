<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$con = mysqli_connect('localhost', 'root', '', 'carproject');
if (!$con) {
    echo 'Please check your database connection';
}

$query = "
    SELECT 
        DATE_FORMAT(BOOK_DATE, '%Y-%m') AS month,
        SUM(PRICE) AS total_expense
    FROM booking
    GROUP BY DATE_FORMAT(BOOK_DATE, '%Y-%m')
    ORDER BY month
";

$result = mysqli_query($con, $query);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
header('Content-Type: application/json');
echo json_encode($data);
