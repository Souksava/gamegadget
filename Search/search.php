<?php 
SESSION_START();
require '../Administrator/oop/connect.php';
date_default_timezone_set("Asia/Bangkok");
$datenow = time();
$Date = date("Y-m-d",$datenow);
$sqlshop = "select * from shop;";
$resultshop = mysqli_query($conn,$sqlshop);
$rowshop = mysqli_fetch_array($resultshop,MYSQLI_ASSOC);
require '../config.php';
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
	<link rel="icon" type="image/png" href="../backend/image/<?php echo $rowshop['img_title']; ?>">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	
	<!-- StyleSheet -->
	
	<!-- Bootstrap -->
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
                                    <li><i class="ti-power-off"></i><a href="../Check/Logout">ອອກຈາກລະບົບ</a></li>
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
                        <div class="logo">
							<a href="../Home"><img src="http://backend.gamegadgetlao.com/image/<?php echo $rowshop['img_path']; ?>" alt="" width="60%"></a>
						</div>
						<!--/ End Logo -->
						<!-- Search Form -->
						<div class="search-top">
							<div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
							<!-- Search Form -->
							<div class="search-top">
								<form action="Search" method="GET" id="formserach" class="search-form">
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
								<form action="Search" method="GET" id="formserach">
									<input name="id" placeholder="Product Name, Brand" type="search">
									<button type="submit" class="btnn"><i class="ti-search"></i></button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-3 col-12 font12">
					<?php 
							if(isset($_SESSION['ses_id']) != ''){
							$cus_id = $_SESSION['cus_id'];
							$sqlsumlist = "select sum((p.price-promotion) * l.qty) as amount,count(l.pro_id) as countorder from listselldetail l left join product p on l.pro_id=p.pro_id where l.cus_id = '$cus_id';";
							$resultsumlist = mysqli_query($conn,$sqlsumlist);               
							$rowsumlist = mysqli_fetch_array($resultsumlist,MYSQLI_ASSOC);
							$sqllistfbck = "select l.detail_id,l.pro_id,pro_name,l.color_id,l.qty,p.price,promotion,p.price-promotion as newprice,(promotion / p.price) * 100 as perzen,cate_name,cated_name,brand_name,unit_name,color_name,p.img_path from listselldetail l left join product p on l.pro_id=p.pro_id left join categorydetail d on p.cated_id=d.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id left join category c on d.cate_id=c.cate_id left join product_color o on l.color_id=o.color_id where l.cus_id = '$cus_id';";
							$resultlistfbck = mysqli_query($conn,$sqllistfbck);               
							if(mysqli_num_rows($resultlistfbck) > 0){
						?>
						<div class="right-bar">
							<!-- Search Form -->					
							<div class="sinlge-bar shopping">
								<a href="#" class="single-icon"><i class="ti-bag"></i> <span class="total-count"><?php echo $rowsumlist['countorder']; ?></span></a>
								<!-- Shopping Item -->
								<div class="shopping-item">
									<div class="dropdown-cart-header">
										<span><?php echo $rowsumlist['countorder']; ?> Items</span>
										<a href="../Basket/Basket">View Cart</a>
									</div>
									<ul class="shopping-list">
										<?php 
										  $sqllistfb = "select l.detail_id,l.pro_id,pro_name,l.color_id,l.qty,p.price,promotion,p.price-promotion as newprice,(p.price-promotion) * l.qty as total,(promotion / p.price) * 100 as perzen,cate_name,cated_name,brand_name,unit_name,color_name,p.img_path from listselldetail l left join product p on l.pro_id=p.pro_id left join categorydetail d on p.cated_id=d.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id left join category c on d.cate_id=c.cate_id left join product_color o on l.color_id=o.color_id where l.cus_id = '$cus_id';";
										  $resultlistfb = mysqli_query($conn,$sqllistfb);               
										  while($rowlistfb = mysqli_fetch_array($resultlistfb,MYSQLI_ASSOC)){
										?>
										<li>
											<a class="cart-img" href="#"><img src="http://backend.gamegadgetlao.com/image/<?php echo $rowlistfb['img_path']; ?>" style="width: 70px;height:70px;" alt="#"></a>
											<h4><a href="#"><?php echo $rowlistfb['cate_name']; ?> <?php echo $rowlistfb['brand_name']; ?> <?php echo $rowlistfb['pro_name']; ?> <?php echo $rowlistfb['cated_name']; ?></a></h4>
											<p class="quantity"><?php echo $rowlistfb['qty']; ?>x - <span class="amount"><?php echo number_format($rowlistfb['total'],2); ?></span></p>
										</li>
										<?php 
											}
										?>
									</ul>
									<div class="bottom">
										<div class="total">
											<span>Total</span>
											<span class="total-amount"><?php echo number_format($rowsumlist['amount'],2); ?> K</span>
										</div>
										<form action="../Basket/Delivery" method="POST" id="formdeli">
                                            <button type="submit" class="btn" style="font-family: 'Noto Sans Lao,Arial';width: 100%;">ດຳເນີນການສັ່ງຊື້</button>
                                        </form>
									</div>
								</div>
								<!--/ End Shopping Item -->
							</div>						
						</div>
						<?php 
							}
							else {
						?>
						<div class="right-bar">
							<!-- Search Form -->					
							<div class="sinlge-bar shopping">
								<a href="#" class="single-icon"><i class="ti-bag"></i> <span class="total-count"><?php echo $rowsumlist['countorder']; ?></span></a>
								<!-- Shopping Item -->
								<div class="shopping-item">
									<div class="dropdown-cart-header">
										<span> ກະຕ່າສິນຄ້າ</span>
										<a href="../Basket/Basket">View Cart</a>
									</div>
									<ul class="shopping-list">
										<li>
											<h4 align="center"><a href="#">ບໍ່ມີລາຍການສິນຄ້າ</a></h4>
										</li>
									</ul>
								</div>
								<!--/ End Shopping Item -->
							</div>						
						</div>
						<?php
							}
						}
						?>		
						<?php 
						if(isset($_SESSION['fb_access_token']) != ''){
							$token = $_SESSION['fb_access_token'];
							try {
								// Returns a `Facebook\FacebookResponse` object
								$response = $fb->get('/me?fields=id,name,email', $token);
							} catch(Facebook\Exceptions\FacebookResponseException $e) {
								echo 'Graph returned an error: ' . $e->getMessage();
								exit;
							} catch(Facebook\Exceptions\FacebookSDKException $e) {
								echo 'Facebook SDK returned an error: ' . $e->getMessage();
								exit;
							}
							$user = $response->getGraphUser();
							$fb_id = $user['id'];
							$sqlcus_id = "select * from customers where fb_id='$fb_id';";
							$resultcus_id = mysqli_query($conn,$sqlcus_id);
							$rowcus_id = mysqli_fetch_array($resultcus_id,MYSQLI_ASSOC);
							$cus_idfb = $rowcus_id['cus_id'];				
							$sqlsumlist = "select sum((p.price-promotion) * l.qty) as amount,count(l.pro_id) as countorder from listselldetail l left join product p on l.pro_id=p.pro_id where l.cus_id = '$cus_idfb';";
							$resultsumlist = mysqli_query($conn,$sqlsumlist);               
							$rowsumlist = mysqli_fetch_array($resultsumlist,MYSQLI_ASSOC);
							$sqllistfbck = "select l.detail_id,l.pro_id,pro_name,l.color_id,l.qty,p.price,promotion,p.price-promotion as newprice,(promotion / p.price) * 100 as perzen,cate_name,cated_name,brand_name,unit_name,color_name,p.img_path from listselldetail l left join product p on l.pro_id=p.pro_id left join categorydetail d on p.cated_id=d.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id left join category c on d.cate_id=c.cate_id left join product_color o on l.color_id=o.color_id where l.cus_id = '$cus_idfb';";
							$resultlistfbck = mysqli_query($conn,$sqllistfbck);               
							if(mysqli_num_rows($resultlistfbck) > 0){
						?>
						<div class="right-bar">
							<!-- Search Form -->					
							<div class="sinlge-bar shopping">
								<a href="#" class="single-icon"><i class="ti-bag"></i> <span class="total-count"><?php echo $rowsumlist['countorder']; ?></span></a>
								<!-- Shopping Item -->
								<div class="shopping-item">
									<div class="dropdown-cart-header">
										<span><?php echo $rowsumlist['countorder']; ?> Items</span>
										<a href="../Basket/Basket">View Cart</a>
									</div>
									<ul class="shopping-list">
										<?php 
										  $sqllistfb = "select l.detail_id,l.pro_id,pro_name,l.color_id,l.qty,p.price,promotion,p.price-promotion as newprice,(p.price-promotion) * l.qty as total,(promotion / p.price) * 100 as perzen,cate_name,cated_name,brand_name,unit_name,color_name,p.img_path from listselldetail l left join product p on l.pro_id=p.pro_id left join categorydetail d on p.cated_id=d.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id left join category c on d.cate_id=c.cate_id left join product_color o on l.color_id=o.color_id where l.cus_id = '$cus_idfb';";
										  $resultlistfb = mysqli_query($conn,$sqllistfb);               
										  while($rowlistfb = mysqli_fetch_array($resultlistfb,MYSQLI_ASSOC)){
										?>
										<li>
											<a class="cart-img" href="#"><img src="http://backend.gamegadgetlao.com/image/<?php echo $rowlistfb['img_path']; ?>" style="width: 70px;height:70px;" alt="#"></a>
											<h4><a href="#"><?php echo $rowlistfb['cate_name']; ?> <?php echo $rowlistfb['brand_name']; ?> <?php echo $rowlistfb['pro_name']; ?> <?php echo $rowlistfb['cated_name']; ?></a></h4>
											<p class="quantity"><?php echo $rowlistfb['qty']; ?>x - <span class="amount"><?php echo number_format($rowlistfb['total'],2); ?></span></p>
										</li>
										<?php 
											}
										?>
									</ul>
									<div class="bottom">
										<div class="total">
											<span>Total</span>
											<span class="total-amount"><?php echo number_format($rowsumlist['amount'],2); ?> K</span>
										</div>
										<form action="../Basket/Delivery" method="POST" id="formdeli">
                                            <button type="submit" class="btn" style="font-family: 'Noto Sans Lao,Arial';width: 100%;">ດຳເນີນການສັ່ງຊື້</button>
                                        </form>
									</div>
								</div>
								<!--/ End Shopping Item -->
							</div>						
						</div>
						<?php 
							}
							else {
						?>
						<div class="right-bar">
							<!-- Search Form -->					
							<div class="sinlge-bar shopping">
								<a href="#" class="single-icon"><i class="ti-bag"></i> <span class="total-count"><?php echo $rowsumlist['countorder']; ?></span></a>
								<!-- Shopping Item -->
								<div class="shopping-item">
									<div class="dropdown-cart-header">
										<span> ກະຕ່າສິນຄ້າ</span>
										<a href="../Basket/Basket">View Cart</a>
									</div>
									<ul class="shopping-list">
										<li>
											<h4 align="center"><a href="#">ບໍ່ມີລາຍການສິນຄ້າ</a></h4>
										</li>
									</ul>
								</div>
								<!--/ End Shopping Item -->
							</div>						
						</div>
						<?php
							}
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
													<li class="active"><a href="../Home">ໜ້າຫຼັກ</a></li>																		
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
    <!-- Start Product Area -->
    <?php 
        if(isset($_GET['id'])){
        $id = "%".$_GET['id']."%";
    ?>
    <div class="product-area section" style="padding-top: 20px;">
            <div class="container font14">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
                            <?php 
                                if($_GET['id'] == ""){
                                    echo"";
                                }
                                else {
                                    echo"<h2>ຄົ້ນຫາດ້ວຍ: '".$_GET['id']."'</h2><br>";
                                }
                            ?>
							
						</div>
					</div>
				</div>
				<div class="row" style="margin-top: -80px;">
					<div class="col-12">
						<div class="product-info">
							<div class="tab-content" id="myTabContent">	
									<div class="tab-single">
										<div class="row">
											<?php 
												$sqlprobrand = "select p.pro_id,pro_name,brand_name,p.status,promotion,p.promotion,cated_name,cate_name,p.price,p.img_path,p.price-promotion as newprice,(promotion/p.price) * 100 as persen from product p left join brand b on p.brand_id=b.brand_id left join categorydetail d on p.cated_id=d.cated_id left join category c on d.cate_id=c.cate_id where cated_name like '$id' or brand_name like '$id' or pro_name like '$id' or p.pro_id like '$id' and qty != '0' order by p.pro_name;";
												$resultprobrand = mysqli_query($conn,$sqlprobrand);
												while($rowprobrand = mysqli_fetch_array($resultprobrand,MYSQLI_ASSOC)){
											?>
											<div class="col-xl-3 col-lg-4 col-md-4 col-12">
											
												<div class="single-product">
													<div class="product-img">
														<a href="../Product/Productdetail?id=<?php echo $rowprobrand['pro_id']; ?>">
															<img class="default-img" src="http://backend.gamegadgetlao.com/image/<?php echo $rowprobrand['img_path']; ?>" style="width:300px;height:280px;" alt="">
															<img class="hover-img" src="http://backend.gamegadgetlao.com/image/<?php echo $rowprobrand['img_path']; ?>" style="width:300px;height:280px;" alt="">
															<?php 
																if($rowprobrand['promotion'] != 0){
																	echo"<span class='out-of-stock'>ຫຼຸດ ".number_format($rowprobrand['persen'],2)."%</span>";
																}
																elseif($rowprobrand['status'] = "Hot" ){
																	echo"<span class='out-of-stock'>ມາແຮງ</span>";
																}
																elseif($rowprobrand['status'] = "Best Seller" ){
																	echo"<span class='out-of-stock'>ສິນຄ້າຂາຍດີ</span>";
																}
																else{
																	echo"";
																}
															?>
															
														</a>
														<div class="button-head">
															<div class="product-action-2">
																<a title="Add to cart" href="../Basket/Basket?product=<?php echo $rowprobrand['pro_id']; ?>">ເພີ່ມລົງໃນກະຕ່າ</a>
															</div>
														</div>
													</div>
													<div class="product-content">
													<h3><a href="../Product/Productdetail?id=<?php echo $rowprobrand['pro_id']; ?>"><?php echo $rowprobrand['cate_name']; ?> <?php echo $rowprobrand['brand_name']; ?> <?php echo $rowprobrand['pro_name']; ?> <br> <?php echo $rowprobrand['cated_name']; ?></a></h3>
														<div class="product-price"><br>
															<span><h4 style="color: red;"><?php echo number_format($rowprobrand['newprice'],2); ?> ກີບ </h4></span>
															<?php 
																if($rowprobrand['promotion'] > 0){
															?>
																<span class="old">ປົກກະຕິ <?php echo number_format($rowprobrand['price'],2); ?> ກີບ</span>
															<?php 
																}
																else {
																	echo"<br>";
																}
															?>
															<div class="quickview-content" style="margin-top: -30px;margin-left: -40px;"> 
																<div class="quickview-ratting-review">
																	<div class="quickview-ratting-wrap">
																		<div class="quickview-ratting">
																			<i class="yellow fa fa-star"></i>
																			<i class="yellow fa fa-star"></i>
																			<i class="yellow fa fa-star"></i>
																			<i class="yellow fa fa-star"></i>
																			<i class="fa fa-star"></i>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<?php 
												}
											?>
										</div>
									</div>
							</div>
						</div>
					</div>
				</div>
            </div>
    </div>
    <?php 
        }
    ?>
	<!-- End Product Area -->
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
			<div class="container">
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