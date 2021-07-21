<?php
    $output = "";
    $amount = 0;
    if(isset($_POST["btnExcel"]))
    {
        require '../../oop/obj.php';
        $date1 = $_POST["excel_date1"];
        $date2 = $_POST["excel_date2"];
        $result_pay = mysqli_query($conn,"select d.pro_id,pro_name,sum(d.qty) as total_qty,sum(d.qty*d.price) as total,count(d.pro_id) as count_product,p.img_path,cate_name,cated_name,brand_name,unit_name from selldetail d left join sell s on d.sell_id=s.sell_id left join product p on d.pro_id=p.pro_id left join categorydetail i on p.cated_id=i.cated_id left join category c on i.cate_id=c.cate_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where sell_date between '$date1' and '$date2' group by d.pro_id order by count(d.pro_id) desc");
        $output .= '
        <table style="width: 1500px;font-size: 18px;font-family: '."Phetsarath OT".';" border="1">
            <tr style="font-size: 14px;" >
                <th style="width: 50px;">#</th>
                <th style="width: 190px;" scope="col">ລະຫັດສິນຄ້າ</th>
                <th style="width: 240px;" scope="col">ຊື່ສິນຄ້າ</th>
                <th style="width: 100px;" scope="col">ຈຳນວນ</th>
                <th style="width: 130px;" scope="col">ລວມ</th>
            </tr>
        ';
        $Bill = 0;
        $amount = 0;
        while($row = mysqli_fetch_array($result_pay)){
            $Bill = $Bill + 1 ;
            $amount += $row["total"];
            $output .='
                <tr align="center">
                    <td>'.$Bill.'</td>
                    <td>'.$row["pro_id"].'</td>
                    <td> '.$row["cate_name"].' '.$row["cated_name"].' '.$row["brand_name"].' '.$row["pro_name"].'</td>
                    <td>'.$row["total_qty"].' '.$row["unit_name"].'</td>
                    <td>'.number_format($row["total"],2).' ກີບ</td> 
                </tr>
            ';
        }   
            $output .='
            <tr>
                <td colspan="3" align="right"><h4>ມູນຄ່າທັງໝົດ:</h4></td>
                <td colspan="2" align="right"><h4 style="color: red;">'.number_format($amount).'</h4></td>
            </tr>
            </table><br>
        ';
        header("Content-Type: application/xls");
        header("Content-Disposition:attachment; filename=bestsell.xls");
        echo $output;
    }
?>