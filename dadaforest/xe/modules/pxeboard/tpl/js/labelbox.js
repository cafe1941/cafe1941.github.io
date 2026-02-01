/**
 * derived from xe labelbox.js
 **/
;(function($) {

    var defaults = {
    };

    var labelbox = {
        selected : null,
        /**
         * 라벨 박스 창 팝업
         */
        open : function(input_obj, filter) {
            this.selected = input_obj;

            var url = request_uri
                .setQuery('module', 'module')
                .setQuery('act', 'dispPxeboardLabelBox')
                .setQuery('input', this.selected.name)
                .setQuery('filter', filter);

            popopen(url, 'labelbox');
        },

        /**
         * 라벨 선택
         */
        selectFile : function(file_url, pxeboard_labelbox_srl){
            var target = $(opener.XE.labelbox.selected);
            var target_name = target.attr('name');

            target.val(file_url);
            var html = _displayMultimedia(file_url);
            $('#labelbox_preview_' + target_name, opener.document).html(html).show();
            $('#labelbox_cancel_' + target_name, opener.document).show();

            window.close();
        },

        /**
         * 라벨 선택 취소
         */
        cancel : function(name) {
            $('[name=' + name + ']').val('');
            $('[name=cancel_' + name + ']').val('Y');
            $('#labelbox_preview_' + name).hide().html('');
            $('#labelbox_cancel_' + name).hide();
        },

        /**
         * 라벨 삭제
         */
        deleteFile : function(pxeboard_labelbox_srl){
            var params = {
                'pxeboard_labelbox_srl' : pxeboard_labelbox_srl
            };

            $.exec_json('module.procPxeboardLabelBoxDelete', params, function() { document.location.reload(); });
        },

        /**
         * 초기화
         */
        init : function(name) {
            /*
            var file;

            if(opener && opener.selectedWidget && opener.selectedWidget.getAttribute("widget")) {
                file = opener.selectedWidget.getAttribute(name);
            } else if($('[name=' + name + ']').val()) {
                file = $('[name=' + name + ']').val();
            }

            if(file) {
                var html = _displayMultimedia(file, '100%', '100%');
                $('#labelbox_preview_' + name).html(html).show();
                $('#labelbox_cancel_' + name).show();
            }
            */
        }
    };

    // XE에 담기
    $.extend(window.XE, {'labelbox' : labelbox});

}) (jQuery);
