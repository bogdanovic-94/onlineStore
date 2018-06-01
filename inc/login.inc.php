<?php
session_start();

if (isset($POST_['logbtn'])){
	
	include('inc/db.php');
	$u_email =mysqli_real_escape_string($conn, $_POST['u_email']);
	$u_pwd = mysqli_real_escape_string($conn, $_POST['u_email']);
	
	if(empty($u_email) || empty($u_pwd)){
		header("Location: ../index.php?login=empty");
		exit();
	}else{
		$sql= ("select * from user where u_email ='$u_email' ");
		$result = mysqli_query($conn, $sql);
		$result_check = mysqli_num_rows($result);
		if($result_check <1){
		header("Location: ../index.php?login=error");
		exit();
		}else{
			if($row= mysqli_fetch_assoc($result)){
				$hashedPWdCheck = password_verify($pwd, $row['u_pwd']);
				if($hashedPWdCheck == false){
				header("Location: ../index.php?login=error");
					exit();
				}elseif($hashedPWdCheck == true){
					$_SESSION['u_id']= $row['u_id'];
					$_SESSION['u_name']= $row['u_name'];
					$_SESSION['u_email']= $row['u_email'];
					$_SESSION['u_adrs']= $row['u_adrs'];
					header("Location: ../index.php?login=success");
					exit();
				}
			}
		}
	}
	else{
		header("Location: ../index.php?login=error");
		exit();
	}

}

?>