<?php
require_once('./db.inc.php');

$sql = "DELETE FROM `items` WHERE `itemId` = ? ";

$sqlGetImg = "SELECT `itemImg` FROM `items` WHERE `itemId` = ? ";
$stmtGetImg = $pdo->prepare($sqlGetImg);

for( $i = 0; $i < count($_POST['chk']); $i++ ){
    $arrGetImgParam = [
        (int)$_POST['chk'][$i]
    ];

    $stmtGetImg->execute($arrGetImgParam);

    if($stmtGetImg->rowCount() > 0){
        $arrImg = $stmtGetImg->fetchAll(PDO::FETCH_ASSOC)[0];
        if( $arrImg['itemImg'] !== NULL ){
            @unlink("./images/".$arrImg['itemImg']);
        }
    }

    $arrParam = [
        (int)$_POST['chk'][$i]
    ];

    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);

}


$sql1 = "DELETE FROM `multiple_images` WHERE `itemId` = ? ";

$sqlImg = "SELECT `multipleImageImg` FROM `multiple_images` WHERE `itemId` = ? ";
$stmt_img = $pdo->prepare($sqlImg);

for($i = 0; $i < count($_POST['chk']); $i++){
    $arrParam = [
        $_POST['chk'][$i]
    ];
    $stmt_img->execute($arrParam);

    if($stmt_img->rowCount() > 0) {
        //取得檔案資料 (單筆)
        $arr = $stmt_img->fetchAll(PDO::FETCH_ASSOC)[0];
        
        if( $arr['multipleImageImg']!== NULL ){
            unlink("./images/".$arr['multipleImageImg']);
        }
    }
            $arrParam1 = [
                $_POST['chk'][$i]
            ];
            $stmt = $pdo->prepare($sql1);
            $stmt->execute($arrParam1);
    
}
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();

if( $stmt->rowCount() > 0 ){
    header("Refresh: 3; url=./productlist.php");
    echo "刪除成功";
} else {
    header("Refresh: 3; url=./productlist.php");
    echo "刪除失敗";
}