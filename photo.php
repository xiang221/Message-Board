<?php
	include_once "database.php";
	session_start();
	$id=$_SESSION["id"];
    $sql="SELECT * FROM `member` WHERE id = $id ";
	$result = mysqli_query($con , $sql) or die('MySQL query error');
   	$row = mysqli_fetch_array($result);
?>



<html>
    
    
<head>
    
    <meta http-equiv="cache-control" content="no-store">
    <meta http-equiv="pragma" content="no-store">
    <meta charset="UTF-8">
    <title>上傳大頭貼</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <style type="text/css">
        *{margin: 1%}
    </style>
</head>
   
<body>
    
    <img src="<?php echo $row["path"]; ?>">
    <form method="post" action="save.php" enctype="multipart/form-data" onSubmit="return InputCheck(this)">    
        上傳圖片:
        <input type="file" name="file" id="file"><br>
        <input type="submit" id="submit" value="確認">
    </form>

    
</body>
    
    
</html>    