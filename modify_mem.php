<?php
	include_once "database.php";
	session_start();
	$id=$_SESSION["id"];
    $sql="SELECT * FROM `member` WHERE id = '$id'";
	$result = mysqli_query($con , $sql) or die('MySQL query error');
   	$row = mysqli_fetch_array($result);
    if(!isset($_SESSION["id"])){
    	header("Location: login.php");
    }
?>


<html>
<head>
	<meta charset="UTF-8">
	<title>留言板 - 修改資料</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link rel="stylesheet" href="main.css">
</head>
<body>
    
	<div class="container">
		<h1>修改資料</h1>
		<form role="form" action="account.php?method=modify&id=<?php echo $row["id"]?>" method="post">
            <div class="form-group">
                <label for="username">帳號</label>
                <input type="text" class="form-control" id="username" placeholder="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">密碼</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            </div>
            <div class="form-group">
                <label for="name">暱稱</label>
                <input type="text" class="form-control" id="name" placeholder="name" name="name">
            </div>
            <button type="submit" class="btn btn-primary">確定修改</button>
			<a href="index.php">返回</a>
        </form>
	</div>
	
	    


</body>
</html>