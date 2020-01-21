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
         .table h2 {
                text-align:left;
          }
          .table  th{
              text-align:right;
          } 
          .table  td{
              text-align:center;
          } 
     .inputimg{
            position:relative;
            background:url(./png/add.png)no-repeat 50% 35%;
            background-size:50px 50px;
            width:200px;
            height:200px;
            border:1px dashed #999;
          }
          .openFile{
            position:absolute;
            left:0;
            opacity:0;
            width:200px;
            height:200px;
          }
          #cross{
            width:200px;
            height:200px;
          }
          #cross span{
              line-height:250px;
          }
          .output{
            position:absolute;
            left:-1px;
            top:-1px;
          }
          .input{
              padding:10px;
              border:1px solid #999;
              border-radius:5px;
              width:800px;
              height:45px;
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
                            <li><a href="./productlist.php">商品列表</a></li>
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
                    <h2>修改商品</h2>
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
                            <form name="myForm" method="POST" action="./updateEdit.php" enctype="multipart/form-data" class="productlistform">
                                <table class="table">
                                    <tbody>
                                    <?php
                                    //SQL 敘述
                                    $sql = "SELECT `itemName`, `itemImg`, `itemPrice`, `itemQty`, `itemCategoryId`,`itemColor`
                                            FROM `items` 
                                            WHERE `itemId` = ? ";

                                    //設定繫結值
                                    $arrParam = [(int)$_GET['editId']];

                                    //查詢
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute($arrParam);

                                    if($stmt->rowCount() > 0) {
                                        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
                                    ?>
                                    <tr>
                                       <th><h2>編輯商品照片</h2></th>
                                    </tr>
                                    <tr> 
                                         <td id="cross"> 
                                            <div class="inputimg">
                                                <span>增加更多照片</span>
                                                <?php if($arr['itemImg'] !== NULL) { ?>
                                                <img class="output" height="200" width="200" src="./images/<?php echo $arr['itemImg']; ?>" >
                                            <?php } ?>
                                            <input type="file" name="itemImg" class="openFile">
                                                    <!-- <img class="output" height="200"  style="display:none"> -->
                                                    <!-- <input  type="file" name="itemImg[]" value="" class="openFile" multiple>       -->
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>商品名稱</th>
                                        <td>
                                            <input type="text" name="itemName" value="" maxlength="60" id="textcomName" class="input">
                                            <br>
                                            <span id="textCount" style="padding-left:56%;">0/60</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>商品描述</th>
                                        <td>
                                            <textarea name="itemDescription" cols="30" rows="10" maxlength="3000" id="dealDescId" class="input" style="resize:none;"></textarea>
                                            <br>
                                            <span id="textCount-1" style="padding-left:55%;">0/3000</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>商品類別</th>
                                        <td>
                                            <select name="itemCategoryId" class="input">
                                            <option value="智慧手錶">智慧手錶</option>
                                            <option value="藍芽耳機">藍芽耳機</option>
                                            <option value="錄影器材">錄影器材</option>
                                            <option value="其他">其他</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <h2>價格和庫存</h2>
                                        </th>
                                    </tr>
                                    <tr>
                                        <tr>
                                            <th>商品價格</th>
                                            <td >
                                                <input type="text" name="itemPrice" value="" class="input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>商品數量</th>
                                            <td>
                                            <input type="text" name="itemQty" value="<?php echo $arr['itemQty']; ?>" class="input">
                                            </td>
                                        </tr>     
                                        <tr>
                                            <th>商品顏色</th>
                                            <td>
                                                <select name="itemColor" class="input">
                                                    <option value="黑">黑</option>
                                                    <option value="白">白</option>
                                                    <option value="紅">紅</option>
                                                    <option value="藍">藍</option>
                                                    <option value="灰">灰</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                            <td>功能</td>
                                            <td>
                                                <a href="./delete.php?deleteId=<?php echo $arr['id']; ?>">刪除</a>
                                            </td>
                                        </tr> -->
                                    <?php
                                    } else {
                                    ?>
                                        <tr>
                                            <td colspan="6">沒有資料</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                    <td colspan="6"><input type="submit" name="smb" value="修改">
                                    </td>
                                        </tr>
                                    </tfoo>
                                </table>
                                <input type="hidden" name="editId" value="<?php echo (int)$_GET['editId']; ?>">
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