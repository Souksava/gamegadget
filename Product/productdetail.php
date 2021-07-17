<?php 
if(isset($_GET["id"])){
?>
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
    <link rel="icon" type="image/png" href="../Administrator/image/<?php echo $rowshop['img_title']; ?>">
    <!-- Web Font -->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

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
    <link rel="stylesheet" href="../css/reset2.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../css/jquery.wm-zoom-1.0.min.css">
    <style>
    #imagel {
        width: 100%;
    }
    </style>
</head>

<body>
    <?php 
	if(isset($_GET['id']) || isset($_GET['id']) === "" ){
		$pro_id = $_GET['id'];
	?>
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


    <!-- Header -->
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
                            <a href="../Home"><img
                                    src="../Administrator/image/<?php echo $rowshop['img_path']; ?>" alt=""
                                    width="60%"></a>
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
                                <a href="#" class="single-icon"><i class="ti-bag"></i> <span
                                        class="total-count"><?php echo $rowsumlist['countorder']; ?></span></a>
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
                                            <a class="cart-img" href="#"><img
                                                    src="../Administrator/image/<?php echo $rowlistfb['img_path']; ?>"
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
                                        <form action="../Basket/Delivery" method="POST" id="formdeli">
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
						if(isset($_SESSION['ses_id']) == ''){
						?>
                        <div class="right-bar">
                            <!-- Search Form -->
                            <div class="sinlge-bar shopping">
                                <a href="#" class="single-icon"><i class="ti-bag"></i></a>
                                <!-- Shopping Item -->
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">

                                    </div>
                                    <ul class="shopping-list" align="center">
                                        <li>
                                            <form action="../Login/Login" method="POST" id="formlogin">
                                                ຍັງບໍ່ທັນເຂົ້າສູ່ລະບົບ<br><br>
                                                <button type="submit" class="btn"
                                                    style="font-family: 'Noto Sans Lao,Arial';width: 100%;">ໄປໜ້າເຂົ້າສູ່ລະບົບ</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <!--/ End Shopping Item -->
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
                        <div class="col-lg-3">
                            <div class="all-category">
                                <h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i><a
                                        href="../Home">ໜ້າຫຼັກ</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Header Inner -->
    </header>
    <!--/ End Header -->
    <div class="clearfix"></div>

    <div class="container font14" style="margin-top: -10px;">
        <br>
        <div class="row">
            <!-- start zoom -->
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="wm-zoom-container my-zoom-1">
                    <div class="wm-zoom-box">
                        <?php 
							$sqlcolorss = "select * from product where pro_id='$pro_id';";
							$resultcolorss = mysqli_query($conn,$sqlcolorss);
                            $rowcolorss = mysqli_fetch_array($resultcolorss,MYSQLI_ASSOC);
                            if($rowcolorss["img_path"] == ""){
                                $rowcolorss["img_path"] = "logo_front.png";
                            }
						?>
                        <img id="imagel" src="../Administrator/image/<?php echo $rowcolorss['img_path']; ?>"
                            class="wm-zoom-default-img"
                            data-hight-src="../Administrator/image/<?php echo $rowcolorss['img_path']; ?>"
                            data-loader-src="../Administrator/image/loader.gif" alt="test">
                    </div>
                </div>
            </div>
            <!-- end zoom -->
            <div class="col-xs-12 col-sm-6 col-md-4 form-group">
                <?php 
					$sqlshow = "select p.pro_id,pro_name,brand_name,cated_name,cate_name,p.price,p.img_path,p.price-promotion as newprice,(promotion/p.price) * 100 as persen,p.promotion,p.type,p.guarantee  from product p left join categorydetail d on p.cated_id=d.cated_id left join brand b on p.brand_id=b.brand_id left join category c on d.cate_id=c.cate_id where pro_id='$pro_id';";
					$resultshow = mysqli_query($conn,$sqlshow);
                    $rowshow = mysqli_fetch_array($resultshow,MYSQLI_ASSOC);
                    if($rowshow["img_path"] == ""){
                        $rowshow["img_path"] = "logo_front.png";
                    }
				?>
                <label style="color: #7E7C7C;"><?php echo $rowshow['brand_name']; ?></label><br>
                <h5><?php echo $rowshow['cate_name']; ?> <?php echo $rowshow['brand_name']; ?>
                    <?php echo $rowshow['pro_name']; ?><br><?php echo $rowshow['cated_name']; ?></h5>
                <div class="quickview-content" style="margin-top: -30px;margin-left: -30px;">
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
                <div style="margin-top: -30px;">
                    <label style="color: #7E7C7C;">ລະຫັດສິນຄ້າ: <?php echo $rowshow['pro_id']; ?></label><br>
                    <h4 class="price with-discount" style="color: #CE3131;font-family: 'Noto Sans Lao UI';">
                        <?php echo number_format($rowshow['newprice'],2); ?> ກີບ</h4>
                    <span class="old" style="color: #7E7C7C;"><s>ປົກກະຕິ
                            <?php echo number_format($rowshow['price'],2); ?> ກີບ</s></span><br>
                </div>
                <?php 
					$sqlckstock = "select * from product where pro_id='$pro_id' and  qty > 0";
					$resultckstock = mysqli_query($conn,$sqlckstock);
					if(mysqli_num_rows($resultckstock) > 0){
						echo"<label style='color: #1EAD60;font-size: 18px;'> ມີສິນຄ້າ </label><br>";
					}
					else {
						echo"<label style='color: #CE3131;font-size: 18px;'> ສິນຄ້າໝົດ </label><br>";
					}
				?>
                <label style="color: #424343;font-size: 12px;">
                    <?php 
						$sqlspec = "select * from product_special where pro_id='$pro_id';";
						$resultspec = mysqli_query($conn,$sqlspec);
						while($rowspec = mysqli_fetch_array($resultspec,MYSQLI_ASSOC)){
							echo"- ".$rowspec["content"]."<br>";
						}
					?>
                </label><br>
                <?php 
					if($rowshow['guarantee'] > 0){
						echo"<label style='color: #0D68C4;font-size: 18px;'>ການຮັບປະກັນ</label><br>";
						echo"<label style='color: #7E7C7C;font-size: 14px;'>ໄລຍະເວລາຮັບປະກັນ : ".$rowshow['guarantee']." ".$rowshow['type']."</label><br>";
					}
					else {
						echo"<br>";
					}
				?>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 form-group">
                <form action="../Basket/Basket" method="GET" id="formAdd">
                    <div class="container font12" align="left"
                        style="margin:0 auto;100%;height:300px;background-color: white;box-shadow: 5px 5px 5px 5px #9f9e9a;">
                        <div class="quickview-content">
                            <h2>ຈັດສົ່ງຟຣີ</h2>
                            <div class="size">
                                <div class="row">
                                    <input type="hidden" name="id" value="<?php echo $pro_id; ?>">
                                </div>
                            </div>
                            <div class="quantity">
                                <!-- Input Order -->
                                <div class="input-group">
                                    <div class="button minus">
                                        <button type="button" class="btn btn-primary btn-number" disabled="disabled"
                                            data-type="minus" data-field="quant[1]">
                                            <i class="ti-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000"
                                        value="1">
                                    <div class="button plus">
                                        <button type="button" class="btn btn-primary btn-number" data-type="plus"
                                            data-field="quant[1]">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!--/ End Input Order -->
                            </div>
                            <div class="add-to-cart">
                                <button type="submit" name="btnAdd" class="btn"
                                    style="font-family: 'Noto Sans Lao,Arial';z-index: 1;">ເພີ່ມລົງກະຕ່າ</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Start Shop Services Area -->
    <div class="clearfix">

    </div>
    <div class="container-fluid font14">
        <div class="row">
            <div class="col-md-8">
                <?php 
					$sqlckdetail = "select * from productdetail where pro_id='$pro_id';";
					$resultckdetail = mysqli_query($conn,$sqlckdetail);
					if(mysqli_num_rows($resultckdetail)){
				?>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-secondary">ລາຍລະອຽດ</li>
                </ul>
                <?php 
					$sqlprodetail = "select id,d.pro_id,pro_name,d.img_path,review_youtube,content,topic_name,cate_name,cated_name,brand_name from productdetail d left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join brand b on p.brand_id=b.brand_id left join category c on i.cate_id=c.cate_id left join topic t on d.topic_id=t.topic_id where d.pro_id='$pro_id' order by t.topic_id asc;";
					$resultprodetail = mysqli_query($conn,$sqlprodetail);
					while($rowpro = mysqli_fetch_array($resultprodetail,MYSQLI_ASSOC)){
				?>
                <h5><br>
                    <?php echo $rowpro['topic_name']; ?> <?php echo $rowpro['cate_name']; ?>
                    <?php echo $rowpro['brand_name']; ?> <?php echo $rowpro['pro_name']; ?>
                    <?php echo $rowpro['cated_name']; ?>
                </h5>
                <?php 
						if($rowpro['review_youtube'] != ""){
					?>
                <br><iframe width="100%" height="400px" src="<?php echo $rowpro['review_youtube']; ?>" frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
                <?php 
						}
						else {
							echo"<br>";
						}
					?>
                <p>
                    <?php echo $rowpro['content'] ?>
                </p><br>
                <a href="../Administrator/image/<?php echo $rowpro['img_path'] ?>">
                    <img src="../Administrator/image/<?php echo $rowpro['img_path'] ?>" width="100%"
                        class="card-img-top" alt=""><br>
                </a>
                <?php 
					}
				}
				?>
            </div>
            <div class="col-md-8" style="margin-top: -40px;">
                <div class="row">
                    <?php 
						$sqlfunc = "select f.func_id,func_name from func_pro f left join function_product p on f.func_id=p.func_id where pro_id='$pro_id' group by f.func_id order by f.func_id asc;";
						$resultfunc = mysqli_query($conn,$sqlfunc);
						while($rowfunc = mysqli_fetch_array($resultfunc,MYSQLI_ASSOC)){
						$func_id = $rowfunc['func_id'];
					?>
                    <div class="col-xs-12 col-sm-6"><br>
                        <h4><?php echo $rowfunc['func_name']; ?></h4><br>
                        <?php 
								$sqlfuncpro = "select * from function_product where func_id='$func_id' and pro_id='$pro_id';";
								$resultfuncpro = mysqli_query($conn,$sqlfuncpro);
								while($rowfuncpro = mysqli_fetch_array($resultfuncpro,MYSQLI_ASSOC)){
							?>
                        - <?php echo $rowfuncpro['content']; ?><br>
                        <?php 
								}
							?>
                    </div>
                    <?php 
						}
					?>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div><br>
    <div class="container-fluid font14">
        <?php 
			$sqlckproper = "select * from product_property where pro_id='$pro_id';";
			$resultckproper = mysqli_query($conn,$sqlckproper);
			if(mysqli_num_rows($resultckproper) <= 0){
				echo"";
			}
			else {
		?>
        <div class="row">
            <div class="col-md-8">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-secondary">ລາຍລະອຽດເພີ່ມເຕີມ</li>
                </ul>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-8">
                <ul class="list-group">
                    <h5>ຄຸນສົມບັດສິນຄ້າ</h5>
                </ul>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-xs-12 col-sm-6"><br>
                        <div class="table-responsive">
                            <table class="table table-striped" style="width: 100%;font-size: 12px;">
                                <?php 
									$sqlproper = "select * from product_property where pro_id='$pro_id';";
									$resultproper = mysqli_query($conn,$sqlproper);
									while($rowproper = mysqli_fetch_array($resultproper,MYSQLI_ASSOC)){
									?>
                                <tr>
                                    <td><?php echo $rowproper['ppy_name']; ?></td>
                                    <th><?php echo $rowproper['content']; ?></th>
                                </tr>
                                <?php 
									}
								?>
                            </table>
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
                                <a href="index.html"><img
                                        src="../Administrator/image/<?php echo $rowshop['img_path'] ?>" width="80px;"
                                        alt="#"></a>
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
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Help</a></li>
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
                                    src="../Administrator/image/<?php echo $rowcredit['img_path'] ?>" width="30px;"
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
    <?php
	}
	?>
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

    <script src="../js/jquery-1.11.1.js"></script>

    <script src="../js/jquery.wm-zoom-1.0.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.my-zoom-1').WMZoom();
        $('.my-zoom-2 ').WMZoom({
            config: {
                inner: true
            }
        });
    });
    </script>
</body>

</html>
<?php
}
else{
    echo"<meta http-equiv='refresh' content='1;URL=../Product/Page-Not-ID'>";
}
?>