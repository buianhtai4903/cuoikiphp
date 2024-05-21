<?php 
    session_start();    
    error_reporting(0);
	include("myclass/clsKhachHang.php");
	$p = new khachhang();

if(isset($_SESSION['id'])){
    $idkh = $_SESSION['id'];
    $tenkh = $p->Laycot("select ten from khachhang where iduser='$idkh' limit 1");
}
?>  


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Chi tiet san pham</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div id="container">
        <header>
            <h1>Banner Web</h1>
        </header>

        <section style="width: 1000px; background-color: bisque;">
        <a href="index.php">Back</a>
        <?php 
            echo '<div align="right"><i>Xin chào:'.$tenkh.' | <a href="logout/index.php">Log out</a></i></div>';
        ?>
            <form method="post">
                <?php 
                    $idsp = $_REQUEST["id"];
                    $p->xemchitietsanpham("select*from sanpham where idsp=' $idsp' limit 1");
                ?>

                <?php 
                    if($_POST['nut']=='Thêm vào giỏ hàng'){
                        if(isset($_SESSION['id'])){
                            
                            $ngaydathang=date('Y-m-d');
                            if($p->themxoasuaa("INSERT INTO dathang(idkh ,ngaydathang) VALUES ('$idkh','$ngaydathang')")){
                                $iddh = $p->Laycot("select iddh from dathang where idkh='' order by iddh desc limit 1");
                                $idsp = $_REQUEST['id'];
                                $soluong = $_REQUEST['txtsoluong'];
                                $dongia = $p-> Laycot("select gia from sanpham where idsp='$idsp' limit 1");
                                $giamgia = $p-> Laycot("select giamgia from sanpham where idsp='$idsp' limit 1");
                                if($p->themxoasuaa("INSERT INTO dathang_chitiet(iddh, idsp,soluong,dongia,giamgia) VALUES ('$iddh',' $idsp',' $soluong','$dongia','$giamgia')")==1){
                                    //echo 'Thêm vào giỏ hàng thành công';
                                }else{
                                    echo 'Đặt hàng không thành công';
                                }
                            }else{
                                echo '<script language="javascript"> 
                                alert("Đặt hàng không thành công!!!");
                            </script>';
                            }
                        }else{
                            echo '<script language="javascript"> 
                                alert("Vui lòng đăng nhập trước khi đặt hàng!!!");
                            </script>';

                            echo '<script language="javascript"> 
                                window.location="khachhang/";
                            </script>';
                        }
                    }
                    
                    
                ?>
                <?php 
                    if ($_POST['nut'] == 'Xóa đơn hàng') {
                        if (isset($_SESSION['id'])) {
                            // Lấy ID đơn hàng cần xóa
                            $iddh = $_POST['iddh']; 
                            
                            // Xóa đơn hàng khỏi cơ sở dữ liệu
                            $delete_query = "DELETE FROM dathang_chitiet WHERE iddh = '$iddh' limit 1" ;
                            $p->themxoasuaa($delete_query);
                            $delete1_query = "DELETE FROM dathang WHERE iddh = '$iddh'  limit 1";
                            $p->themxoasuaa($delete1_query);
            
                            } else {
                                echo '<script language="javascript">
                                        alert("Xóa đơn hàng thất bại");
                                        </script>';
                            }  
                    }
                ?>
            </form>
                <?php 
                    if(isset($_SESSION['id'])){
                        $p ->giohang("select ct.iddh, ct.idsp, ct.soluong, ct.dongia, ct.giamgia
                        from dathang dh,dathang_chitiet ct
                        where dh.iddh=ct.iddh and dh.idkh='$idkh'");
                    }
                ?>
        </section>
        <footer></footer>
    </div>
</body>

</html>