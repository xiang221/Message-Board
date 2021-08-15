<?php include_once "database.php";
    session_start();
    $sql = "SELECT * FROM `mes`";
    $sql_2 = "SELECT * FROM `member`";
    $sql_3 = "SELECT * FROM `comments`";
	$result = mysqli_query($con , $sql) or die('MySQL query error');
    $result_2 = mysqli_query($con , $sql_2) or die('MySQL query error');
    $result_3 = mysqli_query($con , $sql_3) or die('MySQL query error');
    $row_2 = mysqli_fetch_array($result_2);
?>


<html>
<head>
	<meta charset="UTF-8">
	<title>留言板</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<div class="container">
		<h1>留言板</h1>
		<span>
			<?php if(isset($_SESSION["id"])){?>
				<a href="account.php?method=logout">登出</a>
                <a href="photo.php">個人資料</a>
                <a href="modify_mem.php">修改資料</a>
				<a href="new_mes.php">新增文章</a>
                積分:<?php  echo $_SESSION["points"]; ?>(將於每次重新登入後刷新)
            
			<?php }else{?>
				<a href="login.php">登入</a>
				<a href="signup.php">註冊</a>
			<?php }?>
		</span>
        
		<?php  while($row = mysqli_fetch_array($result)){?>
			<div class="card">
				<h4 class="card-header">標題：<?php echo $row["title"];?>
				<?php if(@$_SESSION["id"]===$row["uid"]){?>
					<a href="mes.php?method=del&id=<?php echo $row["id"]?>" class="btn btn-danger mybtn">刪除</a>
					<a href="modify_mes.php?id=<?php echo $row["id"]?>" class="btn btn-primary mybtn">編輯</a>
  			    <?php }else if (@$_SESSION["manager"]==1){?>
                    <a href="mes.php?method=del&id=<?php echo $row["id"]?>" class="btn btn-danger mybtn">刪除</a>
				<?php }?>
				</h4>

				<div class="card-body">
					<h5 class="card-title">作者：<?php echo $row["uid"];?></h5>
					<p class="card-text">
						<?php echo $row["content"];?>
					</p>
                    <?php if(isset($_SESSION["id"])){?>
                    <form role="form" action="mes.php?method=comments&id=<?php echo $row["id"]?>" method="post">
                        <div class="form-group">
                            <label for="content">留言:</label>
                            <textarea class="form-control" id="message" placeholder="message" name="message">
                            </textarea>    
                        </div>
                        <button type="submit" class="btn btn-primary">送出</button>  
                    </form>
                    <?php }?>
                    <?php  $result_3 = mysqli_query($con , $sql_3) or die('MySQL query error');
                           $row_3 = mysqli_fetch_array($result_3);
                           while($row_3 = mysqli_fetch_array($result_3)){
                           if($row_3["cid"]==$row["id"]){?>
          
                        <h6><?php echo $row_3["message_uid"];?>:
                        </h6>
                        <p class="card-comments">
	                       <?php echo $row_3["message"];?>
                           <?php if(@$_SESSION["id"]===$row_3["message_uid"]){?>
					<a href="mes.php?method=del_mes&id=<?php echo $row_3["id"]?>" class="btn btn-danger mybtn">刪除</a>
					<a href="modify_com.php?id=<?php echo $row_3["id"]?>" class="btn btn-primary mybtn">編輯</a>
                    <?php }else if (@$_SESSION["manager"]==1){?>
                    <a href="mes.php?method=del_mes&id=<?php echo $row_3["id"]?>" class="btn btn-danger mybtn">刪除</a>
				    <?php }?>        
                        </p>
                         <?php }}?>

                </div> 

            </div>
        <?php }?>      
    </div> 
    
</body>
</html>