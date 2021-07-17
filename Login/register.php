<?php 
require '../Administrator/oop/connect.php';
session_start();
date_default_timezone_set("Asia/Bangkok");
$datenow = time();
$Date = date("Y-m-d",$datenow);
$sqlshop = "select * from shop;";
$resultshop = mysqli_query($conn,$sqlshop);
$rowshop = mysqli_fetch_array($resultshop,MYSQLI_ASSOC);
require 'config.php';

?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title><?php echo $rowshop['name']; ?></title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="../Administrator/image/<?php echo $rowshop['img_title']; ?>">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	
	<!-- StyleSheet -->
	
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="../css/magnific-popup.min.css">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="../css/font-awesome.css">
	<!-- Fancybox -->
	<link rel="stylesheet" href="../css/jquery.fancybox.min.css">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="../css/themify-icons.css">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="../css/niceselect.css">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="../css/animate.css">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="../css/flex-slider.min.css">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="../css/owl-carousel.css">
	<!-- Slicknav -->
    <link rel="stylesheet" href="../css/slicknav.min.css">
	
	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/responsive.css">

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
</head>
<body class="js">
	
	<!-- Preloader -->
	<!-- <div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div> -->
	<!-- End Preloader -->
	<header class="header shop">
		<!-- Topbar -->
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-12 col-12">
						<!-- Top Left -->
						<div class="top-left">
							<ul class="list-main">
								<li><i class="ti-headphone-alt"></i><?php echo $rowshop['tel']; ?></li>
								<li><i class="ti-email"></i> <?php echo $rowshop['email']; ?></li>
							</ul>
						</div>
						<!--/ End Top Left -->
					</div>
					<div class="col-lg-6 col-md-12 col-12">
						<!-- Top Right -->
						<div class="right-content font14">
							<ul class="list-main">
                                <li><i class="ti-user"></i> <a href="Register">ລົງທະບຽນ</a></li>
                                <li><i class="ti-power-off"></i><a href="Login">ເຂົ້າສູ່ລະບົບ</a></li>   
							</ul>
						</div>
						<!-- End Top Right -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Topbar -->
		<div class="middle-inner">
			<div class="container">
				<div class="row">
                    <div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
                        <div class="logo"><br>
							<a href="../Home"><img src="http://backend.gamegadgetlao.com/image/<?php echo $rowshop['img_path']; ?>" style="margin-top: -40px;" alt="" width="60%"></a>
						</div>
						<!--/ End Logo -->
						<!-- Search Form -->
						<div class="search-top">
							<div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
							<!-- Search Form -->
							<div class="search-top">
								<form action="../Search/Search" method="GET" id="formserach" class="search-form">
									<input type="text" placeholder="Product Name, Brand" name="id">
									<button type="submit"><i class="ti-search"></i></button>
								</form>
							</div>
							<!--/ End Search Form -->
						</div>
						<!--/ End Search Form -->
						<div class="mobile-nav"></div>
					</div>
					<div class="col-lg-8 col-md-7 col-12">
						<div class="search-bar-top">
							<div class="search-bar">
								<form action="../Search/Search" method="GET" id="formserach">
									<input name="id" placeholder="Product Name, Brand" type="search">
									<button type="submit" class="btnn"><i class="ti-search"></i></button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Header Inner -->
		<div class="header-inner">
			<div class="container font14">
				<div class="cat-nav-head">
					<div class="row">
						<div class="col-lg-9 col-12">
							<div class="menu-area">
								<!-- Main Menu -->
								<nav class="navbar navbar-expand-lg">
									<div class="navbar-collapse">	
										<div class="nav-inner">	
											<ul class="nav main-menu menu navbar-nav">
													<li><a href="../Home">ໜ້າຫຼັກ</a></li>																		
													<li><a href="../Contact/Contact">ຕິດຕໍ່ເຮົາ</a></li>
												</ul>
										</div>
									</div>
								</nav>
								<!--/ End Main Menu -->	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>
    <!--/ End Header -->
    <?php 
    ?>
    <div class="container font18" align="center" style="margin-top: 20px;">
        <form action="Register" method="POST" id="frmregister">
            <h3>ລົງທະບຽນ</h3><br>
            <div class="row">
                <div class="col-xs-12 col-sm-6 form-group" align="left">
                    <label>ຊື່</label>
                    <input type="text" name="cus_name" class="form-control" placeholder=" Name" style="height: 50px;">
                </div>
                <div class="col-xs-12 col-sm-6 form-group" align="left">
                    <label>ນາມສະກຸນ</label>
                    <input type="text" name="cus_surname" class="form-control" placeholder=" Surname" style="height: 50px;">
                </div>
                <div class="col-xs-12 col-sm-6 " align="left">
                <label>ເພດ</label>
                    <div class="quickview-content" style="margin-top: -40px;margin-left: -40px;width: 100%;">
                        <select class="form-control" name="gender" >
                            <option value="">ເລືອກເພດ</option>
                            <option value="ຍິງ">ຍິງ</option>
                            <option value="ຊາຍ">ຊາຍ</option>
                        </select>
                    </div>
                </div>				
                <div class="col-xs-12 col-sm-6 form-group" align="left">
                    <label>ທີ່ຢູ່ປັດຈຸບັນ</label>
                    <input type="text" name="address" class="form-control" placeholder=" Address" style="height: 50px;">
                </div>
                <div class="col-xs-12 col-sm-6 form-group" align="left">
                    <label>ເບີໂທລະສັບ</label>
                    <input type="text" name="tel" class="form-control" placeholder=" Tel" style="height: 50px;">
                </div>
                <div class="col-xs-12 col-sm-6 form-group" align="left">
                    <label>ເບີແອັບ</label>
                    <input type="text" name="tel_app" class="form-control" placeholder=" What's App" style="height: 50px;">
                </div>
                <div class="col-xs-12 col-sm-6 form-group" align="left">
                    <label>ອີເມວ</label>
                    <input type="email" name="email" class="form-control" placeholder=" Email" style="height: 50px;">
                </div>
                <div class="col-xs-12 col-sm-6 form-group" align="left">
                    <label>ລະຫັດ</label>
                    <input type="password" name="pass" class="form-control" placeholder=" Password" style="height: 50px;">
                </div>
                <div class="col-xs-12 col-sm-6 form-group" align="left">
                    <label>ຢືນຢັນລະຫັດ</label>
                    <input type="password" name="requetpass" class="form-control" placeholder=" Requet Password" style="height: 50px;">
                </div>
                <div class="col-md-12 form-group">
                    <button type="submit" style="width: 100%;" name="btnRegister" class="btn" onclick="">Register</button><br>
                </div>
            </div>                  
        </form>           
    </div>
	<!-- End Shop Home List  -->
	<section class="shop-services section home">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Free shiping</h4>
						<p>Orders over $100</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Free Return</h4>
						<p>Within 30 days returns</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Sucure Payment</h4>
						<p>100% secure payment</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Best Peice</h4>
						<p>Guaranteed price</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Services Area -->

	<!-- Start Footer Area -->
	<footer class="footer">
		<!-- Footer Top -->
		<div class="footer-top section">
			<div class="container font14">
				<div class="row">
					<div class="col-lg-5 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer about">
							<div class="logo">
								<a href="../Home"><img src="http://backend.gamegadgetlao.com/image/<?php echo $rowshop['img_path'] ?>" width="80px;" alt=""></a>
							</div>
							<p class="text">ສະຖານທີ່ຕັ້ງ: <?php echo $rowshop['address'] ?></p>
							<p class="call">ເບີໂທລະສັບຕິດຕໍ່: <span><a href="tel<?php echo $rowshop['tel'] ?>"><?php echo $rowshop['tel'] ?></a></span></p>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Information</h4>
							<ul>
			
								<li><a href="../Contact/Contact">Contact Us</a></li>

							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer social">
							<h4>Get In Tuch</h4>
							<!-- Single Widget -->
							<div class="contact">
								<ul>
									<li>Vientiane Capital Laos</li>
									<li><?php echo $rowshop['email']; ?></li>
									<li><?php echo $rowshop['tel']; ?></li>
								</ul>
							</div>
							<!-- End Single Widget -->
							<ul>
								<li><a href="#"><i class="ti-facebook"></i></a></li>
								<li><a href="#"><i class="ti-twitter"></i></a></li>
								<li><a href="#"><i class="ti-flickr"></i></a></li>
								<li><a href="#"><i class="ti-instagram"></i></a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Footer Top -->
		<div class="copyright">
			<div class="container font14">
				<div class="inner">
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="left">
								<p>Copyright © 2020 Development -  All Rights Reserved.</p>
							</div>
						</div>
						
						<div class="col-lg-6 col-12">
							<div class="center">
							<?php 
								$sqlcredit = "select * from credit_card";
								$resultcredit = mysqli_query($conn,$sqlcredit);
								while($rowcredit = mysqli_fetch_array($resultcredit,MYSQLI_ASSOC)){
							?>
								&nbsp;&nbsp;&nbsp; <img src="http://backend.gamegadgetlao.com/image/<?php echo $rowcredit['img_path'] ?>" width="30px;" alt="#">
							<?php 
                                }
                                if(isset($_POST['btnRegister'])){
                                    $cus_name = $_POST['cus_name'];
                                    $cus_surname = $_POST['cus_surname'];
                                    $gender = $_POST['gender'];
                                    $address = $_POST['address'];
                                    $tel = $_POST['tel'];
                                    $tel_app = $_POST['tel_app'];
                                    $email = $_POST['email'];
                                    $pass = $_POST['pass'];
                                    $requetpass = $_POST['requetpass'];
                                    if(trim($cus_name) == ""){
                                        echo"<script>";
                                        echo"window.location.href='Register?cus_name=null';";
                                        echo"</script>";
                                    }
                                    elseif (trim($cus_surname) == "") {
                                        echo"<script>";
                                        echo"window.location.href='Register?cus_surname=null';";
                                        echo"</script>";
                                    }
                                    elseif (trim($gender) == "") {
                                        echo"<script>";
                                        echo"window.location.href='Register?gender=null';";
                                        echo"</script>";
                                    }
                                    elseif (trim($address) == "") {
                                        echo"<script>";
                                        echo"window.location.href='Register?address=null';";
                                        echo"</script>";
                                    }
                                    elseif (trim($tel) == "") {
                                        echo"<script>";
                                        echo"window.location.href='Register?tel=null';";
                                        echo"</script>";
                                    }
                                    elseif (trim($email) == "") {
                                        echo"<script>";
                                        echo"window.location.href='Register?email=null';";
                                        echo"</script>";
                                    }
                                    elseif (trim($pass) == "") {
                                        echo"<script>";
                                        echo"window.location.href='Register?pass=null';";
                                        echo"</script>";
                                    }
                                    elseif (trim($requetpass) == "") {
                                        echo"<script>";
                                        echo"window.location.href='Register?requetpass=null';";
                                        echo"</script>";
                                    }
                                    else {
                                        $sqlckemail = "select * from customers where email='$email';";
                                        $resultckemail = mysqli_query($conn,$sqlckemail);
                                        if(mysqli_num_rows($resultckemail) > 0){
                                            echo"<script>";
                                            echo"window.location.href='Register?emaill2=false';";
                                            echo"</script>";
                                        }
                                        elseif (trim($pass) != trim($requetpass)) {
                                            echo"<script>";
                                            echo"window.location.href='Register?pass2=false';";
                                            echo"</script>";
                                        }
                                        else {
                                            $sqlregister = "insert into customers(cus_name,cus_surname,gender,address,tel,tel_app,email,pass) values('$cus_name','$cus_surname','$gender','$address','$tel','$tel_app','$email','$pass');";
                                            $resultregister = mysqli_query($conn,$sqlregister);
                                            if(!$resultregister){
                                                echo"<script>";
                                                echo"window.location.href='Register?save=false';";
                                                echo"</script>";
                                            }
                                            else {
                                                echo"<script>";
                                                echo"window.location.href='Login?savere=truere';";
                                                echo"</script>";
                                            }
                                        }
                                    }

                                }
                                if(isset($_GET['cus_name'])=='null'){
                                    echo'<script type="text/javascript">
                                    swal("", "ກະລຸນາປ້ອນຊື່ !!", "info");
                                    </script>';
                                }
                                if(isset($_GET['cus_surname'])=='null'){
                                    echo'<script type="text/javascript">
                                    swal("", "ກະລຸນາປ້ອນນາມສະກຸນ !!", "info");
                                    </script>';
                                }
                                if(isset($_GET['gender'])=='null'){
                                    echo'<script type="text/javascript">
                                    swal("", "ກະລຸນາເລືອກເພດ !!", "info");
                                    </script>';
                                }
                                if(isset($_GET['address'])=='null'){
                                    echo'<script type="text/javascript">
                                    swal("", "ກະລຸນາປ້ອນທີ່ຢູ່ !!", "info");
                                    </script>';
                                }
                                if(isset($_GET['tel'])=='null'){
                                    echo'<script type="text/javascript">
                                    swal("", "ກະລຸນາປ້ອນເບີໂທລະສັບ !!", "info");
                                    </script>';
                                }
                                if(isset($_GET['email'])=='null'){
                                    echo'<script type="text/javascript">
                                    swal("", "ກະລຸນາປ້ອນອີເມວ !!", "info");
                                    </script>';
                                }
                                if(isset($_GET['pass'])=='null'){
                                    echo'<script type="text/javascript">
                                    swal("", "ກະລຸນາໃສ່ລະຫັດ !!", "info");
                                    </script>';
                                }
                                if(isset($_GET['requetpass'])=='null'){
                                    echo'<script type="text/javascript">
                                    swal("", "ກະລຸນາຢືນຢັນລະຫັດ !!", "info");
                                    </script>';
                                }
                                if(isset($_GET['email2'])=='false'){
                                    echo'<script type="text/javascript">
                                    swal("", "ມີຜູ້ໃຊ້ອີເມວນີ້ແລ້ວ ກະລຸນາໃສ່ອີເມວທີ່ແຕກຕ່າງ !!", "info");
                                    </script>';
                                }
                                if(isset($_GET['pass2s'])=='false'){
                                    echo'<script type="text/javascript">
                                    swal("", "ຢືນຢັນລະຫັດຜ່ານບໍ່ຕົງກັນ ກະລຸນາລອງໃໝ່ອີກຄັ້ງ !!", "error");
                                    </script>';
                                }
                                if(isset($_GET['save'])=='false'){
                                    echo'<script type="text/javascript">
                                    swal("", "ລົງທະບຽນບໍ່ສຳເລັດ !!", "error");
                                    </script>';
                                }

							?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- /End Footer Area -->
	<!-- Jquery -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery-migrate-3.0.0.js"></script>
	<script src="../js/jquery-ui.min.js"></script>
	<!-- Popper JS -->
	<script src="../js/popper.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="../js/bootstrap.min.js"></script>
	<!-- Color JS -->
	<script src="../js/colors.js"></script>
	<!-- Slicknav JS -->
	<script src="../js/slicknav.min.js"></script>
	<!-- Owl Carousel JS -->
	<script src="../js/owl-carousel.js"></script>
	<!-- Magnific Popup JS -->
	<script src="../js/magnific-popup.js"></script>
	<!-- Waypoints JS -->
	<script src="../js/waypoints.min.js"></script>
	<!-- Countdown JS -->
	<script src="../js/finalcountdown.min.js"></script>
	<!-- Nice Select JS -->
	<script src="../js/nicesellect.js"></script>
	<!-- Flex Slider JS -->
	<script src="../js/flex-slider.js"></script>
	<!-- ScrollUp JS -->
	<script src="../js/scrollup.js"></script>
	<!-- Onepage Nav JS -->
	<script src="../js/onepage-nav.min.js"></script>
	<!-- Easing JS -->
	<script src="../js/easing.js"></script>
	<!-- Active JS -->
    <script src="../js/active.js"></script>
</body>
</html>