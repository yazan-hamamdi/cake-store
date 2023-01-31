<?php
session_start();
include('configration.php');
include 'result.php';
$conn = mysqli_connect(servername, username, password, database);
if (!$conn) {
    die("connection failed " . mysqli_connect_error());
}
if (!($_SESSION["email"]))
    header("location: LoginForm.php?result=" . "Please Log in first");
else {
    $user_email = $_SESSION["email"];
    $sql = "SELECT * FROM `users` WHERE `email` = '$user_email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $user_id = $row[0];
    $user_name = $row[1];
    $is_admin = $row[4];
    if ($is_admin == 0)
        header("location: index.php?result=" . "you not authorized");

    $sql1 = "SELECT * FROM `users`";
    $sql2 = "SELECT * FROM `cakes`";
    $sql3 = "SELECT * FROM `orders`";

    $result1 = mysqli_query($conn, $sql1);
    $result2 = mysqli_query($conn, $sql2);
    $result3 = mysqli_query($conn, $sql3);

    $allUsers = "<table>";
    $allUsers .= "<tr>";
    $allUsers .= "<th>user id</th>";
    $allUsers .= "<th>user name</th>";
    $allUsers .= "<th>Email</th>";
    $allUsers .= "<th>Password</th>";
    $allUsers .= "<th>is admin</th>";
    $allUsers .= "</tr>";
    while ($row = mysqli_fetch_array($result1)) {
        $allUsers .= "<tr>";
        $allUsers .= "<td>" . $row[0] . "</td>";
        $allUsers .= "<td>" . $row[1] . "</td>";
        $allUsers .= "<td>" . $row[2] . "</td>";
        $allUsers .= "<td>" . $row[3] . "</td>";
        $allUsers .= "<td>" . $row[4] . "</td>";
        $allUsers .= "</tr>";
    }
    $allUsers .= "</table>";

    $allCakes = "<table>";
    $allCakes .= "<tr>";
    $allCakes .= "<th>cake id</th>";
    $allCakes .= "<th>cake name</th>";
    $allCakes .= "<th>cake price</th>";
    $allCakes .= "<th>cake photo</th>";
    $allCakes .= "</tr>";
    while ($row = mysqli_fetch_array($result2)) {
        $allCakes .= "<tr>";
        $allCakes .= "<td>" . $row[0] . "</td>";
        $allCakes .= "<td>" . $row[1] . "</td>";
        $allCakes .= "<td>" . $row[2] . "</td>";
        $photo = base64_encode($row[3]);
        $allCakes .= "<td><img src=' data:image/jpeg;base64, $photo'></td>";
        $allCakes .= "</tr>";
    }
    $allCakes .= "</table>";

    $allOrders = "<table>";
    $allOrders .= "<tr>";
    $allOrders .= "<th>order id</th>";
    $allOrders .= "<th>user id</th>";
    $allOrders .= "<th>the_order</th>";
    $allOrders .= "<th>place of delivery</th>";
    $allOrders .= "<th>total</th>";
    $allOrders .= "</tr>";
    while ($row = mysqli_fetch_array($result3)) {
        $allOrders .= "<tr>";
        $allOrders .= "<td>" . $row[0] . "</td>";
        $allOrders .= "<td>" . $row[1] . "</td>";
        $allOrders .= "<td>" . $row[2] . "</td>";
        $allOrders .= "<td>" . $row[3] . "</td>";
        $allOrders .= "<td>" . $row[4] . "</td>";
        $allOrders .= "</tr>";
    }
    $allOrders .= "</table>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Panel</title>
    <link rel="stylesheet" href="style/ControlPanel.css">
</head>

<body>
    <?php
    echo "<center><h1> Welcome: $user_name </h1>"
    ?>
    <button class='btn' onclick='location.href = "LogOut.php"'>Logout</button></center>

    <div class="main-container">

        <div class="btn-container">
            <button class="btn" onclick="users()">Users</button>
            <button class="btn" onclick="cakes()">Cakes</button>
            <button class="btn" onclick="orders()">Orders</button>
        </div>

        <div class="table-container" id="users">

            <?php
            echo $allUsers;
            ?>
            <div class="btn-container">
                <button class="btn" onclick="addUser()">Add User</button>
                <button class="btn" onclick="deleteUser()">Delete User</button>
            </div>

            <form method="post" class="addUserForm hidden-form" style="display:none" action="controlPanelValidation/addUser.php">
                <input type="text" name="user_name" placeholder="user name" require>
                <input type="email" name="email" placeholder="email" require>
                <input type="password" name="password" placeholder="password" require>
                <input type="text" name="is_admin" placeholder="is admin" require>
                <input type="submit" name="add_user" value="Add User">
            </form>

            <form method="post" class="deleteUserForm hidden-form" style="display:none" action="controlPanelValidation/deleteUser.php">
                <input type="text" name="user_id" placeholder="user id" require>
                <input type="submit" name="delete_user" value="Delete User">
            </form>
        </div>

        <div class="table-container" id="cakes">

            <?php
            echo $allCakes;
            ?>

            <div class="btn-container">
                <button class="btn" onclick="addCake()">Add Cake</button>
                <button class="btn" onclick="deleteCake()">Delete Cake</button>
            </div>

            <form method="post" class="addCakeForm hidden-form" style="display:none" action="controlPanelValidation/addCake.php" enctype="multipart/form-data">
                <input type="text" name="cake_name" placeholder="cake name" require>
                <input type="text" name="cake_price" placeholder="cake price" require>
                <input type="file" name="image" placeholder="cake photo" require>
                <input type="submit" name="add_cake" value="Add Cake">
            </form>

            <form method="post" class="deleteCakeForm hidden-form" style="display:none" action="controlPanelValidation/deleteCake.php">
                <input type="text" name="cake_id" placeholder="cake id" require>
                <input type="submit" name="delete_cake" value="Delete Cake">
            </form>

        </div>

        <div class="table-container" id="orders">
            <?php
            echo $allOrders;
            ?>
            <div class="btn-container">
                <button class="btn" onclick="deleteOrder()">Delete Order</button>
            </div>

            <form method="post" class="deleteOrderForm hidden-form" style="display:none" action="controlPanelValidation/deleteOrder.php">
                <input type="text" name="order_id" placeholder="order id" require>
                <input type="submit" name="delete_order" value="Delete Order">
            </form>

        </div>

    </div>

    <script>
        function users() {
            document.getElementById("users").style.display = "flex";
            document.getElementById("cakes").style.display = "none";
            document.getElementById("orders").style.display = "none";
        }

        function cakes() {
            document.getElementById("users").style.display = "none";
            document.getElementById("cakes").style.display = "flex";
            document.getElementById("orders").style.display = "none";
        }

        function orders() {
            document.getElementById("users").style.display = "none";
            document.getElementById("cakes").style.display = "none";
            document.getElementById("orders").style.display = "flex";
        }

        function addUser() {
            if (document.getElementsByClassName("addUserForm")[0].style.display == "flex")
                document.getElementsByClassName("addUserForm")[0].style.display = "none";
            else
                document.getElementsByClassName("addUserForm")[0].style.display = "flex";

            document.getElementsByClassName("deleteUserForm")[0].style.display = "none";
        }

        function deleteUser() {
            if (document.getElementsByClassName("deleteUserForm")[0].style.display == "flex")
                document.getElementsByClassName("deleteUserForm")[0].style.display = "none";
            else
                document.getElementsByClassName("deleteUserForm")[0].style.display = "flex";

            document.getElementsByClassName("addUserForm")[0].style.display = "none";
        }

        function addCake() {
            if (document.getElementsByClassName("addCakeForm")[0].style.display == "flex")
                document.getElementsByClassName("addCakeForm")[0].style.display = "none";
            else
                document.getElementsByClassName("addCakeForm")[0].style.display = "flex";

            document.getElementsByClassName("deleteCakeForm")[0].style.display = "none";
        }

        function deleteCake() {
            if (document.getElementsByClassName("deleteCakeForm")[0].style.display == "flex")
                document.getElementsByClassName("deleteCakeForm")[0].style.display = "none";
            else
                document.getElementsByClassName("deleteCakeForm")[0].style.display = "flex";

            document.getElementsByClassName("addCakeForm")[0].style.display = "none";
        }

        function deleteOrder() {
            if (document.getElementsByClassName("deleteOrderForm")[0].style.display == "flex")
                document.getElementsByClassName("deleteOrderForm")[0].style.display = "none";
            else
                document.getElementsByClassName("deleteOrderForm")[0].style.display = "flex";
        }
    </script>

</body>

</html>


<?php
mysqli_close($conn);
?>