<?php 
session_start();
require 'Administrator/oop/connect.php';
date_default_timezone_set("Asia/Bangkok");
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
    <link rel="icon" type="image/png" href="Administrator/image/<?php echo $rowshop['img_title']; ?>">
    <!-- Web Font -->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <!-- StyleSheet -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Fancybox -->
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="css/niceselect.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Flex Slider CSS -->
    <link rel="stylesheet" href="css/flex-slider.min.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="css/owl-carousel.css">
    <!-- Slicknav -->
    <link rel="stylesheet" href="css/slicknav.min.css">

    <!-- Eshop StyleSheet -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</head>

<body class="js">

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- End Preloader -->
    <!-- Header -->

    <header class="header shop">
        <!-- Topbar -->
        <div class="topbar">
            <div class="container font14">
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
									
									if(isset($_SESSION['game_gadget_customer_ses_id']) != ''){
								?>
                                <li><i class="ti-user"></i> <a href="Login/Login">ບັນຊີຂອງຂ້ອຍ</a></li>
                                <li><i class="ti-power-off"></i><a href="Check/Logout">ອອກຈາກລະບົບ</a></li>
                                <?php 
									}
									else {
								?>
                                <li><i class="ti-user"></i> <a href="Login/Register">ລົງທະບຽນ</a></li>
                                <li><i class="ti-power-off"></i><a href="Login/Login">ເຂົ້າສູ່ລະບົບ</a></li>
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
                            <a href="Home"><img src="../game_gadget_shop/image/<?php echo $rowshop['img_path']; ?>"
                                    alt="" width="100px"></a>
                        </div>
                        <!--/ End Logo -->
                        <!-- Search Form -->
                        <div class="search-top">
                            <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                            <!-- Search Form -->
                            <div class="search-top">
                                <form action="Search/Search" method="GET" id="formserach" class="search-form">
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
                                <form action="Search/Search" method="GET" id="formserach2">
                                    <input name="id" placeholder="Product Name, Brand" type="search">
                                    <button type="submit" class="btnn"><i class="ti-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-12 font12">
                        <?php 
							if(isset($_SESSION['game_gadget_customer_ses_id']) != ''){
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
                                <a href="#" class="single-icon"><i class="ti-bag"></i> <span
                                        class="total-count"><?php echo $rowsumlist['countorder']; ?></span></a>
                                <!-- Shopping Item -->
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span><?php echo $rowsumlist['countorder']; ?> Items</span>
                                        <a href="Basket/Basket">View Cart</a>
                                    </div>
                                    <ul class="shopping-list">
                                        <?php 
										  $sqllistfb = "select l.detail_id,l.pro_id,pro_name,l.color_id,l.qty,p.price,promotion,p.price-promotion as newprice,(p.price-promotion) * l.qty as total,(promotion / p.price) * 100 as perzen,cate_name,cated_name,brand_name,unit_name,color_name,p.img_path from listselldetail l left join product p on l.pro_id=p.pro_id left join categorydetail d on p.cated_id=d.cated_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id left join category c on d.cate_id=c.cate_id left join product_color o on l.color_id=o.color_id where l.cus_id = '$cus_id';";
										  $resultlistfb = mysqli_query($conn,$sqllistfb);               
										  while($rowlistfb = mysqli_fetch_array($resultlistfb,MYSQLI_ASSOC)){
										?>
                                        <li>
                                            <a class="cart-img" href="#"><img
                                                    src="../game_gadget_shop/image/<?php echo $rowlistfb['img_path']; ?>"
                                                    style="width: 70px;height:70px;" alt="#"></a>
                                            <h4><a href="#"><?php echo $rowlistfb['cate_name']; ?>
                                                    <?php echo $rowlistfb['brand_name']; ?>
                                                    <?php echo $rowlistfb['pro_name']; ?>
                                                    <?php echo $rowlistfb['cated_name']; ?></a></h4>
                                            <p class="quantity"><?php echo $rowlistfb['qty']; ?>x - <span
                                                    class="amount"><?php echo number_format($rowlistfb['total'],2); ?></span>
                                            </p>
                                        </li>
                                        <?php 
											}
										?>
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span
                                                class="total-amount"><?php echo number_format($rowsumlist['amount'],2); ?>
                                                K</span>
                                        </div>
                                        <form action="Basket/Delivery" method="POST" id="formdeli">
                                            <button type="submit" class="btn"
                                                style="font-family: 'Noto Sans Lao,Arial';width: 100%;">ດຳເນີນການສັ່ງຊື້</button>
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
                                <a href="#" class="single-icon"><i class="ti-bag"></i> <span
                                        class="total-count"><?php echo $rowsumlist['countorder']; ?></span></a>
                                <!-- Shopping Item -->
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span> ກະຕ່າສິນຄ້າ</span>
                                        <a href="Basket/Basket">View Cart</a>
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
                        <div class="col-lg-3">
                            <div class="all-category">
                                <h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>ປະເພດສິນຄ້າ</h3>
                                <ul class="main-category">
                                    <?php 
										$sqlcate = "select * from category order by cate_id asc limit 0,13;";
										$resultcate = mysqli_query($conn,$sqlcate);
										while($rowcate = mysqli_fetch_array($resultcate,MYSQLI_ASSOC)){
									?>
                                    <li><a href="#"><img
                                                src="../game_gadget_shop/image/<?php echo $rowcate['img_path']; ?>"
                                                width="15px;" alt=""> <?php echo $rowcate['cate_name']; ?> <i
                                                class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <ul class="sub-category">
                                            <?php 
												$cate_id = $rowcate['cate_id'];
												$sqlcatedetail = "select * from categorydetail where cate_id='$cate_id' order by cated_name asc;";
												$resultcatedetail = mysqli_query($conn,$sqlcatedetail);
												while($rowcatedetail = mysqli_fetch_array($resultcatedetail,MYSQLI_ASSOC)){
											?>
                                            <li><a
                                                    href="Search/Search?id=<?php echo $rowcatedetail['cated_name'] ?>"><?php echo $rowcatedetail['cated_name']; ?></a>
                                            </li>
                                            <?php 
												}
											?>
                                        </ul>
                                    </li>
                                    <?php 
										}
									?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 col-12">
                            <div class="menu-area">
                                <!-- Main Menu -->
                                <nav class="navbar navbar-expand-lg">
                                    <div class="navbar-collapse">
                                        <div class="nav-inner">
                                            <ul class="nav main-menu menu navbar-nav">
                                                <li class="active"><a href="#">ໜ້າຫຼັກ</a></li>
                                                <li><a href="Contact/Contact">ຕິດຕໍ່ເຮົາ</a></li>
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

    <!-- Slider Area -->
    <section class="hero-slider">
        <?php 
		$sqlpro = "select * from product;";
		$resultpro = mysqli_query($conn,$sqlpro);
		$rowpro = mysqli_fetch_array($resultpro,MYSQLI_ASSOC);
		?>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php 
					$sqlcolors = "select min(id) as id,img_path from cover;";
					$resultcolors = mysqli_query($conn,$sqlcolors);
					$rowcolors = mysqli_fetch_array($resultcolors,MYSQLI_ASSOC);
					$sqlcolorsck = "select min(id) as id from cover;";
					$resultcolorsck = mysqli_query($conn,$sqlcolorsck);
					$rowcolorsck = mysqli_fetch_array($resultcolorsck,MYSQLI_ASSOC);
					$i = $rowcolorsck['id'];
				?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $rowcolors['id']; ?>"
                    class="active"></li>
                <?php 
					$sqlcolor = "select * from cover where id!='$i';";
					$resultcolor = mysqli_query($conn,$sqlcolor);
					while($rowcolor = mysqli_fetch_array($resultcolor,MYSQLI_ASSOC)){
				?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $rowcolor['id']; ?>"></li>
                <?php 
					}
				?>
            </ol>
            <div class="carousel-inner">
                <?php 
					$sqlcolors2 = "select min(id) as id,img_path from cover;";
					$resultcolors2 = mysqli_query($conn,$sqlcolors2);
					$rowcolors2 = mysqli_fetch_array($resultcolors2,MYSQLI_ASSOC);
				?>
                <div class="carousel-item active">
                    <img class="d-block w-100" src="../game_gadget_shop/image/<?php echo $rowcolors2['img_path']; ?>"
                        width="100%" alt="">
                </div>
                <?php 
						$sqlcolor2 = "select * from cover where id!='$i'";
						$resultcolor2 = mysqli_query($conn,$sqlcolor2);
						while($rowcolor2 = mysqli_fetch_array($resultcolor2,MYSQLI_ASSOC)){
							if($rowcolor2["img_path"] == ""){
								$rowcolor2["img_path"] = "logo_front.png";
							}
				?>
                <div class="carousel-item">
                    <img class="d-block w-100" src="../game_gadget_shop/image/<?php echo $rowcolor2['img_path']; ?>"
                        width="100%" alt="">
                </div>
                <?php 
						}
				?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <!--/ End Slider Area -->
    <div class="product-area most-popular section" style="margin-top: -60px;">
        <div class="container font14">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>ສິນຄ້າລົດລາຄາ</h2>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: -60px;">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                        <!-- Start Single Product -->
                        <?php 
							$sqlshow = "select p.pro_id,pro_name,brand_name,cated_name,cate_name,p.price,p.img_path,p.price-promotion as newprice,(promotion/p.price) * 100 as persen from product p left join categorydetail d on p.cated_id=d.cated_id left join brand b on p.brand_id=b.brand_id left join category c on d.cate_id=c.cate_id where promotion != '0' and qty != '0' order by time_stamp desc;";
							$resultshow = mysqli_query($conn,$sqlshow);
							while($rowshow = mysqli_fetch_array($resultshow,MYSQLI_ASSOC)){
								if($rowshow["img_path"] == ""){
									$rowshow["img_path"] = "logo_front.png";
								}
						?>
                        <div class="single-product">
                            <div class="product-img">
                                <a href="Product/Productdetail?id=<?php echo $rowshow['pro_id']; ?>">
                                    <img class="default-img"
                                        src="../game_gadget_shop/image/<?php echo $rowshow['img_path']; ?>"
                                        style="width:300px;height:280px;" alt="">
                                    <img class="hover-img"
                                        src="../game_gadget_shop/image/<?php echo $rowshow['img_path']; ?>"
                                        style="width:300px;height:280px;" alt="">
                                    <span class="out-of-stock">ຫຼຸດ
                                        <?php echo number_format($rowshow['persen'],2); ?>%</span>
                                </a>
                                <div class="button-head">
                                    <div class="product-action-2">
                                        <a title="Add to cart"
                                            href="Basket/Basket?product=<?php echo $rowshow['pro_id']; ?>">ເພີ່ມລົງໃນກະຕ່າ</a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">

                                <h3><a href="Product/Productdetail?id=<?php echo $rowshow['pro_id']; ?>"><?php echo $rowshow['cate_name']; ?>
                                        <?php echo $rowshow['brand_name']; ?> <?php echo $rowshow['pro_name']; ?> <br>
                                        <?php echo $rowshow['cated_name']; ?></a></h3>
                                <div class="product-price"><br>
                                    <span>
                                        <h4 style="color: #C72214;"><?php echo number_format($rowshow['newprice'],2); ?>
                                            ກີບ </h4>
                                    </span>
                                    <span class="old">ປົກກະຕິ <?php echo number_format($rowshow['price'],2); ?>
                                        ກີບ</span>
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
                        <?php 
							}
						?>
                        <!-- End Single Product -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Product Area -->
    <div class="product-area section" style="margin-top: -125px;">
        <div class="container font14">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Brand ສິນຄ້າ</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-info">
                        <div class="nav-main">
                            <!-- Tab Nav -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">

                                <?php 
									$sqlbrand = "select * from brand order by brand_id asc;";
									$resultbrand = mysqli_query($conn,$sqlbrand);
									while($rowbrand = mysqli_fetch_array($resultbrand,MYSQLI_ASSOC)){
								?>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                        href="#<?php echo $rowbrand['brand_id'];?>" role="tab"><img
                                            src="../game_gadget_shop/image/<?php echo $rowbrand['bimg_path'];?>"
                                            width="50px" height="50px" alt="First slide"></a></li>
                                <?php 
									}
								?>
                            </ul>
                            <!--/ End Tab Nav -->
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <?php 
									$sqlbrand2 = "select * from brand order by brand_id asc;";
									$resultbrand2 = mysqli_query($conn,$sqlbrand2);
									while($rowbrand2 = mysqli_fetch_array($resultbrand2,MYSQLI_ASSOC)){
								?>
                            <div class="tab-pane fade show" id="<?php echo $rowbrand2['brand_id'];?>" role="tabpanel">
                                <div class="tab-single">
                                    <div class="row">
                                        <?php 
												$brand_id = $rowbrand2['brand_id'];
												$sqlprobrand = "select p.pro_id,pro_name,brand_name,p.status,promotion,p.promotion,cated_name,cate_name,p.price,p.img_path,p.price-promotion as newprice,(promotion/p.price) * 100 as persen from product p left join brand b on p.brand_id=b.brand_id left join categorydetail d on p.cated_id=d.cated_id left join category c on d.cate_id=c.cate_id where b.brand_id='$brand_id' and qty != '0' order by b.brand_id asc;";
												$resultprobrand = mysqli_query($conn,$sqlprobrand);
												while($rowprobrand = mysqli_fetch_array($resultprobrand,MYSQLI_ASSOC)){
													if($rowprobrand['img_path'] == ""){
														$rowprobrand['img_path'] = "logo.ico";
													} 
											?>
                                        <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                            <div class="single-product">
                                                <div class="product-img">
                                                    <a
                                                        href="Product/Productdetail?id=<?php echo $rowprobrand['pro_id']; ?>">
                                                        <img class="default-img"
                                                            src="../game_gadget_shop/image/<?php echo $rowprobrand['img_path']; ?>"
                                                            style="width:300px;height:280px;" alt="#">
                                                        <img class="hover-img"
                                                            src="../game_gadget_shop/image/<?php echo $rowprobrand['img_path']; ?>"
                                                            style="width:300px;height:280px;" alt="#">
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
                                                            <a title="Add to cart"
                                                                href="Basket/Basket?product=<?php echo $rowprobrand['pro_id']; ?>">ເພີ່ມລົງໃນກະຕ່າ</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a
                                                            href="Product/Productdetail?id=<?php echo $rowprobrand['pro_id']; ?>"><?php echo $rowprobrand['cate_name']; ?>
                                                            <?php echo $rowprobrand['brand_name']; ?>
                                                            <?php echo $rowprobrand['pro_name']; ?> <br>
                                                            <?php echo $rowprobrand['cated_name']; ?></a></h3>
                                                    <div class="product-price"><br>
                                                        <span>
                                                            <h4 style="color: red;">
                                                                <?php echo number_format($rowprobrand['newprice'],2); ?>
                                                                ກີບ </h4>
                                                        </span>
                                                        <?php 
																if($rowprobrand['promotion'] > 0){
															?>
                                                        <span class="old">ປົກກະຕິ
                                                            <?php echo number_format($rowprobrand['price'],2); ?>
                                                            ກີບ</span>
                                                        <?php 
																}
																else {
																	echo"<br>";
																}
															?>
                                                        <div class="quickview-content"
                                                            style="margin-top: -30px;margin-left: -40px;">
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
                            <?php 
									}
								?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Area -->
    <!-- Start Most Popular -->
    <div class="product-area most-popular section" style="margin-top: -80px;">
        <div class="container font14">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>ສິນຄ້າມາແຮງ</h2>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: -60px;">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                        <!-- Start Single Product -->
                        <?php 
							$sqlshow2 = "select p.pro_id,pro_name,brand_name,cated_name,cate_name,promotion,p.price,p.img_path,p.price-promotion as newprice from product p left join categorydetail d on p.cated_id=d.cated_id left join brand b on p.brand_id=b.brand_id left join category c on d.cate_id=c.cate_id where status = 'Hot' and qty != '0' order by time_stamp desc;";
							$resultshow2 = mysqli_query($conn,$sqlshow2);
							while($rowshow2 = mysqli_fetch_array($resultshow2,MYSQLI_ASSOC)){
							$promotion = $rowshow2['promotion'];
						?>
                        <div class="single-product">
                            <div class="product-img">
                                <a href="Product/Productdetail?id=<?php echo $rowshow2['pro_id']; ?>">
                                    <img class="default-img"
                                        src="../game_gadget_shop/image/<?php echo $rowshow2['img_path']; ?>"
                                        style="width:300px;height:280px;" alt="">
                                    <img class="hover-img"
                                        src="../game_gadget_shop/image/<?php echo $rowshow2['img_path']; ?>"
                                        style="width:300px;height:280px;" alt="">
                                    <span class="out-of-stock">ມາແຮງ</span>
                                </a>
                                <div class="button-head">
                                    <div class="product-action-2">
                                        <a title="Add to cart"
                                            href="Basket/Basket?product=<?php echo $rowshow2['pro_id']; ?>">ເພີ່ມລົງໃນກະຕ່າ</a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">

                                <h3><a href="Product/Productdetail?id=<?php echo $rowshow2['pro_id']; ?>"><?php echo $rowshow2['cate_name']; ?>
                                        <?php echo $rowshow2['brand_name']; ?> <?php echo $rowshow2['pro_name']; ?> <br>
                                        <?php echo $rowshow2['cated_name']; ?></a></h3>
                                <div class="product-price"><br>
                                    <?php 
										if($promotion > 0){
									?>
                                    <span>
                                        <h4 style="color: #C72214;">
                                            <?php echo number_format($rowshow2['newprice'],2); ?> ກີບ </h4>
                                    </span>
                                    <span class="old">ປົກກະຕິ <?php echo number_format($rowshow2['price'],2); ?>
                                        ກີບ</span>
                                    <?php 
										}
										else {
									?>
                                    <span>
                                        <h4 style="color: #C72214;">
                                            <?php echo number_format($rowshow2['newprice'],2); ?> ກີບ </h4>
                                    </span>
                                    <br>
                                    <?php 
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
                        <?php 
							}
						?>
                        <!-- End Single Product -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Most Popular Area -->

    <!-- Start Shop Home List  -->
    <section class="shop-home-list section" style="margin-top: -90px;">
        <div class="container font14">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="shop-section-title">
                                <h1>ສິນຄ້າຫຼຸດລາຄາ</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Start Single List  -->
                    <div class="single-list">
                        <div class="row">
                            <?php 
							$sqlsale = "select p.pro_id,pro_name,brand_name,cated_name,cate_name,promotion,p.price,p.img_path,p.price-promotion as newprice from product p left join categorydetail d on p.cated_id=d.cated_id left join brand b on p.brand_id=b.brand_id left join category c on d.cate_id=c.cate_id where promotion > '0' and qty != '0' order by time_stamp desc limit 0,5;";
							$resultsale = mysqli_query($conn,$sqlsale);
							while($rowsale = mysqli_fetch_array($resultsale,MYSQLI_ASSOC)){
								if($rowsale["img_path"] == ""){
									$rowsale["img_path"] = "logo_front.png";
								}
						?>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="list-image overlay">
                                    <img src="../game_gadget_shop/image/<?php echo $rowsale['img_path']; ?>"
                                        style="width:230px;height:200px;" alt="">
                                    <a href="Basket/Basket?product=<?php echo $rowsale['pro_id']; ?>" class="buy"><i
                                            class="fa fa-shopping-bag"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 no-padding">
                                <div class="content">
                                    <h4 class="title"><a
                                            href="Product/Productdetail?id=<?php echo $rowsale['pro_id']; ?>"><?php echo $rowsale['cate_name']; ?>
                                            <?php echo $rowsale['brand_name']; ?> </a></h4>
                                    <h4 class="title"><a
                                            href="Product/Productdetail?id=<?php echo $rowsale['pro_id']; ?>"><?php echo $rowsale['pro_name']; ?>
                                        </a></h4>
                                    <h4 class="title"><a
                                            href="Product/Productdetail?id=<?php echo $rowsale['pro_id']; ?>"><?php echo $rowsale['cated_name']; ?>
                                        </a></h4>
                                    <p class="price with-discount"><?php echo number_format($rowsale['newprice'],2); ?>
                                        ກີບ</p>
                                    <span class="old"><s>ປົກກະຕິ <?php echo number_format($rowsale['price'],2); ?>
                                            ກີບ</s></span><br>
                                </div>
                            </div>
                            <?php 
								}
							?>
                        </div>
                    </div>
                    <!-- End Single List  -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="shop-section-title">
                                <h1>ສິນຄ້າຂາຍດີ</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Start Single List  -->
                    <div class="single-list">
                        <div class="row">
                            <?php 
							$sqlbest = "select p.pro_id,pro_name,brand_name,cated_name,cate_name,promotion,p.price,p.img_path,p.price-promotion as newprice from product p left join categorydetail d on p.cated_id=d.cated_id left join brand b on p.brand_id=b.brand_id left join category c on d.cate_id=c.cate_id where status = 'Best Seller' and qty != '0' order by time_stamp desc limit 0,5;";
							$resultbest = mysqli_query($conn,$sqlbest);
							while($rowbest = mysqli_fetch_array($resultbest,MYSQLI_ASSOC)){
						?>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="list-image overlay">
                                    <img src="../game_gadget_shop/image/<?php echo $rowbest['img_path']; ?>"
                                        style="width:230px;height:200px;" alt="">
                                    <a href="Basket/Baske?product=<?php echo $rowbest['pro_id']; ?>" class="buy"><i
                                            class="fa fa-shopping-bag"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 no-padding">
                                <div class="content">
                                    <h4 class="title"><a
                                            href="Product/Productdetail?id=<?php echo $rowbest['pro_id']; ?>"><?php echo $rowbest['cate_name']; ?>
                                            <?php echo $rowbest['brand_name']; ?> </a></h4>
                                    <h4 class="title"><a
                                            href="Product/Productdetail?id=<?php echo $rowbest['pro_id']; ?>"><?php echo $rowbest['pro_name']; ?>
                                        </a></h4>
                                    <h4 class="title"><a
                                            href="Product/Productdetail?id=<?php echo $rowbest['pro_id']; ?>"><?php echo $rowbest['cated_name']; ?>
                                        </a></h4>
                                    <p class="price with-discount"><?php echo number_format($rowbest['newprice'],2); ?>
                                        ກີບ</p>
                                    <?php 
										if($rowbest['promotion'] != 0){
											echo"<span class='old'><s>ປົກກະຕິ ".number_format($rowbest['promotion'],2)." ກີບ</s></span>";
										}
										else {
											echo"<br>";
										}
									?>
                                </div>
                            </div>
                            <?php 
								}
							?>
                        </div>
                    </div>
                    <!-- End Single List  -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="shop-section-title">
                                <h1>ສິນຄ້າຍອດລີວິວ</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Start Single List  -->
                    <div class="single-list">
                        <div class="row">
                            <?php 
							$sqltop = "select p.pro_id,pro_name,brand_name,cated_name,cate_name,promotion,p.price,p.img_path,p.price-promotion as newprice from product p left join categorydetail d on p.cated_id=d.cated_id left join brand b on p.brand_id=b.brand_id left join category c on d.cate_id=c.cate_id where status = 'Top View' and qty != '0' order by time_stamp desc;";
							$resulttop = mysqli_query($conn,$sqltop);
							while($rowtop = mysqli_fetch_array($resulttop,MYSQLI_ASSOC)){
						?>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="list-image overlay">
                                    <img src="../game_gadget_shop/image/<?php echo $rowtop['img_path']; ?>"
                                        style="width:230px;height:200px;" alt="">
                                    <a href="Basket/Basket?product=<?php echo $rowtop['pro_id']; ?>" class="buy"><i
                                            class="fa fa-shopping-bag"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 no-padding">
                                <div class="content">
                                    <h4 class="title"><a
                                            href="Product/Productdetail?id=<?php echo $rowtop['pro_id']; ?>"><?php echo $rowtop['cate_name']; ?>
                                            <?php echo $rowtop['brand_name']; ?> </a></h4>
                                    <h4 class="title"><a
                                            href="Product/Productdetail?id=<?php echo $rowtop['pro_id']; ?>"><?php echo $rowtop['pro_name']; ?>
                                        </a></h4>
                                    <h4 class="title"><a
                                            href="Product/Productdetail?id=<?php echo $rowtop['pro_id']; ?>"><?php echo $rowtop['cated_name']; ?>
                                        </a></h4>
                                    <p class="price with-discount"><?php echo number_format($rowtop['newprice'],2); ?>
                                        ກີບ</p>
                                    <?php 
										if($rowbest['promotion'] != 0){
											echo"<span class='old'><s>ປົກກະຕິ ".number_format($rowtop['promotion'],2)." ກີບ</s></span>";
										}
										else {
											echo"<br>";
										}
									?>
                                </div>
                            </div>
                            <?php 
								}
							?>
                        </div>
                    </div>
                    <!-- End Single List  -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Home List  -->
    <!-- Start Shop Services Area -->
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
                                <a href="Home"><img src="../game_gadget_shop/image/<?php echo $rowshop['img_title'] ?>"
                                        width="80px;" alt="#"></a>
                            </div>
                            <p class="text">ສະຖານທີ່ຕັ້ງ: <?php echo $rowshop['address'] ?></p>
                            <p class="call">ເບີໂທລະສັບຕິດຕໍ່: <span><a
                                        href="tel<?php echo $rowshop['tel'] ?>"><?php echo $rowshop['tel'] ?></a></span>
                            </p>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer links">
                            <h4>Information</h4>
                            <ul>
                                <li><a href="Contact/Contact">Contact Us</a></li>
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
                                <p>Copyright © 2020 Development - All Rights Reserved.</p>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="center">
                                <?php 
								$sqlcredit = "select * from credit_card";
								$resultcredit = mysqli_query($conn,$sqlcredit);
								while($rowcredit = mysqli_fetch_array($resultcredit,MYSQLI_ASSOC)){
							?>
                                &nbsp;&nbsp;&nbsp; <img
                                    src="../game_gadget_shop/image/<?php echo $rowcredit['img_path'] ?>" width="30px;"
                                    alt="#">
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
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <!-- Popper JS -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Color JS -->
    <script src="js/colors.js"></script>
    <!-- Slicknav JS -->
    <script src="js/slicknav.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="js/owl-carousel.js"></script>
    <!-- Magnific Popup JS -->
    <script src="js/magnific-popup.js"></script>
    <!-- Waypoints JS -->
    <script src="js/waypoints.min.js"></script>
    <!-- Countdown JS -->
    <script src="js/finalcountdown.min.js"></script>
    <!-- Nice Select JS -->
    <script src="js/nicesellect.js"></script>
    <!-- Flex Slider JS -->
    <script src="js/flex-slider.js"></script>
    <!-- ScrollUp JS -->
    <script src="js/scrollup.js"></script>
    <!-- Onepage Nav JS -->
    <script src="js/onepage-nav.min.js"></script>
    <!-- Easing JS -->
    <script src="js/easing.js"></script>
    <!-- Active JS -->
    <script src="js/active.js"></script>
</body>

</html>