<?php include_once "database.php";
    session_start();
	switch ($_GET["method"]) {
		case "login":
			login();
			break;
		case "signup":
			signup();
			break;
		case "logout":
			logout();
			break;
        case "modify":
            modify();
            break;
		default:
			break;
	}

	function login(){
		$sql="SELECT * FROM `member`
				WHERE username = '$_POST[username]' && password = '$_POST[password]'";
		global $con;
		$result = mysqli_query($con , $sql) or die('MySQL query error');
	    $row = mysqli_fetch_array($result);
	    if($row==""){
			echo "<script type='text/javascript'>";
			echo "alert('帳密錯誤');";
			echo "location.href='login.php';";
			echo "</script>";
	    }else{
	    	$_SESSION["id"] = $row['id'];
            $_SESSION["manager"] = $row['manager'];
            $_SESSION["points"] = $row['points'];
            date_default_timezone_set("Asia/Taipei");
            $time=date('Y-m-d');
            if($time!==$row["time"]){
                $points=$_SESSION["points"]+1;
                $id=$_SESSION['id'];
                $sql = "UPDATE `member` SET points ='$points' ,time= '$time' WHERE id = $id";
                global $con;
		        $result = mysqli_query($con , $sql) or die('MySQL query error');
            }
            }
	    	echo "<script type='text/javascript'>";
			echo "alert('登入成功');";
			echo "location.href='index.php';";
			echo "</script>";
	    }

	function signup(){
        $username = $_POST["username"];
		$password = $_POST["password"];
        $name = $_POST["name"];
		$sql="SELECT * FROM `member`
				WHERE username = '$_POST[username]'";
		global $con;
	    $result = mysqli_query($con , $sql) or die('MySQL query error');
	    $row = mysqli_fetch_array($result);
		if($row!=""){
			echo "<script type='text/javascript'>";
			echo "alert('已經辦過帳號了');";
			echo "location.href='login.php';";
			echo "</script>";
		}
		else{
			$sql="INSERT INTO `member` (username, password, name) VALUES ('$username','$password','$name')";
			global $con;
            $result = mysqli_query($con , $sql) or die('MySQL query error1');
			$sql="SELECT * FROM `member`
				WHERE username = '$_POST[username]' && password = '$_POST[password]'";
			global $con;
	    	$result = mysqli_query($con , $sql) or die('MySQL query error2');
	    	$row = mysqli_fetch_array($result);		    
	    	$_SESSION["id"] = $row["id"];
            $_SESSION["points"] = $row['points'];
		 	echo "<script type='text/javascript'>";
			echo "alert('註冊成功');";
			echo "location.href='index.php';";
			echo "</script>";
		}
	} 

	function logout(){
		if(isset($_SESSION["id"])){
			session_unset();
			echo "<script type='text/javascript'>";
			echo "alert('登出成功');";
			echo "location.href='index.php';";
			echo "</script>";
		}
	} 


    function modify(){
        $id = $_GET["id"];
		$username = $_POST["username"];
		$password = $_POST["password"];		
        $name = $_POST["name"];
		$sql = "UPDATE `member` SET username = '$username', password = '$password', name = '$name' WHERE id = $id";
		global $con;
		$result = mysqli_query($con , $sql) or die('MySQL query error');
		echo "<script type='text/javascript'>";
		echo "alert('修改資料成功');";
		echo "location.href='index.php';";
		echo "</script>";
	}
        




?>