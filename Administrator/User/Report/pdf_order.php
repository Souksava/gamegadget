
<?php
require_once __DIR__ . '../../../vendor/autoload.php';
$amount = 0;
    $content = '';
    require '../../oop/obj.php';
    if(isset($_POST["btnPDF"]))
    {
        $date1 = $_POST["pdf_date1"];
        $date2 = $_POST["pdf_date2"];
        $result_pay = mysqli_query($conn,"select order_id,emp_name,company,amount,order_date,order_time,o.status,seen2,rate_id,rate_buy from orders o left join employees e on o.emp_id=e.emp_id left join suppliers s  on o.sup_id=s.sup_id where order_date between '$date1' and '$date2' order by order_date asc");
    }
     else
     {
        $result_pay = mysqli_query($conn,"select order_id,emp_name,company,amount,order_date,order_time,o.status,seen2,rate_id,rate_buy from orders o left join employees e on o.emp_id=e.emp_id left join suppliers s  on o.sup_id=s.sup_id where order_date between '' and '' order by order_date asc");
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
                        ລາຍງານການສັ່ງຊື້
                    </b>
                </u>
            </div>`
            <table width="100%;">
                <tr style="font-size: 16px;" >
                    <th style="width: 40px">No.</th>
                    <th style="width: 120px">ເລກທີບິນ</th>
                    <th style="width: 150px">ຜູ້ສະໜອງ</th>
                    <th style="width: 150px">ລວມ</th>
                    <th style="width: 150px">ຜູ້ສັ່ງຊື້</th>
                    <th style="width: 120px">ວັນທີ</th>
                    <th style="width: 120px">ເວລາ</th>
                    <th style="width: 120px">ສະຖານະ</th>
                </tr>
                ';
                if(mysqli_num_rows($result_pay) > 0){
                    $Bill = 0;
                    while($row = mysqli_fetch_array($result_pay)){
                        
                        $Bill = $Bill + 1 ;
                        $content .='
                            <tr align="center">
                                <td>'.$Bill.'</td>
                                <td>'.$row["order_id"].'</td>
                                <td>'.$row["company"].'</td>
                                <td>'.number_format($row["amount"],2).' '.$row["rate_id"].'</td>
                                <td>'.$row["emp_name"].'</td>
                                <td>'.date("d/m/Y",strtotime($row["order_date"])).'</td>
                                <td>'.$row["order_time"].'</td>
                                <td>'.$row["status"].'</td>
                            </tr>
                        ';
                    }
                }   
                $result_amount = mysqli_query($conn,"select sum(amount) as amount,rate_id from orders where order_date between '$date1' and '$date2' group by rate_id order by rate_id asc;");
                foreach($result_amount as $row_a){
                $content .='
                <tr>
                    <td colspan="6" align="right"><h4>ມູນຄ່າທັງໝົດ ('.$row_a["rate_id"].'):</h4></td>
                    <td colspan="2" align="right"><h4 style="color: red;">'.number_format($row_a["amount"],2).' '.$row_a["rate_id"].'</h4></td>
                </tr>
                ';
                }
                $content .='
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