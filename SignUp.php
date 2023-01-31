<?php
include 'result.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SignUp</title>
    <link rel="stylesheet" href="style/SignUpStyle.css">
</head>

<body>
    <h1 class="title"><span class="L">S</span>ign<span class="I">U</span>p<span class="supTitile"> to our store!</span>
    </h1>
    <form id="msform" method="post">
        <!-- fieldsets -->
        <fieldset>
            <h2 class="fs-title">Sign Up</h2>
            <input type="text" name="user_name" placeholder="User Name" require />
            <input type="email" name="email" placeholder="Email" require />
            <input type="password" name="pass" placeholder="Password" require />
            <input type="submit" name="sub" value="Sign Up" class="submit">
        </fieldset>
    </form>

    <button class="button" role="button"><a href="LoginForm.php"> Go to Login!</a></button>



    <?php
    include('configration.php');
    $conn = mysqli_connect(servername, username, password, database);
    $flag = "";
    if (isset($_POST['sub'])) {
        $email = $_POST['email'];
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $flag =  "Email Already Exist";
            header("location:SignUp.php?result=" . $flag);
        } else {
            $user_name = $_POST['user_name'];
            $pass = $_POST['pass'];
            $sql = "INSERT INTO users (`user_name`,`email`, `password`) VALUES ('$user_name','$email','$pass')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $flag = "Account Created Successfully";
                header("location:LoginForm.php?result=" . $flag);
            } else {
                $flag = "There is some issues please contact admin";
                header("location:SignUp.php?result=" . $flag);
            }
        }
    }


    ?>
</body>

</html>
<?php
mysqli_close($conn);
?>