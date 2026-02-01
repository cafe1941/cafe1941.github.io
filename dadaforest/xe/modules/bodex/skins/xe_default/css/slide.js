
// 썸네일 바꾸기
function _exSkinResizeThumb(){
    var frame = jQuery('.xeSkinThumbnailFrame');
    if(!frame) return false;

    var img = jQuery('img.xeSkinThumbnailImage', frame);
    if(!img) return false;

    var _type = jQuery('.xeSkinThumbControl').attr('rel');

    var _iw = img.width();
    var _ih = img.height();
    var _wp = frame.innerWidth() - (img.outerWidth(true) - img.innerWidth()) - 4;
    var _hp = frame.innerHeight() - (img.outerHeight(true) - img.innerHeight()) - 4;

    //작다면 패스
    if(_iw<=_wp && _ih<=_hp) return;

    if (_iw<=_ih || _type == 'ratio'){
        if(_iw<=_wp) return;
        img.width(_wp);
    }else{
        if(_ih<=_hp) return;
        img.height(_hp);
    }
}
function _xeSkinChangeThumbnail(md){
    var imgbox = jQuery('.exSkinImageListBox');
    if(!imgbox.get(0)){
        var imgbox = jQuery('.exSkinThumbListBox');
        if(!imgbox.get(0)) return false;
    }

    var img = jQuery('img.xeSkinThumbnailImage');
    if(!img.get(0)) return false;

    var _index = img.attr('rel');

    if(_index==='0' && md != 'next')
        _index = img.attr('rev');

    var _regNum = /^[0-9]*$/;
    if(!_regNum.test(_index)) return false;

    if(md=='next') _index++; else _index--;

    var src = jQuery('a.exSkinImageSrc[rel='+_index+']',imgbox).attr('href');
    if(!src){
        if(md=='next') _index = 0; else _index = img.attr('rev')-1;
        src = jQuery('a.exSkinImageSrc[rel='+_index+']',imgbox).attr('href');
    }
    if(src){
        img.load(_exSkinResizeThumb);
        img.removeAttr('width');
        img.removeAttr('height');
        img.css('width','');
        img.css('height','');
        img.attr('src',src);
        img.attr('rel',_index);
    }

    return false;
}

(function($) {

    var exScreen = null;

    // 슬라이드를 위한 블랙 스크린을 만들거나 반환하는 함수 (디자인 호환을 위해 addons/resize_image 함수를 사용)
    function getExScreen() {
        var body    = $(document.body);
        var controls, imgframe, closebtn, prevbtn, nextbtn;

        // 스크린이 없으면 스크린을 만든다.
        if (!exScreen) {
            // 검은 스크린
            exScreen = $("<div>")
                .attr("id","ex_gallery_screen")
                .css({
                    position:"absolute",
                    display:"none",
                    backgroundColor:"black",
                    zIndex:500,
                    opacity:0.5
                });

            // 이미지를 보여주고 컨트롤 버튼을 다룰 레이어
            controls = $("<div>")
                .attr("id","ex_gallery_controls")
                .css({
                    position:"absolute",
                    display:"none",
                    overflow:"hidden",
                    zIndex:510
                });

            // 닫기 버튼
            closebtn = $("<img>")
                .attr("id", "ex_gallery_closebtn")
                .attr("src", request_uri+"addons/resize_image/iconClose.png")
                .css({
                    top : "10px"
                })
                .click(function(){exScreen.xeHide()})
                .appendTo(controls);

            // 이전 버튼
            prevbtn = $("<img>")
                .attr("id", "ex_gallery_prevbtn")
                .attr("src", request_uri+"addons/resize_image/iconLeft.png")
                .css("left","10px")
                .click(function(){exScreen.xePrev()})
                .appendTo(controls);

            // 다음 버튼
            nextbtn = $("<img>")
                .attr("id", "ex_gallery_nextbtn")
                .attr("src", request_uri+"addons/resize_image/iconRight.png")
                .css("right","10px")
                .click(function(){exScreen.xeNext()})
                .appendTo(controls);

            // 버튼 공통 속성
            controls.find("img")
                .attr({
                    width  : 60,
                    height : 60,
                    className : "iePngFix"
                })
                .css({
                    position : "absolute",
                    width : "60px",
                    height : "60px",
                    zIndex : 530,
                    cursor : "pointer"
                });

            // 이미지 홀더
            imgframe = $("<img>")
                .attr("id", "ex_gallery_holder")
                .css("border", "7px solid white")
                .css("zIndex", 520)
                .appendTo(controls).draggable();

            body.append(exScreen).append(controls);

            // exScreen 객체를 확장한다.
            exScreen.xeShow = function() {
                var clientWidth  = $(window).width();
                var clientHeight = $(window).height();

                $("#ex_gallery_controls,#ex_gallery_screen").css({
                    display:"block",
                    width  : clientWidth + "px",
                    height : clientHeight + "px",
                    left   : $(document).scrollLeft(),
                    top    : $(document).scrollTop()
                });

                closebtn.css("left", Math.round((clientWidth-60)/2) + "px");

                $("#ex_gallery_prevbtn,#ex_gallery_nextbtn").css("top", Math.round( (clientHeight-60)/2 ) + "px");

                this.xeMove(0);
            };
            exScreen.reposition = function(event) {
                var clientWidth  = $(window).width();
                var clientHeight = $(window).height();

                imgframe.css({
                            left : Math.round( Math.max( (clientWidth-imgframe.width()-14)/2, 0 ) ) + "px",
                            top  : Math.round( Math.max( (clientHeight-imgframe.height()-14)/2, 0 ) ) + "px"
                        });
                imgframe.css("visibility","visible");
                 $("#waitingforserverresponse", document).css('visibility','hidden');
            };
            exScreen.xeHide = function(event) {
                exScreen.css("display","none");
                controls.css("display","none");
            };
            exScreen.xePrev = function() {
                this.xeMove(-1);
            };
            exScreen.xeNext = function() {
                this.xeMove(1);
            };
            exScreen.xeMove = function(val) {
                this.index += val;

                prevbtn.css("visibility", (this.index>0)?"visible":"hidden");
                nextbtn.css("visibility", (this.index<this.list.size()-1)?"visible":"hidden");

                //textyle 이미지 리사이즈 처리
                var src = this.list.eq(this.index).attr("href");

                $("#waitingforserverresponse").html(waiting_message).css({
                            left : $(document).scrollLeft()+20 + "px",
                            top  : $(document).scrollTop()+20 + "px"
                        }).css('visibility','visible');

                imgframe.css("visibility","hidden");
                imgframe.attr("src", src);
            };

            // 스크린을 닫는 상황
            $(document).scroll(exScreen.xeHide);
            $(document).keydown(exScreen.xeHide);
            $(window).resize(exScreen.xeHide);
            $(window).scroll(exScreen.xeHide);
            $(imgframe).load(exScreen.reposition);
        } else {
            controls = $("#ex_gallery_controls");
            imgframe = $("#ex_gallery_holder");
            closebtn = $("#ex_gallery_closebtn");
            prevbtn  = $("#ex_gallery_prevbtn");
            nextbtn  = $("#ex_gallery_nextbtn");
        }

        return exScreen;
    }

    $(function() {

        // 썸네일 크게 보기
        $('img.xeSkinThumbnailImage').click(function() {
            var imgbox = $('.exSkinImageListBox');
            if(!imgbox.get(0)){
                var imgbox = jQuery('.exSkinThumbListBox');
                if(!imgbox.get(0)) return false;
            }

            var imglist    = imgbox.find("a.exSkinImageSrc");
            var currentIdx = parseInt($(this).attr('rel'));
            var exScreen    = getExScreen();

            // 스크린을 보여주고
            exScreen.list  = imglist;
            exScreen.index = currentIdx;
            exScreen.xeShow();
        });

        // 썸네일 네비게이션 버튼
        $('.xeSkinThumbControl').each(function() {
            $(this).mouseover(function() {jQuery('.xeSkinThumbControl').show()});
            $(this).mouseout(function() {jQuery('.xeSkinThumbControl').hide()});
            var $frame = $('.xeSkinThumbnailFrame');
            $frame.mouseover(function() {jQuery('.xeSkinThumbControl').show()});
            $frame.mouseout(function() {jQuery('.xeSkinThumbControl').hide()});
            var $img = $('img.xeSkinThumbnailImage');
            $img.mouseover(function() {jQuery('.xeSkinThumbControl').show()});
            $img.mouseout(function() {jQuery('.xeSkinThumbControl').hide()});
        });

    });

})(jQuery);
