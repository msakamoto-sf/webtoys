<html>
<head>
<style type="text/css">
<!--
a.pagenavi_enabled:link {
    text-decoration: underline;
}
a.pagenavi_enabled:visited {
    text-decoration: underline;
}
a.pagenavi_disabled:link {
    text-decoration: none;
}
a.pagenavi_disabled:visited {
    text-decoration: none;
}
-->
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js" type="text/javascript" ></script>
<script type="text/javascript">

var objPager = {
    all : 0,
    current : 1,
    nextok : function() {
        if (2 > this.all) {
            return false;
        }
        if (this.current == this.all) {
            return false;
        }
        return true;
    },
    prevok : function() {
        if (2 > this.all) {
            return false;
        }
        if (1 == this.current) {
            return false;
        }
        return true;
    },
    nextpage : function() {
        var cur = this.current;
        cur++;
        if (cur > this.all) {
            return false;
        } else {
            this.current = cur;
            return !((cur + 1) > this.all);
        }
    },
    prevpage : function() {
        var cur = this.current;
        cur--;
        if (cur < 1) {
            return false;
        } else {
            this.current = cur;
            return (cur - 1) > 0;
        }
    },
    nil : null
};

objPager.update_navilinks = function() {
    $('#page_prev').attr(
        'class', 
        this.prevok() ? 'pagenavi_enabled' : 'pagenavi_disabled');
    $('#page_next').attr(
        'class', 
        this.nextok() ? 'pagenavi_enabled' : 'pagenavi_disabled');
}

$(document).ready(function(){
    objPager.all = $('#page_container > div').size();
    if (0 < objPager.all) {
        $('#page_container>div:first').css('display', 'block');
        $('#pageno_cur').text(objPager.current);
        $('#pageno_all').text(objPager.all);
    }
    if (1 < objPager.all) {
        objPager.update_navilinks();
        $('#page_prev').click(function(event){
            var old = objPager.current;
            var r = objPager.prevpage();
            var prev = objPager.current;
            var id = null;
            if (old == prev) {
                return;
            }
            $('#pageno_cur').text(objPager.current);
            id = '#page_' + old;
            $(id).css('display', 'none');
            id = '#page_' + prev;
            $(id).css('display', 'block');
            objPager.update_navilinks();
            event.preventDefault();
        });
        $('#page_next').click(function(event){
            var old = objPager.current;
            var r = objPager.nextpage();
            var next = objPager.current;
            var id = null;
            if (old == next) {
                return;
            }
            $('#pageno_cur').text(objPager.current);
            id = '#page_' + old;
            $(id).css('display', 'none');
            id = '#page_' + next;
            $(id).css('display', 'block');
            objPager.update_navilinks();
            event.preventDefault();
        });
    }
});
</script>
</head>
<body>

<div id="page_navi">
page <span id="pageno_cur"></span> / all <span id="pageno_all"></span>, 
<a href="#" id="page_prev" class="pagenavi_disabled">prev</a>&nbsp;/&nbsp;
<a href="#" id="page_next" class="pagenavi_disabled">next</a>
</div>
<hr />
<div id="page_container">
<?php for ($i = 1; $i <= 10; $i++) : ?>
<div id="page_<?php echo $i; ?>" style="display: none">
Page Block No <?php echo $i; ?>.
</div>
<?php endfor; ?>
</div>

</body>
</html>
