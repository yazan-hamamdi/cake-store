
<?php
session_start();
if (!($_SESSION["email"]))
    header("location: LoginForm.php?result=" . "Please Log in first");
else {
    include '../configration.php';
    $conn = mysqli_connect(servername, username, password, database);
    if (!$conn) {
        die("connection failed " . mysqli_connect_error());
    }
    $user_email = $_SESSION["email"];
    $sql = "SELECT * FROM `users` WHERE `email` = '$user_email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $user_id = $row[0];
    $user_name = $row[1];
    $is_admin = $row[4];
    if ($is_admin == 0) {
        mysqli_close($conn);
        header("location: index.php?result=" . "you not authorized");
    }
}
$flag = "";

if (isset($_POST['add_cake'])) {
    if (!empty($_FILES["image"]["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        $cake_photo = $imgContent;
    }
    $cake_name = $_POST['cake_name'];
    $cake_price = $_POST['cake_price'];
    $check = "SELECT * FROM cakes WHERE c_name = '$cake_name'";
    $resultCheck = mysqli_query($conn, $check);
    if (mysqli_num_rows($resultCheck) > 0) {
        $flag = "cake already exists";
    } else {
        $sql = "INSERT INTO cakes (c_name, c_price, c_photo) VALUES ('$cake_name', $cake_price, '$cake_photo')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $flag = "cake added successfully";
        } else {
            $flag = "add cake failed";
        }
    }
}
mysqli_close($conn);
header("Location: ../ControlPanel.php?result=$flag");

?>
