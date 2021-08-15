<?php include_once "database.php";
    session_start();
    if(!isset($_SESSION["id"])){
    	header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>留言板 - 新增留言</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<div class="container">
		<h1>新增留言</h1>
		<span>
			<a href="index.php">首頁</a>
		</span>
		<form role="form" action="mes.php?method=add" method="post">
            <div class="form-group">
                <label for="title">標題</label>
                <input type="text" class="form-control" id="title" placeholder="title" name="title">
            </div>
            <div class="form-group">
                <label for="content">文章內容</label>
                <input type="text" class="form-control" id="content" placeholder="content" name="content">
            </div>
            <button type="submit" class="btn btn-primary">新增</button>
        </form>
	</div>
	     


</body>
</html>