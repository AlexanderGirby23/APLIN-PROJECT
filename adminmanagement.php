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
    require_once('connection.php');
    require('protected.php');
    $query = "SELECT *from admin";
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
        <a class="btn btn-primary my-2" href="addadmin.php">+ ADD ADMIN</a>
        <div>
            <div>
                <table id="example" class="display">
                    <thead>
                        <tr>

                            <th>Admin ID</th>
                            <th>Admin Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php


                        while ($res = mysqli_fetch_array($queryy)) {


                        ?>
                            <tr class="active-row">

                                <td><?php echo $res['ADMIN_ID']; ?></php>
                                </td>
                                <td><?php echo $res['ADMIN_PASSWORD']; ?></php>
                                </td>
                                <td><a class="btn btn-danger" href="deleteadmin.php?id=<?php echo $res['ADMIN_ID'] ?>">DELETE ADMIN</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>

</html>