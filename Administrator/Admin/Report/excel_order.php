<?php
    $output = "";
    $amount = 0;
    if(isset($_POST["btnExcel"]))
    {
        require '../../oop/obj.php';
        $date1 = $_POST["excel_date1"];
        $date2 = $_POST["excel_date2"];
        $result_pay = mysqli_query($conn,"select order_id,emp_name,company,amount,order_date,order_time,o.status,seen2,rate_id,rate_buy from orders o left join employees e on o.emp_id=e.emp_id left join suppliers s  on o.sup_id=s.sup_id where order_date between '$date1' and '$date2' order by order_date asc;");        
        $output .= '
        <table style="width: 2000px;font-size: 18px;font-family: '."Phetsarath OT".';" border="1">
            <tr style="font-size: 14px;" >
                <th style="width: 40px">No.</th>
                <th style="width: 180px">ເລກທີບິນ</th>
                <th style="width: 180px">ຜູ້ສະໜອງ</th>
                <th style="width: 280px">ລວມ</th>
                <th style="width: 180px">ຜູ້ສັ່ງຊື້</th>
                <th style="width: 180px">ວັນທີ</th>
                <th style="width: 120px">ເວລາ</th>
                <th style="width: 150px">ສະຖານະ</th>
            </tr>
        ';
        $Bill = 0;
        $amount = 0;
        while($row = mysqli_fetch_array($result_pay)){
            $Bill = $Bill + 1 ;
            $amount += $row["amount"];
            $output .='
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
        $result_amount = mysqli_query($conn,"select sum(amount) as amount,rate_id from orders where order_date between '$date1' and '$date2' group by rate_id order by rate_id asc;");
        foreach($result_amount as $row_a){
        $output .='
        <tr>
            <td colspan="6" align="right"><h4>ມູນຄ່າທັງໝົດ ('.$row_a["rate_id"].'):</h4></td>
            <td colspan="2" align="right"><h4 style="color: red;">'.number_format($row_a["amount"],2).' '.$row_a["rate_id"].'</h4></td>
        </tr>
        ';
        }
        $output .='
            </table><br>
        ';
        header("Content-Type: application/xls");
        header("Content-Disposition:attachment; filename=Order.xls");
        echo $output;
    }
?>