<?php 
	include("myclass/clsKhachHang.php");
	$p = new khachhang();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cuoi ki</title>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div id="container">
        <header>
            <h1>Banner Website</h1>
        </header>
        <nav>
        	<a href="index.php">Home</a> <br>
        	<?php 
				$p->xuatdscongty("select*from congty order by tencty asc");
			?>
        </nav>
        <section>
        	<?php 
			  $idcty = isset($_REQUEST["id"]) ? $_REQUEST["id"] : null;	
			 if($idcty !== null && $idcty >0){
				$p->xuatsanpham("select*from sanpham where idcty='$idcty' order by gia asc");
			 }else{
				$p->xuatsanpham("select*from sanpham order by gia asc"); 
			 }
			?>
        </section>
        <footer></footer>
    </div>

</body>
</html>