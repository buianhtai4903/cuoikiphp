<?php 
class login
{
	public function connectLogin()
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
    //
    public function loginAdmin($user,$pass){
        $sql="select iduser,username,password,phanquyen from taikhoan where username='$user' and password='$pass' limit 1";
        $link = $this->connectLogin();
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);
        if($i==1){
            while($row = mysqli_fetch_array($ketqua)){
                $id = $row['iduser'];
                $myuser = $row['username'];
                $mypass = $row['password'];
                $phanquyen = $row['phanquyen'];
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['user'] = $myuser;
                $_SESSION['pass'] = $mypass;
                $_SESSION['phanquyen'] = $phanquyen;
                header('location:../admin/admin.php');

            }
        }else{
            return 0;
        }
    }
    //
    public function mylogin($user,$pass,$table,$header){
        $sql="select iduser,username,password,phanquyen from $table where username='$user' and password='$pass' limit 1";
        $link = $this->connectLogin();
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);
        if($i==1){
            while($row = mysqli_fetch_array($ketqua)){
                $id = $row['iduser'];
                $myuser = $row['username'];
                $mypass = $row['password'];
                $phanquyen = $row['phanquyen'];
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['user'] = $myuser;
                $_SESSION['pass'] = $mypass;
                $_SESSION['phanquyen'] = $phanquyen;
                header('location:'.$header);

            }
        }else{
            return 0;
        }
    }

    //
    public function confirmlogin($id,$user,$pass,$phanquyen)
    {
        $sql="select iduser from taikhoan where iduser='$id' and username='$user' and password='$pass' and phanquyen='$phanquyen' limit 1";
        $link=$this->connectLogin();
        $ketqua=mysqli_query($link,$sql);
        $i=mysqli_num_rows($ketqua);
        if($i!=1)
        {
            header('location:../login/index.php');	
        }
    }

}
?>