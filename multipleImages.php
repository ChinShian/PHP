<?php
require_once('./db.inc.php');
require_once('./button.php');
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Search Page</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
    .tobodycross {
        display:flex;
        flex-wrap:wrap;
        box-sizing:border-box;
        }
    .inputimg{
        position:relative;
        background:url(./png/add.png)no-repeat 50% 35%;
        background-size:50px 50px;
        width:200px;
        height:200px;
        overflow:hidden;
    }
    .openFile{
        position:absolute;
        left:0;
        opacity:0;
        width:200px;
        height:200px;
    }
    .cross{
        width:200px;
        height:200px;
    }
    .cross span{
        line-height:250px;
        margin-left:25%;
    }
    .output{
        position:absolute;
        left:-1px;
        top:-1px;
    }
    img.previous_images{
        width: 100px;
        height:100px;
    }
    </style>
</head>

<body>

    <div id="wrapper">
        <!-- 左側選單 -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <!-- 個人資料選單 -->
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img alt="image" class="rounded-circle" src="img/profile_small.jpg" />
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">David Williams</span>
                            </a>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    <li class="active">
                        <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">商品管理</span><span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="./commodity.php">新增商品</a></li>
                            <li><a href="./productlist.php">我的商品</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </nav>
        <!-- Body -->
        <div id="page-wrapper" class="gray-bg">
            <!-- 上側選單 -->
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                                class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                            </a>
                        </li>


                        <li>
                            <a href="login.html">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>
            <!-- 標題 -->
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>多圖上傳</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            Extra Pages
                        </li>
                        <li class="breadcrumb-item active">
                            <strong> Search Page</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- 內文 -->
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-content">
                            <form name="myForm" method="POST" action="./deleteMultipleImages.php">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>多圖圖片選擇</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tobodycross">
                                    <?php
                                    $sql = "SELECT `multipleImageId`, `multipleImageImg`, `created_at`, `updated_at`
                                            FROM `multiple_images`
                                            WHERE `itemId` = ?
                                            ORDER BY `multipleImageId` ASC";
                                    $stmt = $pdo->prepare($sql);
                                    $arrParam = [
                                        (int)$_GET['itemId']
                                    ];
                                    $stmt->execute($arrParam);
                                    if($stmt->rowCount() > 0) {
                                        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        for($i = 0; $i < count($arr); $i++) {
                                    ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="chk[]" class="box" value="<?php echo $arr[$i]['multipleImageId']; ?>" />
                                            </td>
                                            <td>
                                                <img class="previous_images" src="./images/<?php echo $arr[$i]['multipleImageImg'] ?>">
                                            </td>
                                        </tr>

                                    <?php
                                        }
                                    } else {
                                    ?>

                                <tr><td colspan="2">尚未上傳圖檔</td></tr>

                                <?php
                                }
                                ?>
                                    </table>
                                    <br>
                                    <input type="checkbox" id="allChecked" class="tr1">全選/取消全選
                                    <br>
                                    <br>
                                    <input class="ladda-button btn btn-danger" data-style="expand-right" type="submit" name="smb" class="tr1" value="刪除" >
                                    <input type="hidden" name="itemId" value="<?php echo (int)$_GET['itemId']; ?>">
                            </form>

                                <hr />

                                <form name="myForm" method="POST" action="./insertMultipleImages.php" enctype="multipart/form-data">
                                    <table>
                                    <tr>
                                       <th><h2>編輯商品照片</h2></th>
                                    </tr>
                                    <thead id="mythead" class="tobodycross" >
                                    <tr> 
                                        <td class="cross"> 
                                            <div class="inputimg">
                                                    <span>增加更多照片</span>
                                                    <img class="output" height="200" width="200" style="display:none">
                                                    <input  type="file" name="multipleImageImg[]" value="" class="openFile" multiple>
                                            </div>
                                        </td>
                                    </tr>
                                    </thead>
                                    </table>
                                        
                                    <input type="submit" name="smb_add" class="ladda-button btn btn-info" data-style="slide-up" value="新增">
                                    <input type="button" class="ladda-button btn btn-info" data-style="slide-up" value="返回" onclick="location.href='./productlist.php'" style="margin-left:820px">

                                    <input type="hidden" name="itemId" value="<?php echo (int)$_GET['itemId']; ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <!-- <div class="footer">
            <div class="float-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2018
            </div>
        </div> -->

    </div>
    </div>


    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>


</body>

</html>