<?php
include("clstmdt.php");

class khachhang extends tmdt
{

	public function xuatsanpham($sql)
	{
		$link = $this->connect();
		$ketqua = mysqli_query($link, $sql);
		$i = mysqli_num_rows($ketqua);
		if ($i > 0) {
			while ($row = mysqli_fetch_array($ketqua)) {
				$idsp = $row['idsp'];
				$tensp = $row['tensp'];
				$hinh = $row['hinh'];
				$gia = $row['gia'];
				echo ' <div id="sanpham">
						<div id="sanpham_ten">' . $tensp . '</div>
						<div id="sanpham_hinh"><a href="chitietsanpham.php?id=' . $idsp . '"><img src="./hinh/' . $hinh . '" alt=""></a></div>
						<div id="sanpham_gia"> Giá: ' . $gia . ' USD</div>
						</div>';
			}
		} else {
			echo 'Dang cap nhat san pham';
		}
	}
	//-------------

	public function themxoasuaa($sql)
	{
		$link = $this->connect();
		if ($ketqua = mysqli_query($link, $sql)) {
			return 1;
		} else {
			return 0;
		}
	}
	//-------------
	public function xuatdscongty($sql)
	{
		$link = $this->connect();
		$ketqua = mysqli_query($link, $sql);
		$i = mysqli_num_rows($ketqua);
		if ($i > 0) {
			while ($row = mysqli_fetch_array($ketqua)) {
				$idcty = $row['idcty'];
				$tencty = $row['tencty'];
				echo '<a href="?id=' . $idcty . '">' . $tencty . '</a>';
				echo '<br>';
			}
		} else {
			echo 'Đang cập nhật công ty';
		}
	}

	public function xemchitietsanpham($sql)
	{
		$link = $this->connect();
		$ketqua = mysqli_query($link, $sql);
		$i = mysqli_num_rows($ketqua);
		if ($i > 0) {
			echo '<table width="800" border="1" align="center" cellpadding="5" cellspacing="0">';
			while ($row = mysqli_fetch_array($ketqua)) {
				$idsp = $row['idsp'];
				$tensp = $row['tensp'];
				$gia = $row['gia'];
				$mota = $row['mota'];
				$giamgia = $row['giamgia'];
				$hinh = $row['hinh'];
				$idcty = $row['idcty'];
				$tencty = $this->Laycot("select tencty from congty where idcty='$idcty' limit 1");
				//
				echo ' <tr>
					<td width="277" rowspan="7"><img src="hinh/' . $hinh . '" width="263" height="191" /></td>
					<td width="146">Tên sản phẩm</td>
					<td width="339">' . $tensp . '</td>
				</tr>
				<tr>
					<td>Công ty sản xuất</td>
					<td>' . $tencty . '</td>
				</tr>
				<tr>
					<td height="94">Mô tả </td>
					<td>' . $mota . '</td>
				</tr>
				<tr>
					<td>Giá </td>
					<td>' . $gia . '</td>
				</tr>
				<tr>
					<td>Giảm giá </td>
					<td>' . $giamgia . '</td>
				</tr>
				<tr>
					<td>Số lượng </td>
					<td><input name="txtsoluong" type="text" id="txtsoluong" value="1" /></td>
				</tr>
				<tr>
					<td>Đặt hàng</td>
					<td><input type="submit" name="nut" id="nut" value="Thêm vào giỏ hàng" /></td>
				</tr>';
			}

			echo '</table>';
		} else {
			echo 'khong co du lieu';
		}
	}

	//gio hang
	public function giohang($sql)
	{
		$link = $this->connect();
		$ketqua = mysqli_query($link, $sql);
		$i = mysqli_num_rows($ketqua);
		if ($i > 0) {
			echo '
			<table width="725" border="1" align="center" cellpadding="10" cellspacing="0" style="position: relative; z-index: 2; background-color: white;" >
			<tr>
			  
			  <td width="37">STT</td>
			  <td width="200">TÊN SẢN PHẨM</td>
			  <td width="112">SỐ LƯỢNG</td>
			  <td width="146">ĐƠN GIÁ</td>
			  <td width="118">GIẢM GIÁ</td>
			  <td width="118">HÀNH ĐỘNG</td>
			</tr>';
			$dem = 1;
			while ($row = mysqli_fetch_array($ketqua)) {
				$iddh = $row[0];
				$idsp = $row[1];
				$tensp = $this->Laycot("select tensp from sanpham where idsp='$idsp' limit 1");
				$soluong = $row[2];
				$dongia = $row[3];
				$giamgia = $row[4];

				echo '<tr>
				
				<td>'.$dem.'</td>
				<td>'.$tensp.'</td>
				<td>'.$soluong.'</td>
				<td>'.$dongia.'</td>
				<td>'.$giamgia.'</td>
				<td>
                    <form method="post">
						<input type="hidden" name="iddh" value="'.$iddh.'">
                        <input type="submit" name="nut" id="nut" value="Xóa đơn hàng" />
                    </form>
                </td>
			  </tr>';
			  
			  $dem++;

			}
			echo '</table>';
		} else {
			echo 'khong co du lieu';
		}
	}
}
