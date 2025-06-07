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
    $query = "SELECT *from booking ORDER BY BOOK_ID DESC";
    $queryy = mysqli_query($con, $query);

    // under processing
    $queryup = "SELECT *from booking where BOOK_STATUS = 'UNDER PROCESSING' ORDER BY BOOK_ID DESC";
    $queryyup = mysqli_query($con, $queryup);
    $numup = mysqli_num_rows($queryyup);

    // approved
    $queryapp = "SELECT *from booking where BOOK_STATUS = 'APPROVED' ORDER BY BOOK_ID DESC";
    $queryyapp = mysqli_query($con, $queryapp);
    $numapp = mysqli_num_rows($queryyapp);

    // returned (history)
    $queryret = "SELECT *from booking where BOOK_STATUS = 'RETURNED' ORDER BY BOOK_ID DESC";
    $queryyret = mysqli_query($con, $queryret);



    ?>
    <script>
        window.onload = () => {
            new DataTable('#example');
            new DataTable('#example1');
            new DataTable('#example2');
        }
    </script>
    <div class="container">
        <h1 class="header">BOOKINGS</h1>
        <h2 style="text-align: center;">Under Processing</h2>
        <div>
            <div>
                <table id="example" class="display">
                    <thead>
                        <tr>
                            <th>CAR ID</th>
                            <th>EMAIL</th>
                            <th>BOOK DATE</th>
                            <th>DURATION</th>
                            <th>PHONE NUMBER</th>
                            <th>RETURN DATE</th>
                            <th>BOOKING STATUS</th>
                            <th>TAKE METHOD</th>
                            <th>ADDRESS</th>
                            <th>APPROVE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($res = mysqli_fetch_array($queryyup)) {

                        ?>
                            <tr class="active-row">

                                <td><?php echo $res['CAR_ID']; ?></php>
                                </td>
                                <td><?php echo $res['EMAIL']; ?></php>
                                </td>
                                <td><?php echo $res['BOOK_DATE']; ?></php>
                                </td>
                                <td><?php echo $res['DURATION']; ?></php>
                                </td>
                                <td><?php echo $res['PHONE_NUMBER']; ?></php>
                                </td>
                                <td><?php echo $res['RETURN_DATE']; ?></php>
                                </td>
                                <td><?php echo $res['BOOK_STATUS']; ?></php>
                                </td>
                                <td><?php echo $res['TAKE_METHOD']; ?></php>
                                </td>
                                <td><?php echo $res['ADDRESS']; ?></php>
                                </td>
                                <td><a class="btn btn-success" href="approve.php?id=<?php echo $res['BOOK_ID'] ?>">APPROVE</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
        <br><br>
        <h2 style="text-align: center;">Approved</h2>
        <div>
            <div>
                <?php if ($numapp) { ?>
                    <table id="example1" class="display">
                        <thead>
                            <tr>
                                <th>CAR ID</th>
                                <th>EMAIL</th>
                                <th>BOOK DATE</th>
                                <th>DURATION</th>
                                <th>PHONE NUMBER</th>
                                <th>RETURN DATE</th>
                                <th>BOOKING STATUS</th>
                                <th>TAKE METHOD</th>
                                <th>ADDRESS</th>
                                <th>RETURN CAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            while ($res = mysqli_fetch_array($queryyapp)) {

                            ?>
                                <tr class="active-row">

                                    <td><?php echo $res['CAR_ID']; ?></php>
                                    </td>
                                    <td><?php echo $res['EMAIL']; ?></php>
                                    </td>
                                    <td><?php echo $res['BOOK_DATE']; ?></php>
                                    </td>
                                    <td><?php echo $res['DURATION']; ?></php>
                                    </td>
                                    <td><?php echo $res['PHONE_NUMBER']; ?></php>
                                    </td>
                                    <td><?php echo $res['RETURN_DATE']; ?></php>
                                    </td>
                                    <td><?php echo $res['BOOK_STATUS']; ?></php>
                                    </td>
                                    <td><?php echo $res['TAKE_METHOD']; ?></php>
                                    </td>
                                    <td><?php echo $res['ADDRESS']; ?></php>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="adminreturn.php?id=<?php echo $res['CAR_ID'] ?>&bookid=<?php echo $res['BOOK_ID'] ?>">Returned</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else {
                    echo "<h2 style='text-align: center'>None here!</h2>'";
                } ?>
            </div>
        </div>
        <br><br>
        <h2 style="text-align: center;">Returned</h2>
        <div>
            <div>
                <table id="example2" class="display">
                    <thead>
                        <tr>
                            <th>CAR ID</th>
                            <th>EMAIL</th>
                            <th>BOOK DATE</th>
                            <th>DURATION</th>
                            <th>PHONE NUMBER</th>
                            <th>RETURN DATE</th>
                            <th>BOOKING STATUS</th>
                            <th>TAKE METHOD</th>
                            <th>ADDRESS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($res = mysqli_fetch_array($queryyret)) {

                        ?>
                            <tr class="active-row">

                                <td><?php echo $res['CAR_ID']; ?></php>
                                </td>
                                <td><?php echo $res['EMAIL']; ?></php>
                                </td>
                                <td><?php echo $res['BOOK_DATE']; ?></php>
                                </td>
                                <td><?php echo $res['DURATION']; ?></php>
                                </td>
                                <td><?php echo $res['PHONE_NUMBER']; ?></php>
                                </td>
                                <td><?php echo $res['RETURN_DATE']; ?></php>
                                </td>
                                <td><?php echo $res['BOOK_STATUS']; ?></php>
                                </td>
                                <td><?php echo $res['TAKE_METHOD']; ?></php>
                                </td>
                                <td><?php echo $res['ADDRESS']; ?></php>
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