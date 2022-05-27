<?php
error_reporting(0);

$servername = "localhost";
$username = "shop_user";
$password = "zhVOXqkvsPDS95MW";
$database = "shop";
// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$message = "";

if(isset($_COOKIE["session"])) {
   
    $session = $_COOKIE["session"];
    $sql = "SELECT first_name,last_name FROM users WHERE session='$session'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
       
        $message = "شما وارد  سایت شده اید";
        header('Location:/dashboard.php');
    } else {
      
        setcookie("session", null); 
    }
    
  }


$register_message = "";
if(isset($_POST["submit"])){
$has_error = false;
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$mobile = $_POST["mobile"];
$password = $_POST["password"];

    if($_POST["first_name"] == ""){
        $message .= "<li>لطفا نام خود را وارد کنید</li>";$has_error = true;
    } 
    if($_POST["last_name"] == ""){
        $message .= "<li>لطفا نام خانوادگی خود را وارد کنید</li>";$has_error = true;
    } 
    if($_POST["mobile"] == ""){
        $message .= "<li>لطفا موبایل خود را وارد کنید</li>";$has_error = true;
    } 
    if($_POST["password"] == ""){
        $message .= "<li>لطفا رمز عبور خود را وارد کنید</li>";$has_error = true;
    } 
    if($_POST["password"] != $_POST["password_repeat"]){
        $message .= "<li>رمز عبور مطابقت ندارد</li>";$has_error = true;
    }

if($has_error == false){

    $password = md5($password);
    $sql = "INSERT INTO users (first_name, last_name, mobile , password)
VALUES ('$first_name', '$last_name', '$mobile', '$password')";

if ($conn->query($sql) === TRUE) {
    $register_message = "ثبت نام با موفقیت انجام شد";
} 

}

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/xzoom.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col col-sm-12 col-lg-3 logo">
                    <img src="assets/img/logo.jpg" id="logo">
                    <div>
                        <h1>عنوان</h1>
                        <p>توضیحات</p>
                    </div>
                </div>
                <div class="col col-sm-12 col-lg-5 search md-d-none">

                    <div class="input-group">

                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </div>
                        <input type="text" class="form-control" aria-label="Text input with dropdown button">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon1">
                                <i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>

                </div>
                <div class="col col-sm-12 col-lg-2 login md-d-none">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <a href="">
                        ورود
                    </a>
                    /
                    <a href="">
                        ثبت نام
                    </a>
                </div>
                <div class="col col-sm-12 col-lg-2 basket md-d-none">
                    <button>
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <p>سبد خرید</p>
                        <div class="basket-count">3</div>
                    </button>
                </div>
                <div class="col col-sm-12 col-lg-12 nav md-d-none">
                    <ul>
                        <li>
                            <a href="">خودرو</a>
                            <div class="mega-menu">
                                <ul class="sub-menu">
                                    <li>
                                        <a class="parent" href="">قطعات خودرو</a>

                                    </li>
                                    <li>
                                        <a href=""> لنت ترمز</a>
                                    </li>

                                </ul>
                                <img src="assets/img/menu/bmw.webp">
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

    </header>
    <main>

        <div class="container">
            <div class="row">

                <div class="col-12 col-sm-12 col-lg-12 ">



                    <div class="product-cards">

                        <div class="row">

                            <div class="col-12 col-sm-12 col-lg-12 p-5 ">
                                <?php if(strlen($message) > 0) {?>
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        <?php echo $message; ?>
                                    </ul>
                                </div>
                                <?php } ?>
                                <?php if(strlen($register_message) > 0) {?>
                                <div class="alert alert-success" role="alert">

                                    <?php echo $register_message; ?>

                                </div>
                                <?php } ?>


                                <form method="post">
                                    <div class="form-group">
                                        <label for="first_name">نام</label>
                                        <div class="col-md-4">
                                            <input type="text"
                                                <?php if(isset($_POST["first_name"])){ echo "value='".$_POST["first_name"]."'"; } ?>
                                                name="first_name" class="form-control " id="first_name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">نام خانوادگی</label>
                                        <div class="col-md-4">
                                            <input type="text"
                                                <?php if(isset($_POST["last_name"])){ echo "value='".$_POST["last_name"]."'"; } ?>
                                                name="last_name" class="form-control" id="last_name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">موبایل</label>
                                        <div class="col-md-4">
                                            <input type="text"
                                                <?php if(isset($_POST["mobile"])){ echo "value='".$_POST["mobile"]."'"; } ?>
                                                name="mobile" class="form-control" id="mobile">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="type">نوع کاربری</label>
                                        <div  class="col-md-4">
                                            <select class="form-control" id="type" name="type" >
                                                <option <?php if(isset($_POST["type"]) && $_POST["type"] == "1"){ echo "selected"; } ?> value="1">خریدار</option>
                                                <option <?php if(isset($_POST["type"]) && $_POST["type"] == "2"){ echo "selected"; } ?> value="2">فروشنده</option>

                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="password">رمز عبور</label>
                                        <div class="col-md-4">
                                            <input type="password" name="password" class="form-control" id="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_repeat">تکرار رمز عبور</label>
                                        <div class="col-md-4">
                                            <input type="password" name="password_repeat" class="form-control"
                                                id="password_repeat">
                                        </div>
                                    </div>




                                    <button type="submit" name="submit" class="btn btn-primary">ثبت نام</button>
                                </form>


                            </div>
                        </div>
                    </div>





                </div>


            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <div class="row my-5">

                <div class="col-12 col-sm-12 col-lg-3 ">
                    <ul class="links">
                        <li><a href="#">لینک</a></li>
                        <li><a href="#">لینک</a></li>
                        <li><a href="#">لینک</a></li>
                        <li><a href="#">لینک</a></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-12 col-lg-3 ">
                    <ul class="links">
                        <li><a href="#">لینک</a></li>
                        <li><a href="#">لینک</a></li>
                        <li><a href="#">لینک</a></li>
                        <li><a href="#">لینک</a></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-12 col-lg-3 ">
                    <ul class="links">
                        <li><a href="#">لینک</a></li>
                        <li><a href="#">لینک</a></li>
                        <li><a href="#">لینک</a></li>
                        <li><a href="#">لینک</a></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-12 col-lg-3 ">
                    <p>عضویت در خبرنامه</p>
                    <div class="input-group mb-2">

                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username">
                        <div class="input-group-prepend">
                            <div class="input-group-text">@</div>
                        </div>
                    </div>
                    <div class="row my-3 enamad">

                        <div class="col-12 col-sm-12 col-lg-6 ">
                            <img src="assets/img/logo.jpg">
                        </div>
                        <div class="col-12 col-sm-12 col-lg-6 ">
                            <img src="assets/img/logo.jpg">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-lg-12 ">
                    <p class="copyright">تمامی حقوق این وب سایت ...</p>
                </div>
            </div>
        </div>

    </footer>


    <div class="row m-footer active">
        <div class="col-3">
            <button id="menu"><i class="fa fa-server" aria-hidden="true"></i>
                <p>فهرست</p>
            </button>

        </div>
        <div class="col-3">
            <button id="search"><i class="fa fa-search" aria-hidden="true"></i>
                <p>جستجو</p>
            </button>

        </div>
        <div class="col-3">
            <button id="basket"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <p>سبد خرید</p>
            </button>

        </div>
        <div class="col-3">
            <button id="user"><i class="fa fa-user" aria-hidden="true"></i>
                <p>پروفایل</p>
            </button>

        </div>
    </div>

    <div class="back-drop"></div>

    <div class="mmenu" id="m-menu">
        <button class="close-mmenu"><i class="fa fa-times" aria-hidden="true"></i></button>


        <ul>
            <li><a href="#">لینک</a>
                <button><i class="fa fa-chevron-down" aria-hidden="true"></i></button>
                <ul>
                    <li><a href="#">لینک</a></li>
                    <li><a href="#">لینک</a></li>
                    <li><a href="#">لینک</a></li>
                    <li><a href="#">لینک</a></li>
                </ul>
            </li>
            <li><a href="#">لینک</a></li>
            <li><a href="#">لینک</a>
                <button><i class="fa fa-chevron-down" aria-hidden="true"></i></button>
                <ul>
                    <li><a href="#">لینک</a></li>
                    <li><a href="#">لینک</a></li>
                    <li><a href="#">لینک</a></li>
                    <li><a href="#">لینک</a></li>
                </ul>
            </li>
            <li><a href="#">لینک</a></li>
        </ul>

    </div>
    <div class="mmenu" id="m-search">
        <button class="close-mmenu"><i class="fa fa-times" aria-hidden="true"></i></button>

        <div class="input-group p-3 mb-2">
            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username">
            <div class="input-group-prepend">
                <div class="input-group-text">@</div>
            </div>
        </div>

    </div>
    <div class="mmenu" id="m-basket">
        <button class="close-mmenu"><i class="fa fa-times" aria-hidden="true"></i></button>
        mbasket
    </div>
    <div class="mmenu" id="m-user">
        <button class="close-mmenu"><i class="fa fa-times" aria-hidden="true"></i></button>
        mmenu
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>

    <script type="text/javascript" src="assets/js/xzoom.min.js"></script>


    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>