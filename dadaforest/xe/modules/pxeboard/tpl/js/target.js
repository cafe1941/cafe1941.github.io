/**
 * vi:set ts=4 sw=4 expandtab enc=utf8: 
 **/

// 위젯의 대상 모듈 입력기 (단일 선택)
function insertSelectedModule(id, module_srl, mid, browser_title) {
    var obj= xGetElementById('_'+id);
    var sObj = xGetElementById(id);
    sObj.value = module_srl;
    obj.value = browser_title+' ('+mid+')';

}

// 위젯의 대상 모듈 입력기 (다중 선택)
function insertSelectedModules(id, module_srl, mid, browser_title) {
    var sel_obj = xGetElementById('_'+id);
    for(var i=0;i<sel_obj.options.length;i++) if(sel_obj.options[i].value==module_srl) return;
    var opt = new Option(browser_title+' ('+mid+')', module_srl, false, false);
    sel_obj.options[sel_obj.options.length] = opt;
    if(sel_obj.options.length>8) sel_obj.size = sel_obj.options.length;

    syncMid(id);
}

function syncMid(id) {
    var sel_obj = xGetElementById('_'+id);
    var valueArray = new Array();
    for(var i=0;i<sel_obj.options.length;i++) valueArray[valueArray.length] = sel_obj.options[i].value;
    xGetElementById(id).value = valueArray.join(',');
}

function completeImportBoard(ret_obj) {
    alert(ret_obj['message']);
    opener.location.href = opener.current_url;
    window.close();
}

function completeExportBoard(ret_obj) {
    alert(ret_obj['message']);
    opener.location.href = opener.current_url;
    window.close();
}

function getBoardSkins(obj) {
    var module_name = obj.options[obj.selectedIndex].value;
    var params = new Array();
    params["module_name"] = module_name;

    var response_tags = new Array("error","message","skin_list");
    exec_xml("module", "getPxeboardAdminBoardSkins", params, completeGetBoardSkins, response_tags);
}

function completeGetBoardSkins(ret_obj, response_tags) {
    var skin_list = ret_obj['skin_list'];
    if(!skin_list) return;

    var item = skin_list.item;
    if (typeof(item.length) == 'undefined' || item.length < 1) item = new Array(item);

    var list_obj = xGetElementById('target_skin');
    list_obj.length = 0;
    for (var i=0; i < item.length; i++) {
        list_obj.options[list_obj.length] = new Option(item[i].title, item[i].skin, false, false);
    }
}

