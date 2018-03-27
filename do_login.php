<?php

	$u = $_REQUEST['username'];
	$p = $_REQUEST['pass'];
	$sql = "SELECT COUNT(*) AS ok FROM customer WHERE uname=? AND passwd_enc=PASSWORD(?)";
	
	if( $stmt = $mysqli->prepare($sql) ) 
	{
		$stmt->bind_param("ss", $u,$p);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		if($row[ok]=='1')
		{
			$sql2 = "SELECT * FROM customer WHERE uname=? AND passwd_enc=PASSWORD(?)";
			if( $stmt2 = $mysqli->prepare($sql2) ) 
			{
				$stmt2->bind_param("ss", $u, $p);
				$stmt2->execute();
				$result2 = $stmt2->get_result();
				$row2 = $result2->fetch_assoc();

				$_SESSION['username']=$row2['uname'];
				$_SESSION['name']=$row2['Fname'];
				$_SESSION['surname']=$row2['Lname'];
				$_SESSION['customer_id']=$row2['ID'];
				$_SESSION['address']=$row2['Address'];
				$_SESSION['phone']=$row2['Phone'];


				if($row2['is_admin']=='1')
				{
					$_SESSION['username'] = 'admin';
					header('Location: index.php?p=after_login');
				}
				else
				{
					header('Location:  index.php?p=after_login');
				}
			}

		}
	}
	
	else
	{
		print "Unknown user";
		print $mysqli->error;
		$_SESSION['username'] = '?';
	}
?>