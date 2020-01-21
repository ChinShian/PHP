<?php 
    $sql = "SELECT `comId`,`comName`,`comImg`,`comPrice`,`comQty`,
            `comCategoryId`,`comColor`,`created_at`,`updated_at`  
            FROM `com` WHERE `comCategoryId` = ? ";
    $arrParam = [
    $_GET['comCategoryId']
        ];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0) {
        for($i = 0; $i < count($arr); $i++) {
    ?>
            <tr class="tr">
                <td>
                    <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['comId'] ?>" class="box">
                </td>
                <td><?php echo $arr[$i]['comName'] ?></td>
                <td>
                    <img src="./images/<?php echo $arr[$i]['comImg'] ?>" class="w100px">
                </td>
                <td><?php echo $arr[$i]['comPrice'] ?></td>
                <td><?php echo $arr[$i]['comQty'] ?></td>
                <td><?php echo $arr[$i]['comCategoryId'] ?></td>
                <td><?php echo nl2br($arr[$i]['comColor']) ?></td>
                <td><?php echo $arr[$i]['created_at'] ?></td>
                <td><?php echo $arr[$i]['updated_at'] ?></td>
                <td>
                    <a href="./multipleImages.php?comId=<?php echo $arr[$i]['comId']; ?>">多圖設定</a>
                    <a href="./edit.php?editId=<?php echo $arr[$i]['comId'] ?>">修改/</a>
                    <a href="./delete.php?deleteId=<?php echo $arr[$i]['comId'] ?>">刪除</a>
                </td>
            </tr>
            <?php
                }
            }
        ?>
?>