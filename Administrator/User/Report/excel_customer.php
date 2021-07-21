<?php
    $output = "";
    $amount = 0;
    if(isset($_POST["btnExcel"]))
    {
        require '../../oop/obj.php';
        $query = "%".$_POST["excel_search"]."%";
        $result_customer = mysqli_query($conn,"select * from customers where cus_id like '$query' or cus_name like '$query' or cus_surname like '$query' or gender like '$query' or email like '$query' order by cus_name asc;");        
        $output .= '
        <table style="width: 1500px;font-size: 18px;font-family: '."Phetsarath OT".';" border="1">
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
        $Bill = 0;
        while($row = mysqli_fetch_array($result_customer)){
            $Bill = $Bill + 1 ;
            $output .='
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
            $output .='
            <tr>
                <td colspan="5" align="right"><h4>ຈຳນວນທັງໝົດ:</h4></td>
                <td colspan="3" align="right"><h4 style="color: red;">'.number_format($Bill).'</h4></td>
            </tr>
            </table><br>
        ';
        header("Content-Type: application/xls");
        header("Content-Disposition:attachment; filename=customer.xls");
        echo $output;
    }
?>