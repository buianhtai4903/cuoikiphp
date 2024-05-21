<?php 
	error_reporting(0);
	session_start();
	if(isset($_SESSION['id']) && isset($_SESSION['user']) && isset($_SESSION['pass']) && isset($_SESSION['phanquyen'])){
		include ("../myclass/clslogin.php");
    $q = new login();
    $q -> confirmlogin($_SESSION['id'],$_SESSION['user'],$_SESSION['pass'],$_SESSION['phanquyen']);
	}else{
		header('location:../login/index.php');
	}
	
?>

<?php
include("../myclass/clsquantri.php");
$p = new quantri();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Untitled Document</title>
</head>

<body>
<?php
	$myid=$_REQUEST['id'];
	$Laytensp=$p->Laycot("select tensp from sanpham where idsp='$myid' limit 1");
	$Laygia=$p->Laycot("select gia from sanpham where idsp='$myid' limit 1");
	$Laymota=$p->Laycot("select mota from sanpham where idsp='$myid' limit 1");
	$Laygiamgia=$p->Laycot("select giamgia from sanpham where idsp='$myid' limit 1");
?>
  <form action="" enctype="multipart/form-data" name="form" id="form" method="post">
    <table width="747" border="1" align="center" cellpadding="5" cellspacing="0">
      <tr>
        <td colspan="2" align="center">QUẢN LÍ SẢN PHẨM</td>
      </tr>
      <tr>
        <td width="189" align="left">Chọn nhà sản xuất:</td>
        <td width="532" align="left">
          <?php
          $layidcty=$p->Laycot("select idcty from sanpham where idsp='$myid' limit 1");
          $p->choncongty("select*from congty order by tencty asc");
          ?>
          <input type="hidden" name="txtmyid" id="txtmyid" value="<?php echo $_REQUEST["id"]; ?>">
        </td>
      </tr>
      <tr>
        <td align="left">Tên sản phẩm:</td>
        <td align="left"><input type="text" name="txtTenSP" id="txtTenSP" value="<?php echo $Laytensp;?>"/></td>
      </tr>
      <tr>
        <td align="left">Giá:</td>
        <td align="left"><input type="text" name="txtGia" id="txtGia" value="<?php echo $Laygia;?>"/></td>
      </tr>
      <tr>
        <td align="left">Mô tả:</td>
        <td align="left">
          <textarea name="txtMota" id="txtMota" cols="45" rows="5"><?php echo $Laymota;?></textarea>
        </td>
      </tr>
      <tr>
        <td align="left">Giảm giá:</td>
        <td align="left"><input type="text" name="txtGiamgia" id="txtGiamgia" value="<?php echo $Laygiamgia;?>"></td>
      </tr>
      <tr>
        <td align="left">Hình sản phẩm: </td>
        <td align="left">
          <input type="file" name="myfile" id="myfile" />
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <input type="submit" name="nut" id="nut" value="Thêm sản phẩm" />
          <input type="submit" name="nut" id="nut" value="Sửa sản phẩm" />
          <input type="submit" name="nut" id="nut" value="Xóa sản phẩm" />
        </td>
      </tr>
    </table>
    <div align="center">
      <?php
      switch ($_POST["nut"]) {
        case 'Thêm sản phẩm': {
            $name = $_FILES['myfile']['name'];
            $tmp_name = $_FILES['myfile']['tmp_name'];
            $id_cty = $_REQUEST['congty'];
            $ten = $_REQUEST['txtTenSP'];
            $gia = $_REQUEST['txtGia'];
            $mota = $_REQUEST['txtMota'];
            $giamgia = $_REQUEST['txtGiamgia'];
            if ($name != '') {
              $name = time() . "_" . $name;
              if ($p->uploadfile($name, $tmp_name, "../hinh") == 1) {
                if ($p->themxoasua("INSERT INTO sanpham (tensp,gia,mota,hinh,giamgia,idcty) VALUES ('$ten', '$gia', '$mota', '$name', '$giamgia', '$id_cty')") == 1) {
                  echo '<script language="javascript">
                          alert("Cập nhật thành công");
                        </script>';
                } else {
                  echo '<script language="javascript">
					 	        alert("Rớt rồi");
					       </script>';
                }
              } else {
                echo '<script language="javascript">
                     alert("Upload hình không thành công!!!");
                   </script>';
              }
            } else {
              echo '<script language="javascript">
					 	      alert("Vui lòng chọn hình đại diện cho sản phẩm");
					       </script>';
            }

            echo '<script language="javascript">
					window.location="admin.php";
               </script>';
            break;
          }
        case 'Xóa sản phẩm': {
            $idsp = $_REQUEST["txtmyid"];
            if ($idsp > 0) {
              if ($p->themxoasua("DELETE FROM sanpham WHERE idsp ='$idsp' limit 1") == 1) {
                echo '<script language="javascript">
                alert("Xóa thành công");
                window.location="admin.php";
                </script>';
              } else {
                echo '<script language="javascript">
                   alert("Xóa không thành công");
                    </script>';
              }
            }
          }
          case 'Sửa sản phẩm':
            {	
              $idsp=$_REQUEST['txtmyid'];		
              $id_cty=$_REQUEST['congty'];
              $ten = $_REQUEST['txtTenSP'];
              $gia = $_REQUEST['txtGia'];
              $mota = $_REQUEST['txtMota'];
              $giamgia = $_REQUEST['txtGiamgia'];
              if($idsp>0)
              {
                
                  if($p->themxoasua("UPDATE sanpham SET tensp='$ten',gia= '$gia',mota='$mota',giamgia='$giamgia' WHERE idsp='$idsp' LIMIT 1")==1)
                  {
                    echo '<script language="javascript">
                      alert("Sửa sản phẩm thành công!");
                      </script>';
                  }
                  else
                  {
                    echo '<script language="javascript">
                      alert("Đệ thi rớt rồi!");
                      </script>';
                  }
                
              }
              else
              {
                echo '<script language="javascript">
                  alert("Vui lòng chọn sản phẩm cần sửa!");
                  </script>';	
              }
              echo '<script language="javascript">
              window.location="admin.php";
                  </script>';
              
              break;	
            }
      }
      ?>
    </div>
    <?php
    $p->dsSanPham("select*from sanpham order by idsp desc");
    ?>
  </form>
</body>

</html>