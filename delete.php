<?php
    require_once("./db.inc.php");
    //單圖
    $sql = "DELETE FROM `items` WHERE `itemId` = ? ";
    $sqlGetImg = "SELECT `itemImg` FROM `items` WHERE `itemId` = ? ";
    $stmtGetImg = $pdo->prepare($sqlGetImg);
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
    $stmt->execute($arrParam);

    //多圖
    $sqlImg = "SELECT `multipleImageImg` FROM `multiple_images` WHERE `itemId` = ? ";
    $stmt_img = $pdo->prepare($sqlImg);
        $arrGetImgParam = [
            (int)$_GET['deleteId']
        ];
    $stmt_img->execute($arrGetImgParam);

        if($stmt_img->rowCount() > 0){

            $arr = $stmt_img->fetchAll(PDO::FETCH_ASSOC);

            for( $k = 0 ; $k <count($arr) ;$k++){
                if(file_exists("./images/".$arr[$k]['multipleImageImg'])){
                    unlink("./images/".$arr[$k]['multipleImageImg']);
                }
                    $sql1 = "DELETE FROM `multiple_images` WHERE `itemId` = ? ";
                        $stmt = $pdo->prepare($sql1);
                        $stmt->execute($arrGetImgParam);            
         }
    }
    header("Refresh: 3; url=./productlist.php");
    echo "刪除成功";