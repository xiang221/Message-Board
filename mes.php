<?php include_once "database.php";
    session_start();	
	switch ($_GET["method"]) {
		case "add":
			add();
			break;
		case "update":
			update();
			break;
        case "update_mes":
            update_mes();
            break;
		case "del":
			del();
			break;
        case "del_mes":
            del_mes();
            break;
        case "comments":
			comments();
			break;    
		default:
			break;
	}

	function add(){
        if($_SESSION["id"]!=''){
		$uid = $_SESSION["id"];
		$title = $_POST["title"];
		$content = $_POST["content"];
		$sql = "INSERT INTO `mes` (uid, title, content)
		VALUES ('$uid', '$title', '$content')";
        $sql_2 = "UPDATE `member` SET points = points+1 WHERE id = $uid";
		global $con;
		$result = mysqli_query($con , $sql) or die('MySQL query error');
        $result_2 = mysqli_query($con , $sql_2) or die('MySQL query error');
		echo "<script type='text/javascript'>";
		echo "alert('新增文章成功，積分+1');";
		echo "location.href='index.php';";
		echo "</script>";
        }
	}

	function update(){
        $mid = $_GET["id"];
        $sql = "SELECT * FROM `mes` WHERE id = $mid";
        global $con;
        $result = mysqli_query($con , $sql) or die('MySQL query error');
        $row = mysqli_fetch_array($result);
        if($row["uid"]==$_SESSION["id"]){
		$title = $_POST["title"];
		$content = $_POST["content"];
		$sql = "UPDATE `mes` SET title = '$title', content = '$content' WHERE id = $mid";
		global $con;
		$result = mysqli_query($con , $sql) or die('MySQL query error');
		echo "<script type='text/javascript'>";
		echo "alert('編輯文章成功');";
		echo "location.href='index.php';";
		echo "</script>";
        }else{
            echo "<script type='text/javascript'>";
            echo "alert('你沒有權限');";
            echo "location.href='index.php';";
            echo "</script>";
        }
	}

	function update_mes(){
        $mid = $_GET["id"];
        $sql = "SELECT * FROM `comments` WHERE id = $mid";
        global $con;
        $result = mysqli_query($con , $sql) or die('MySQL query error');
        $row = mysqli_fetch_array($result);
        if($row["message_uid"]==$_SESSION["id"]){
		$message = $_POST["message"];
		$sql = "UPDATE `comments` SET message = '$message' WHERE id = $mid";
		global $con;
		$result = mysqli_query($con , $sql) or die('MySQL query error');
		echo "<script type='text/javascript'>";
		echo "alert('編輯留言成功');";
		echo "location.href='index.php';";
		echo "</script>";
	    }else{
            echo "<script type='text/javascript'>";
            echo "alert('你沒有權限');";
            echo "location.href='index.php';";
            echo "</script>";
        }
    }

	function del(){
        $mid = $_GET["id"];
        $sql = "SELECT * FROM `mes` WHERE id = $mid";
        global $con;
        $result = mysqli_query($con , $sql) or die('MySQL query error');
        $row = mysqli_fetch_array($result);
        if(($row["uid"]==$_SESSION["id"]) || (@$_SESSION["manager"]==1)){
    		$sql = "DELETE FROM `mes` WHERE id = $mid";
            $sql_2 = "DELETE FROM `comments` WHERE cid = $mid";
            global $con;
            $result = mysqli_query($con , $sql) or die('MySQL query error');
            $result_2 = mysqli_query($con , $sql_2) or die('MySQL query error');
            echo "<script type='text/javascript'>";
            echo "alert('刪除文章成功');";
            echo "location.href='index.php';";
            echo "</script>";
        }else{
            echo "<script type='text/javascript'>";
            echo "alert('你沒有權限');";
            echo "location.href='index.php';";
            echo "</script>";
        }
        
	}

    function del_mes(){
        $mid = $_GET["id"];
        $sql = "SELECT * FROM `comments` WHERE id = $mid";
        global $con;
        $result = mysqli_query($con , $sql) or die('MySQL query error');
        $row = mysqli_fetch_array($result);
        if(($row["message_uid"]==$_SESSION["id"]) || (@$_SESSION["manager"]==1)){
            $id = $_GET["id"];
            $sql = "DELETE FROM `comments` WHERE id = $id";
            global $con;
            $result = mysqli_query($con , $sql) or die('MySQL query error');
            echo "<script type='text/javascript'>";
            echo "alert('刪除留言成功');";
            echo "location.href='index.php';";
            echo "</script>";
        }else{
            echo "<script type='text/javascript'>";
            echo "alert('你沒有權限');";
            echo "location.href='index.php';";
            echo "</script>";
        }
	}

	function comments(){
        if($_SESSION["id"]!=''){
	    $cid = $_GET["id"];
        $message_uid = $_SESSION["id"];
		$message = $_POST["message"];
		$sql = "INSERT INTO `comments` (cid, message_uid, message)
		VALUES ('$cid', '$message_uid', '$message')";
		global $con;
		$result = mysqli_query($con , $sql) or die('MySQL query error');
		echo "<script type='text/javascript'>";
		echo "alert('新增留言成功');";
		echo "location.href='index.php';";
		echo "</script>";
	}}


?>