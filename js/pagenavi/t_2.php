<html>
<head>
<style type="text/css">
<!--
div.block1 {
    display: none;
    border: 1px solid red;
}

div.block2 {
    display: none;
    border: 1px solid blue;
}

.plain2 {
    color: #aaa;
    background-color: #333;
    text-decoration: underline;
}

a.link2:link {
    color: #333;
    background-color: #aaa;
    text-decoration: none;
}
a.link2:visited {
    color: #333;
    background-color: #aaa;
    text-decoration: none;
}

-->
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js" type="text/javascript" ></script>
<script src="JsPrevNextPager.js" type="text/javascript" ></script>
</head>
<body>

<!-- [start] default parameter example -->
<h2>default parameter</h2>
<script type="text/javascript">
<!--
$(function(){
    pager1 = new JsPrevNextPager('id1');
    pager1.all = $('#page_container > div').size();
    if (0 < pager1.all) {
        $('#page_container>div:first').css('display', 'block');
        $('#pageno_cur').text(pager1.current);
        $('#pageno_all').text(pager1.all);
    }
    pager1.update_navilinks();
});
-->
</script>
<div id="page_navi">
  page <span id="pageno_cur"></span> / all <span id="pageno_all"></span>, 
  <span id="page_prev"></span>&nbsp;/&nbsp;
  <span id="page_next"></span>
</div>
<hr />
<div id="page_container">
  <?php for ($i = 1; $i <= 10; $i++) : ?>
    <div id="page_<?php echo $i; ?>" class="block1">
    Page Block No <?php echo $i; ?>.
    </div>
  <?php endfor; ?>
</div>
<!-- [end] default parameter example -->

<!-- [start] customized parameter example -->
<h2>customized parameter</h2>
<script type="text/javascript">
<!--
$(function(){
    pager2 = new JsPrevNextPager('id2');

    pager2.id_pageno_cur = 'pageno_cur2';
    pager2.id_eachpage = 'page_foobar_';
    pager2.id_prev = 'page_prev2';
    pager2.id_next = 'page_next2';
    pager2.plain_next = '<span class="plain2">次のページ</span>';
    pager2.plain_prev = '<span class="plain2">前のページ</span>';
    pager2.link_next = '<a href="#" class="link2">次のページ</a>';
    pager2.link_prev = '<a href="#" class="link2">前のページ</a>';

    pager2.all = $('#page_container2 > div').size();
    if (0 < pager2.all) {
        $('#page_container2>div:first').css('display', 'block');
        $('#pageno_cur2').text(pager2.current);
        $('#pageno_all2').text(pager2.all);
    }
    pager2.update_navilinks();
});
-->
</script>
<div id="page_navi">
  page <span id="pageno_cur2"></span> / all <span id="pageno_all2"></span>, 
  <span id="page_prev2"></span>&nbsp;/&nbsp;
  <span id="page_next2"></span>
</div>
<hr />
<div id="page_container2">
  <?php for ($i = 1; $i <= 5; $i++) : ?>
    <div id="page_foobar_<?php echo $i; ?>" class="block2">
    Page Block No <?php echo $i; ?>.
    </div>
  <?php endfor; ?>
</div>
<!-- [end] customized parameter example -->

</body>
</html>
