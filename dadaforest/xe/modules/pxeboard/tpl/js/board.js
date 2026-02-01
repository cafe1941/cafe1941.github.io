/**
 * vi:set ts=4 sw=4 expandtab enc=utf8:
 * @file   modules/board/js/board.js
 * @author zero (zero@nzeo.com)
 * @brief  board 모듈의 javascript
 **/

/* 글쓰기 작성후 */
function completeDocumentInserted(ret_obj, response_tags, callback_func_args, fo_obj) {

    var error = ret_obj['error'];
    var message = ret_obj['message'];
    var mid = ret_obj['mid'];
    var document_srl = ret_obj['document_srl'];
    var category_srl = ret_obj['category_srl'];

    if (document_srl) {
        fo_obj.document_srl.value = document_srl;
        if (fo_obj.category_srl != undefined)
            fo_obj.category_srl.value = '';
    } else {
        fo_obj.document_srl.value = '';
        if (category_srl)
            fo_obj.category_srl.value = category_srl;
    }

    fo_obj.act.value = 'procBoardAttachFile';
    fo_obj.submit();
}

/* 글 삭제 */
function completeDeleteDocument(ret_obj) {
    var error = ret_obj['error'];
    var message = ret_obj['message'];
    var mid = ret_obj['mid'];
    var page = ret_obj['page'];

    var url = current_url.setQuery('mid',mid).setQuery('act','').setQuery('document_srl','');
    if(page) url = url.setQuery('page',page);

    //alert(message);

    location.href = url;
}

/* 검색 실행 */
function completeSearch(ret_obj, response_tags, params, fo_obj) {
    fo_obj.submit();
}

function completeVote(ret_obj) {
    var error = ret_obj['error'];
    var message = ret_obj['message'];
    alert(message);
    location.href = location.href;
}

// 현재 페이지 reload
function completeReload(ret_obj) {
    var error = ret_obj['error'];
    var message = ret_obj['message'];

    location.href = location.href;
}

/* 댓글 글쓰기 작성후 */
function completeInsertComment(ret_obj) {
    var error = ret_obj['error'];
    var message = ret_obj['message'];
    var mid = ret_obj['mid'];
    var document_srl = ret_obj['document_srl'];
    var comment_srl = ret_obj['comment_srl'];

    var url = current_url.setQuery('mid',mid).setQuery('document_srl',document_srl).setQuery('act','');
    if(comment_srl) url = url.setQuery('rnd',comment_srl)+"#comment_"+comment_srl;

    //alert(message);

    location.href = url;
}

/* 댓글 삭제 */
function completeDeleteComment(ret_obj) {
    var error = ret_obj['error'];
    var message = ret_obj['message'];
    var mid = ret_obj['mid'];
    var document_srl = ret_obj['document_srl'];
    var page = ret_obj['page'];

    var url = current_url.setQuery('mid',mid).setQuery('document_srl',document_srl).setQuery('act','');
    if(page) url = url.setQuery('page',page);

    //alert(message);

    location.href = url;
}

/* 트랙백 삭제 */
function completeDeleteTrackback(ret_obj) {
    var error = ret_obj['error'];
    var message = ret_obj['message'];
    var mid = ret_obj['mid'];
    var document_srl = ret_obj['document_srl'];
    var page = ret_obj['page'];

    var url = current_url.setQuery('mid',mid).setQuery('document_srl',document_srl).setQuery('act','');
    if(page) url = url.setQuery('page',page);

    //alert(message);

    location.href = url;
}

/* 카테고리 이동 */
function doChangeCategory() {
    var url = decodeURI(current_url);
    var mid = jQuery('input[name=mid]', '#fo_dummy').val();
    if (mid) url = url.setQuery('mid',mid);
    var category_srl = jQuery('#board_category option:selected').val();
    location.href = url.setQuery('category',category_srl).setQuery('document_srl','');
}

/* 스크랩 */
function doScrap(document_srl) {
    var params = new Array();
    params["document_srl"] = document_srl;
    exec_xml("member","procMemberScrapDocument", params, null);
}
