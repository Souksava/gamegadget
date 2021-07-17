<?php
 include ('connect.php');
date_default_timezone_set("Asia/Bangkok");
$datenow = time();
$Date = date("Y-m-d",$datenow);
$Time = date("H:i:s",$datenow);
$Year = date("Y",$datenow);
class obj{
    public $conn;
    public $search;
    public static function login($email,$pass){
        global $conn;
        session_start();
        $pass = md5($pass);
        $resultck = mysqli_query($conn, "call login('$email','$pass')");
        if($email == "")
        {
            echo"<script>";
            echo"window.location.href='Login?email=null';";
            echo"</script>";
        }
        else if($pass == "")
        {
            echo"<script>";
            echo"window.location.href='Login?pass=null';";
            echo"</script>";
        }
        else if(!mysqli_num_rows($resultck))
        {
            echo"<script>";
            echo"window.location.href='Login?login=false';";
            echo"</script>";
        }
        else 
        {
            if(mysqli_num_rows($resultck) <= 0){
                echo"<meta http-equiv-'refress' content='1;URL=/'>";
            }
            else{
               
                while($user = mysqli_fetch_array($resultck))
                {
                    if($user['status'] == 1)
                    {
                        $_SESSION['game_gadget_lao_ses_id'] = session_id();
                        $_SESSION['emp_id'] = $user['emp_id'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['emp_name'] = $user['emp_name'];
                        $_SESSION['img_path'] = $user['img_path'];
                        $_SESSION['game_gadget_lao_ses_status_id'] = 1;
                        echo"<meta http-equiv='refresh' content='1;URL=Admin/Main'>";
                    }
                    else if($user['status'] == 2)
                    {
                        $_SESSION['game_gadget_lao_ses_id'] = session_id();
                        $_SESSION['emp_id'] = $user['emp_id'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['emp_name'] = $user['emp_name'];
                        $_SESSION['img_path'] = $user['img_path'];
                        $_SESSION['game_gadget_lao_ses_status_id'] = 2;
                        echo"<meta http-equiv='refresh' content='1;URL=User/Main'>";
                    }
                    else
                    {
                        $_SESSION['game_gadget_lao_ses_id'] = session_id();
                        session_start();
                        unset($_SESSION['game_gadget_lao_ses_id']);
                        unset($_SESSION['emp_id']);
                        unset($_SESSION['email']);
                        unset($_SESSION['emp_name']);
                        unset($_SESSION['img_path']);
                        unset($_SESSION['game_gadget_lao_ses_status_id']);
                        session_destroy();
                        echo"<script>";
                        echo"window.location.href='/?permission=found';";
                        echo"</script>";
                    }

                }
            }
        }  
    }
    public static function logout(){
        session_start();
        unset($_SESSION['game_gadget_lao_ses_id']);
        unset($_SESSION['emp_id']);
        unset($_SESSION['email']);
        unset($_SESSION['emp_name']);
        unset($_SESSION['img_path']);
        unset($_SESSION['game_gadget_lao_ses_status_id']);
        session_destroy();
        global $session_path;
        echo"<script>";
        echo"window.location.href='$session_path';";
        echo"</script>";
    }
    public static function select_order_cookie(){
        global $cart_data;
        if(isset($_COOKIE['list_order'])){//ຕອນໂຫຼດກວດສອບວ່າຄຸກກີ້ມີຄ່າວ່າງຫຼືບໍ່
            $cookie_data = $_COOKIE['list_order'];//ຕັ້ງຄຸກກີ້ໃຫ້ເປັນ string
            $cart_data = json_decode($cookie_data, true);// ຕັ້ງຄຸກກີ້ໃຫ້ເປັນຮູບແບບ json
        }
    }
    public static function cookie_order($pro_id,$qty,$price){
        global $conn;
        $check_product = mysqli_query($conn,"select * from product where pro_id='$pro_id';");
        if(mysqli_num_rows($check_product) > 0){
            if(isset($_COOKIE['list_order'])){//ກວດສອບວ່າຄຸກກີ້ distribute_list ນັ້ນມີຄ່າຫຼືບໍ່
                $cookie_data = $_COOKIE['list_order'];//ຕັ້ງຄ່າຄຸກກີ້ໃຫ້ເປັນ String
                $cart_data = json_decode($cookie_data, true);//Decode ຄ່າຄຸກກີ້ອອກມາໃຫ້ອ່ານຄ່າເປັນ Array ໄດ້ໃນຮູບແບບ json
            }
            else{
                $cart_data = array();//ຖ້າຄຸກກີ້ບໍ່ມີຄ່າຂໍ້ມູນແລ້ວຕັ້ງໂຕປ່ຽນໃຫ້ເປັນອາເລ
            }
            $item_id_list = array_column($cart_data,'pro_id');//ຕັ້ງຄ່າ serial ໃຫ້ມີຄ່າເທົ່າກັບ array $cart_data['code']
            if(in_array($pro_id,$item_id_list)){//ຖ້າວ່າໄອດີທີ່ປ້ອນມາທາງຄີບອດຕົງກັນກັບໄອດີທີ່ຢູ່ໃນ Array Cart_data ໃຫ້ເຮັດວຽກຈຸດນີ້
                foreach($cart_data as $keys => $values){//Loop ຂໍ້ມູນ cart_data ອອກມາເພື່ອຊອກຫາໄອດີທີ່ປ້ອນເຂົ້າມາກັບໄອດີທີ່ຢູ່ໃນ cart_data ທີ່ຕົງກັນ
                    if($cart_data[$keys]["pro_id"] == $pro_id){//ຖ້າຫາກວ່າຊອກຫາໄອດີທີຕົງກັນໄດ້ແລ້ວແມ່ນເຮັດວຽກດັ່ງນີ້
                        $cart_data[$keys]["qty"] = $cart_data[$keys]["qty"] + $qty;//ປັບໃຫ້ຈຳນວນຂອງ array cart_data ບວກໃຫ້ກັບຈຳນວນທີ່ປ້ອນເຂົ້າມາ
                    }
                }
                echo"<script>";
                echo"window.location.href='Order';";
                echo"</script>";
            }
            else{ // ຖ້າວ່າໄອດີບໍ່ຕົງກັນໃຫ້ເພີ່ມຂໍ້ມູນເຂົ້າໃນຄຸກກີ້
                $getin = mysqli_query($conn,"SELECT pro_id,pro_name,qty,price,p.cate_id,cate_name,p.unit_id,unit_name,p.brand_id,brand_name,p.size_id,size_name,qty_alert,img FROM product p LEFT JOIN category c ON p.cate_id=c.cate_id LEFT JOIN unit u ON p.unit_id=u.unit_id LEFT JOIN brand b ON p.brand_id=b.brand_id LEFT JOIN size s ON p.size_id=s.size_id WHERE pro_id = '$pro_id';");
                $get_info = mysqli_fetch_array($getin,MYSQLI_ASSOC);
                $pro_name = $get_info['pro_name'];
                $cate_name = $get_info['cate_name'];
                $unit_name = $get_info['unit_name'];
                $brand_name = $get_info['brand_name'];
                $size_name = $get_info['size_name'];
                $img = $get_info['img'];
                $item_array = [//ເພີ່ມຂໍ້ມູນທີ່ຮັບມາຈາກຄີບອດເຂົ້າໄວ້ໃນຕົວປ່ຽນອາເລ $item_array
                    "pro_id" => $pro_id,
                    "img" => $img,
                    "pro_name" => $pro_name,
                    "unit_name" => $unit_name,
                    "cate_name" => $cate_name,
                    "brand_name" => $brand_name,
                    "size_name" => $size_name,
                    "qty" => $qty,
                    "price" => $price
                ];
                $cart_data[] = $item_array;//ເພີ່ມຂໍ້ມູນຈາກ $item_array ເຂົ້າໄປໃນ $cart_data
            }
            $item_data ="";
            $item_data = json_encode($cart_data);//ປັບ item_data ໃຫ້ມັນສິ້ນສຸດການຮັບຂໍ້ມູນຈາກ $cart_data
            setcookie('list_order',$item_data,time() + (86400 * 30));//ຕັ້ງຄ່າເວລາຄຸກກີ້
            echo"<script>";
            echo"window.location.href='Order';";
            echo"</script>";
        
        }
        else{
            echo"<script>";
            echo"window.location.href='Order?product=null';";
            echo"</script>";
        }
            
        
    }
    public static function clear_order(){
        setcookie("list_order","",time() - 3600);//ຕັ້ງຄ່າໃຫ້ຄຸກກີ້ໃຫ້ເປັນຄ່າວ່າງ
        echo"<script>";
        echo"window.location.href='Order';";
        echo"</script>";
    }
    public static function del_order($pro_id){
        $cookie_data = $_COOKIE['list_order'];//ຕັ້ງຄ່າຄຸກກີ້ໃຫ້ເປັນ String
        $cart_data = json_decode($cookie_data, true);//ຕັ້ງຄ່າຄຸກກີ້ໃຫ້ເປັນອາເລໃນຮູບແບບ json
        foreach($cart_data as $keys => $values){//ຊອກຫາຄ່າໄອດີຢູ່ໃນອາເລ
            if($cart_data[$keys]['pro_id'] == $pro_id){//ຖ້າໄອດີຕົງກັນໃຫ້ລົບຂໍ້ມູນ
                unset($cart_data[$keys]);//ລົບຂໍ້ມູນຢູ່ຄຸກກີ້ໝົດແຖວທີ່ມີໄອດີຕົງກັນ
                $item_data = json_encode($cart_data);//ໃຫ້ຈົບການສ້າງອາເລໃນຮູບແບບ json
                setcookie('list_order',$item_data,time() + (86400 * 30));//ຕັ້ງເວລາຄຸກກີ້
                foreach($cart_data as $keys => $values){}
                if(!$cart_data[$keys]){
                    setcookie("list_order","",time() - 3600);//ຕັ້ງຄ່າໃຫ້ຄຸກກີ້ໃຫ້ເປັນຄ່າວ່າງ
                }
                echo"<script>";
                echo"window.location.href='Order';";
                echo"</script>";
            }
        }
    }
    public static function save_order($order_id,$emp_id,$sup_id){
        global $conn;
        if(isset($_COOKIE['list_order'])){//ກວດສອບວ່າຄຸກກີ້ order ນັ້ນມີຄ່າຫຼືບໍ່
            $result = mysqli_query($conn,"call insert_order('$order_id','$emp_id','$sup_id')");
            // mysqli_free_result($result);  
            // mysqli_next_result($conn);
            if(!$result){
                echo"<script>";
                echo"window.location.href='Order?save=fail';";
                echo"</script>";
            }
            else{
                $cookie_data = $_COOKIE['list_order'];//ຕັ້ງຄ່າຄຸກກີ້ໃຫ້ເປັນ String
                $cart_data = json_decode($cookie_data, true);//Decode ຄ່າຄຸກກີ້ອອກມາໃຫ້ອ່ານຄ່າເປັນ Array ໄດ້ໃນຮູບແບບ json
                foreach($cart_data as $data){
                    $pro_id = $data['pro_id'];
                    $qty = $data['qty'];
                    $price = $data['price'];
                    $result2 = mysqli_query($conn,"call insert_order_detail('$pro_id','$qty','$price','$order_id')");
                    // mysqli_free_result($result2);  
                    // mysqli_next_result($conn);
                }
                if(!$result2){
                    echo"<script>";
                    echo"window.location.href='Order?save=fail';";
                    echo"</script>";
                }
                else{
                    setcookie("list_order","",time() - 3600);//ຕັ້ງຄ່າໃຫ້ຄຸກກີ້ໃຫ້ເປັນຄ່າວ່າງ
                    echo"<script>";
                    echo"window.location.href='Order?save2=success';";
                    echo"</script>";
                }
            }
        }
        else{
            echo"<script>";
            echo"window.location.href='Order?list=null';";
            echo"</script>";
        }
    }
    public static function cookie_import($pro_id,$qty,$price,$remark){
        global $conn;
        $check_product = mysqli_query($conn,"select * from product where pro_id='$pro_id';");
        if(mysqli_num_rows($check_product) > 0){
            if(isset($_COOKIE['list_import'])){//ກວດສອບວ່າຄຸກກີ້ distribute_list ນັ້ນມີຄ່າຫຼືບໍ່
                $cookie_data = $_COOKIE['list_import'];//ຕັ້ງຄ່າຄຸກກີ້ໃຫ້ເປັນ String
                $cart_data = json_decode($cookie_data, true);//Decode ຄ່າຄຸກກີ້ອອກມາໃຫ້ອ່ານຄ່າເປັນ Array ໄດ້ໃນຮູບແບບ json
            }
            else{
                $cart_data = array();//ຖ້າຄຸກກີ້ບໍ່ມີຄ່າຂໍ້ມູນແລ້ວຕັ້ງໂຕປ່ຽນໃຫ້ເປັນອາເລ
            }
            $item_id_list = array_column($cart_data,'pro_id');//ຕັ້ງຄ່າ serial ໃຫ້ມີຄ່າເທົ່າກັບ array $cart_data['code']
            if(in_array($pro_id,$item_id_list)){//ຖ້າວ່າໄອດີທີ່ປ້ອນມາທາງຄີບອດຕົງກັນກັບໄອດີທີ່ຢູ່ໃນ Array Cart_data ໃຫ້ເຮັດວຽກຈຸດນີ້
                foreach($cart_data as $keys => $values){//Loop ຂໍ້ມູນ cart_data ອອກມາເພື່ອຊອກຫາໄອດີທີ່ປ້ອນເຂົ້າມາກັບໄອດີທີ່ຢູ່ໃນ cart_data ທີ່ຕົງກັນ
                    if($cart_data[$keys]["pro_id"] == $pro_id){//ຖ້າຫາກວ່າຊອກຫາໄອດີທີຕົງກັນໄດ້ແລ້ວແມ່ນເຮັດວຽກດັ່ງນີ້
                        $cart_data[$keys]["qty"] = $cart_data[$keys]["qty"] + $qty;//ປັບໃຫ້ຈຳນວນຂອງ array cart_data ບວກໃຫ້ກັບຈຳນວນທີ່ປ້ອນເຂົ້າມາ
                    }
                }
            }
            else{ // ຖ້າວ່າໄອດີບໍ່ຕົງກັນໃຫ້ເພີ່ມຂໍ້ມູນເຂົ້າໃນຄຸກກີ້
                $getin = mysqli_query($conn,"SELECT pro_id,pro_name,qty,price,p.cate_id,cate_name,p.unit_id,unit_name,p.brand_id,brand_name,p.size_id,size_name,qty_alert,img FROM product p LEFT JOIN category c ON p.cate_id=c.cate_id LEFT JOIN unit u ON p.unit_id=u.unit_id LEFT JOIN brand b ON p.brand_id=b.brand_id LEFT JOIN size s ON p.size_id=s.size_id WHERE pro_id = '$pro_id';");
                $get_info = mysqli_fetch_array($getin,MYSQLI_ASSOC);
                $pro_name = $get_info['pro_name'];
                $cate_name = $get_info['cate_name'];
                $unit_name = $get_info['unit_name'];
                $brand_name = $get_info['brand_name'];
                $size_name = $get_info['size_name'];
                $img = $get_info['img'];
                $item_array = [//ເພີ່ມຂໍ້ມູນທີ່ຮັບມາຈາກຄີບອດເຂົ້າໄວ້ໃນຕົວປ່ຽນອາເລ $item_array
                    "pro_id" => $pro_id,
                    "img" => $img,
                    "pro_name" => $pro_name,
                    "unit_name" => $unit_name,
                    "cate_name" => $cate_name,
                    "brand_name" => $brand_name,
                    "size_name" => $size_name,
                    "qty" => $qty,
                    "price" => $price,
                    "remark" => $remark
                ];
                $cart_data[] = $item_array;//ເພີ່ມຂໍ້ມູນຈາກ $item_array ເຂົ້າໄປໃນ $cart_data
            }
            $item_data ="";
            $item_data = json_encode($cart_data);//ປັບ item_data ໃຫ້ມັນສິ້ນສຸດການຮັບຂໍ້ມູນຈາກ $cart_data
            setcookie('list_import',$item_data,time() + (86400 * 30));//ຕັ້ງຄ່າເວລາຄຸກກີ້
            echo"<script>";
            echo"window.location.href='Import';";
            echo"</script>";
        }
        else{
            echo"<script>";
            echo"window.location.href='Import?product=null';";
            echo"</script>";
        }
 
    }
    public static function select_import_cookie(){
        global $cart_data;
        if(isset($_COOKIE['list_import'])){//ຕອນໂຫຼດກວດສອບວ່າຄຸກກີ້ມີຄ່າວ່າງຫຼືບໍ່
            $cookie_data = $_COOKIE['list_import'];//ຕັ້ງຄຸກກີ້ໃຫ້ເປັນ string
            $cart_data = json_decode($cookie_data, true);// ຕັ້ງຄຸກກີ້ໃຫ້ເປັນຮູບແບບ json
        }
    }
    public static function clear_import(){
        setcookie("list_import","",time() - 3600);//ຕັ້ງຄ່າໃຫ້ຄຸກກີ້ໃຫ້ເປັນຄ່າວ່າງ
        echo"<script>";
        echo"window.location.href='Import';";
        echo"</script>";
    }
    public static function del_import($pro_id){
        $cookie_data = $_COOKIE['list_import'];//ຕັ້ງຄ່າຄຸກກີ້ໃຫ້ເປັນ String
        $cart_data = json_decode($cookie_data, true);//ຕັ້ງຄ່າຄຸກກີ້ໃຫ້ເປັນອາເລໃນຮູບແບບ json
        foreach($cart_data as $keys => $values){//ຊອກຫາຄ່າໄອດີຢູ່ໃນອາເລ
            if($cart_data[$keys]['pro_id'] == $pro_id){//ຖ້າໄອດີຕົງກັນໃຫ້ລົບຂໍ້ມູນ
                unset($cart_data[$keys]);//ລົບຂໍ້ມູນຢູ່ຄຸກກີ້ໝົດແຖວທີ່ມີໄອດີຕົງກັນ
                $item_data = json_encode($cart_data);//ໃຫ້ຈົບການສ້າງອາເລໃນຮູບແບບ json
                setcookie('list_import',$item_data,time() + (86400 * 30));//ຕັ້ງເວລາຄຸກກີ້
                foreach($cart_data as $keys => $values){}
                if(!$cart_data[$keys]){
                    setcookie("list_import","",time() - 3600);//ຕັ້ງຄ່າໃຫ້ຄຸກກີ້ໃຫ້ເປັນຄ່າວ່າງ
                }
                echo"<script>";
                echo"window.location.href='Import';";
                echo"</script>";
            }
        }
    }
    public static function save_import($order_id,$emp_id,$sup_id,$import_no){
        global $conn;
        $check_order = mysqli_query($conn,"select * from orders where order_id='$order_id'");
        if(mysqli_num_rows($check_order) > 0){
            if(isset($_COOKIE['list_import'])){//ກວດສອບວ່າຄຸກກີ້ order ນັ້ນມີຄ່າຫຼືບໍ່
                $cookie_data = $_COOKIE['list_import'];//ຕັ້ງຄ່າຄຸກກີ້ໃຫ້ເປັນ String
                $cart_data = json_decode($cookie_data, true);//Decode ຄ່າຄຸກກີ້ອອກມາໃຫ້ອ່ານຄ່າເປັນ Array ໄດ້ໃນຮູບແບບ json
                foreach($cart_data as $data){
                    $pro_id = $data['pro_id'];
                    $qty = $data['qty'];
                    $price = $data['price'];
                    $remark = $data['remark'];
                    // (imp_bill,order_id,sup_id,emp_id,pro_id,qty,price,remark)
                    $result2 = mysqli_query($conn,"call insert_import('$import_no','$order_id','$sup_id','$emp_id','$pro_id','$qty','$price','$remark')");
                    mysqli_free_result($result2);  
                    mysqli_next_result($conn);
                    $update_product = mysqli_query($conn,"update product set qty=qty+'$qty' where pro_id='$pro_id'");
                }
                if(!$result2){
                    echo"<script>";
                    echo"window.location.href='Import?save=fail';";
                    echo"</script>";
                }
                else{
                    setcookie("list_import","",time() - 3600);//ຕັ້ງຄ່າໃຫ້ຄຸກກີ້ໃຫ້ເປັນຄ່າວ່າງ
                    echo"<script>";
                    echo"window.location.href='Import?save2=success';";
                    echo"</script>";
                }
            
        }
        else{
            echo"<script>";
            echo"window.location.href='Import?list=null';";
            echo"</script>";
        }
        }
        else{
            echo"<script>";
            echo"window.location.href='Import?order=wrong';";
            echo"</script>";
        }
        
    }
    public static function select_sell_cookie(){
        global $cart_data;
        if(isset($_COOKIE['list_sell'])){//ຕອນໂຫຼດກວດສອບວ່າຄຸກກີ້ມີຄ່າວ່າງຫຼືບໍ່
            $cookie_data = $_COOKIE['list_sell'];//ຕັ້ງຄຸກກີ້ໃຫ້ເປັນ string
            $cart_data = json_decode($cookie_data, true);// ຕັ້ງຄຸກກີ້ໃຫ້ເປັນຮູບແບບ json
        }
    }
    public static function cookie_sell($pro_id,$qty){
        global $conn;
        if($qty == ""){
            $qty = 1;
        }
        $check_product = mysqli_query($conn,"select * from product where pro_id='$pro_id';");
        if(mysqli_num_rows($check_product) > 0){
            if(isset($_COOKIE['list_sell'])){//ກວດສອບວ່າຄຸກກີ້ distribute_list ນັ້ນມີຄ່າຫຼືບໍ່
                $cookie_data = $_COOKIE['list_sell'];//ຕັ້ງຄ່າຄຸກກີ້ໃຫ້ເປັນ String
                $cart_data = json_decode($cookie_data, true);//Decode ຄ່າຄຸກກີ້ອອກມາໃຫ້ອ່ານຄ່າເປັນ Array ໄດ້ໃນຮູບແບບ json
            }
            else{
                $cart_data = array();//ຖ້າຄຸກກີ້ບໍ່ມີຄ່າຂໍ້ມູນແລ້ວຕັ້ງໂຕປ່ຽນໃຫ້ເປັນອາເລ
            }
            $item_id_list = array_column($cart_data,'pro_id');//ຕັ້ງຄ່າ serial ໃຫ້ມີຄ່າເທົ່າກັບ array $cart_data['code']
            if(in_array($pro_id,$item_id_list)){//ຖ້າວ່າໄອດີທີ່ປ້ອນມາທາງຄີບອດຕົງກັນກັບໄອດີທີ່ຢູ່ໃນ Array Cart_data ໃຫ້ເຮັດວຽກຈຸດນີ້
                foreach($cart_data as $keys => $values){//Loop ຂໍ້ມູນ cart_data ອອກມາເພື່ອຊອກຫາໄອດີທີ່ປ້ອນເຂົ້າມາກັບໄອດີທີ່ຢູ່ໃນ cart_data ທີ່ຕົງກັນ
                    if($cart_data[$keys]["pro_id"] == $pro_id){//ຖ້າຫາກວ່າຊອກຫາໄອດີທີຕົງກັນໄດ້ແລ້ວແມ່ນເຮັດວຽກດັ່ງນີ້
                        $new_qty = $cart_data[$keys]["qty"] + $qty;//ປັບໃຫ້ຈຳນວນຂອງ array cart_data ບວກໃຫ້ກັບຈຳນວນທີ່ປ້ອນເຂົ້າມາ
                    }
                }
                $check_qty = mysqli_fetch_array($check_product,MYSQLI_ASSOC);
                if($check_qty["qty"] < $new_qty){
                    $msg = $check_qty["pro_name"];
                    echo"<script>";
                    echo"window.location.href='Sell?stock=orver&&productid=$pro_id&&msg=$msg';";
                    echo"</script>";
                }
                else{
                    $item_id_list2 = array_column($cart_data,'pro_id');//
                    if(in_array($pro_id,$item_id_list2)){//ຖ້າວ່າໄອດີທີ່ປ້ອນມາທາງຄີບອດຕົງກັນກັບໄອດີທີ່ຢູ່ໃນ Array Cart_data ໃຫ້ເຮັດວຽກຈຸດນີ້
                        foreach($cart_data as $keys2 => $values2){//Loop ຂໍ້ມູນ cart_data ອອກມາເພື່ອຊອກຫາໄອດີທີ່ປ້ອນເຂົ້າມາກັບໄອດີທີ່ຢູ່ໃນ cart_data ທີ່ຕົງກັນ
                            if($cart_data[$keys2]["pro_id"] == $pro_id){//ຖ້າຫາກວ່າຊອກຫາໄອດີທີຕົງກັນໄດ້ແລ້ວແມ່ນເຮັດວຽກດັ່ງນີ້
                                $cart_data[$keys2]["qty"] = $cart_data[$keys2]["qty"] + $qty;//ປັບໃຫ້ຈຳນວນຂອງ array cart_data ບວກໃຫ້ກັບຈຳນວນທີ່ປ້ອນເຂົ້າມາ
                            }
                        }
                        echo"<script>";
                        echo"window.location.href='Sell';";
                        echo"</script>";
                    }
                }
            }

            else{ // ຖ້າວ່າໄອດີບໍ່ຕົງກັນໃຫ້ເພີ່ມຂໍ້ມູນເຂົ້າໃນຄຸກກີ້
                $getin = mysqli_query($conn,"SELECT pro_id,pro_name,price,qty,p.price,p.price - p.promotion as newprice,p.promotion,(p.promotion/p.price) * 100 as perzen,qty*(p.price - p.promotion) as total,p.cated_id,cated_name,p.unit_id,unit_name,p.brand_id,brand_name,qtyalert,img_path FROM product p LEFT JOIN categorydetail c ON p.cated_id=c.cated_id LEFT JOIN unit u ON p.unit_id=u.unit_id LEFT JOIN brand b ON p.brand_id=b.brand_id WHERE pro_id = '$pro_id';");
                $get_info = mysqli_fetch_array($getin,MYSQLI_ASSOC);
                $pro_name = $get_info['pro_name'];
                $price = $get_info['price'];
                $cate_name = $get_info['cated_name'];
                $unit_name = $get_info['unit_name'];
                $brand_name = $get_info['brand_name'];
                $img_path = $get_info['img_path'];
                $newprice = $get_info['newprice'];
                $perzen = $get_info['perzen'];
                $promotion = $get_info['promotion'];
                $item_array = [//ເພີ່ມຂໍ້ມູນທີ່ຮັບມາຈາກຄີບອດເຂົ້າໄວ້ໃນຕົວປ່ຽນອາເລ $item_array
                    "pro_id" => $pro_id,
                    "img_path" => $img_path,
                    "pro_name" => $pro_name,
                    "unit_name" => $unit_name,
                    "cate_name" => $cate_name,
                    "brand_name" => $brand_name,
                    "qty" => $qty,
                    "price" => $price,
                    "newprice" => $newprice,
                    "promotion" => $promotion,
                    "perzen" => $perzen
                ];
                $cart_data[] = $item_array;//ເພີ່ມຂໍ້ມູນຈາກ $item_array ເຂົ້າໄປໃນ $cart_data
            }
            $item_data ="";
            $item_data = json_encode($cart_data);//ປັບ item_data ໃຫ້ມັນສິ້ນສຸດການຮັບຂໍ້ມູນຈາກ $cart_data
            setcookie('list_sell',$item_data,time() + (86400 * 30));//ຕັ້ງຄ່າເວລາຄຸກກີ້
            echo"<script>";
            echo"window.location.href='Sell';";
            echo"</script>";
        
        }
        else{
            echo"<script>";
            echo"window.location.href='Sell?product=null';";
            echo"</script>";
        }
    }
    public static function del_sell($pro_id){
        $cookie_data = $_COOKIE['list_sell'];//ຕັ້ງຄ່າຄຸກກີ້ໃຫ້ເປັນ String
        $cart_data = json_decode($cookie_data, true);//ຕັ້ງຄ່າຄຸກກີ້ໃຫ້ເປັນອາເລໃນຮູບແບບ json
        foreach($cart_data as $keys => $values){//ຊອກຫາຄ່າໄອດີຢູ່ໃນອາເລ
            if($cart_data[$keys]['pro_id'] == $pro_id){//ຖ້າໄອດີຕົງກັນໃຫ້ລົບຂໍ້ມູນ
                unset($cart_data[$keys]);//ລົບຂໍ້ມູນຢູ່ຄຸກກີ້ໝົດແຖວທີ່ມີໄອດີຕົງກັນ
                $item_data = json_encode($cart_data);//ໃຫ້ຈົບການສ້າງອາເລໃນຮູບແບບ json
                setcookie('list_sell',$item_data,time() + (86400 * 30));//ຕັ້ງເວລາຄຸກກີ້
                foreach($cart_data as $keys => $values){}
                if(!$cart_data[$keys]){
                    setcookie("list_sell","",time() - 3600);//ຕັ້ງຄ່າໃຫ້ຄຸກກີ້ໃຫ້ເປັນຄ່າວ່າງ
                }
                echo"<script>";
                echo"window.location.href='Sell';";
                echo"</script>";
            }
        }
    }
    public static function save_sell($sell_id,$emp_id,$cus_id,$amount,$img,$delivery,$getmoney){
        global $conn;
        global $path;
        global $Date;
        global $Time;
        if(isset($_COOKIE['list_sell'])){//ກວດສອບວ່າຄຸກກີ້ order ນັ້ນມີຄ່າຫຼືບໍ່
            $cookie_data_check_stokc = $_COOKIE['list_sell'];//ຕັ້ງຄ່າຄຸກກີ້ໃຫ້ເປັນ String
            $cart_data_check_stock = json_decode($cookie_data_check_stokc, true);//Decode ຄ່າຄຸກກີ້ອອກມາໃຫ້ອ່ານຄ່າເປັນ Array ໄດ້ໃນຮູບແບບ json
            foreach($cart_data_check_stock as $check_stock){
                $check_pro_id = $check_stock['pro_id'];
                $check_pro_name = trim($check_stock['pro_name']);
                $check_qty = $check_stock['qty'];
                $check = mysqli_query($conn,"select * from product where pro_id='$check_pro_id'");
                $db_qty = mysqli_fetch_array($check,MYSQLI_ASSOC);
                if($check_qty > $db_qty['qty']){
                    echo"<script>";
                    echo"window.location.href='Sell?stock2=over2&&msg2=$check_pro_name&&productid2=$check_pro_id';";
                    echo"</script>";
                    $i = true;
                    break;        
                }
            }
            if($i == true){

            }
            else{
                    if($_FILES['img_path']['name'] == ""){
                        $Pro_image = "";
                    }
                    else{
                        $ext = pathinfo(basename($_FILES['img_path']['name']), PATHINFO_EXTENSION);
                        $new_image_name = 'img_'.uniqid().".".$ext;
                        $image_path = $path.'image/';
                        $upload_path = $image_path.$new_image_name;
                        move_uploaded_file($_FILES['img_path']['tmp_name'], $upload_path);
                        $Pro_image = $new_image_name;
                    }
                    if($getmoney == ""){
                        $getmoney = 0;
                    }
                    if($delivery == ""){
                        $delivery = 0;
                    }
                    $result = mysqli_query($conn,"insert into sell(sell_id,emp_id,cus_id,sell_date,sell_time,amount,status,status_cash,img_path,sell_type,seen1,seen2,delivery,place_deli,note,getmoney) values('$sell_id','$emp_id','$cus_id','$Date','$Time','$amount','ສັ່ງຊື້ສຳເລັດ','ເງິນສົດ','$Pro_image','ໜ້າຮ້ານ','1','1','$delivery','ໜ໊າຮ້ານ','-','$getmoney');");
                    // mysqli_free_result($result);  
                    // mysqli_next_result($conn);
                    if(!$result){
                        echo"<script>";
                        echo"window.location.href='Sell?save=fail';";
                        echo"</script>";
                    }
                    else{
                        $cookie_data = $_COOKIE['list_sell'];//ຕັ້ງຄ່າຄຸກກີ້ໃຫ້ເປັນ String
                        $cart_data = json_decode($cookie_data, true);//Decode ຄ່າຄຸກກີ້ອອກມາໃຫ້ອ່ານຄ່າເປັນ Array ໄດ້ໃນຮູບແບບ json
                        foreach($cart_data as $data){
                            $pro_id = $data['pro_id'];
                            $qty = $data['qty'];
                            $price = $data['newprice'];
                            $result2 = mysqli_query($conn,"insert into selldetail(pro_id,qty,price,sell_id) values('$pro_id','$qty','$price','$sell_id')");
                            mysqli_free_result($result2);  
                            mysqli_next_result($conn);
                            $update_stokc = mysqli_query($conn,"update product set qty=qty-'$qty' where pro_id='$pro_id'");
                        }
                        if(!$result2){
                            echo"<script>";
                            echo"window.location.href='Sell?save=fail';";
                            echo"</script>";
                        }
                        else{
                            setcookie("list_sell","",time() - 3600);//ຕັ້ງຄ່າໃຫ້ຄຸກກີ້ໃຫ້ເປັນຄ່າວ່າງ
                            echo"<script>";
                            echo"window.location.href='Bill?billno=$sell_id';";
                            echo"</script>";
                        }
                    }
                }
        }
        else{
            echo"<script>";
            echo"window.location.href='Sell?list=null';";
            echo"</script>";
        }
    }
    public static function bill($bill){
        global $conn;
        global $result_bill;
        $result_bill = mysqli_query($conn,"call select_bill('$bill')");
    }
    public static function billdetail($bill){
        global $conn;
        global $result_billdetail;
        $result_billdetail = mysqli_query($conn,"call select_billdetail('$bill')");
    }
   
}
$obj = new obj();
?>