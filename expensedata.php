<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$con = mysqli_connect('localhost', 'root', '', 'carproject');
if (!$con) {
    echo 'Please check your database connection';
}

$query = "
  SELECT 
    DATE_FORMAT(created_at, '%Y-%m') AS month,
    SUM(price * stock) AS total_expense
  FROM master_spareparts
  WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)
  GROUP BY DATE_FORMAT(created_at, '%Y-%m')
  ORDER BY month;
";

$result = mysqli_query($con, $query);

$data = [
    'labels' => [],
    'values' => []
];

while ($row = $result->fetch_assoc()) {
    $data['labels'][] = $row['month'];
    $data['values'][] = (float) $row['total_expense'];
}

header('Content-Type: application/json');
echo json_encode($data);
