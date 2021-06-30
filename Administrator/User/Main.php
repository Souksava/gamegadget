<?php
  $title = "ໜ້າຫຼັກ";
  $path = "../";
  $links = "";
  $session_path = "../";
  include ("../header-footer/header.php");
?>

<?php 
    $resultorder = mysqli_query($conn, "select count(sell_id) as count_order from sell where sell_date = '$Date' and status='ສັ່ງຊື້';");
    $roworder = mysqli_fetch_array($resultorder,MYSQLI_ASSOC);
?>

<div class="container-fluid" style="font-family: 'Noto Sans Lao';">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo $roworder['count_order']; ?></h3>
                    <p>ຈຳນວນສັ່ງຊື້ໃນມື້ນີ້</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">ຂໍ້​ມູນ​ເພີ່ມ​ເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <?php 
                $resultrevenue = mysqli_query($conn, "select sum(amount) as amount from sell where sell_date = '$Date' and status='ສັ່ງຊື້ສຳເລັດ';");
                $rowrevenue = mysqli_fetch_array($resultrevenue,MYSQLI_ASSOC);
        ?>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?php echo number_format($rowrevenue['amount']); ?> ກີບ</h3>

                    <p>ລາຍໄດ້ມື້ນີ້</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">ຂໍ້​ມູນ​ເພີ່ມ​ເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <?php 
                $resultpay = mysqli_query($conn, "select sum(qty*price) as amount from imports where imp_date = '$Date';");
                $rowpay = mysqli_fetch_array($resultpay,MYSQLI_ASSOC);
        ?>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?php echo number_format($rowpay['amount']); ?> ກີບ</h3>

                    <p>ລາຍຈ່າຍມື້ນີ້</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">ຂໍ້​ມູນ​ເພີ່ມ​ເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <?php 
            $resultcus = mysqli_query($conn, "select count(cus_id) as count_cus from customers where pass != '';");
            $rowcus = mysqli_fetch_array($resultcus,MYSQLI_ASSOC);
        ?>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?php echo $rowcus['count_cus']; ?> ຄົນ</h3>

                    <p>ຈຳນວນລູກຄ້າ</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">ຂໍ້​ມູນ​ເພີ່ມ​ເຕີມ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>



    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative mb-4" id="chartContainer" style="height: 370px; width: 100%;">
                    </div>
                </div>
            </div><!-- /.card -->
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative mb-4" id="chartContainer2" style="height: 370px; width: 100%;">
                    </div>
                </div>
            </div><!-- /.card -->
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative mb-4" id="chartContainer3" style="height: 370px; width: 100%;">
                    </div>
                </div>
            </div><!-- /.card -->
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative mb-4" id="chartContainer4" style="height: 370px; width: 100%;">
                    </div>
                </div>
            </div><!-- /.card -->
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->


<?php
 include ("../header-footer/footer.php");
?>
<script src="<?php echo $path ?>dist/js/canvasjs.min.js"></script>
<script>
window.onload = function() {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title: {
            text: "ລາຍຮັບຕໍ່ເດືອນ",
            fontFamily: "Noto Sans Lao",
        },
        axisX: {
            labelFontFamily: "Noto Sans Lao",
        },
        axisY: {
            labelFontFamily: "Noto Sans Lao",
        },
        toolTip: {
            fontFamily: "Noto Sans Lao",
        },
        legend: {
            fontFamily: "Noto Sans Lao",
        },
        data: [{
            type: "column",
            indexLabelFontFamily: "Noto Sans Lao",
            dataPoints: [
                <?php 
                    $result_revenue = mysqli_query($conn,"select date_format(sell_date,'%M') as month,sum(amount) as amount from sell where year(sell_date) = date_format(now(),'%Y') group by month(sell_date);");
                    foreach($result_revenue as $rowr){
                    // if($rowr["month"] == "January"){
                    //     $rowr["month"] = "ມັງກອນ";
                    // }
                ?> {
                    y: <?php echo $rowr["amount"] ?>,
                    label: " <?php echo $rowr["month"] ?>"
                },
                <?php
                    }
                ?>
            ]
        }]
    });
    chart.render();

    var chart2 = new CanvasJS.Chart("chartContainer2", {
        animationEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title: {
            text: "ລາຍຮັບໃນແຕ່ລະປີ",
            fontFamily: "Noto Sans Lao",
        },
        axisX: {
            labelFontFamily: "Noto Sans Lao",
        },
        axisY: {
            labelFontFamily: "Noto Sans Lao",
        },
        toolTip: {
            fontFamily: "Noto Sans Lao",
        },
        legend: {
            fontFamily: "Noto Sans Lao",
        },
        data: [{
            type: "column",
            indexLabelFontFamily: "Noto Sans Lao",
            dataPoints: [
                <?php 
                    //$result_pay = mysqli_query($conn,"select date_format(imp_date,'%M') as month,sum(qty*price) as amount from imports where year(imp_date) = date_format(now(),'%Y') group by month(imp_date);");
                    $result_pay = mysqli_query($conn,"select date_format(imp_date,'%M') as month,sum(qty*price) as amount from imports group by month(imp_date);");
                    foreach($result_pay as $rowp){
                    if($rowp["month"] == ""){
                        $rowp["month"] = "None";
                    }
                    if($rowp["amount"] == ""){
                        $rowp["amount"] = 0;
                    }
                ?> {
                    y: <?php echo $rowp["amount"] ?>,
                    label: " <?php echo $rowp["month"] ?>"
                },
                <?php
                    }
                ?>
            ]
        }]
    });
    chart2.render();

    var chart3 = new CanvasJS.Chart("chartContainer3", {
        animationEnabled: true,
        title: {
            text: "ລາຍຮັບແຕ່ລະປີ",
            fontFamily: "Noto Sans Lao",
        },
        axisY: {
            valueFormatString: "#0,,.",
            suffix: " ລ້ານ",
            labelFontFamily: "Noto Sans Lao",

        },
        toolTip: {
            fontFamily: "Noto Sans Lao",
        },
        data: [{
            type: "splineArea",
            color: "rgba(54,158,173,.7)",
            markerSize: 5,
            xValueFormatString: "YYYY",
            yValueFormatString: "#,##0.## ກີບ",
            dataPoints: [
                <?php 
                    $result_revenue_year = mysqli_query($conn,"select date_format(sell_date,'%Y') as year,sum(amount) as amount from sell group by year(sell_date)");
                    foreach($result_revenue_year as $rowrevenue_year){
                ?> {
                    x: new Date(<?php echo $rowrevenue_year["year"] ?>, 0),
                    y: <?php echo $rowrevenue_year["amount"] ?>
                },
                <?php
                   }
                ?>
            ]
        }]
    });
    chart3.render();

    var chart4 = new CanvasJS.Chart("chartContainer4", {
        animationEnabled: true,
        title: {
            text: "ລາຍຈ່າຍແຕ່ລະປີ",
            fontFamily: "Noto Sans Lao",
        },
        axisY: {
            valueFormatString: "#0,,.",
            suffix: " ລ້ານ",
            labelFontFamily: "Noto Sans Lao",

        },
        toolTip: {
            fontFamily: "Noto Sans Lao",
        },
        data: [{
            type: "splineArea",
            color: "rgba(255, 99, 71)",
            markerSize: 5,
            xValueFormatString: "YYYY",
            yValueFormatString: "#,##0.## ກີບ",
            dataPoints: [
                <?php 
                $result_revenue_year = mysqli_query($conn,"select date_format(imp_date,'%Y') as year,sum(qty*price) as amount from imports group by year(imp_date);");
                foreach($result_revenue_year as $rowrevenue_year){
            ?> {
                    x: new Date(<?php echo $rowrevenue_year["year"] ?>, 0),
                    y: <?php echo $rowrevenue_year["amount"] ?>
                },
                <?php
               }
            ?>
            ]
        }]
    });
    chart4.render();
}
</script>