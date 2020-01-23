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

    
     <!-- Ladda style -->
     <link href="css/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
    <style>
         .tobodycross {
            display:flex;
            flex-wrap:wrap;
            box-sizing:border-box;
          }
          .table h2 {
                text-align:left;
          }
          .table  th{
              text-align:right;
          } 
          .table  td{
              text-align:center;
          } 
          button{
              margin-left:20px;
          }
          h2{
            font-weight:bold;
          }
          #mytr td{
              padding-top:20px;
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
          .inputtest{
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
                    <h2>新增商品</h2>
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
                                <form name="myForm" enctype="multipart/form-data" method="POST" action="send.php">
                                <div  class="formtable">
                                <table>
                                    <tr>
                                       <th><h2>編輯商品照片</h2></th>
                                    </tr>
                                    <thead id="mythead" class="tobodycross" >
                                    <tr class="inputimgss"> 
                                        <td class="cross"> 
                                            <div class="inputimg">
                                                
                                                <span>增加更多照片</span>
                                                    <img class="output" height="200" width="200" style="display:none">
                                                    <input  type="file" name="itemImg[]" value="" class="openFile" multiple>      
                                            </div>
                                        </td>
                                    </tr>
                                    </thead>
                                </table>
                                <table class="table">
                                    <tbody>
                                <tr>
                                    <tr>
                                        <th><h2>基本資訊</h2></th>
                                    </tr> 
                                    <tr>
                                        <th>商品名稱</th>
                                        <td>
                                            <input type="text" name="itemName[]" value="" maxlength="60" id="textcomName" class="inputtest">
                                            <br>
                                            <span id="textCount" style="padding-left:56%;">0/60</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>商品描述</th>
                                        <td>
                                            <textarea name="itemDescription[]" cols="30" rows="10" maxlength="3000" id="dealDescId" class="inputtest" style="resize:none;"></textarea>
                                            <br>
                                            <span id="textCount-1" style="padding-left:55%;">0/3000</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>商品類別</th>
                                        <td>
                                            <select name="itemCategoryId[]" class="inputtest">
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
                                                <input type="text" name="itemPrice[]" value="" class="inputtest">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>商品數量</th>
                                            <td>
                                                <input type="text" name="itemQty[]" value="" class="inputtest">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>商品顏色</th>
                                            <td>
                                                <select name="itemColor[]" class="inputtest">
                                                    <option value="黑">黑</option>
                                                    <option value="白">白</option>
                                                    <option value="紅">紅</option>
                                                    <option value="藍">藍</option>
                                                    <option value="灰">灰</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tr>
                                </tr>
                                    </tbody>                            
                                    </table>
                                    </div>
                                    <input type="submit" name="sub" value="新增商品" class="ladda-button btn btn-danger" data-style="expand-right">
                                    <button name="btn_new" id="btn_new" type="button" class="ladda-button btn btn-info" data-style="slide-up" >新增欄位</button> 
                                     <button name="btn_del" id="btn_del" type="button" class="ladda-button btn btn-info" data-style="slide-up">刪除欄位</button>
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
    
    <!-- Ladda -->
    <script src="js/plugins/ladda/spin.min.js"></script>
    <script src="js/plugins/ladda/ladda.min.js"></script>
    <script src="js/plugins/ladda/ladda.jquery.min.js"></script>
    <script>
    $(document).ready(function (){

        // Bind normal buttons
        Ladda.bind( '.ladda-button',{ timeout: 300 });

        // Bind progress buttons and simulate loading progress
        Ladda.bind( '.progress-demo .ladda-button',{
            callback: function( instance ){
                var progress = 0;
                var interval = setInterval( function(){
                    progress = Math.min( progress + Math.random() * 0.1, 1 );
                    instance.setProgress( progress );

                    if( progress === 1 ){
                        instance.stop();
                        clearInterval( interval );
                    }
                }, 200 );
            }
        });


        var l = $( '.ladda-button-demo' ).ladda();

        l.click(function(){
            // Start loading
            l.ladda( 'start' );

            // Timeout example
            // Do something in backend and then stop ladda
            setTimeout(function(){
                l.ladda('stop');
            },12000)


        });

    });

</script>
</body>

</html>