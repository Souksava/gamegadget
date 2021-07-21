
<?php
require_once __DIR__ . '../../../vendor/autoload.php';
$amount = 0;
$Bill = 0;
    $content = '';
    require '../../oop/obj.php';
    if(isset($_POST["btnPDF"]))
    {
        $query = "%".$_POST["pdf_search"]."%";
        $result_customer = mysqli_query($conn,"select emp_id,emp_name,emp_surname,gender,dob,address,tel,email,md5(pass) as pass,e.status,name,work_start,end_work,img_path,DATEDIFF('$Date',dob)/365 AS age from employees e left join status s on e.status=s.id where emp_id like '$query' or emp_name like '$query' or emp_surname like '$query' or gender like '$query' or email like '$query' order by emp_name");
        
    }
     else
     {
        $result_customer = mysqli_query($conn,"select emp_id,emp_name,emp_surname,gender,dob,address,tel,email,md5(pass) as pass,e.status,name,work_start,end_work,img_path,DATEDIFF('$Date',dob)/365 AS age from employees e left join status s on e.status=s.id where emp_id like '%%' or emp_name like '%%' or emp_surname like '%%' or gender like '%%' or email like '%%' order by emp_name asc");
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
                        ລາຍງານຂໍ້ມູນພະນັກງານ
                    </b>
                </u>
            </div>
            <table width="100%;">
                <tr style="font-size: 16px;" >
                    <th style="width: 50px;">ລຳດັບ</th>
                    <th style="width: 150px;">ລະຫັດພະນັກງານ</th>
                    <th style="width: 150px;">ຊື່ພະນັກງານ</th>
                    <th style="width: 150px;">ນາມສະກຸນ</th>
                    <th style="width: 80px;">ເພດ</th>
                    <th style="width: 120px;">ວັນເດືອນປີເກີດ</th>
                    <th style="width: 350px;">ທີ່ຢູ່ປັດຈຸບັນ</th>
                    <th style="width: 180px;">ເບີໂທລະສັບ</th>
                    <th style="width: 220px;">ອີເມວ</th>
                    <th style="width: 200px;">ລະຫັດ</th>
                    <th style="width: 170px;">ຮູບພາບ</th>
                </tr>
                ';
                if(mysqli_num_rows($result_customer) > 0){
                  
                    while($row = mysqli_fetch_array($result_customer)){
                        $Bill = $Bill + 1 ;
                        $content .='
                            <tr align="center">
                                <td>'.$Bill.'</td>
                                <td>'.$row["emp_id"].'</td>
                                <td>'.$row["emp_name"].'</td>
                                <td>'.$row["emp_surname"].'</td>
                                <td>'.$row["gender"].'</td>
                                <td>'.date("d/m/Y",strtotime($row["dob"])).'</td>
                                <td>'.$row["address"].'</td>
                                <td>'.$row["tel"].'</td>
                                <td>'.$row["email"].'</td>
                                <td>'.$row["pass"].'</td>
                                ';
                                if($row["img_path"] == ""){
                                    $row["img_path"] = "image.jpeg";
                                }
                                $content .='
                                <td style="text-align: center;">
                                    <img src="../../image/'.$row["img_path"].'" alt="'.$row["img_path"].'" width="55px" />
                                </td>
                            </tr>
                        ';
                    }
                }   
                $content .='
                <tr>
                    <td colspan="7" align="right"><h4>ຈຳນວນທັງໝົດ:</h4></td>
                    <td colspan="4" align="right"><h4 style="color: red;">'.number_format($Bill).'</h4></td>
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
$mpdf->Output('ລາຍງານພະນັກງານ.pdf','I');
?>