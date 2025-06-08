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
    $query = "select * from users";
    $queryy = mysqli_query($con, $query);
    $num = mysqli_num_rows($queryy);
    ?>
    <div class="container" style="margin-top: 100px;">
        <h1 style="text-align: center; margin: 1rem 0">USERS</h1>
        <div>
            <table id="example" class="display">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>DOMICILE</th>
                        <th>NIK</th>
                        <th>PHONE NUMBER</th>
                        <th>GENDER</th>
                        <th>Password</th>
                        <th>DELETE USERS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($res = mysqli_fetch_array($queryy)) {
                    ?>
                        <tr class="active-row">
                            <td><?php echo $res['FNAME'] . "  " . $res['LNAME']; ?></php>
                            </td>
                            <td><?php echo $res['EMAIL']; ?></php>
                            </td>
                            <td><?php echo $res['DOMICILE']; ?></php>
                            </td>
                            <td><?php echo $res['NIK']; ?></php>
                            </td>
                            <td><?php echo $res['PHONE_NUMBER']; ?></php>
                            </td>
                            <td><?php echo $res['GENDER']; ?></php>
                            </td>
                            <td><?php echo  $res['PASSWORD']; ?></php>
                            </td>
                            <td><a class="btn btn-danger" href="deleteuser.php?id=<?php echo $res['EMAIL'] ?>">DELETE USER</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    window.onload = () => {
        new DataTable('#example');
    }
</script>

</html>