
<?php
if(isset($_POST["btnBill"])){
    require_once __DIR__ . '../../../vendor/autoload.php';
    $amount = 0;
    $no_ = 0;
    $content = '';
    require '../../oop/obj.php';
$order_id = $_POST["id"];
$result_bill_order = mysqli_query($conn,"select order_id,emp_name,company,amount,order_date,order_time,o.status,seen2 from orders o left join employees e on o.emp_id=e.emp_id left join suppliers s  on o.sup_id=s.sup_id where order_id='$order_id';");
$row2 = mysqli_fetch_array($result_bill_order,MYSQLI_ASSOC);
$result_rate = mysqli_query($conn,"select * from orders where order_id='$order_id'");
$get_rate = mysqli_fetch_array($result_rate,MYSQLI_ASSOC);
$rate = $get_rate["rate_id"];
$content .= '
        <style>
            table {
            border-collapse: collapse;
            width: 100%;
            }

            th, td {
            text-align: left;
            padding: 8px;
            }

            tr:nth-child(even){background-color: #f2f2f2}

            th {
            background-color: #04AA6D;
            color: white;
            }
            div img{
                border-radius: 50%;
            }
        </style>
            <div align="center" style="font-size: 10px;">
                ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ<br>
                ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ<br>
                =========oooo=========
            </div>
                <div align="left" style="z-index: 1;position: absolute;margin-top: -80px;">
                    <img src="../../image/title_logo.png" width="100px">
                </div>
            <div style="float: left; width: 65%;">
                <p>
                    <p style="font-size: 12px;">
                        ຮ້ານ GAME GADGET<br>
                        ທີ່ຢູ່: ບ້ານ ດອນນົກຂຸມ ເມືອງສີສັດຕະນາກ ນະຄອນຫຼວງວຽງຈັນ<br>
                        ເບີໂທລະສັບ: +856 20 5445 5777 <br>
                        ຜູ້ສະໜອງສິນຄ້າ: '.$row2["company"].'

                    </p>
                </P>
            </div>
            <div style="float: left;text-align: right;">
                <br>
                <p style="font-size: 12px;">
                    ເລກທີໃບສັ່ງຊື້: '.$row2["order_id"].'<br>
                    ພະນັກງານສັ່ງຊື້: '.$row2["emp_name"].'<br>
                    ວັນທີ: '.date("d/m/Y",strtotime($row2["order_date"])).' '.$row2["order_time"].'<br>
                </p>
            </div>
            <div align="center" style="font-size: 18px;">
                <u>
                    <b>
                        ໃບສັ່ງຊື້ສິນຄ້າ
                    </b>
                </u>
            </div>
            <table width="100%" style="font-size: 12px;" class="table">
                <tr>
                    <th align="center" style="width: 15px;">#</th>
                    <th align="center" style="width: 60px;">ສີນຄ້າ</th>
                    <th align="center" style="width: 120px;">ຊື່ສິນຄ້າ</th>
                    <th align="center" style="width: 30px;">ຈຳນວນ</th>
                    <th align="center" style="width: 40px;">ລາຄາ</th>
                    <th align="center" style="width: 50px;">ລວມ</th>
                </tr>
                ';
                mysqli_free_result($result_bill_order);  
                mysqli_next_result($conn);
                $result_report_orderdetail = mysqli_query($conn,"SELECT o.pro_id,pro_name,o.qty,o.price,o.qty*o.price as total,p.cated_id,cated_name,cate_name,p.unit_id,unit_name,p.brand_id,brand_name,qtyalert,p.img_path,order_id FROM orderdetail o LEFT JOIN product p ON o.pro_id=p.pro_id LEFT JOIN categorydetail c ON p.cated_id=c.cated_id LEFT JOIN category ty ON c.cate_id=ty.cate_id LEFT JOIN unit u ON p.unit_id=u.unit_id LEFT JOIN brand b ON p.brand_id=b.brand_id WHERE o.order_id='$order_id'");
                while($row = mysqli_fetch_array($result_report_orderdetail,MYSQLI_ASSOC))
                {
               $amount = $amount + $row["total"];
               $no_ += 1;
                 $content .= '
                   <tr>
                       <td align="center">'.$no_.'</td>
                       ';
                       if($row["img_path"] == ""){
                          $row["img_path"] = "image.jpeg";
                       }
                       $content .='
                       <td style="text-align: center;">
                          <img src="../../image/'.$row["img_path"].'" class="img-circle elevation-2" alt="" width="55px" />
                       </td>
                       <td align="center">'.$row["cate_name"].' '.$row["brand_name"].' <br> '.$row["pro_name"].' '.$row["size_name"].'</td>
                       <td align="center">'.$row["qty"].'</td>
                       <td align="center">'.number_format($row["price"],2).' '.$rate.'</td>
                       <td align="center">'.number_format($row["total"],2).' '.$rate.'</td>
                   </tr>
                 ';
                }
                $content .='
                <tr>
                    <td colspan="4" align="right"><h2>ມູນຄ່າທັງໝົດ:</h2></td>
                    <td colspan="2" align="right"><h2 style="color: red;">'.number_format($amount,2).' '.$rate.'</h2></td>
                </tr>
            </table><br><br><br>
            <table style="width: 100%;font-size: 12px;background-color: white;">
                <tr>
                    <td align="left">
                        ເຈົ້າຂອງຮ້ານ<br><br><br><br><br><br><br><br>
                        ລາຍເຊັນ:......................................

                    </td>
                    <td align="right">
                        ພະນັກງານ<br><br><br><br><br><br><br><br>
                        ລາຍເຊັນ:......................................

                    </td>
                </tr>
            </table>

            ';
$mpdf = new \Mpdf\Mpdf([
    'format'            => 'A4',
    'mode'              => 'utf-8',      
    'tempDir'           => '/tmp',
    'default_font_size' => 14,
    'margin_bottom' => 8, 
    'margin_footer' => 5, 
	'default_font' => 'saysettha_ot'
]);
$mpdf->defaultfooterline = 0;
$footer = '<p align="center" style="font-size: 8px;">ໜ້າທີ່ {PAGENO} ຂອງ {nb}<br> </p>';
$mpdf->SetFooter($footer);

$mpdf->WriteHTML($content);
$mpdf->Output('ໃບສິນສັ່ງຊື້.pdf','I');
}
?>