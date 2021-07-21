<?php
    $output = "";
    $amount = 0;
    if(isset($_POST["btnExcel"]))
    {
        require '../../oop/obj.php';
        $date1 = $_POST["excel_date1"];
        $date2 = $_POST["excel_date2"];
        $result_pay = mysqli_query($conn,"select imp_id,imp_bill,order_id,company,emp_name,i.pro_id,pro_name,unit_name,brand_name,cate_name,cated_name,i.qty,i.price,i.qty*i.price as total,imp_date,imp_time,note,p.img_path from imports i left join product p on i.pro_id=p.pro_id left join brand b on p.brand_id=b.brand_id left join categorydetail d on p.cated_id=d.cated_id left join unit u on p.unit_id=u.unit_id left join category c on d.cate_id=c.cate_id left join suppliers s on i.sup_id=s.sup_id left join employees e on i.emp_id=e.emp_id where imp_date between '$date1' and '$date2' order by pro_name asc");
        $output .= '
        <table style="width: 2000px;font-size: 18px;font-family: '."Phetsarath OT".';" border="1">
            <tr style="font-size: 14px;" >
                <th style="width: 45px;">#</th>
                <th style="width: 250px;" scope="col">ລະຫັດສິນຄ້າ</th>
                <th style="width: 350px;" scope="col">ຊື່ສິນຄ້າ</th>
                <th style="width: 220px;" scope="col">ຈຳນວນ</th>
                <th style="width: 220px;" scope="col">ລາຄາ</th>
                <th style="width: 250px;" scope="col">ລວມ</th>
                <th style="width: 280px;" scope="col">ເລກທີບິນນຳເຂົ້າ</th>
                <th style="width: 220px;" scope="col">ຜູ້ສະໜອງ</th>
                <th style="width: 220px;" scope="col">ຜູ້ນຳເຂົ້າ</th>
                <th style="width: 360px;" scope="col">ວັນທີ</th>
                <th style="width: 480px;" scope="col">ໝາຍເຫດ</th>
            </tr>
        ';
        $Bill = 0;
        $amount = 0;
        while($row = mysqli_fetch_array($result_pay)){
            $Bill = $Bill + 1 ;
            $amount += $row["total"];
            $output .='
                <tr align="center">
                    <td align="center">'.$Bill.'</td>
                    <td align="center">'.$row["pro_id"].'</td>
                    <td align="center">'.$row["cate_name"].' '.$row["brand_name"].' '.$row["pro_name"].' '.$row["cated_name"].'</td>
                    <td align="center">'.$row["qty"].' '.$row["unit_name"].'</td>
                    <td align="center">'.number_format($row["price"],2).'</td>
                    <td align="center">'.number_format($row["total"],2).'</td>
                    <td align="center">'.$row["imp_bill"].'</td>
                    <td align="center">'.$row["company"].'</td>
                    <td align="center">'.$row["emp_name"].'</td>
                    <td align="center">'.date("d/m/Y",strtotime($row["imp_date"])).'</td>
                    <td align="center">'.$row["note"].'</td>
                </tr>
            ';
        }   
            $output .='
            <tr>
                <td colspan="7" align="right"><h4>ມູນຄ່າທັງໝົດ:</h4></td>
                <td colspan="4" align="right"><h4 style="color: red;">'.number_format($amount).'</h4></td>
            </tr>
            </table><br>
        ';
        header("Content-Type: application/xls");
        header("Content-Disposition:attachment; filename=import.xls");
        echo $output;
    }
?>