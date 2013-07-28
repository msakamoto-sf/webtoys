/**
 * JavaScript "Previous", "Next" Page Navigation class library
 *
 * @author sakamoto-gsyc-3s@glamenv-septzen.net
 */

/**
 * JsPrevNextPager container and accessor
 *
 * @param string identifier
 * @return object JsPrevNextPager
 */
var JsPrevNextPager = function(id) {
    if (!arguments.callee.pagers) {
        arguments.callee.pagers = {};
    }
    if (!(id in arguments.callee.pagers)) {
        arguments.callee.pagers[id] = new JsPrevNextPager.instanciate(id);
    }
    return arguments.callee.pagers[id];
};

/**
 * JsPrevNextPager
 *
 * @constructor
 * @param string identifier
 * @return object JsPrevNextPager
 */
JsPrevNextPager.instanciate = function(id_) {

    /** identifier */
    this.id = id_;

    /** pages count */
    this.all = 0;

    /** current page */
    this.current = 1;

    /** (X)HTML DOM ID for current page number */
    this.id_pageno_cur = 'pageno_cur';

    /** (X)HTML DOM ID PREFIX for page block element */
    this.id_eachpage = 'page_';

    /** (X)HTML DOM ID for previous link (<span> element recommended) */
    this.id_prev = 'page_prev';

    /** (X)HTML DOM ID for next link (<span> element recommended) */
    this.id_next = 'page_next';

    /** HTML content for plain next link */
    this.plain_next = 'Next Page';

    /** HTML content for plain previous link */
    this.plain_prev = 'Prev Page';

    /** HTML content for active next link */
    this.link_next = '<a href="javascript:void(0);">Next Page</a>';

    /** HTML content for active previous link */
    this.link_prev = '<a href="javascript:void(0);">Prev Page</a>';

    /**
     * @private
     * @return boolean true if there's more 'next' page.
     *                 false if there's no more 'next' page.
     */
    this.nextok = function() {
        if (2 > this.all) {
            return false;
        }
        if (this.current == this.all) {
            return false;
        }
        return true;
    };

    /**
     * @private
     * @return boolean true if there's more 'previous' page.
     *                 false if there's no more 'previous' page.
     */
    this.prevok = function() {
        if (2 > this.all) {
            return false;
        }
        if (1 == this.current) {
            return false;
        }
        return true;
    };

    /**
     * increment page and update this.current member.
     *
     * @private
     * @return integer updated page position.
     */
    this.calcnext = function() {
        var cur = this.current;
        cur++;
        if (cur <= this.all) {
            this.current = cur;
        }
        return cur;
    };

    /**
     * decrement page and update this.current member.
     *
     * @private
     * @return integer updated page position.
     */
    this.calcprev = function() {
        var cur = this.current;
        cur--;
        if (1 <= cur) {
            this.current = cur;
        }
        return cur;
    };

    /**
     * toggle page blocks visibility
     *
     * @private
     * @param integer old page num (set to invisible)
     * @param integer new page num (set to visible)
     */
    this.toggle_pageblock = function(oldnum, newnum) {
        var id = null;
        if (oldnum == newnum) {
            return;
        }
        $('#' + this.id_pageno_cur).text(newnum);
        $('#' + this.id_eachpage + oldnum).hide();
        $('#' + this.id_eachpage + newnum).show();
    };

    /**
     * 'Previous' link click event handler
     *
     * @private
     */
    this.clickprev = function() {
        this.toggle_pageblock(this.current, this.calcprev());
        this.update_navilinks();
    };

    /**
     * 'Next' link click event handler
     *
     * @private
     */
    this.clicknext = function() {
        this.toggle_pageblock(this.current, this.calcnext());
        this.update_navilinks();
    };

    /**
     * initialize and update 'Previous'/'Next' link.
     */
    this.update_navilinks = function() {

        var curr_id = this.id;
        var obj_prev = $('#' + this.id_prev);
        var obj_next = $('#' + this.id_next);

        if (this.all < 2) {
            // only one page is.
            obj_prev.html(this.plain_prev);
            obj_next.html(this.plain_next);
            return;
        }

        if (this.prevok()) {
            obj_prev.html(this.link_prev);
            $('#' + this.id_prev + ' a').click(function(event){
                JsPrevNextPager(curr_id).clickprev();
                event.preventDefault();
            });
        } else {
            obj_prev.html(this.plain_prev);
        }

        if (this.nextok()) {
            obj_next.html(this.link_next);
            $('#' + this.id_next + ' a').click(function(event){
                JsPrevNextPager(curr_id).clicknext();
                event.preventDefault();
            });
        } else {
            obj_next.html(this.plain_next);
        }

    };
}
