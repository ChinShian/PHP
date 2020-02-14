<?php
require_once('./db.inc.php'); 

//使用迴圈走訪陣列元素
for($i = 0; $i < count($_FILES["multipleImageImg"]["name"]); $i++){
    //判斷上傳是否成功 (error === 0)
    if( $_FILES["multipleImageImg"]["error"][$i] === 0 ) {
        //為上傳檔案命名
        $strDatetime =  $_FILES["multipleImageImg"]['name'][$i];
            
        //若上傳成功，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
        if( !move_uploaded_file($_FILES["multipleImageImg"]["tmp_name"][$i], "./images/{$strDatetime}") ) {
        }
    }

    //SQL 敘述
    $sql = "INSERT INTO `multiple_images` (`multipleImageImg`,`itemId`) VALUES (?, ?)";

    //繫結用陣列
    $arrParam = [
        $strDatetime,
        $_POST["itemId"]
    ];

    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    }
    header("Refresh: 3; url=./multipleImages.php?itemId={$_POST["itemId"]}");
    echo "新增成功";