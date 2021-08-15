<?php include_once "database.php";
    session_start();
    $sql = "SELECT * FROM `member`";
	$result = mysqli_query($con , $sql) or die('MySQL query error');
    $row = mysqli_fetch_array($result);?>


<?php
       
        if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")) && ($_FILES["file"]["size"] < 1024 * 1024)) {
            if ($_FILES["file"]["error"] > 0) {
                echo "檔案錯誤 " . $_FILES["file"]["error"];
            } else {
                echo "檔名: " . $_FILES["file"]["name"] . "<br />";
                echo "類型: " . $_FILES["file"]["type"] . "<br />";
                echo "大小: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";

                $photo_uid = $_SESSION["id"];
                $old_filename = explode (".", $_FILES['file']['name']);
                $new_filename = $photo_uid . "." . $old_filename[1];
                $file = "./photos/" . $new_filename;
                if (file_exists($file)) {
                    move_uploaded_file($_FILES["file"]["tmp_name"], "./photos/".$new_filename);
                    $sql = "UPDATE `member` SET path = '$file' WHERE id = $photo_uid";
		            global $con;
		            $result = mysqli_query($con , $sql) or die('MySQL query error');
                    echo "已成功更新";
                }
            }
        } else {
            echo "上傳失敗！";
        }

        ?>



