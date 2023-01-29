
<?php
include('configration.php');
$conn = mysqli_connect(servername, username, password, database);

if (!$conn) {
    die("connection failed " . mysqli_connect_error());
}
$total = $_POST['total'];
$place = $_POST['place'];
$itemWithQuantity = $_POST['itemWithQuantity'];
$id = 1;
$sql = "INSERT INTO `orders` (`user_id`,`the_order` , `place_of_delivery`, `total`) VALUES ('$id','$itemWithQuantity' , '$place', '$total')";


if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>