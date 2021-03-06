<?php
   session_start();
   if($_SESSION['game_gadget_lao_ses_status_id'] == 1){
        $stt = 1;
   }
   if($_SESSION['game_gadget_lao_ses_status_id'] == 2){
    $stt = 2;
    }
    if($_SESSION['game_gadget_lao_ses_id'] == ''){
        unset($_SESSION['game_gadget_lao_ses_id']);
        unset($_SESSION['email']);
        unset($_SESSION['emp_name']);
        unset($_SESSION['emp_id']);
        unset($_SESSION['img_path']);
        unset($_SESSION['game_gadget_lao_ses_status_id']);
        echo"<meta http-equiv='refresh' content='1;URL=$path'>";        
    }
    else if($_SESSION['game_gadget_lao_ses_status_id'] != $stt){
        unset($_SESSION['game_gadget_lao_ses_id']);
        unset($_SESSION['email']);
        unset($_SESSION['emp_name']);
        unset($_SESSION['emp_id']);
        unset($_SESSION['img_path']);
        unset($_SESSION['game_gadget_lao_ses_status_id']);
        echo"<meta http-equiv='refresh' content='1;URL=$path'>";
    }
    else{
        if($_SESSION["img_path"] == ""){
            $_SESSION["img_path"] = "image.jpeg";
        }
    }
      ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo $path ?>/image/title_logo.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo $path ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tcususdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="<?php echo $path ?>plugins/tcususdominus-bootstrap-4/css/tcususdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo $path ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo $path ?>plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $path ?>dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo $path ?>dist/css/alt/style.css">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo $path ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo $path ?>plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo $path ?>plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css">


    <link rel="stylesheet" href="<?php echo $path ?>dist/css/bootstrap-table.min.css">
    <link href="<?php echo $path ?>dist/css/jquery.resizableColumns.css" rel="stylesheet">
    <script src="<?php echo $path ?>dist/js/jquery.min.js"></script>

    <script src="<?php echo $path ?>dist/js/sweetalert.min.js"></script>
</head>
<?php
include (''.$path.'oop/obj.php');        
 if(isset($_POST["btnAdd_sell"])){
    $obj->cookie_sell(trim($_POST["pro_id_sell"]),trim($_POST["qty_sell"]));
}
if(isset($_GET["listsell"])){
    $obj->del_sell(trim($_GET["listsell"]));
}
if(isset($_POST["btn_save"])){
    $result_get_cus_id = mysqli_query($conn,"SELECT * FROM customers WHERE cus_name='????????????????????????????????????'");
    $row_get_cus_id = mysqli_fetch_array($result_get_cus_id,MYSQLI_ASSOC);
    $cusid = $row_get_cus_id["cus_id"];
    $obj->save_sell(trim($_POST["sell_id"]),$_SESSION["emp_id"],$cusid,$_POST["amount"],trim($_FILES["img_path"]["name"]),$_POST["delivery"],trim($_POST["getmoney"]));
}
if(isset($_POST['btnAddOrder'])){
    $obj->cookie_order(trim($_POST['pro_id_order']),trim($_POST['qty']),trim($_POST['price']));
}
if(isset($_POST['btnclear_Order'])){
    $obj->clear_order();
}
if(isset($_POST['btnDelete_cookie_one'])){
    $obj->del_order(trim($_POST['cookie_pro_id']));
}
if(isset($_POST['btnSaveOrder'])){
    $obj->save_order(trim($_POST['order_id']),$_SESSION["emp_id"],trim($_POST['sup_id']),trim($_POST["amount"]),trim($_POST["rate_id"]));
}
if(isset($_POST['btnAddImport'])){
    $obj->cookie_import(trim($_POST['pro_id_import']),trim($_POST['qty']),trim($_POST['price']),trim($_POST['remark']));
}
if(isset($_POST['btnclear_Import'])){
    $obj->clear_import();
}
if(isset($_POST['cookie_pro_id_import'])){
    $obj->del_import(trim($_POST['cookie_pro_id_import']));
}
if(isset($_POST['sup_id_import'])){
    $obj->save_import(trim($_POST['order_id_import']),$_SESSION["emp_id"],trim($_POST['sup_id_import']),trim($_POST['import_no']));
}
?>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light font14">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link"><?php echo $title; ?></a>
                </li>
            </ul>
            <?php
            if($title == "??????????????????????????????????????????????????????"){
                echo'
                    <div class="form-inline ml-3">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" name="search" id="search"
                                placeholder="??????????????????" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                ';
            }
            if($title == "????????????????????????????????????????????????"){
                echo'
                    <div class="form-inline ml-3">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" name="search" id="search"
                                placeholder="??????????????????" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                ';
            }
            if($title == "????????????????????????????????????????????????"){
                echo'
                    <div class="form-inline ml-3">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" name="search" id="search"
                                placeholder="??????????????????" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                ';
            }

        ?>
        <?php
            if($stt == 1){
        ?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-danger navbar-badge" id="alert"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">???????????????????????????</span>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo $links ?>Accept/Accept">
                            <div id="result_list" style="overflow-y: scroll;height:120px;font-size: 14px;"></div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo $links ?>Accept/Accept"
                            class="dropdown-item dropdown-footer">???????????????????????????????????????????????????</a>
                    </div>
                </li>
            </ul> &nbsp; &nbsp; &nbsp;
            <?php
            }
            if($stt == 2){
        ?>
         <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-danger navbar-badge" id="alert"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">???????????????????????????</span>
                        <div class="dropdown-divider"></div>
                            <div id="result_list" style="overflow-y: scroll;height:120px;font-size: 14px;"></div>
                        <div class="dropdown-divider"></div>
                        <!-- <a href="<?php echo $links ?>Accept/Accept"
                            class="dropdown-item dropdown-footer">???????????????????????????????????????????????????</a> -->
                    </div>
                </li>
            </ul> &nbsp; &nbsp; &nbsp;
        <?php
            }
        ?>
        </nav>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 font14">
            <!-- Brand Logo -->
            <a href="<?php echo $links ?>Main" class="brand-link">
                <img src="<?php echo $path ?>image/logo.ico" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Game Gadget</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo $path ?>image/<?php echo $_SESSION["img_path"] ?>"
                            class="img-circle elevation-2" alt="">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $_SESSION["emp_name"] ?></a>
                    </div>
                </div>
                <nav class="mt-2">
                    <?php
                    if($stt == 1){
                ?>
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    ????????????????????????????????????????????????
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Management/Employee" class="nav-link">
                                        <i class="far fa fa-user nav-icon"></i>
                                        <p>?????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="fas fa-shopping-cart nav-icon"></i>
                                <p>
                                    ?????????????????????
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Accept/Accept" class="nav-link">
                                        <i class="fas fa-vote-yea nav-icon"></i>
                                        <p>?????????????????????</p>
                                    </a>
                                </li>
                            </ul>

                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    ??????????????????
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Report/ReportEmployee" class="nav-link">
                                        <i class="far fas fa-book nav-icon"></i>
                                        <p>????????????????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Report/ReportCustomer" class="nav-link">
                                        <i class="far fas fa-book nav-icon"></i>
                                        <p>??????????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Report/ReportProduct" class="nav-link">
                                        <i class="far fas fa-book nav-icon"></i>
                                        <p>??????????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Report/ReportOrder" class="nav-link">
                                        <i class="far fas fa-book nav-icon"></i>
                                        <p>??????????????????????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Report/ReportImport" class="nav-link">
                                        <i class="far fas fa-book nav-icon"></i>
                                        <p>??????????????????????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Report/ReportSell" class="nav-link">
                                        <i class="far fas fa-book nav-icon"></i>
                                        <p>??????????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Report/ReportBestSell" class="nav-link">
                                        <i class="far fas fa-book nav-icon"></i>
                                        <p>???????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModal">
                                <i class="nav-icon fas fa-power-off"></i>
                                <p>
                                    ?????????????????????????????????
                                </p>
                            </a>
                        </li>
                        </li>
                    </ul>
                    <?php
                    }
                    ?>
                    <?php
                    if($stt == 2){
                ?>
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    ????????????????????????????????????????????????
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Management/Supplier" class="nav-link">
                                        <i class="far fa fa-people-carry nav-icon"></i>
                                        <p>????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Management/Type" class="nav-link">
                                        <i class="fab fa-typo3 nav-icon"></i>
                                        <p>????????????????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Management/Category" class="nav-link">
                                        <i class="fab fa-typo3 nav-icon"></i>
                                        <p>?????????????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Management/Unit" class="nav-link">
                                        <i class="fab fa-unity nav-icon"></i>
                                        <p>???????????????????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Management/Brand" class="nav-link">
                                        <i class="fab fa-buy-n-large nav-icon"></i>
                                        <p>????????????????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Management/Product" class="nav-link">
                                        <i class="fab fa-product-hunt nav-icon"></i>
                                        <p>??????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Management/Rate" class="nav-link">
                                        <i class="fab fa-acquisitions-incorporated nav-icon"></i>
                                        <p>????????????????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="fas fa-shopping-cart nav-icon"></i>
                                <p>
                                    ????????????????????? ????????? ?????????????????????
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Order/Order" class="nav-link">
                                        <i class="fas fa-shopping-cart nav-icon"></i>
                                        <p>???????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Order/Acception" class="nav-link">
                                        <i class="fas fa-vote-yea nav-icon"></i>
                                        <p>??????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Order/Import" class="nav-link">
                                        <i class="fas fa-truck nav-icon"></i>
                                        <p>???????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="fas fa-cash-register nav-icon"></i>
                                <p>
                                    ?????????????????????
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Service/Online" class="nav-link">
                                        <i class="fas fa-shopping-bag nav-icon"></i>
                                        <p>??????????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Service/Sell" class="nav-link">
                                        <i class="fas fa-tv nav-icon"></i>
                                        <p>????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    ??????????????????
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Report/ReportEmployee" class="nav-link">
                                        <i class="far fas fa-book nav-icon"></i>
                                        <p>????????????????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Report/ReportCustomer" class="nav-link">
                                        <i class="far fas fa-book nav-icon"></i>
                                        <p>??????????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Report/ReportProduct" class="nav-link">
                                        <i class="far fas fa-book nav-icon"></i>
                                        <p>??????????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Report/ReportOrder" class="nav-link">
                                        <i class="far fas fa-book nav-icon"></i>
                                        <p>??????????????????????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Report/ReportImport" class="nav-link">
                                        <i class="far fas fa-book nav-icon"></i>
                                        <p>??????????????????????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Report/ReportSell" class="nav-link">
                                        <i class="far fas fa-book nav-icon"></i>
                                        <p>??????????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Report/ReportBestSell" class="nav-link">
                                        <i class="far fas fa-book nav-icon"></i>
                                        <p>???????????????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <!-- <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Report/report-product" class="nav-link">
                                        <i class="far fas fa-book nav-icon"></i>
                                        <p>??????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $links ?>Report/report-product" class="nav-link">
                                        <i class="far fas fa-book nav-icon"></i>
                                        <p>??????????????????????????????????????????????????????</p>
                                    </a>
                                </li>
                            </ul> -->
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModal">
                                <i class="nav-icon fas fa-power-off"></i>
                                <p>
                                    ?????????????????????????????????
                                </p>
                            </a>
                        </li>
                        </li>
                    </ul>
                    <?php
                    }
                    ?>
                </nav>
            </div>
        </aside>

        <form action="#" method="POST" id="formLogout">
            <div class="modal fade font14" id="exampleModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">??????????????????</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" align="center">
                            ?????????????????????????????????????????????????????????????????? ????????? ????????? ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-dismiss="modal">?????????????????????</button>
                            <button type="submit" name="btnLogout" class="btn btn-outline-danger">?????????????????????????????????</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
            if(isset($_POST['btnLogout'])){
                $obj->logout();
            }
        ?>
        <div class="main-footer">