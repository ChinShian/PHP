<?php
require_once('./db.inc.php');
require_once('./button.php');

$sqlTotal = "SELECT count(1) FROM `com`"; //SQL 敘述
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0]; //取得總筆數
$numPerPage = 5; //每頁幾筆
$totalPages = ceil($total/$numPerPage); // 總頁數
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; //目前第幾頁
$page = $page < 1 ? 1 : $page; //若 page 小於 1，則回傳 1



//商品種類 SQL 敘述
$sqlTotalCatogories = "SELECT count(1) FROM `categoryid`";

//取得商品種類總筆數
$totalCatogories = $pdo->query($sqlTotalCatogories)->fetch(PDO::FETCH_NUM)[0];
?> 
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Search Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">

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
                            <li><a href="./productlist.php">商品列表</a>
                                <ul>
                                    <!-- <li><a href="./smartwatch.php?comCategoryId=<?php echo $arr[$i]['comCategoryId']; ?>">智慧手錶</a></li>
                                    <li><a href="">藍芽耳機</a></li>
                                    <li><a href="">錄影器材</a></li>
                                    <li><a href="">其他</a></li> -->
                                </ul>
                            </li>
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
                    <h2>商品列表</h2>
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
                           
            
        
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                    <div class="table-responsive">
                         <form action="./search.php" method="POST" name="myForm">
                         <input type="text" name="comName" id="comName" placeholder="請輸入搜尋文字">
                                    <button id="join_btnS">搜尋</button>
                                </form>
                                <a href="./smartphone.php">智慧手錶</a>
                                <a href="./bluetoothheadset.php">藍芽耳機</a>
                                <a href="./videoequipment.php">錄影器材</a>
                                <a href="./other.php">其他</a> 
                                <form name="myForm" method="POST" action="./deleteids.php">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                   
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
                                        $sql = "SELECT `com`.`comId`, `com`.`comName`, `com`.`comImg`, `com`.`comPrice`, 
                                        `com`.`comQty`, `com`.`comCategoryId`, `com`.`comColor`,`com`.`created_at`,
                                         `com`.`updated_at`, `categoryid`.`categoryName`
                                        FROM `com` INNER JOIN `categoryid`
                                        ON `com`.`comCategoryId` = `categoryid`.`categoryParentId`
                                        ORDER BY `com`.`comId` ASC 
                                        LIMIT ?, ? ";
                
                                        $arrParam = [($page - 1) * $numPerPage, $numPerPage];
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute($arrParam);
                                        if($stmt->rowCount() > 0){
                                            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            for($i = 0; $i < count($arr); $i++){
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
                                        </tbody>
                     
                                        <tfoot>
                                            <tr>
                                                <td colspan="9">
                                                <?php for($i = 1; $i <= $totalPages; $i++){ ?>
                                                    <a href="?page=<?=$i?>"><?= $i ?></a>
                                                <?php } ?>
                                                </td>
                                            </tr>
                                            <?php if($total > 0) { ?>
                                                <tr>
                                                <td class="border" colspan="9"><input type="submit" name="smb" value="刪除"></td>
                                                </tr>
                                                <?php } ?>
                                        </tfoot>
                                    </table>
                                    <br>
                                    <br>
                                    <input type="checkbox" id="allChecked" class="tr1">全選/取消全選
                                    <br>
                                    <br>
                                    <label name="ReverseChecked">
                                    <input type="checkbox" name="ReverseChecked" id="ReverseChecked" class="tr1">反選
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

        </div>
        </div>
<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="js/plugins/dataTables/datatables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });

    </script>

</body>

</html>