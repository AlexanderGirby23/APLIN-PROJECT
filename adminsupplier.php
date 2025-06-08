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
    $query = "SELECT *from suppliers";
    $queryy = mysqli_query($con, $query);
    $num = mysqli_num_rows($queryy);
    ?>
    <script>
        window.onload = () => {
            new DataTable('#example');
        }
    </script>
    <div class="container" style="margin-top: 100px;">
        <h1 class="header">SUPPLIER</h1>
        <a class="btn btn-primary" href="addsupplier.php">+ ADD SUPPLIER</a>
        <div>
            <table id="example" class="display">
                <thead>
                    <tr>
                        <th>Supplier ID</th>
                        <th>Supplier Name</th>
                        <th>Contact Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php


                    while ($res = mysqli_fetch_array($queryy)) {


                    ?>
                        <tr class="active-row">
                            <td><?php echo $res['supplier_id']; ?></td>
                            <td><?php echo $res['supplier_name']; ?></td>
                            <td><?php echo $res['contact_name']; ?></td>
                            <td><?php echo $res['phone_number']; ?></td>
                            <td><?php echo $res['email']; ?></td>
                            <td><?php echo $res['address']; ?></td>
                            <td>
                                <button type="submit" class="but" name="delete">
                                    <a href="deletesupplier.php?id=<?php echo $res['supplier_id']; ?>">DELETE</a>
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