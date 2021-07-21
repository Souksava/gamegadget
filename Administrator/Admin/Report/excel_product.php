<?php
    $output = "";
    $amount = 0;
    if(isset($_POST["btnExcel"]))
    {
        require '../../oop/obj.php';
        $query = "%".$_POST["excel_search"]."%";
        $result_customer = mysqli_query($conn,"select p.pro_id,pro_name,cate_name,cated_name,brand_name,unit_name,p.img_path,p.qty,p.price,p.price - p.promotion as newprice,p.promotion,(p.promotion/p.price) * 100 as perzen,p.qty*(p.price - p.promotion) as total from  product p left join categorydetail i  on p.cated_id=i.cated_id left join category c on i.cate_id=c.cate_id left join brand b on p.brand_id=b.brand_id left join unit u on p.unit_id=u.unit_id where p.pro_id like '$query' or pro_name like '$query' or brand_name like '$query' or unit_name like '$query' or cate_name like '$query' order by pro_name asc"); 
        $output .= '
        <table style="width: 1800px;font-size: 18px;font-family: '."Phetsarath OT".';" border="1">
            <tr style="font-size: 16px;" >
                <th style="width: 50px;">#</th>
                <th style="width: 150px;" scope="col">ລະຫັດສິນຄ້າ</th>
                <th style="width: 240px;" scope="col">ຊື່ສິນຄ້າ</th>
                <th style="width: 150px;" scope="col">ຈຳນວນ</th>
                <th style="width: 270px;" scope="col">ລາຄາ</th>
                <th style="width: 270px;" scope="col">ລວມ</th>
            </tr>
        ';
        $Bill = 0;
        $amount = 0;
        while($row = mysqli_fetch_array($result_customer)){
            $Bill = $Bill + 1 ;
            $total =  $row["qty"] * $row["newprice"];
            $amount += $total;
            $output .='
            <tr>
                <td>'.$Bill.'</td>
                <td>'.$row["pro_id"].'</td>
                <td> '.$row["cate_name"].' '.$row["cated_name"].' '.$row["brand_name"].' '.$row["pro_name"].'</td>
                <td>'.$row["qty"].' '.$row["unit_name"].'</td>
                <td align="left" style="padding-left: 15px;">
                    <h3 style="color: #CE3131;">ລາຄາ '.number_format($row["newprice"],2).' ກີບ</h3>
                    <h7>ລາຄາປົກກະຕິ '.number_format($row["price"],2).' ກີບ</h7>
                    <div style="color: #7E7C7C;font-size: 12px;">ສ່ວນຫຼຸດ '.number_format($row["promotion"],2).'  ກີບ ('.number_format($row["perzen"],2).' %)</div>
                </td>
                <td><h6 style="color: #CE3131;">'.number_format($total,2).' ກີບ</h6></td>
            </tr>
            ';
        }   
            $output .='
            <tr>
                <td colspan="4" align="right"><h4>ລວມມູນຄ່າ:</h4></td>
                <td colspan="3" align="right"><h4 style="color: red;">'.number_format($Bill).'</h4></td>
            </tr>
            </table><br>
        ';
        header("Content-Type: application/xls");
        header("Content-Disposition:attachment; filename=product.xls");
        echo $output;
    }
?>