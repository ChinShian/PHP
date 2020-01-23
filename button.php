<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>button</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
    $(document).on('click','button#btn_new', function(){ 
              $('div.formtable').append(`
                            <div class="deltable">
                                <table >
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
                                <table class="table" >
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
                                      `);
            });

    
        $(document).on('click', 'button#btn_del', function(){
            $('div.deltable').last().remove();
        });

        let imgArray = [];
        $(document).on('change', 'input.openFile',function(event) {
            let $target = $(event.target);
            let input = event.target;//觸發DOM元素
            let count = $target.closest('tr').siblings().length ;
            // console.log($('table').length);
            console.log("hi,"+$target.closest('table'));
            console.log("hi,"+$target.closest('table').parent().index());
            // console.log("count="+count);
            if(input.files && input.files.length >= 0){ //如果照片和照片長度大於等於0
                    for(let i=0;i<input.files.length;i++){ 
                        // console.log("input.files="+input.files[i].name);
                        let reader = new FileReader(); //建立新的 FileReader 物件 藉由 FileReader 物件，Web 應用程式能以非同步方式讀取儲存在用戶端的檔案（或原始資料暫存）內容，可以使用 File 或 Blob 物件指定要讀取的資料。
                        reader.onload = function(){//當網頁載入完成後，觸發特定的 JavaScript 函式去執行特定的工作
                            let dataURL = reader.result;//事件處理程序返回的最後一個值，該值由該事件觸發，除非未定義該值
                            let cross = ``;
                            $target.closest('thead').append(`
                            <tr> 
                                <td class="cross"> 
                                    <div class="inputimg">
                                        <span>增加更多照片</span>
                                            <img class="output" height="200" width="200" style="display:none">
                                            <input  type="file" name="multipleImageImg[]" value="" class="openFile" multiple>      
                                    </div>
                                </td>
                            </tr>`)
                            // console.log(t);
                            // console.log($target.parent().parent().parent());
                            
                            
                            $target.closest('thead').children().eq(count+i).children().children().children().attr('src',dataURL).show();

                            // $('.output').eq(t).attr('src',dataURL).show();//siblings尋找input每個.output 規定屬性的名稱規定屬性的值

                        };

                    reader.readAsDataURL(input.files[i]);//讀取指定的files
                    };
                    
                };
        });
 
            $(document).on('click', 'input#allChecked',function() {
                        if($("#allChecked").prop("checked")) {
                            $(".box").prop("checked", true);      
                        } else {
                            $(".box").prop("checked", false);          
                        }
                    });

            $(document).on('click', 'input.box',function() {
                        if ($(this).is(":checked")){
                            let isAllChecked = 0;
                            $("input.box").each(function(){
                                if( !this.checked){
                                    isAllChecked = 1;
                                }
                            })
                            if( isAllChecked == 0){
                                $("input#allChecked").prop("checked",true);
                            }
                            else{
                                $("input#allChecked").prop("checked",false);
                            }
                        }
                        else{
                            $("input#allChecked").prop("checked",false);
                        }
                    });
            
            $(document).on('click', 'input#ReverseChecked',function() {
                if ($(this).prop("checked")){
                    $("input[name='chk[]']").each(function(){
                        if($(this).prop("checked")) {
                            $(this).prop("checked",false);     
                        } else{
                            $(this).prop("checked",true);        
                                }
                    })
                }else{
                    $("input[name='chk[]']").each(function(){      
                        if(!$(this).prop("checked")) {
                            $(this).prop("checked",true);    
                        } else{
                            $(this).prop("checked",false);       
                            }
                    })
                }
            });
            
            $(document).ready(function(){
                $(document).on('click', 'button#join_btnS',function() {
                $.ajax({
                    method:'POST',
                    url:"search.php",
                    data:{
                        'comName':$('#comName').val(),
                    }
                })
                })
            });

            $(document).ready(function(){
                $(document).on('click', 'input#comCategoryId',function() {
                $.ajax({
                    method:'POST',
                    url:"smartphone.php",
                    data:{
                        'comCategoryId':$('#comCategoryId').val(),
                    }
                })
                })
            });

            $(document).on('keyup','input#textcomName',function(event){
                let $target = $(event.target);
                let count = $target.siblings().eq(1);
                // console.log(count);
                let lengthtext = $(this).val().length;
                    if (lengthtext > 60) {
                        alert("已超過上限的內容!!");
                    } else {
                        count.text($target.val().length + "/60");     
                    }
                });

            $(document).on('keyup','textarea#dealDescId',function(event){
                let $target = $(event.target);
                let count = $target.siblings().eq(1);
                // console.log(count);
                let lengthtext = $(this).val().length;
                    if (lengthtext > 3000) {
                        alert("已超過上限的內容!!");
                    } else {
                        count.text($target.val().length + "/3000");
                    }
                });

            $(document).on('click','textarea#dealDescId',function(){
                $(this).css({
                    "height":"300px",
                    "transition":"0.5s",
                    "overflow-y":"scroll"
                })
            }) 

            // $(document).on('change','td.cross',function(){
            //         $("thead.tobodycross").append(`
            //             <tr  class="inputimgss"> 
            //                 <td class="cross"> 
            //                     <div class="inputimg">
            //                         <span>增加更多照片</span>
            //                             <img class="output" height="200" width="200" style="display:none">
            //                             <input  type="file" name="multipleImageImg[]" value="" class="openFile" multiple>      
            //                     </div>
            //                 </td>
            //             </tr>
            //         `)
            // })
    </script>
</head>
<body>

</body>
</html>