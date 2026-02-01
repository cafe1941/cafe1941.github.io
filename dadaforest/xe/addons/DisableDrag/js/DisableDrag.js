function startDisableDrag(apply_target) {
    if(!apply_target) return;
    (function($){
        switch(apply_target) {
            case 'btn':
                $('button').disableTextSelect();
                $('.button').disableTextSelect();
                $('.buttonOfficial').disableTextSelect();
                break;
            case 'img_btn':
                $('img').disableTextSelect();
                $('button').disableTextSelect();
                $('.button').disableTextSelect();
                $('.buttonOfficial').disableTextSelect();
                break;
            case 'img_btn_link':
                $('img').disableTextSelect();
                $('button').disableTextSelect();
                $('.button').disableTextSelect();
                $('.buttonOfficial').disableTextSelect();
                $('a').disableTextSelect();
                break;
            case 'document':
                $(document).disableTextSelect();
                break;
            default:
                $(apply_target).disableTextSelect();
                break;
        }
        $('.selectable-area').enableTextSelect();
    })(jQuery);
}