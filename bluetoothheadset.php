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
    .w100px{
        height:100px;
    }
    .table  th{
              text-align:center;
          } 
    .table  td{
              text-align:center;
         } 
    .input{
        padding:10px;
        border:1px solid #999;
        border-radius:5px;
        width:800px;
        height:35px;
    }
    #join_btnS{
        width:100px;
        padding:5px;
        height:35px;
        margin-bottom:3px;
    }
    a:hover{
        color:#FFF;
    }
    .linka{  
        color:#FFF;
        text-decoration:none;
    }
    .linka1{
        color:#FFF;
        text-decoration:none;
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
                    <h2>藍芽耳機</h2>
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
                            <form action="./search.php" method="POST" name="myForm" style="text-align:right;">
                                    <input type="text" name="itemName" id="itemName" placeholder="請輸入搜尋文字" class="input">
                                    <button id="join_btnS" class="btn btn-outline btn-primary">搜尋</button>
                                </form>   
                                <button class="btn btn-primary btn-rounded"><a href="./smartphone.php" class="linka">智慧手錶</a></button>
                                <button class="btn btn-success btn-rounded"><a href="./bluetoothheadset.php" class="linka">藍芽耳機</a></button>
                                <button class="btn btn-info btn-rounded"><a href="./videoequipment.php" class="linka">錄影器材</a></button>
                                <button class="btn btn-warning btn-rounded"><a href="./other.php" class="linka">其他</a></button>
                                <form name="myForm" method="POST" action="./deleteids.php">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>選取</th>
                                            <th>商品名稱</th>
                                            <th>商品圖片</th>
                                            <th>商品價格</th>
                                            <th>商品數量</th>
                                            <th>商品類別</th>
                                            <th>商品顏色</th>
                                            <th>新增時間</th>
                                            <th>更新時間</th>
                                            <th>多圖設定/修改/刪除</th>
                                        </tr>
                                        </thead>
                                        <tbody >
                                        <?php
                                        $sql = "SELECT `itemId`,`itemName`,`itemImg`,`itemPrice`,`itemQty`,
                                        `itemCategoryId`,`itemColor`,`created_at`,`updated_at`  
                                        FROM `items` WHERE `itemCategoryId` = '藍芽耳機' ";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute();
                                        if($stmt->rowCount() > 0){
                                            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            for($i = 0; $i < count($arr); $i++){
                                        ?>
                                        <tr class="tr">
                                            <td>
                                                <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['itemId'] ?>" class="box">
                                            </td>
                                            <td><?php echo $arr[$i]['itemName'] ?></td>
                                            <td>
                                                <img src="./images/<?php echo $arr[$i]['itemImg'] ?>" class="w100px">
                                            </td>
                                            <td><?php echo $arr[$i]['itemPrice'] ?></td>
                                            <td><?php echo $arr[$i]['itemQty'] ?></td>
                                            <td><?php echo $arr[$i]['itemCategoryId'] ?></td>
                                            <td><?php echo nl2br($arr[$i]['itemColor']) ?></td>
                                            <td><?php echo $arr[$i]['created_at'] ?></td>
                                            <td><?php echo $arr[$i]['updated_at'] ?></td>
                                            <td>
                                            <div class="btn-group">
                                                    <button class="btn btn-primary" type="button" ><a href="./multipleImages.php?itemId=<?php echo $arr[$i]['itemId']; ?>" class="linka1">多圖設定</a></button>
                                                    <button class="btn btn-primary" type="button" ><a href="./edit.php?editId=<?php echo $arr[$i]['itemId'] ?>" class="linka1">修改</a></button>
                                                    <button class="btn btn-primary" type="button" ><a href="./delete.php?deleteId=<?php echo $arr[$i]['itemId'] ?>" class="linka1">刪除</a></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <br>
                                    <br>
                                    <input type="checkbox" id="allChecked" class="tr1">全選/取消全選
                                    <br>
                                    <br>
                                    <!-- <label name="ReverseChecked">
                                    <input type="checkbox" name="ReverseChecked" id="ReverseChecked" class="tr1">反選 -->
                                    </label>
                                    <br>
                                    <input type="submit" name="smb" class="tr1" value="刪除">
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