<?php
require_once('./db.inc.php');

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();


$sql = "DELETE FROM `items` WHERE `itemId` = ? ";

$count = 0;

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

    $count += $stmt->rowCount();

}


if( $count > 0 ){
    header("Refresh: 3; url=./productlist.php");
    echo "刪除成功";
} else {
    header("Refresh: 3; url=./productlist.php");
    echo "刪除失敗";
}