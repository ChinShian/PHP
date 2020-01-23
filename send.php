<?php 
require_once('./db.inc.php');

echo "<pre>";
print_r($_FILES);
print_r($_POST);
echo "</pre>";
// exit();


function searchForId($id, $array) {
    global $blankArray;
    $blankArray[] = 0;
    $lastBalnk = -999;
    foreach ($array as $key => $val) {
        if ($val === $id) {
            if($lastBalnk+1 != $key ){
                global $blankArray;
                if ($lastBalnk >0){
                    $blankArray[] = $lastBalnk+1;
                }
                
                $blankArray[] = $key;
            }
            $lastBalnk = $key;
        }
    }
    return null;
 }
$newArray = $_FILES["multipleImageImg"]["name"];
// print_r($newArray);
searchForId('',$newArray);
print_r($blankArray);
// exit();




$counting = 0;
for($i=0;$i <count($_FILES['itemImg']["name"]); $i++){
    $counting ++;
    echo 'count:'. $counting;
    if($_FILES["itemImg"]["error"][$i]===0){
        $itemImg = $_FILES["itemImg"]['name'][$i];

        if(!move_uploaded_file($_FILES["itemImg"]["tmp_name"][$i],"./images/{$itemImg}")){
            // header("Refresh: 3; url=./commodity.php");
            // echo "上傳失敗!!";
            // exit();
        }
    }


    $sql = " INSERT INTO `items`(`itemName`,`itemDescription`,`itemImg`,`itemPrice`,`itemQty`,`itemCategoryId`,`itemColor`)
            VALUES (?,?,?,?,?,?,?)";

    $arrParam=[
        $_POST['itemName'][$i],
        $_POST['itemDescription'][$i],
        $itemImg,
        $_POST['itemPrice'][$i],
        $_POST['itemQty'][$i],
        $_POST['itemCategoryId'][$i],
        $_POST['itemColor'][$i]
    ];
    
    echo "<pre>";
print_r("i=".$i.$arrParam);
echo "</pre>";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    $orderId = $pdo->lastInsertId();
    if( $stmt->rowCount() > 0 ){
        // header("Refresh: 3; url=./productlist.php");
        echo "i=".$i."更新成功";
        // exit();
    } else {
        // header("Refresh: 3; url=./productlist.php");
        echo  "i=".$i."沒有任何更新";
        // exit();
    }
    

    echo '$blankArray[$i*2]='.$blankArray[$i*2].'/';
    echo '$blankArray[$i*2+1]='.$blankArray[$i*2+1].'/';
    for($k = $blankArray[$i*2]; $k < $blankArray[$i*2+1]; $k++){

        // exit();
            //判斷上傳是否成功 (error === 0)
            if( $_FILES["multipleImageImg"]["error"][$k] === 0 ) {
                
                //為上傳檔案命名
                $itemImg = $_FILES["multipleImageImg"]['name'][$k];

                //若上傳成功，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
                if( !move_uploaded_file($_FILES["multipleImageImg"]["tmp_name"][$k], "./images/{$itemImg}") ) {
                    
                    // header("Refresh: 3; url=./multipleImages.php?itemId={$_POST["itemId"]}");
                    // $objResponse['success'] = false;
                    // $objResponse['code'] = 500;
                    // $objResponse['info'] = "上傳圖片失敗";
                    // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
                    // exit();
                }
            }
            //SQL 敘述
            $sql = "INSERT INTO `multiple_images` (`multipleImageImg`,`itemId`) VALUES (?,?)";
            //繫結用陣列
            $arrParam = [
                $itemImg,
                $orderId
            ];
            // echo "<pre>";
            // print_r($_FILES);
            // echo "</pre>";
            // exit();
            $stmt = $pdo->prepare($sql);
            $stmt->execute($arrParam);
    }

};

header("Refresh: 0; url=./productlist.php");


?>