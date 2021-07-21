
<?php
require_once __DIR__ . '../../../vendor/autoload.php';
$amount = 0;
    $content = '';
    require '../../oop/obj.php';
    if(isset($_POST["btnPDF"]))
    {
        $date1 = $_POST["pdf_date1"];
        $date2 = $_POST["pdf_date2"];
        $result_pay = mysqli_query($conn,"select d.pro_id,pro_name,sum(d.qty) as total_qty,sum(d.qty*d.price) as total,count(d.pro_id) as count_product,p.img_path,cate_name,cated_name,brand_name,unit_name from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join category c on i.cate_id=c.cate_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where sell_date between '$date1' and '$date2' group by d.pro_id order by count(d.pro_id) desc");
    }
     else
     {
        $result_pay = mysqli_query($conn,"select d.pro_id,pro_name,sum(d.qty) as total_qty,sum(d.qty*d.price) as total,count(d.pro_id) as count_product,p.img_path,cate_name,cated_name,brand_name,unit_name from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join category c on i.cate_id=c.cate_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where sell_date between '' and '' group by d.pro_id order by count(d.pro_id) desc");
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
                        ລາຍງານສິນຄ້າຂາຍດີ
                    </b>
                </u>
            </div>`
            <table width="100%;">
                <tr style="font-size: 16px;" >
                    <th style="width: 25px;">#</th>
                    <th style="width: 60px;" scope="col">ສິນຄ້າ</th>
                    <th style="width: 90px;" scope="col">ລະຫັດສິນຄ້າ</th>
                    <th style="width: 140px;" scope="col">ຊື່ສິນຄ້າ</th>
                    <th style="width: 80px;" scope="col">ຈຳນວນ</th>
                    <th style="width: 130px;" scope="col">ລວມ</th>
                </tr>
                ';
                if(mysqli_num_rows($result_pay) > 0){
                    $Bill = 0;
                  
                    while($row = mysqli_fetch_array($result_pay)){
                        $amount = $amount + $row["total"];
                        $Bill = $Bill + 1 ;
                        $content .='
                            <tr align="center">
                                <td>'.$Bill.'</td>
                                ';
                                if($row["img_path"] == ""){
                                    $row["img_path"] = "image.jpeg";
                                }
                                $content .='
                                <td style="text-align: center;">
                                    <img src="../../image/'.$row["img_path"].'" class="img-circle elevation-2" alt="" width="55px" />
                                </td>
                                <td>'.$row["pro_id"].'</td>
                                <td> '.$row["cate_name"].' '.$row["cated_name"].' '.$row["brand_name"].' '.$row["pro_name"].'</td>
                                <td>'.$row["total_qty"].' '.$row["unit_name"].'</td>
                                <td>'.number_format($row["total"],2).' ກີບ</td>    
                            </tr>
                        ';
                    }
                }   
                $content .='
                <tr>
                    <td colspan="4" align="right"><h4>ມູນຄ່າທັງໝົດ:</h4></td>
                    <td colspan="2" align="right"><h4 style="color: red;">'.number_format($amount,2).' ກີບ</h4></td>
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
$mpdf->Output('ລາຍງານສິນຄ້າຂາຍດີ.pdf','I');
?>