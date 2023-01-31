<?php
include('configration.php');
$conn = mysqli_connect(servername, username, password, database);
if (!$conn) {
    die("connection failed " . mysqli_connect_error());
}
$sql = "SELECT * FROM `cakes`";
$result = mysqli_query($conn, $sql);
$allCakes = "<div class='cake-container'>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $id = $row["c_id"];
        $name = $row["c_name"];
        $price = $row["c_price"];
        $photo =   base64_encode($row["c_photo"]);
        $allCakes .= "<div class='card'>";
        $allCakes .= "<img src=' data:image/jpeg;base64, $photo' alt='cake' class='cake-img'>";
        $allCakes .= "<div class='cake-info'>";
        $allCakes .= "<h3>$name</h3>";
        $allCakes .= "</div>";
        $allCakes .= "<p>$price</p>";
        $allCakes .= "<button class='addToCart'>Add to Cart</button>";
        $allCakes .= "</div>";
    }
}
$allCakes .= "</div>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chocolate</title>
    <link href="https://fonts.googleapis.com/css2?family=Martian+Mono:wght@800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3dbf1904d7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="/style/home.css">
</head>

<body>
    <!-- start nav  -->
    <div class="nav">
        Ch<span class=" brown">o</span><img src="image/logo1.png"><span class="brown">o</span>late
        <span class="line"></span>
        <div class="search">
            <input id="search-bar" name="search-bar" type="search" placeholder="Search flowers, cakes, gifts, etc.">
            <label for="search-bar" class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></label>
        </div>
        <span class="cart">
            <i class="fa-solid fa-cart-shopping"><span class="counter">0</span></i>
            <b>Cart</b>
        </span>
        <div class="cart-list display-none">
            <form method="" action="" id="cartForm" onsubmit="return false;">
                <div class="items">

                    <div class="total">
                        total = <span class="total-result">$0</span>
                    </div>
                    <input type="text" class="place-of-delivery" placeholder="Place of delivery" name="placeOfDelivery" required>
                    <div class="checkout">
                        <button class="checkout-btn" onclick="checkout()">Checkout</button>
                    </div>
                </div>
            </form>
        </div>
        <span class="account">
            <i class="fa-solid fa-user-circle"></i>
            <b>Account</b>
        </span>
    </div>

    <!-- end nav -->

    <div>
        <img src="image/Cake-banner.webp" class="banner">
    </div>

    <!-- this slideshow-container  -->




    <div class="slideshow-container ">

        <div class="mySlides fade ">
            <div class="card">
                <img src="image/c1.webp ">
            </div>
            <div class="card">
                <img src="image/c1.webp ">
            </div>
            <div class="card">
                <img src="image/c1.webp ">
            </div>
        </div>

        <div class="mySlides fade">
            <div class="card">
                <img src="image/c2.webp  ">
            </div>
            <div class="card">
                <img src="image/c2.webp  ">
            </div>
            <div class="card">
                <img src="image/c2.webp  ">
            </div>
        </div>

        <div class="mySlides fade">
            <div class="card">
                <img src="image/c3.webp  ">
            </div>
            <div class="card">
                <img src="image/c3.webp  ">
            </div>
            <div class="card">
                <img src="image/c3.webp  ">
            </div>
        </div>
    </div>
    <br>

    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>
    <!-- this end slideshow-container  -->
    <?php
    echo $allCakes;
    ?>

    <div class="go-up display-none" onclick="scrollToTop()">
        <i class="fas fa-chevron-up h4 pt-2"></i>
    </div>

    <footer>
        <p>
            <span class="brown big-size">&copy;</span>2023 WEB DEVELOPMENT I Course
            <br>
            Lecturer: Dr. Rafat Amarneh
            <br>
            Made With <i class="fas fa-heart"></i> by <a href="AboutUs" class="my-team">My <span class="small-minus-margin">Team</span></a>
        </p>
    </footer>



    <script>
        //  slideshow-container script 
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "flex";
            dots[slideIndex - 1].className += " active";
        }
        //  end slideshow-container script 


        //  go-up and navbar show and hide when scroll script
        var myNav = document.getElementsByClassName("nav")[0];
        var goUp = document.getElementsByClassName("go-up")[0];
        window.onscroll = function() {
            if (document.body.scrollTop >= 200 || document.documentElement.scrollTop >= 200) {
                myNav.classList.add("fixed");
                myNav.classList.remove("static");
                goUp.classList.add("display-block");
                goUp.classList.remove("display-none");
            } else {
                myNav.classList.add("static");
                myNav.classList.remove("fixed");
                goUp.classList.add("display-none");
                goUp.classList.remove("display-block");
            }
        };


        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
        //  end go-up and navbar show and hide when scroll script
    </script>
    <script src="/js/cart.js"></script>
    <script src="/js/checkout.js"></script>

</body>

</html>