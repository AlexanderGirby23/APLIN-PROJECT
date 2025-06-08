<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR</title>
</head>

<body>
    <?php
    require_once('adminnav.php');
    $query = "SELECT s.*, sup.supplier_name from master_spareparts s join suppliers sup on s.supplier_id = sup.supplier_id";
    $queryy = mysqli_query($con, $query);
    $num = mysqli_num_rows($queryy);
    ?>
    <script>
        window.onload = () => {
            new DataTable('#example');
        }
    </script>
    <div class="container" style="margin-top: 100px;">
        <h1 class="header">ADMIN</h1>
        <a class="btn btn-primary" href="addsparepart.php">+ ADD SPAREPART</a>
        <div>
            <table id="example" class="display">
                <thead>
                    <tr>
                        <th>Sparepart Name</th>
                        <th>Tgl Beli</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Supplier</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($res = mysqli_fetch_array($queryy)) {


                    ?>
                        <tr class="active-row">
                            <td><?php echo $res['sparepart_name']; ?></td>
                            <td><?php echo $res['created_at']; ?></td>
                            <td><?php echo $res['description']; ?></td>
                            <td><?php echo $res['price']; ?></td>
                            <td><?php echo $res['stock']; ?></td>
                            <td><?php echo $res['supplier_name']; ?></td>
                            <td>
                                <button type="submit" class="but" name="delete">
                                    <a href="deletesparepart.php?id=<?php echo $res['sparepart_id']; ?>">DELETE</a>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</body>

</html>