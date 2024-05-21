<?php 
    include("../myclass/clslogin.php");
    $p = new login();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>

<body>
<form method="post">
<table width="339" border="1" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td colspan="2" align="center">ĐĂNG NHẬP</td>
  </tr>
  <tr>
    <td width="92">Username:</td>
    <td width="231"><label for="txtUser"></label>
    <input type="text" name="txtUser" id="txtUser" /></td>
  </tr>
  <tr>
    <td>Password:</td>
    <td><input type="password" name="txtpass" id="txtpass" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="nut" id="nut" value="Đăng nhập" />
    <input type="reset" name="reset" id="reset" value="Reset" /></td>
  </tr>
</table>

<?php 
if(isset($_POST['nut'])){


	switch($_POST['nut']){
        case 'Đăng nhập':
        {
            $user = $_REQUEST["txtUser"];
            $pass = $_REQUEST["txtpass"];
            if($user!='' && $pass!=''){
                if($p -> loginAdmin($user,$pass) == 0){
                    echo 'Sai username hoặc password de vao admin';
                }
            }else{
                echo "Vui lòng nhập đủ username và password de vao admin";
            }
            break;
        }
    }
  }
?>
</form>
</body>
</html>