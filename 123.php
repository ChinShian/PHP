<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.example2').hide();
    $('a#toggle-example2').click(function() {
        $('.example2').slideToggle(1000);
        return false;
    });
});
</script>
<a href="#" id="toggle-example2" class="button">開啟/關閉</a>
<div class="example2">
    <p>在網頁上常使用按下指定的按鈕(或區塊)後，隱藏與顯示所要展現的區塊，此方法可以使用jQuery click slideToggle 簡單的實踐。</p>
</div>