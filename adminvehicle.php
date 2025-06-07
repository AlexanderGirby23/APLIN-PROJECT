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
    require_once('connection.php');
    require_once('adminnav.php');
    require('protected.php');
    $query = "SELECT *from cars where deleted is null";
    $queryy = mysqli_query($con, $query);
    $num = mysqli_num_rows($queryy);


    ?>
    <script>
        window.onload = () => {
            new DataTable('#example');
        }
    </script>
    <div class="container" style="margin-top: 100px;">
        <div>
            <h1 class="header">CARS</h1>
            <a class="btn btn-primary float-end my-2" href="addcar.php">+ ADD CARS</a>
            <div>
                <table id="example" class="display">
                    <thead>
                        <tr>
                            <th>CAR ID</th>
                            <th>CAR NAME</th>
                            <th>FUEL TYPE</th>
                            <th>CAPACITY</th>
                            <th>PRICE</th>
                            <th>LATE CHARGE</th>
                            <th>AVAILABLE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($res = mysqli_fetch_array($queryy)) {
                        ?>
                            <tr class="active-row">

                                <td><?php echo $res['CAR_ID']; ?></php>
                                </td>
                                <td><?php echo $res['CAR_NAME']; ?></php>
                                </td>
                                <td><?php echo $res['FUEL_TYPE']; ?></php>
                                </td>
                                <td><?php echo $res['CAPACITY']; ?></php>
                                </td>
                                <td><?php echo $res['PRICE']; ?></php>
                                </td>
                                <td><?php echo $res['LATE_CHARGE']; ?></php>
                                </td>
                                <td><?php
                                    if ($res['AVAILABLE'] == 'Y') {
                                        echo 'YES';
                                    } else {
                                        echo 'NO';
                                    }
                                    ?></php>
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="editcar.php?id=<?php echo $res['CAR_ID'] ?>">EDIT CAR</a>
                                    <a class="btn btn-danger" href="deletecar.php?id=<?php echo $res['CAR_ID'] ?>">DELETE CAR</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>