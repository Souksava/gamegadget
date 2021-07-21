
<?php
require_once __DIR__ . '../../../vendor/autoload.php';
$amount = 0;
$Bill = 0;
    $content = '';
    require '../../oop/obj.php';
    if(isset($_POST["btnPDF"]))
    {
        $query = "%".$_POST["pdf_search"]."%";
        $result_customer = mysqli_query($conn,"select p.pro_id,pro_name,cate_name,cated_name,brand_name,unit_name,p.img_path,p.qty,p.price,p.price - p.promotion as newprice,p.promotion,(p.promotion/p.price) * 100 as perzen,p.qty*(p.price - p.promotion) as total from  product p left join categorydetail i  on p.cated_id=i.cated_id left join category c on i.cate_id=c.cate_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where p.pro_id like '$query' or pro_name like '$query' or brand_name like '$query' or unit_name like '$query' or cate_name like '$query' order by pro_name asc"); 
    }
     else
     {
        $result_customer = mysqli_query($conn,"select p.pro_id,pro_name,cate_name,cated_name,brand_name,unit_name,p.img_path,p.qty,p.price,p.price - p.promotion as newprice,p.promotion,(p.promotion/p.price) * 100 as perzen,p.qty*(p.price - p.promotion) as total from  product p left join categorydetail i  on p.cated_id=i.cated_id left join category c on i.cate_id=c.cate_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where p.pro_id like '%%' or pro_name like '%%' or brand_name like '%%' or unit_name like '%%' or cate_name like '%%' order by pro_name asc");
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
                        ລາຍງານຂໍ້ມູນສິນຄ້າ
                    </b>
                </u>
            </div>
            <table width="100%;">
                <tr style="font-size: 14px;" >
                    <th style="width: 25px;">#</th>
                    <th style="width: 60px;" scope="col">ສິນຄ້າ</th>
                    <th style="width: 90px;" scope="col">ລະຫັດສິນຄ້າ</th>
                    <th style="width: 140px;" scope="col">ຊື່ສິນຄ້າ</th>
                    <th style="width: 100px;" scope="col">ຈຳນວນ</th>
                    <th style="width: 170px;" scope="col">ລາຄາ</th>
                    <th style="width: 170px;" scope="col">ລວມ</th>
                </tr>
                ';
                if(mysqli_num_rows($result_customer) > 0){
                    $amount = 0;
                    while($row = mysqli_fetch_array($result_customer)){
                        $Bill = $Bill + 1 ;
                        $total =  $row["qty"] * $row["newprice"];
                        $amount += $total;
                        $content .='
                        <tr>
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
                            <td>'.$row["qty"].' '.$row["unit_name"].'</td>
                            <td align="left" style="padding-left: 15px;">
                                <h6 style="color: #CE3131;">ລາຄາ '.number_format($row["newprice"],2).' ກີບ</h6>
                                <h7>ລາຄາປົກກະຕິ '.number_format($row["price"],2).' ກີບ</h7>
                                <div style="color: #7E7C7C;font-size: 12px;">ສ່ວນຫຼຸດ '.number_format($row["promotion"],2).'  ກີບ ('.number_format($row["perzen"],2).' %)</div>
                            </td>
                            <td><h6 style="color: #CE3131;">'.number_format($total,2).' ກີບ</h6></td>
                        </tr>
                        ';
                    }
                }   
                $content .='
                <tr>
                    <td colspan="4" align="right"><h4>ລວມມູນຄ່າ:</h4></td>
                    <td colspan="3" align="right"><h4 style="color: red;">'.number_format($amount,2).' ກີບ</h4></td>
                </tr>
                </table><br>
            ';
$mpdf = new \Mpdf\Mpdf([
    'format'            => 'A4-L',
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
$mpdf->Output('ລາຍງານສິນຄ້າ.pdf','I');
?>