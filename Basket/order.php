<?php 
session_start();
if($_SESSION['ses_id'] != ''){

}
else{
    echo"<meta http-equiv='refresh' content='1;URL=../Login/Login'>";
}
require '../Administrator/oop/connect.php';
date_default_timezone_set("Asia/Bangkok");
$datenow = time();
$Date = date("Y-m-d",$datenow);
$sqlshop = "select * from shop;";
$resultshop = mysqli_query($conn,$sqlshop);
$rowshop = mysqli_fetch_array($resultshop,MYSQLI_ASSOC);
require '../Login/config.php';
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
                                    <?php 
                                        if(isset($_SESSION['ses_id']) != ''){
                                    ?>
                                        <li><i class="ti-user"></i> <a href="../Login/Login">ບັນຊີຂອງຂ້ອຍ</a></li>
                                        <li><i class="ti-power-off"></i><a href="../Check/Login">ອອກຈາກລະບົບ</a></li>
                                    <?php 
                                        }
                                        else {
                                    ?>
                                        <li><i class="ti-user"></i> <a href="../Login/Register">ລົງທະບຽນ</a></li>
                                        <li><i class="ti-power-off"></i><a href="../Login/Login">ເຂົ້າສູ່ລະບົບ</a></li>
                                    <?php
                                        }
                                    ?>
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
                    <div class="col-lg-2 col-md-3 col-12 font14">
					<?php 
                           if($_SESSION['ses_id'] != ''){
                               $cus_id2 = $_SESSION['cus_id'];
                        ?>
                            <div class="right-bar">    
                            <?php 
                                $sqlck = "select count(sell_id) as ck from sell where status='ສັ່ງຊື້ສຳເລັດ' and seen2='0' and cus_id='$cus_id2';";
                                $resultck = mysqli_query($conn,$sqlck);
                                $rowck = mysqli_fetch_array($resultck, MYSQLI_ASSOC);
                            ?>
                                <div class="sinlge-bar shopping">
                                    <a href="Order">
                                        <img src="../icon/bill.ico" alt="" style="width: 35px;height: 35px;">
                                        <label>ບິນສັ່ງຊື້ <span class="badge badge-warning"><?php echo $rowck['ck'];?></span></label>
                                    </a>
                                </div>
                            </div>
                        <?php 
                            }
                        ?>
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
	</header><br>
    <!--/ End Header -->
    <?php 
        if($_SESSION['ses_id'] != ''){
            $cus_id = $_SESSION['cus_id'];
    ?>
    <div class="container font14">
        <div class="table-responsive">
            <table class="table">
            <tr class="warning">
                <th>
                    #
                </th>
                <th>
                    ເລກທີບິນ
                </th>
                <th>
                    ລູກຄ້າ
                </th>
                <th>
                    ຍອດລວມ
                </th>
                <th>
                    ວັນທີ
                </th>
                <th>
                    ເວລາ
                </th>
                <th>
                    ສະຖານະ
                </th>
                <th>
                    ການຈ່າຍເງິນ
                </th>
                <th></th>
            </tr>
            <?php
                $sql = "select sell_id,cus_name,sell_date,sell_time,amount,s.status,status_cash from sell s left join customers c on s.cus_id=c.cus_id where status='ສັ່ງຊື້ສຳເລັດ' and s.cus_id='$cus_id' order by sell_date desc;";
				$result = mysqli_query($conn,$sql);
				$No_ = 0;
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            ?>
            <tr>
                <td><?php echo $No_ += 1; ?></td>
                <td><?php echo $row['sell_id'] ?></td>
                <td><?php echo $row['cus_name'] ?></td>
                <td><?php echo number_format($row['amount'],2) ?></td>
                <td><?php echo $row['sell_date'] ?></td>
                <td><?php echo $row['sell_time'] ?></td>
                <td><?php echo $row['status'] ?></td>
                <td><?php echo $row['status_cash'] ?></td>
                <td>
                    <a href="Billdetail?id=<?php echo $row['sell_id'] ?>">
                        <img src="../icon/info.ico" alt="" width="20px">&nbsp&nbsp
                    </a>
                </td>
            </tr>
            <?php
                }
            
            ?>
            </table>
        </div>
    </div>
    <?php 
        }
    ?>
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
                                if(isset($_GET['email'])=='not'){
                                    echo'<script type="text/javascript">
                                    swal("", "ກະລຸນາປ້ອນອີເມວ !!", "info");
                                    </script>';
                                 
                                }
                                if(isset($_GET['pass'])=='not'){
                                    echo'<script type="text/javascript">
                                    swal("", "ກະລຸນາປ້ອນລະຫັດຜ່ານ !!", "info");
                                    </script>';
                                }
                                if(isset($_GET['found'])=='true'){
                                    echo'<script type="text/javascript">
                                    swal("", "ອີ່ເມວ ຫຼື ລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ ກະລຸນາລອງໃໝ່ອີກຄັ້ງ !!", "error");
                                    </script>';
                                }
								if(isset($_GET['savere'])=='truere'){
                                    echo'<script type="text/javascript">
                                    swal("", "ລົງທະບຽນສຳເລັດ !!", "success");
                                    </script>';
                                }
                                if(isset($_GET['save1'])=='false1'){
                                    echo'<script type="text/javascript">
                                    swal("", "ບໍ່ສາມາດສັ່ງຊື້ສິນຄ້າໄດ້ ກະລຸນາລອງໃໝ່ອີກຄັ້ງ !!", "error");
                                    </script>';
                                }
                                if(isset($_GET['save2'])=='false2'){
                                    echo'<script type="text/javascript">
                                    swal("", "ບໍ່ສາມາດສັ່ງຊື້ສິນຄ້າໄດ້ ກະລຸນາລອງໃໝ່ອີກຄັ້ງ !!", "error");
                                    </script>';
                                }
                                if(isset($_GET['savet'])=='true'){
                                    echo'<script type="text/javascript">
                                    swal("", "ສັ່ງຊື້ສິນຄ້າສຳເລັດ ກະລຸນາລໍຖ້າການຕອບຮັບການສັ່ງຊື້ສິນຄ້າຈາກພະນັກງານໃນໄວໆນີ້ !!", "success");
                                    </script>';
                                }

							?>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
        <?php 
            if(isset($_GET['del'])){
                $detail_id = $_GET['del'];
                $sqldel = "delete from listselldetail where detail_id='$detail_id';";
                $resultdel = mysqli_query($conn,$sqldel);
                echo"<script>";
                echo"window.location.href='Basket';";
                echo"</script>";
            }
        ?>
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