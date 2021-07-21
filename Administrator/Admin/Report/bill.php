<?php
   session_start();
require_once __DIR__ . '../../../vendor/autoload.php';
require '../../oop/obj.php';
$obj->bill($_POST["id"]);
$row_bill = mysqli_fetch_array($result_bill,MYSQLI_ASSOC);
mysqli_free_result($result_bill);  
mysqli_next_result($conn);
$content = '
            <div align="center" >
                <a href="Sell"><img src="../../image/title_logo.png" width="60px"></a>
            </div>
            <div align="center" style="font-size: 6px;text-align: center;">
                <p>
                   <b> ຮ້ານ GAME GADGET</b><br>
                    ບ້ານ ດອນນົກຊຸມ ເມືອງສີສັດຕະນາກ ນະຄອນຫຼວງວຽງຈັນ<br>
                    ເບີໂທ: 020 7877 7784
                </P>
            </div>
            <div style="width: 100%;font-size: 8px;">
                <div style="width: 50%;float: left;">
                    ພະນັກງານຂາຍ: '.$row_bill["emp_name"].'<br>
                    ວັນທີ: '.date("d/m/Y",strtotime($row_bill["sell_date"])).' '.$row_bill["sell_time"].'<br>
                </div>
                <div align="right" style="float: right;width: 45%;">
                    ເລກທີບິນ: '.$row_bill["sell_id"].'<br>
                    ລູກຄ້າ: '.$row_bill["cus_name"].'
                </div>
            </div>
            <hr size="3" align="center" width="100%" /> 
            <table style="font-size: 6px;">
                <tr>
                    <th align="left" style="width: 15px;">#</th>
                    <th align="left" style="width: 90px;">ສີນຄ້າ</th>
                    <th align="center" style="width: 40px;">ຈຳນວນ</th>
                    <th align="center" style="width: 40px;">ລາຄາ</th>
                    <th align="center" style="width: 50px;">ລວມ</th>
                </tr>
                ';
                $obj->billdetail(trim($_POST["id"]));
                $Bill = 0;
                $amount = 0;
                foreach($result_billdetail as $row){
                    $amount = $amount + $row["total"];
                    $Bill = $Bill + 1 ;
                    $content .='
                        <tr align="">
                            <td align="left">'.$Bill.'</td>
                            <td align="left">'.$row["cated_name"].' '.$row["brand_name"].' <br> '.$row["pro_name"].' '.$row["size_name"].'</td>
                            <td align="center">'.$row["qty"].'</td>
                            <td align="center">'.number_format($row["price"],2).'</td>
                            <td align="center">'.number_format($row["total"],2).'</td>
                        </tr>
                    ';
                }
                mysqli_free_result($result_billdetail);  
                mysqli_next_result($conn);
                $resultTHB = mysqli_query($conn,"select * from rate where rate_id='THB'");
                $row_THB = mysqli_fetch_array($resultTHB,MYSQLI_ASSOC);
                $THB = $row_THB["rate_buy"];
                $resultUSD = mysqli_query($conn,"select * from rate where rate_id='USD'");
                $row_USD = mysqli_fetch_array($resultUSD,MYSQLI_ASSOC);
                $USD = $row_USD["rate_buy"];
                if($row_bill["getmoney"] == 0){
                    $row_bill["getmoney"] = $amount;
                }
                $content .='
                </table>
                <hr size="3" align="center" width="100%" />  
                <div style="width: 100%;font-size: 8px;">
                    <div style="width: 50%;float: left;">
                        <b style="font-size: 6px;">ຮັບເງິນມາ: '.number_format($row_bill["getmoney"],2).' LAK</b><br>
                        <b style="font-size: 6px;">ເງິນທອນ: '.number_format($row_bill["getmoney"]-$amount,2).'</b><br>
                    </div>
                    <div align="right" style="float: right;width: 45%;">
                        <b style="font-size: 6px;">ຍອມລວມ (ລວມພາສີມູນຄ່າເພີ່ມ) </b><br>
                        <b align="right" style="font-size: 12px;">'.number_format($amount,2).' ກີບ</b><br>
                        <b align="right" style="font-size: 8px;">'.number_format($amount/$THB,2).' THB</b><br>
                        <b align="right" style="font-size: 8px;">'.number_format($amount/$USD,2).' USD</b><br>
                        <b align="right" style="font-size: 6px;">#ຄ່າຈັດສົ່ງ: '.number_format($row_bill["delivery"],2).' ກີບ</b><br>
                    </div>
                </div>
';
$mpdf = new \Mpdf\Mpdf([
    'format'        => [58, 100],
    'mode'              => 'utf-8',      
    'tempDir'           => '/tmp',
    'default_font_size' => 8,
    'margin_left' => 1.5, 
    'margin_right' => 1.5, 
    'margin_top' => 3.5,
    'margin_bottom' => 0.5, 
    'margin_footer' => 0.5, 
	'default_font' => 'saysettha_ot'
]);
$mpdf->WriteHTML($content);
$mpdf->Output('ໃບບິນຂາຍສິນຄ້າ.pdf','I');
?>