function startRightClick(apply_target) {
    if(!apply_target) return;
    (function($){
        try {
        switch(apply_target) {
            case 'btn':
                $('button').noContext();
                $('.button').noContext();
                $('.buttonOfficial').noContext();
                break;
            case 'img_btn':
                $('img').noContext();
                $('button').noContext();
                $('.button').noContext();
                $('.buttonOfficial').noContext();
                break;
            case "img_btn_link":
                $('img').noContext();
                $('button').noContext();
                $('.button').noContext();
                $('.buttonOfficial').noContext();
                $('a').noContext();
                break;
            case 'document':
                $(document).noContext();
                $('#Right-Click').noContext();
                break;
            default:
                $(apply_target).noContext();
                break;
        }
        } catch(e){}
    })(jQuery);
    setTimeout("startRightClick('"+apply_target+"')",500);
}