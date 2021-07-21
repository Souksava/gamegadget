
<?php
require_once __DIR__ . '../../../vendor/autoload.php';
$amount = 0;
    $content = '';
    require '../../oop/obj.php';
    if(isset($_POST["btnPDF"]))
    {
        $date1 = $_POST["pdf_date1"];
        $date2 = $_POST["pdf_date2"];
        $result_pay = mysqli_query($conn,"select sell_id,cus_name,sell_date,sell_time,amount,sell_type,getmoney,s.img_path,note,s.status,status_cash,emp_name from sell s left join customers c on s.cus_id=c.cus_id left join employees e on s.emp_id=e.emp_id where  sell_date between '$date1' and '$date2' order by s.sell_id asc;");
    }
     else
     {
        $result_pay = mysqli_query($conn,"select sell_id,cus_name,sell_date,sell_time,amount,sell_type,getmoney,s.img_path,note,s.status,status_cash,emp_name from sell s left join customers c on s.cus_id=c.cus_id left join employees e on s.emp_id=e.emp_id where sell_date between '' and '' order by s.sell_id asc;");
     } 
$content .= '
            `<style>
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
            <div style="float: left; width: 75%;">
                <p>
                    <p style="font-size: 10px;">
                        ຮ້ານ GAME GADGET<br>
                        ທີ່ຢູ່: ບ້ານ ດອນນົກຂຸມ ເມືອງສີສັດຕະນາກ ນະຄອນຫຼວງວຽງຈັນ<br>
                        ເບີໂທລະສັບ: +856 20 5445 5777
                    </p>
                </P>
            </div>
            <div style="float: left;text-align: right;">
                <br><br><br>

                </div>
            <div align="center" style="font-size: 16px;">
                <u>
                    <b>
                        ລາຍງານການຂາຍ
                    </b>
                </u>
            </div>`
            <table width="100%;">
                <tr style="font-size: 16px;" >
                    <th style="width: 35px;">ລຳດັບ</th>
                    <th style="width: 120px;">ເລກທີບິນ</th>
                    <th style="width: 150px;">ລູກຄ້າ</th>
                    <th style="width: 120px;">ມູນຄ່າລວມ</th>
                    <th style="width: 100px;">ສະຖານະ</th>
                    <th style="width: 100px;">ການຈ່າຍ</th>
                    <th style="width: 100px;">ປະເພດຂາຍ</th>
                    <th style="width: 180px;">ພາບລິບການໂອນ</th>
                    <th style="width: 120px;">ວັນທີເວລາ</th>
                    <th style="width: 180px;">ໝາຍເຫດ </th>
                </tr>
                ';
                if(mysqli_num_rows($result_pay) > 0){
                    $Bill = 0;
                  $amount = 0;
                    while($row = mysqli_fetch_array($result_pay)){
                        $amount = $amount + $row["amount"];
                        $Bill = $Bill + 1 ;
                        $content .='
                            <tr align="center">
                                <td>'.$Bill.'</td>
                                <td>'.$row["sell_id"].'</td>
                                <td>'.$row["cus_name"].'</td>
                                <td>'.number_format($row["amount"],2).'</td>
                                <td>'.$row["status"].'</td>
                                <td>'.$row["status_cash"].'</td>
                                <td>'.$row["sell_type"].'</td>
                                ';
                                if($row["img_path"] == ""){
                                    $row["img_path"] = "image.jpeg";
                                }
                                $content .='
                                <td style="text-align: center;">
                                    <img src="../../image/'.$row["img_path"].'" class="img-circle elevation-2" alt="" width="55px" />
                                </td>
                                <td>'.date("d/m/Y",strtotime($row["sell_date"])).'</td>
                                <td>'.$row["note"].'</td>
                            </tr>
                        ';
                    }
                }   
                $content .='
                <tr>
                    <td colspan="7" align="right"><h4>ມູນຄ່າທັງໝົດ:</h4></td>
                    <td colspan="4" align="right"><h4 style="color: red;">'.number_format($amount,2).' ກີບ</h4></td>
                </tr>
                </table><br>
            ';
$mpdf = new \Mpdf\Mpdf([
    'format'            => 'A4',
    'mode'              => 'utf-8',      
    'tempDir'           => '/tmp',
    'default_font_size' => 10,
    'margin_bottom' => 18, 
    'margin_footer' => 5, 
	'default_font' => 'saysettha_ot'
]);
$mpdf->defaultfooterline = 0;
$footer = '<p align="center" style="font-size: 8px;">ໜ້າທີ່ {PAGENO} ຂອງ {nb}<br> </p>';
$mpdf->SetFooter($footer);

$mpdf->WriteHTML($content);
$mpdf->Output('ລາຍງານການຂາຍ.pdf','I');
?>