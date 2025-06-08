<?php
require_once('adminnav.php'); 

$query = "
  SELECT m.*, s.supplier_name 
  FROM master_spareparts m
  JOIN suppliers s ON m.supplier_id = s.supplier_id
  ORDER BY UPDATED_AT DESC
";

$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Report</title>
  <script>
    $(document).ready(function () {
      new DataTable('#paymentTable');
    });
  </script>
</head>

<body style="margin:100px">
  <h2>Expense Report</h2>
  <table id="paymentTable" class="display">
    <thead>
      <tr>
        <th>Sparepart Name</th>
        <th>Date</th>
        <th>Description</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Supplier</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= $row['sparepart_name'] ?></td>
          <td><?= $row['created_at'] ?></td>
          <td><?= $row['DESCRIPTION'] ?></td>
          <td>Rp <?= number_format($row['price'], 0, ',', '.') ?></td>
          <td><?= number_format($row['stock'], 0, ',', '.') ?></td>
          <td><?= $row['supplier_name'] ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>
