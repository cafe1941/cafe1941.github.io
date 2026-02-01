/**
 * @file   modules/bodex/js/bodex.js
 * @author phiDel (FOXB.KR)
 **/

function completeDocumentInserted(ret) {
    var err = ret['error'];
    var msg = ret['message'];
    var mid = ret['mid'];
    var doc_srl = ret['document_srl'];
    var cat_srl = ret['category_srl'];

    var url;
    if(!doc_srl)
    { url = current_url.setQuery('mid',mid).setQuery('act',''); }
    else
    { url = current_url.setQuery('mid',mid).setQuery('document_srl',doc_srl).setQuery('act',''); }
    if(cat_srl) url = url.setQuery('category',cat_srl);
    location.href = url;
}

function completeDeleteDocument(ret) {
    var err = ret['error'];
    var msg = ret['message'];
    var mid = ret['mid'];
    var page = ret['page'];

    var url = current_url.setQuery('mid',mid).setQuery('act','').setQuery('document_srl','');
    if(page) url = url.setQuery('page',page);

    location.href = url;
}

function completeSearch(ret, prm, frm){
    var url = current_url;
    if(frm.vid) url = url.setQuery('vid',frm.vid);
    if(frm.mid) url = url.setQuery('mid',frm.mid);
    if(frm.category) url = url.setQuery('category',frm.category);
    if(frm.search_target) url = url.setQuery('search_target',frm.search_target);
    if(frm.search_keyword) url = url.setQuery('search_keyword',frm.search_keyword);

    location.href = url;
}

function completeVote(ret) {
    var err = ret['error'];
    var msg = ret['message'];
    alert(msg);
    location.href = location.href;
}

function completeReload(ret) {
    var err = ret['error'];
    var msg = ret['message'];

    location.href = location.href;
}

function completeInsertComment(ret) {
    var err = ret['error'];
    var msg = ret['message'];
    var mid = ret['mid'];
    var doc_srl = ret['document_srl'];
    var com_srl = ret['comment_srl'];

    if(current_url.getQuery('is_poped') && opener){
        opener.location.reload();
        location.reload();
    }else{
        if(com_srl!=current_url.getQuery('rnd')){
            var url = current_url.setQuery('mid',mid).setQuery('document_srl',doc_srl).setQuery('act','');
            if(com_srl) url = url.setQuery('rnd',com_srl)+"#comment_"+com_srl;
            location.href = url;
        }else location.reload();
    }
}

function completeDeleteComment(ret) {
    var err = ret['error'];
    var msg = ret['message'];
    var mid = ret['mid'];
    var doc_srl = ret['document_srl'];
    var par_srl  = ret['parent_srl'];
    var page = ret['page'];

    if(current_url.getQuery('is_poped') && opener){
        opener.location.reload();
        location.reload();
    }else{
        if(current_url.getQuery('act')){
            var url = current_url.setQuery('mid',mid).setQuery('document_srl',doc_srl).setQuery('act','');
            if(page) url = url.setQuery('page',page);
            if(par_srl>0)
                url = url.setQuery('rnd',par_srl)+"#comment_"+par_srl;
            else
                url = url+"#comment";
            location.href = url;
        }else location.reload();
    }
}

function completeDeleteTrackback(ret) {
    var err = ret['error'];
    var msg = ret['message'];
    var mid = ret['mid'];
    var doc_srl = ret['document_srl'];
    var page = ret['page'];

    var url = current_url.setQuery('mid',mid).setQuery('document_srl',doc_srl).setQuery('act','');
    if(page) url = url.setQuery('page',page);

    location.href = url;
}

function completeInsertFileLink(ret, prm, frm) {
    var err = ret['error'];
    var msg = ret['message'];
    var editor_sequence_srl = ret['editor_sequence_srl'];
    if(err!=='0'){
        alert(msg);
        return false;
    }
    jQuery('input[name=filelink_url]').val('');
    var settings = uploaderSettings[editor_sequence_srl?editor_sequence_srl:'1'];
    reloadFileList(settings);
}

function doChangeCategory() {
    var cat_srl = jQuery('#board_category option:selected').val();
    location.href = decodeURI(current_url).setQuery('category',cat_srl);
}

function doScrap(doc_srl) {
    var prm = new Array();
    prm["document_srl"] = doc_srl;
    exec_xml("member","procMemberScrapDocument", prm, null);
}

function doDeleteHistory(his_srl) {
    if(confirm('Are you sure to delete the history?'))
        doCallModuleAction('bodex','procBoardHistoryDelete',his_srl);
}

function doCopyClipboard(txt)
{
    if (window.clipboardData)
    {
        window.clipboardData.setData("Text", txt);
        alert("The text is copied to your clipboard...");
    }
    else
    { prompt("press CTRL+C copy it to clipboard...",txt); }
    return false;
}

function doChangeDocumentsState(ste) {
    var doc_srls = new Array();
    jQuery('input[name=cart]:checked').each(function() {
        doc_srls[doc_srls.length] = jQuery(this).val();
    });

    if(doc_srls.length<1) {
        alert('Not selected documents');
        return false;
    }

    doChangeDocumentState(doc_srls.join(','), ste);
}

function doChangeDocumentState(doc_srls, ste) {
    if(!ste && ste!==0){
        alert('Not selected state');
        return false;
    }

    var prm = new Array();
    prm['cur_mid'] = current_url.getQuery('mid');
    prm['target_srls'] = doc_srls;
    prm['state_value'] = ste;
    // 문서 보기 인지 체크
    prm['document_srl'] = current_url.getQuery('document_srl');
    exec_xml('bodex', 'procBoardChangeState', prm, completeCallModuleAction);
}

function doDocumentRating(point, doc_srl) {
    var prm = new Array();
    prm['cur_mid'] = current_url.getQuery('mid');
    prm['point'] = point;
    prm['target_srl'] = doc_srl?doc_srl:current_url.getQuery('document_srl');
    exec_xml('bodex', 'procBoardVoteRegister', prm, completeCallModuleAction);
}

function popupCommentList(doc_srl) {
    var mid = current_url.getQuery('mid');
    popopen(request_uri+"?module=bodex&mid="+mid+"&is_poped=1&act=dispBoardContentCommentList&document_srl="+doc_srl, 'popCommentList');
}

function popupDisplayMedia(file_srl, sid) {
    if(!file_srl || !sid) return false;

    var mid = current_url.getQuery('mid');
    popopen(request_uri+"?module=bodex&mid="+mid+"&act=dispBoardMediaPlayer&is_poped=1&file_srl="+file_srl+"&sid="+sid, 'popDisplayMedia');
}

function popupTagList(mid) {
    if(!mid) mid = current_url.getQuery('mid');
    popopen(request_uri+"?module=bodex&mid="+mid+"&act=dispBoardTagList&list_count=200&is_poped=1", 'popTagList');
}

function setSelectTag(tag) {
    if(!opener || !tag) {
        window.close();
        return;
    }
    var _obj = opener.document.getElementsByName('tags');
    if(!_obj[0]) {
        alert('Input element not found. (need element "tags")');
        return;
    }
    var len = _obj[0].value.length;
    if(len>0 && (_obj[0].value.substr((len-1),1) != ',')) _obj[0].value += ',';
    _obj[0].value += tag;
}
