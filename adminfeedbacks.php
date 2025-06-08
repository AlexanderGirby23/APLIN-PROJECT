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
    $query = "select *from feedback";
    $queryy = mysqli_query($con, $query);
    $num = mysqli_num_rows($queryy);
    ?>
    <script>
        window.onload = () => {
            new DataTable('#example');
        }
    </script>
    <div class="container" style="margin-top: 100px;">
        <table id="example" class="display">
            <thead>
                <tr>
                    <th>FEEDBACK_ID</th>
                    <th>EMAIL</th>
                    <th>COMMENT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($res = mysqli_fetch_array($queryy)) {
                ?>
                    <tr class="active-row">
                        <td><?php echo $res['FED_ID']; ?></php>
                        </td>
                        <td><?php echo $res['EMAIL']; ?></php>
                        </td>
                        <td><?php echo $res['COMMENT']; ?></php>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>