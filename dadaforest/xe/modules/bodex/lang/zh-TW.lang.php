<?php
    /**
     * @file   zh-TW.lang.php
     * @author phidel (phidel@foxb.kr)
     * @brief  留言板 EX (bodex) 模塊繁體中文語言包 by DuRi
     **/
    $lang->cmd_bodex_content = '초기 페이지';
    $lang->cmd_Insert_bodex = '게시판 생성';
    $lang->new_declared = '최근 신고된 문서';
    $lang->declared_count = '신고된 횟수';
    $lang->about_bodex = '게시판을 생성하고 관리할 수 있는 모듈입니다. 세부 옵션 수정은 게시판 목록에서 해당 게시판의 설정 버튼을 눌러 주세요.';
    $lang->write_comment = '댓글 쓰기';
    $lang->msg_not_allow_mobile ='모바일 기기에선 허용하지 않는 기능입니다.';

    $lang->new_document = '최근 문서';
    $lang->new_comment = '최근 댓글';
    $lang->new_download_log = '최근 다운로드 (포인트 사용 방식이 다운로드이면 기록됩니다)';

    $lang->use_load_extra_vars = '확장 변수 읽기';
    $lang->about_load_extra_vars = '문서의 일반 쿼리시 확장 변수도 같이 읽어들입니다.<br />게시판 EX 에선 필요할때 따로 가져오기 때문에 사용 안함으로 설정시 사이트의 과부하를 조금 줄일수있습니다.';

    $lang->date_range = '日期范圍';
    $lang->best_document = '最優秀的文章';
    $lang->best_comment = '最優秀的貼子';
    $lang->about_best_document = '把被選的稿子顯示到上框供眾人閱讀. (用以推薦數固定鐵子的排列對象)';
    $lang->about_use_anonymous_phase = '使用匿名時可按需設定保安級別.<br /><br />1. 會員信息以最低的級別供管理這審閱. (在咨詢留言板也可看到)<br />2. 以基本級別可隱藏所有信息但管理者可通過分析數據庫查出信息.<br />3. 最高級別則任何人都沒發了解會員信息發稿者推出網頁后不可修改或刪除自己的文稿.';

    $lang->bodex = '留言板 EX';
    $lang->list_target_item = '備選項目';
    $lang->list_display_item = '顯示項目';
    $lang->list_sort_item = '使用分類';
    $lang->search_display_item = '搜索項目';
    $lang->visitor = '訪問者';
    $lang->count = '個數';
    $lang->sort = '排列';
    $lang->option = '選項';
    $lang->etcetera = '其它';
    $lang->previous = '上一個';
    $lang->next = '下一個';

    $lang->always = '每次';
    $lang->first = '首次';
    $lang->cancel = '取消';
    $lang->my_point = '我的積分';
    $lang->anonymous = '匿名';
    $lang->restore = '復原';
    $lang->admin = '管理者';
    $lang->rating = '評價';
    $lang->registrant = '注冊人';
    $lang->user = '使用者';
    $lang->image = '圖像';
    $lang->media = '多媒體';
    $lang->filelink_url = '文檔連接地址';
    $lang->display = '輸出';
    $lang->adopted = '采納';
    $lang->not_adopted = '未采納';

    $lang->file_last_update= '最新更新';
    $lang->file_total_download= '全部下載';

    $lang->point_configs = '點數設置';
    $lang->point_insert_document = '發表主題';
    $lang->point_insert_comment = '發表評論';
    $lang->point_read_document = '檢視主題';
    $lang->point_upload_file = '上傳檔案';
    $lang->point_download_file = '下載檔案 (圖片除外)';

    // 목록항목
    $lang->reward_point = '積分';
    $lang->blamed_count = '非推薦次數';
    $lang->trackback_count = '引用次數';
    $lang->uploaded_count = '上載次數';
    $lang->vote_point = '推薦(星積分)';
    $lang->voted_people = '投票';
    $lang->summary = '摘要';
    $lang->thumbnail = '縮圖';
    $lang->doc_state = '狀況';
    $lang->last_updater = '最近貼子';
    $lang->random = '隨機';

    // 항목
    $lang->search_result = '搜索結果';

    $lang->except_notice = '公告除外';
    $lang->consultation = '咨詢功能';
    $lang->thisissecret = '這是一個隱藏文.';
    $lang->admin_mail = '管理者的郵件';
    $lang->auto_reply = '自動發貼';
    $lang->anonymous_phase = '匿名級別';
    $lang->notify_message_type = '提示方法';

    $lang->use_doc_state ='狀態功能';
    $lang->use_doc_state_default_value = '待審,審閱,已完成,保留';

    $lang->use_category_none = '不使用';
    $lang->use_category_comb = '選擇框';
    $lang->use_category_tab = '標簽頁';
    $lang->use_category_left = '左菜單';
    $lang->use_category_right = '右菜單';

    $lang->use_vote = '使用推薦';
    $lang->use_vote_none = '不使用';
    $lang->use_vote_yes = '推薦:選擇使用';
    $lang->use_vote_require = '推薦:必須使用';
    $lang->use_vote_star = '星積分:選擇使用';
    $lang->use_vote_star_require = '星積分:必須使用';

    $lang->use_vote_empty = '允許可以修正或刪除推薦/非推薦點數';
    $lang->use_vote_bonus = '受到推薦或非推薦時將獲得點數相應的積分獎勵 (星積分, 推薦點數 * 星點數)';
    $lang->use_vote_not_checkip = '推薦/非推薦時無需進行IP確認(如同實際網絡使用在相同的IP的環境)';

    $lang->use_reward = '使用積分';
    $lang->use_reward_none = '不使用';
    $lang->use_reward_yes = '選擇使用';
    $lang->use_reward_require = '必須使用';
    $lang->use_reward_down = '下載';

    $lang->use_secret = '密碼功能';
    $lang->use_secret_none = '不使用';
    $lang->use_secret_yes = '始終使用';
    $lang->use_secret_require = '選擇使用';

    $lang->use_anonymous = '使用匿名';
    $lang->use_anonymous_none = $lang->use_secret_none;
    $lang->use_anonymous_yes = $lang->use_secret_yes;
    $lang->use_anonymous_require = $lang->use_secret_require;

    $lang->use_down_point_images = '圖像文件也實行積分制';
    $lang->use_down_point_medias = '以多媒體文檔應用積分';
    $lang->use_down_point_always = '每次應用于不同文件類別';
    $lang->use_down_point_one = '僅限于1件文檔資料';

    $lang->use_allow = '允許';
    $lang->use_allow_none = '不允許';
    $lang->use_allow_require = '始終允許';
    $lang->use_allow_yes = '選擇使用';

    $lang->display_extra_images = '顯示圖標';
    $lang->about_display_extra_images = '你可以指定項目題目旁產出的圖標.';
    $lang->use_extra_image_new = '新的文字';
    $lang->use_extra_image_update = '更新';
    $lang->use_extra_image_secret = '隱藏文';
    $lang->use_extra_image_image = '圖表';
    $lang->use_extra_image_movie = '影響';
    $lang->use_extra_image_file = '文檔';

    // 버튼에 사용되는 언어
    $lang->cmd_reward = '積分投注';
    $lang->cmd_adopt_comment = '采納答辯';
    $lang->cmd_search_not_adopt_post = '找出未被采納貼子';
    $lang->cmd_bodex_list = '留言板目錄';
    $lang->cmd_view_info = '留言板信息';
    $lang->cmd_list_setting = '設置目錄';
    $lang->cmd_search_setting = '設定搜索';
    $lang->cmd_vote_empty = '推薦初始化';
    $lang->cmd_change_state = '狀態變更';
    $lang->cmd_get_tags = '求一個標記列表';
    $lang->cmd_recount_voted = '更新推薦次數';
    $lang->cmd_adopted_comment = '被采納答辯';
    $lang->cmd_adopted_comment_view = '被采納答辯 檢視';
    $lang->cmd_history_all = '過去文書記錄';
    $lang->cmd_view_filelist = '查看附件文檔目錄';
    $lang->cmd_file_link = '附加外部文檔';

    $lang->send_notify = '發送條子';
    $lang->send_mail = '發送郵件';

    // 메세지에 사용되는 언어
    $lang->success_adopt = '已被采納.';

    $lang->confirm_recount_voted = "消耗的時間取決于數據量.\n要繼續推薦次數的更新嗎?";

    $lang->msg_alert = '告知!';
    $lang->msg_apply_with = '包括%s';
    $lang->msg_not_skin_info = "無法讀取皮膚信息.\n請確認留言板信息皮膚選擇項";
    $lang->msg_please_login ='請登入.';
    $lang->msg_please_use = '請用%s.';
    $lang->msg_acted_current_document = '該文檔資料已%s了.';
    $lang->msg_act_not_permitted = '你沒有權力%s.';
    $lang->msg_reward_point_adopt = '采納答辯時積分獎勵%s';
    $lang->msg_reward_point_download = '下載,使用積分%s';
    $lang->msg_writer_same_user = '與發貼者是同一個人.';
    $lang->msg_not_enough_point = '積分不夠.';
    $lang->msg_reward_please_adopt = "已有三個以上未被采納的貼子.\n請須先選擇.";
    $lang->msg_invalid_upload_format = '不能下載的文檔格式.';
    $lang->msg_please_select_rating = '請選擇分數.';

    // 주절 주절..
    $lang->about_except_notice = '在一般的列表上不讓顯示列表的頂部經常出現的公告顯示.';
    $lang->about_use_anonymous = '刪除發貼者的個人信息,可以用匿名發貼.';
    $lang->about_consultation = '咨詢功能即沒有管理權限的會員只允許查看自己的發稿的功能.<br />只限會員可以發稿對使用匿名者保安級別調整到一級.';
    $lang->about_secret = '留言板可以使用隱藏貼子. 必要時可以自動轉化成隱藏格式.';
    $lang->about_admin_mail = '貼子被注冊,則按注冊的郵箱地址發送郵件.<br />,以(豆號)連接時可同時發送多個郵箱地址. (如果同一個發件人和收件人被排除在外.)';
    $lang->about_list_config = '當使板的列表格式時,可以按需設置其項目. (備選項目/ 重復點擊顯示項目就會被添加或刪除)';
    $lang->about_use_category = '風格選擇框可以指定標簽頁,左菜單中,右菜單.';
    $lang->about_use_vote = '可以指定推薦方法.  (非會員除外)<br /><br /><span style="color:red">更新推薦數</span>:當推薦形態改變時要以按現行形態數更新.<br />* 주의 * 추천 수 새로 갱신은 디비의 값을 직접 수정하는 것이므로 안전을 위해서 백업후 실행 하세요.';
    $lang->about_use_reward_alert = '注意：其他設置點值將結合使用.';
    $lang->about_use_reward = '如果用積分投注選擇答辯,則會員和發貼者各得50%.<br />如果答辯之后仍有三個以上未被采納的貼子就會受到限制發貼. (采納時被解除.)<br /><br />下載附件的會員給發貼者支付50%的積分.';
    $lang->about_use_doc_state = '顯示該文件的設置狀態. (如果目錄列表上查看當前狀態請使用設置目錄列表狀.)';
    $lang->about_search_setting = '留言板搜索可以設定所需項目. (擴張變數的搜索選擇搜索項目才能看到)';
    $lang->about_use_doc_state_value = '可以指定可使用狀態值的目錄. (HTML 可使用標簽)<br />同時多數的注冊以豆號區分. (提供最多可使用10個 ex:待審,審閱,已完成,保留)';
    $lang->about_use_reward_value = '可以指定可使用積分值的目錄.<br />首值盡量最低以便和我的積分比較使用. (ex: 10,30,50,100,300,500,1000)';
    $lang->about_auto_reply = '登載新的論壇自動輸入相應的貼子. (HTML 可使用標簽)';
    $lang->about_notify_message_type = '如果登載新貼子如有提示功能可指定提示方法.';
    $lang->about_module_text = '可指定相關留言板模塊上,下段輸出的內容.';
    $lang->about_file_link = '連接外部文檔地址登記文檔.';
    $lang->about_use_allow = '在留言板上可選擇是否允許貼子或引用通告.';
    $lang->about_category_list = '被設定限制使用所分類的文僅限于該群組.';
    $lang->about_extra_vars = '如果點擊搜索可通過搜索功能搜索.';
    $lang->about_order_target = '指定項目清單和默認的排序.<br />如果您選擇一個隨機就回始終隨機的輸出.';

    // 모바일
    $lang->mobile = '모바일';
    $lang->use_mobile = '모바일 뷰 사용';
    $lang->mobile_skin = '모바일 스킨';
    $lang->about_use_mobile = '스마트폰 등을 이용하여 접속할 때 모바일 화면에 최적화된 레이아웃을 이용하도록 합니다.';
    $lang->about_mobile_layout = '';
    $lang->about_mobile_skin = '';
?>
