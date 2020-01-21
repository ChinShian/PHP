<?php
require_once("./db.inc.php");
$sql = "DELETE FROM `items` WHERE `itemId` = ? ";
$sqlGetImg = "SELECT `itemImg` FROM `items` WHERE `itemId` = ? ";
$stmtGetImg = $pdo->prepare($sqlGetImg);
if( !$stmtGetImg ){
    echo "<pre>";
    print_r($pdo->errorInfo());
    echo "</pre>";
    exit();
}

$arrGetImgParam = [
    (int)$_GET['deleteId']
];

$stmtGetImg->execute($arrGetImgParam);

if( $stmtGetImg->rowCount() > 0 ){
    $arrImg = $stmtGetImg->fetchAll(PDO::FETCH_ASSOC)[0];
    if( $arrImg['itemImg'] !== NULL ){
        @unlink("./images/".$arrImg['itemImg']);
    }
}


$arrParam = [
    (int)$_GET['deleteId']
];

$stmt = $pdo->prepare($sql);
if( !$stmt ){
    echo "<pre>";
    print_r($pdo->errorInfo());
    echo "</pre>";
    exit();
}

$stmt->execute($arrParam);

if( $stmt->rowCount() > 0 ){
    header("Refresh: 3; url=./productlist.php");
    echo "刪除成功";
    exit();
} else {
    header("Refresh: 3; url=./productlist.php");
    echo "刪除失敗";
    exit();
}