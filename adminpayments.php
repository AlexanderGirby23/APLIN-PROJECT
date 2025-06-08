<?php
require_once('adminnav.php'); 

$query = "
  SELECT 
    BOOK_ID,
    EMAIL,
    CAR_ID,
    PRICE,
    PAYMENT_METHOD,
    PAYMENT_STATUS,
    TRANSACTION_ID,
    UPDATED_AT
  FROM booking
  ORDER BY UPDATED_AT DESC
";

$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Report</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#paymentTable').DataTable();
    });
  </script>
</head>

<body style="margin:100px">
  <h2>Booking Payment Report</h2>
  <table id="paymentTable" class="display">
    <thead>
      <tr>
        <th>Booking ID</th>
        <th>Email</th>
        <th>Car ID</th>
        <th>Price</th>
        <th>Method</th>
        <th>Status</th>
        <th>Transaction ID</th>
        <th>Last Updated</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= $row['BOOK_ID'] ?></td>
          <td><?= htmlspecialchars($row['EMAIL']) ?></td>
          <td><?= $row['CAR_ID'] ?></td>
          <td>Rp <?= number_format($row['PRICE'], 0, ',', '.') ?></td>
          <td><?= htmlspecialchars($row['PAYMENT_METHOD']) ?></td>
          <td><?= htmlspecialchars($row['PAYMENT_STATUS']) ?></td>
          <td><?= htmlspecialchars($row['TRANSACTION_ID']) ?></td>
          <td><?= $row['UPDATED_AT'] ?? '-' ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>
