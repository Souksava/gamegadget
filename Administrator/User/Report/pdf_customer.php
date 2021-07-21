
<?php
require_once __DIR__ . '../../../vendor/autoload.php';
$amount = 0;
$Bill = 0;
    $content = '';
    require '../../oop/obj.php';
    if(isset($_POST["btnPDF"]))
    {
        $query = "%".$_POST["pdf_search"]."%";
        $result_customer = mysqli_query($conn,"select * from customers where cus_id like '$query' or cus_name like '$query' or cus_surname like '$query' or gender like '$query' or email like '$query' order by cus_name asc;");        
    }
     else
     {
        $result_customer = mysqli_query($conn,"select * from customers where cus_id like '%%' or cus_name like '%%' or cus_surname like '%%' or gender like '%%' or email like '%%' order by cus_name");
     } 
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
                        ລາຍງານຂໍ້ມູນລູກຄ້າ
                    </b>
                </u>
            </div>
            <table width="100%;">
                <tr style="font-size: 16px;" >
                    <th style="width: 50px;">ລຳດັບ</th>
                    <th style="width: 150px;">ລະຫັດ</th>
                    <th style="width: 150px;">ຊື່ລູກຄ້າ</th>
                    <th style="width: 150px;">ນາມສະກຸນ</th>
                    <th style="width: 80px;">ເພດ</th>
                    <th style="width: 350px;">ທີ່ຢູ່ປັດຈຸບັນ</th>
                    <th style="width: 180px;">ເບີໂທລະສັບ</th>
                    <th style="width: 220px;">ອີເມວ</th>
                </tr>
                ';
                if(mysqli_num_rows($result_customer) > 0){
                  
                    while($row = mysqli_fetch_array($result_customer)){
                        $Bill = $Bill + 1 ;
                        $content .='
                            <tr align="center">
                                <td>'.$Bill.'</td>
                                <td>'.$row["cus_id"].'</td>
                                <td>'.$row["cus_name"].'</td>
                                <td>'.$row["cus_surname"].'</td>
                                <td>'.$row["gender"].'</td>
                                <td>'.$row["address"].'</td>
                                <td>'.$row["tel"].'</td>
                                <td>'.$row["email"].'</td>
                            </tr>
                        ';
                    }
                }   
                $content .='
                <tr>
                    <td colspan="5" align="right"><h4>ຈຳນວນທັງໝົດ:</h4></td>
                    <td colspan="3" align="right"><h4 style="color: red;">'.number_format($Bill).'</h4></td>
                </tr>
                </table><br>
            ';
$mpdf = new \Mpdf\Mpdf([
    'format'            => 'A4',
    'mode'              => 'utf-8',      
    'tempDir'           => '/tmp',
    'default_font_size' => 14,
    'margin_bottom' => 18, 
    'margin_footer' => 5, 
	'default_font' => 'saysettha_ot'
]);
$mpdf->defaultfooterline = 0;
$footer = '<p align="center" style="font-size: 8px;">ໜ້າທີ່ {PAGENO} ຂອງ {nb}<br> </p>';
$mpdf->SetFooter($footer);

$mpdf->WriteHTML($content);
$mpdf->Output('ລາຍງານລູກຄ້າ.pdf','I');
?>