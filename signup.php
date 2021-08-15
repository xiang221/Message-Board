<?php include_once "database.php";
    session_start();
    if(isset($_SESSION["id"])){
        header("Location: index.php");
    }
?>


<html>
<head>
	<meta charset="UTF-8">
	<title>留言板 - 註冊會員</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<div class="container">
		<h1>註冊會員</h1>
		<form role="form" action="account.php?method=signup" method="post">
            <div class="form-group">
                <label for="username">帳號</label>
                <input type="text" class="form-control" id="username" placeholder="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">密碼</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            </div>
            <div class="form-group">
                <label for="name">綽號</label>
                <input type="text" class="form-control" id="name" placeholder="name" name="name">
            </div>
            <button type="submit" class="btn btn-primary">註冊</button>
			<a href="login.php">已有帳號想登入</a>
        </form>
	</div>


</body>
</html>