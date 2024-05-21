<?php
class tmdt
{
	public function connect()
	{
		$con=mysqli_connect("localhost","usertmdt","passtmdt");
		if(!$con)
		{
			echo 'Khong ket noi csdl';
			exit();
		}
		else
		{
			mysqli_select_db($con,"testdb");
			//mysqli_query("SET NAMES UTF8");
			return $con;	
		}
	}
	public function xuatdscty($sql)
	{
		$link =$this->connect();
		$ketqua=mysqli_query($link, $sql);
		$i=mysqli_num_rows($ketqua);
		if($i>0)
		{	
		echo '<table width="500" border="1" align="center" cellpadding="5" cellspacing="0">
		  <tbody>
			<tr>
			  <td width="39" align="center"><strong>STT</strong></td>
			  <td width="268" align="center"><strong>TÊN CÔNG TY</strong></td>
			  <td width="155" align="center"><strong>ĐỊA CHỈ</strong></td>
			</tr>';
			$dem=1;
			while($row=mysqli_fetch_array($ketqua))	
			{
				$idcty=$row['idcty'];
				$tencty=$row['tencty'];
				$diachi=$row['diachi'];
				echo '<tr>
			  <td align="center">'.$dem.'</td>
			  <td align="center" valign="middle">'.$tencty.'</td>
			  <td align="center" valign="middle">'.$diachi.'</td>
			</tr>';
			$dem++;
			}
			echo '  </tbody>
				</table>';
		}
	else
	{
		echo 'Không có dữ liệu';
	}
	}

	public function Laycot($sql)
			{
				$link=$this->connect();
				$ketqua=mysqli_query($link,$sql);
				$i=mysqli_num_rows($ketqua);
				$giatri='';
				if($i>0){
					
					while($row=mysqli_fetch_array($ketqua)){
						$gt=$row[0];
						$giatri=$gt;
					}
				}
				return $giatri;
			}

}
?>