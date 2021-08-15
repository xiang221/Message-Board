<?php
	include_once "database.php";
	session_start();
	$id = $_GET["id"];
    $sql="SELECT * FROM `comments` WHERE id = '$id'";
	$result = mysqli_query($con , $sql) or die('MySQL query error');
   	$row = mysqli_fetch_array($result);
    if($_SESSION["id"]!=$row["message_uid"]){
    	header("Location: login.php");
    }
?>


<html>
<head>
	<meta charset="UTF-8">
	<title>留言板 - 編輯留言</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<div class="container">
		<h1>編輯留言</h1>
		<span>
			<a href="index.php">首頁</a>
		</span>
		<form role="form" action="mes.php?method=update_mes&id=<?php echo $row["id"]?>" method="post">

            <div class="form-group">
                <label for="content">留言內容</label>
                <textarea class="form-control" id="message" placeholder="message" name="message" value="<?php echo $row["message"]?>"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">修改</button>
        </form>
	</div>
	    


</body>
</html>