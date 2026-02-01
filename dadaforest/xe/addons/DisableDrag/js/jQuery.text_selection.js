/**
 * Enables/Disables text select
 *
 * @example jQuery('body').disableTextSelect(); / jQuery('.selectable-area').enableTextSelect();
 * @cat plugin
 * @type jQuery
 *
 */
(function($){
    $.fn.enableTextSelect = function() {
        this.each(function() {
            $(this).css({
              'MozUserSelect' : 'all'
            }).bind('selectstart', function() {
                return true;
            }).mousedown(function() {
                return true;
            });
        });
    };
    $.fn.disableTextSelect = function() {
        this.each(function() {
            // Exception Tags
            var exceptionTags = new Array('SELECT', 'OPTION', 'INPUT', 'TEXTAREA', 'BUTTON');
            $(this).css('MozUserSelect', 'none').bind('selectstart',
                function(e) {
                    var tagName = e.target.tagName;
                    if($.inArray(tagName, exceptionTags) >= 0) return true;
                    return false;
                }).mousedown(function(e) {
                    var tagName = e.target.tagName;
                    if($.inArray(tagName, exceptionTags) >= 0) return true;
                    return false;
                });
        });
    };
})(jQuery);