<?php
include 'result.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style/FormStyle.css">
</head>

<body>
    <h1 class="title"><span class="L">L</span>og<span class="I">I</span>n <span class="supTitile">to your home</span>
    </h1>
    <form id="msform" method="post">
        <!-- fieldsets -->
        <fieldset>
            <h2 class="fs-title">Your Account</h2>
            <h3 class="fs-subtitle">Hello again</h3>
            <input type="email" name="email" placeholder="Email" />
            <input type="password" name="pass" placeholder="Password" />
            <input type="submit" name="sub" value="Log in" class="submit">
        </fieldset>
        <div class="bar"><span>OR</span></div>
        <fieldset>
            <h2 class="fs-title">Social Profiles</h2>
            <h3 class="fs-subtitle">Your presence on the social </h3>
            <input type="button" class="Twitter" value="twitter" />
            <input type="button" class="Facebook" value="Facebook" />
            <input type="button" class="Gplus" value="Google Plus" />
        </fieldset>

    </form>
    <button class="button" role="button"><a href="SignUp.php"> Sign up now!</a></button>


    <?php
    include 'configration.php';
    $conn = mysqli_connect(servername, username, password, database);
    $flag = "";
    if (isset($_POST['sub'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$pass'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["email"] = $email;
            $flag =  "Login Successfully";
            mysqli_close($conn);
            header("location:index.php?result=" . $flag);
        } else {
            $flag = "Email or Password is incorrect";
            mysqli_close($conn);
            header("location:LoginForm.php?result=" . $flag);
        }
    }

    ?>
</body>

</html>

<?php
mysqli_close($conn);
?>