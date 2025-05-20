<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Navbar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #ffffff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 20px;
            font-weight: bold;
            color: #000;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            list-style: none;
        }

        .navbar-nav li {
            margin-left: 20px;
        }

        .navbar-nav a {
            text-decoration: none;
            color: #000;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .navbar-nav a:hover {
            color: #007bff;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            z-index: 1000;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px 20px;
            color: #000;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .dropdown-menu a:hover {
            background-color: #f8f9fa;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .search-bar {
            display: flex;
            align-items: center;
        }

        .search-bar input[type="text"] {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 14px;
            margin-right: 10px;
        }

        .search-bar button {
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 5px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-bar button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="navbar-brand">CARS</div>
        <ul class="navbar-nav">
            <li class="dropdown">
                <a href="#">MASTER &#9662;</a>
                <div class="dropdown-menu">
                    <a href="adminvehicle.php">Vehicle</a>
                    <a href="adminusers.php">Users</a>
                    <a href="adminmanagement.php">Admin</a>
                    <a href="adminsupplier.php">Supplier</a>
                    <a href="adminsparepart.php">Sparepart</a>
                </div>
            </li>
            <li><a href="admindash.php">Feedbacks</a></li>
            <li><a href="adminbook.php">Booking Request</a></li>
            <li><button class="nn"><a href="index.php">Logout</a></button></li>
        </ul>
        <!-- <div class="search-bar">
            <input type="text" placeholder="Search">
            <button>Search</button>
        </div> -->
    </div>

</body>
</html>
