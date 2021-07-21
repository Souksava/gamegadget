<?php
    $output = "";
    $amount = 0;
    if(isset($_POST["btnExcel"]))
    {
        require '../../oop/obj.php';
        $date1 = $_POST["excel_date1"];
        $date2 = $_POST["excel_date2"];
        $result_pay = mysqli_query($conn,"select sell_id,cus_name,sell_date,sell_time,amount,sell_type,getmoney,s.img_path,note,s.status,status_cash,emp_name from sell s left join customers c on s.cus_id=c.cus_id left join employees e on s.emp_id=e.emp_id where  sell_date between '$date1' and '$date2' order by s.sell_id asc;");        
        $output .= '
        <table style="width: 2000px;font-size: 18px;font-family: '."Phetsarath OT".';" border="1">
            <tr style="font-size: 14px;" >
                <th style="width: 35px;">ລຳດັບ</th>
                <th style="width: 120px;">ເລກທີບິນ</th>
                <th style="width: 150px;">ລູກຄ້າ</th>
                <th style="width: 120px;">ມູນຄ່າລວມ</th>
                <th style="width: 100px;">ສະຖານະ</th>
                <th style="width: 100px;">ການຈ່າຍ</th>
                <th style="width: 100px;">ປະເພດຂາຍ</th>
                <th style="width: 120px;">ວັນທີເວລາ</th>
                <th style="width: 180px;">ໝາຍເຫດ </th>
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
                    <td>'.$row["sell_id"].'</td>
                    <td>'.$row["cus_name"].'</td>
                    <td>'.number_format($row["amount"],2).'</td>
                    <td>'.$row["status"].'</td>
                    <td>'.$row["status_cash"].'</td>
                    <td>'.$row["sell_type"].'</td>
                    <td>'.date("d/m/Y",strtotime($row["sell_date"])).'</td>
                    <td>'.$row["note"].'</td>
                </tr>
            ';
        }   
            $output .='
            <tr>
                <td colspan="6" align="right"><h4>ມູນຄ່າທັງໝົດ:</h4></td>
                <td colspan="3" align="right"><h4 style="color: red;">'.number_format($amount).'</h4></td>
            </tr>
            </table><br>
        ';
        header("Content-Type: application/xls");
        header("Content-Disposition:attachment; filename=sell.xls");
        echo $output;
    }
?>