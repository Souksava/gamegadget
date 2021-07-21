<?php
    $output = "";
    $amount = 0;
    if(isset($_POST["btnExcel"]))
    {
        require '../../oop/obj.php';
        $query = "%".$_POST["excel_search"]."%";
        $result_customer = mysqli_query($conn,"select emp_id,emp_name,emp_surname,gender,dob,address,tel,email,md5(pass) as pass,e.status,name,work_start,end_work,img_path,DATEDIFF('$Date',dob)/365 AS age from employees e left join status s on e.status=s.id where emp_id like '$query' or emp_name like '$query' or emp_surname like '$query' or gender like '$query' or email like '$query' order by emp_name");
        $output .= '
        <table style="width: 1500px;font-size: 18px;font-family: '."Phetsarath OT".';" border="1">
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
        </tr>
        ';
        $Bill = 0;
        while($row = mysqli_fetch_array($result_customer)){
            $Bill = $Bill + 1 ;
            $output .='
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
                </tr>
            ';
        }   
            $output .='
            <tr>
                <td colspan="7" align="right"><h4>ຈຳນວນທັງໝົດ:</h4></td>
                <td colspan="4" align="right"><h4 style="color: red;">'.number_format($Bill).'</h4></td>
            </tr>
            </table><br>
        ';
        header("Content-Type: application/xls");
        header("Content-Disposition:attachment; filename=employee.xls");
        echo $output;
    }
?>