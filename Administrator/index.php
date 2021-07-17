<?php
  include ('oop/obj.php');
  if(isset($_POST['btnLogin'])){
    $obj->login($_POST['email'],$_POST['pass']);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="image/title_logo.png">
  <title>GAME GADGET</title>
  <link rel="stylesheet" href="dist/css/alt/style2.css">
  <link rel="stylesheet" href="dist/css/alt/style.css">
  <link rel="stylesheet" href="fontawesome/css/all.css">
  <script src="dist/js/sweetalert.min.js"></script>
  <style>
  button{
    width: 150px;
    height: 49px;
    border: none;
    outline: none;
    border-radius: 49px;
    cursor: pointer;
    background-color: #5995fd;
    color: #fff;
    text-transform: uppercase;
    font-weight: 600;
    margin: 10px 0;
    transition: .5s;
}
  </style>
</head>

<body>
    <div class="container">
      <div class="forms-container">
          <div class="signin-signup">
              <form action="Login" method="POST" id="formLogin" class="sign-in-form">
                <img src="image/logo.ico" alt="" width="100px"><br>
                <h2 class="title">ເຂົ້າສູ່ລະບົບ</h2>
                  <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="ອີເມວຜູ້ໃຊ້">
                  </div>
                  <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="pass" placeholder="ລະຫັດຜ່ານ">
                  </div>
                  <!-- <input type="submit" class="btn solid" value="ເຂົ້າສູ່ລະບົບ"> -->
                  <button type="submit" name="btnLogin" class="solid">ເຂົ້າສູ່ລະບົບ</button>

                  <p class="social-text" style="display: none;">ຫຼືທ່ານຕ້ອງການເຂົ້າສູ່ລະບົບດ້ວຍບັນຊີອື່ນ</p>
                  <div class="social-media">
                    <!-- <a href="#" class="social-icon">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon">
                      <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="social-icon">
                      <i class="fab fa-linkedin-in"></i>
                    </a> -->
                  </div>
              </form>

              <form action="User/Main" method="POST" id="formRegister" class="sign-up-form">
                <h2 class="title">ລົງທະບຽນ</h2>
                  <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="ຊື່">
                  </div>
                  <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="ນາມສະກຸນ">
                  </div>
                  <div class="input-field">
                    <i class="fas fa-briefcase"></i>
                    <select name="" id="" style="font-family: 'Noto Sans Lao';">
                      <option value="">ເລືອກຕຳແໜ່ງ</option>
                      <option value="ຜູ້ຈັດການ">ຜູ້ຈັດການ</option>
                      <option value="ໄອທີ">ໄອທີ</option>
                      <option value="ຕອນຮັບ">ຕອນຮັບ</option>
                    </select>
                  </div>
                  <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="Email" placeholder="ອີເມວຜູ້ໃຊ້">
                  </div>
                  <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="ລະຫັດເຂົ້າໃຊ້ລະບົບ">
                  </div>
                  <input type="submit" class="btn solid" value="ລົງທະບຽນ">
              </form>
          </div>
      </div>
      <div class="panels-container">
            <div class="panel left-panel">
              <div class="content">
                <h3 style="display: none;">ລົງທະບຽນໃໝ່ ?</h3>
                <p style="display: none;">ຖ້າຫາກທ່ານຍັງບໍ່ມີອີເມວເພື່ອເຂົ້າໃຊ້ລະບົບທ່ານສາມາດເຂົ້າໄປລົງທະບຽນເພື່ອຍື່ນຂໍສິດເຂົ້າໃຊ້ລະບົບໄດ້ທາງຂ້າງລຸ່ມນີ້</p>
                <button class="btn transparent" id="sign-up-btn" style="display: none;">ໄປໜ້າລົງທະບຽນ</button>
              </div>

              <img src="image/login_picture.svg" class="image" alt="">
            </div>
            <div class="panel right-panel">
              <div class="content">
                <h3>ທ່ານຕ້ອງການເຂົ້າສູ່ລະບົບບໍ່ ?</h3>
                <p>ຖ້າຫາກທ່ານຕ້ອງການເຂົ້າສູ່ລະບົບດ້ວຍອີເມວຜູ້ໃຊ້ທີ່ມີຢູ່ແລ້ວທ່ານສາມາດໄປທີ່ໜ້າເຂົ້າສູ່ລະບົບໂດຍການກົດປຸ່ມຂ້າງລຸ່ມນີ້</p>
                <button class="btn transparent" id="sign-in-btn">ໄປໜ້າເຂົ້າສູ່ລະບົບ</button>
              </div>

              <img src="image/register.svg" class="image" alt="">
            </div>
      </div>
    </div>
    <?php
    if(isset($_GET['email'])=='null'){
      echo'<script type="text/javascript">
      swal("", "ກະລຸນາປ້ອນອີເມວ !", "info");
      </script>';
    }
    if(isset($_GET['pass'])=='null'){
      echo'<script type="text/javascript">
      swal("", "ກະລຸນາປ້ອນລະຫັດຜ່ານ !", "info");
      </script>';
    }
    if(isset($_GET['login'])=='false'){
      echo'<script type="text/javascript">
      swal("", "ອີເມວ ຫຼື ລະຫັດຜ່ານຂອງທ່ານບໍ່ຖືກຕ້ອງ!", "error");
      </script>';
    }
    if(isset($_GET['permission'])=='found'){
      echo'<script type="text/javascript">
      swal("", "ຜູ້ໃຊ້ນີ້ບໍ່ມີສິດເຂົ້າໃຊ້ລະບົບ!", "error");
      </script>';
    }
    ?>
    <script src="dist/js/app.js"></script>
</body>
</html>