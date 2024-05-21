<?php 
	include("clstmdt.php");
	class quantri extends tmdt{
		public function choncongty($sql){
			$link=$this->connect();
			$ketqua = mysqli_query($link, $sql);
			$i = mysqli_num_rows($ketqua);
			if($i>0){
				echo '<select name="congty" id="congty">
          			<option>Mời chọn nhà sản xuất</option>';
				while($row=mysqli_fetch_array($ketqua)){
					$idcty = $row["idcty"];
					$tencty = $row["tencty"];	
					echo '  <option value="'.$idcty.'">'.$tencty.'</option>';
				}	
				echo ' </select>';
			}else{
				echo 'Không có dữ liệu';
			}	
		}
		//-------------------
		public function uploadfile($name, $tmp_name, $folder)
		{
			// $name = $folder . "_" . $name;
			$newname = $folder . "/" . $name;
			if (move_uploaded_file($tmp_name, $newname)) {
				return 1;
			} else {
				return 0;
			}
		}
		public function themxoasua($sql){
			$link=$this->connect();
			if($ketqua=mysqli_query($link,$sql)){
				return 1;	
			}else{
				return 0;
			}
		}

	//
	public function dsSanPham($sql)
	{
		$link = $this->connect();
		$ketqua = mysqli_query($link, $sql);
		$i = mysqli_num_rows($ketqua);
		if ($i > 0) {
			echo '<table width="606" border="1" align="center" cellpadding="10" cellspacing="0">
			<tr>
			  <td width="35" align="center">STT</td>
			  <td width="145" align="center">TÊN SẢN PHẨM</td>
			  <td width="139" align="center">MÔ TẢ</td>
			  <td width="70" align="center">GIÁ</td>
			  <td width="105" align="center">GIÁ GIẢM</td>
			</tr>';
			$dem = 1;
			while ($row = mysqli_fetch_array($ketqua)) {
				$idsp= $row["idsp"];
				$tensp = $row["tensp"];
				$gia = $row["gia"];
				$mota = $row["mota"];
				$giamgia = $row["giamgia"];
				echo '    <tr>
				<td align="center"><a href=?id='.$idsp.'>'.$dem.'</a></td>
				<td align="left"><a href=?id='.$idsp.'>'.$tensp.'</a></td>
				<td align="left"><a href=?id='.$idsp.'>'.$gia.'</a></td>
				<td align="center"><a href=?id='.$idsp.'>'.$mota.'</a></td>
				<td align="center"><a href=?id='.$idsp.'>'.$giamgia.'</a></td>
			  </tr>';
			  $dem++;
			}
			echo ' </table>';
		} else {
			echo 'Không có dữ liệu';
		}
	}

	}
?>