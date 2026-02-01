<?php
    /**
     * @file   ko.lang.php
     * @author phidel (phidel@foxb.kr)
     * @brief  게시판 EX (bodex) 모듈의 기본 언어팩
     **/

    $lang->bodex = '게시판 EX';

    $lang->new_document = '최근 문서';
    $lang->new_comment = '최근 댓글';
    $lang->new_declared = '최근 신고된 문서';
    $lang->declared_count = '신고된 횟수';
    $lang->new_download_log = '최근 다운로드 (포인트 사용 방식이 다운로드이면 기록됩니다)';

    $lang->search_display_item = '검색 항목';
    $lang->list_target_item = '대상 항목';
    $lang->list_display_item = '표시 항목';
    $lang->list_sort_item = '정렬 사용';
    $lang->visitor = '방문자';
    $lang->count = '갯수';
    $lang->sort = '정렬';
    $lang->option = '옵션';
    $lang->etcetera = '기타';
    $lang->previous = '이전';
    $lang->next = '다음';

    $lang->always = '매번';
    $lang->first = '처음';
    $lang->cancel = '취소';
    $lang->my_point = '내 포인트';
    $lang->anonymous = '익명';
    $lang->restore = '복원';
    $lang->admin = '관리자';
    $lang->rating = '평가';
    $lang->registrant = '등록자';
    $lang->user = '사용자';
    $lang->image = '이미지';
    $lang->media = '미디어';
    $lang->filelink_url = '파일 링크 주소';
    $lang->display = '출력';
    $lang->adopted = '채택';
    $lang->not_adopted = '미채택';
    $lang->date_range = '날짜범위';

    $lang->file_last_update= '최근 업데이트';
    $lang->file_total_download= '전체 다운로드';

    $lang->point_configs = '포인트 설정들';
    $lang->point_insert_document = '글 작성';
    $lang->point_insert_comment = '댓글 작성';
    $lang->point_read_document = '게시글 조회';
    $lang->point_upload_file = '파일 업로드';
    $lang->point_download_file = '파일 다운로드 (이미지 제외)';

    // 목록항목
    $lang->reward_point = '포인트';
    $lang->blamed_count = '비추천 수';
    $lang->trackback_count = '트랙백 수';
    $lang->uploaded_count = '업로드 수';
    $lang->vote_point = '추천(별점)';
    $lang->voted_people = '투표';
    $lang->summary = '요약';
    $lang->thumbnail = '썸네일';
    $lang->doc_state = '상태';
    $lang->last_updater = '최근 댓글';
    $lang->random = '랜덤';

    // 항목
    $lang->search_result = '검색결과';

    $lang->except_notice = '공지 제외';
    $lang->consultation = '상담 기능';
    $lang->thisissecret = '비밀글입니다.';
    $lang->admin_mail = '관리자 메일';
    $lang->auto_reply = '자동 댓글';
    $lang->anonymous_phase = '익명 단계';
    $lang->notify_message_type = '알림 방법';
    $lang->best_document = '베스트 문서';
    $lang->best_comment = '베스트 댓글';

    $lang->use_load_extra_vars = '확장 변수 읽기';

    $lang->use_doc_state ='상태 기능';
    $lang->use_doc_state_default_value = '대기,검토,완료,보류';

    $lang->use_category_none = '사용안함';
    $lang->use_category_comb = '콤보박스';
    $lang->use_category_tab = '탭페이지';
    $lang->use_category_left = '좌측메뉴';
    $lang->use_category_right = '우측메뉴';

    $lang->use_vote = '추천 사용';
    $lang->use_vote_none = '사용안함';
    $lang->use_vote_yes = '추천:선택사용';
    $lang->use_vote_require = '추천:필수사용';
    $lang->use_vote_star = '별점:선택사용';
    $lang->use_vote_star_require = '별점:필수사용';

    $lang->use_vote_bonus = '추천/비추천 받으면 위의 점수만큼 포인트 보너스 받기 (별점시, 추천점수 * 별점수)';
    $lang->use_vote_empty = '추천/비추천 점수를 삭제(초기화) 가능하도록 허용 하기';
    $lang->use_vote_not_checkip = '추천/비추천시 IP 체크를 하지 않기 (사설 네트워크 처럼 같은 IP를 사용해야하는 환경에 사용)';

    $lang->use_reward = '포인트 사용';
    $lang->use_reward_none = '사용안함';
    $lang->use_reward_yes = '선택사용';
    $lang->use_reward_require = '필수사용';
    $lang->use_reward_down = '다운로드';

    $lang->use_secret = '비밀글 기능';
    $lang->use_secret_none = '사용안함';
    $lang->use_secret_yes = '선택사용';
    $lang->use_secret_require = '항상사용';

    $lang->use_anonymous = '익명 사용';
    $lang->use_anonymous_none = $lang->use_secret_none;
    $lang->use_anonymous_yes = $lang->use_secret_yes;
    $lang->use_anonymous_require = $lang->use_secret_require;

    $lang->use_down_point_images = '이미지 파일에도 포인트 적용';
    $lang->use_down_point_medias = '미디어 파일에도 포인트 적용';
    $lang->use_down_point_always = '파일별로 매번 적용';
    $lang->use_down_point_one = '파일별로 1회 적용';

    $lang->use_allow = '허용';
    $lang->use_allow_none = '허용안함';
    $lang->use_allow_require = '항상허용';
    $lang->use_allow_yes = '선택사용';

    $lang->display_extra_images = '아이콘 표시';
    $lang->about_display_extra_images = '목록의 제목 옆에 출력되는 아이콘들을 지정할 수 있습니다.';
    $lang->use_extra_image_new = '새 글';
    $lang->use_extra_image_update = '업데이트';
    $lang->use_extra_image_secret = '비밀글';
    $lang->use_extra_image_image = '이미지';
    $lang->use_extra_image_movie = '동영상';
    $lang->use_extra_image_file = '파일';

    // 버튼에 사용되는 언어
    $lang->cmd_reward = '포인트 배팅';
    $lang->cmd_adopt_comment = '답변 채택';
    $lang->cmd_search_not_adopt_post = '미채택 글 찾기';
    $lang->cmd_bodex_content = '초기 페이지';
    $lang->cmd_bodex_list = '게시판 목록';
    $lang->cmd_Insert_bodex = '게시판 생성';
    $lang->cmd_view_info = '게시판 정보';
    $lang->cmd_list_setting = '목록 설정';
    $lang->cmd_search_setting = '검색 설정';
    $lang->cmd_vote_empty = '추천 초기화';
    $lang->cmd_change_state = '상태 변경';
    $lang->cmd_get_tags = '태그 목록 가져오기';
    $lang->cmd_recount_voted = '추천 수 새로 갱신';
    $lang->cmd_adopted_comment = '채택된 답변';
    $lang->cmd_adopted_comment_view = '채택된 답변 보기';
    $lang->cmd_history_all = '이전 문서 기록';
    $lang->cmd_view_filelist = '첨부된 파일 목록 보기';
    $lang->cmd_file_link = '외부 파일 첨부';

    $lang->send_notify = '쪽지 보내기';
    $lang->send_mail = '메일 보내기';

    $lang->write_comment = '댓글 쓰기';

    // 메세지에 사용되는 언어
    $lang->success_adopt = '채택 되었습니다.';

    $lang->confirm_recount_voted = "데이터량에 따라 다소 시간이 걸릴 수 있습니다.\n추천 수 갱신을 계속하시겠습니까?";

    $lang->msg_alert = '알림!';
    $lang->msg_apply_with = '%s도 포함';
    $lang->msg_not_skin_info = "스킨 정보를 읽어올 수 없습니다.\n게시판 정보의 스킨 선택을 확인해 주세요.";
    $lang->msg_please_login ='로그인 해주세요.';
    $lang->msg_please_use = '%s를(을) 사용해 주세요.';
    $lang->msg_acted_current_document = '이 문서에 %s 하셨습니다.';
    $lang->msg_act_not_permitted = '%s할 수 있는 권한이 없습니다.';
    $lang->msg_reward_point_adopt = '답변 채택시 %s 포인트 보상';
    $lang->msg_reward_point_download = '다운로드시 %s 포인트 사용';
    $lang->msg_writer_same_user = '글쓴이와 같은 사용자입니다.';
    $lang->msg_not_enough_point = '포인트가 부족합니다.';
    $lang->msg_reward_please_adopt = "미채택 글이 3개이상 존재합니다.\n먼저 채택을 해주세요.";
    $lang->msg_invalid_upload_format = '업로드 할 수 없는 파일 포멧입니다.';
    $lang->msg_please_select_rating = '점수를 선택해 주세요.';
    $lang->msg_not_allow_mobile ='모바일 기기에선 허용하지 않는 기능입니다.';

    // 주절 주절..
    $lang->about_except_notice = '목록 상단에 늘 나타나는 공지사항을 하단의 일반 목록에선 출력하지 않도록 제외시킵니다.';
    $lang->about_use_anonymous = '글쓴이의 정보를 없애고 익명으로 게시판 사용을 할 수 있게 합니다.';
    $lang->about_bodex = '게시판을 생성하고 관리할 수 있는 모듈입니다. 세부 옵션 수정은 게시판 목록에서 해당 게시판의 설정 버튼을 눌러 주세요.';
    $lang->about_consultation = '상담 기능은 관리 권한이 없는 회원은 자신이 쓴 글만 보이도록 하는 기능입니다.<br />회원만 글쓰기가 허용되며 익명 기능 사용시 보안 단계는 1단계로 조정됩니다.';
    $lang->about_secret = '게시판 및 댓글에 비밀글을 사용할 수 있도록 합니다. 필수일 경우 해당글은 자동으로 비밀글이 됩니다.';
    $lang->about_admin_mail = '글이나 댓글이 등록될때 메일주소로 메일이 발송됩니다.<br />,(콤마)로 연결시 다수의 메일주소로 발송할 수 있습니다. (보낸이와 받는이가 같을 경우엔 제외됩니다.)';
    $lang->about_search_setting = '게시판의 검색을 원하는 항목들을 설정할 수 있습니다. (확장변수 검색은 확장변수의 검색 항목을 선택하셔야 보입니다)';
    $lang->about_list_config = '게시판의 목록을 원하는 항목들로 배치를 할 수 있습니다. (항목을 더블 클릭하면 추가/제거가 됩니다)';
    $lang->about_use_category = '분류의 스타일을 콤보박스, 탭페이지, 좌측메뉴, 우측메뉴 형태로 지정할 수 있습니다.';
    $lang->about_use_vote = '추천을 하는 방법을 지정할 수 있습니다.  (단, 비회원은 투표에서 제외)<br /><br /><span style="color:red">추천 수 새로 갱신</span>: 추천 형태가 바뀌었을때 현 상태에 맞게 수를 갱신합니다.<br />* 주의 * 추천 수 새로 갱신은 디비의 값을 직접 수정하는 것이므로 안전을 위해서 백업후 실행 하세요.';
    $lang->about_use_reward_alert = '참고: 추가 설정의 포인트 값과 중복 적용됩니다.';
    $lang->about_use_reward_value = '사용할 수 있는 포인트 값의 목록을 지정할 수 있습니다. (ex: 10,30,50,100,300,500,1000)';
    $lang->about_use_reward = '포인트를 걸고 답변을 채택하면 채택된 멤버에게 50%, 글쓴이에게 다시 50%의 포인트가 돌아갑니다.<br />만약에 답변이 있음에도 채택을 안한 글이 3개 이상 존재시 글 작성이 제한됩니다. (단, 채택시 해제됩니다.)<br /><br />다운로드 형태는 첨부파일을 다운받는 맴버가 포인트 50%만큼 파일 소유자에게 지불합니다.';
    $lang->about_use_doc_state_value = '사용할 수 있는 상태 값의 목록을 지정할 수 있습니다. (HTML 태그 사용 가능)<br />복수 등록은 ,(콤마) 로 구분합니다. (최대 10개 사용 가능 ex: 대기,검토,완료,보류)';
    $lang->about_use_doc_state = '문서의 상태를 설정하고 보여줍니다. (목록에서  현재 상태를 보려면 목록설정에서 상태를 사용해주세요.)';
    $lang->about_auto_reply = '새로운 글이 등록되면 그 글에 자동으로 해당 내용의 댓글을 입력합니다. (HTML 태그 사용 가능)';
    $lang->about_notify_message_type = '새로운 글이나 댓글이 등록될때 상위 문서에 알림 기능이 있다면 알려줄 알림 방법을 지정할 수 있습니다.';
    $lang->about_module_text = '해당 게시판 모듈의 상, 하단에 출력될 내용을 지정할 수 있습니다.';
    $lang->about_file_link = '외부 파일의 주소를 연결하여 파일을 등록합니다.';
    $lang->about_use_allow = '게시판에 댓글 또는 엮인글을 허용할지 선택할 수 있습니다.';
    $lang->about_use_anonymous_phase = '익명 사용시 보안을 어느 정도로 할지 설정할 수 있습니다.<br /><br />1. 가장 낮은 단계로 관리자에겐 회원 정보가 보입니다. (상담 게시판에서도 보입니다)<br />2. 기본적인 단계로 모든 회원 정보를 감추지만 최고 관리자는 디비를 분석해 알수있는 방법이 있습니다.<br />3. 최고 단계로 회원 정보를 그 누구도 알수없고 로그아웃 후엔 글 작성자도 수정/삭제가 불가능합니다.';
    $lang->about_category_list = '그룹 제한을 사용한 분류의 글은 해당 그룹만 쓰기가 가능합니다.';
    $lang->about_extra_vars = '검색을 체크하시면 검색설정을 통해 검색이 가능해 집니다.';
    $lang->about_order_target = '목록의 기본 정렬 항목과 정렬 방식을 지정합니다.<br />랜덤을 선택하시면 항상 무작위로 출력합니다.';
    $lang->about_best_document = '선택한 옵션에 해당하는 글을 상단에 올려 여러 사람이 볼 수 있게 합니다. (댓글의 정렬 대상은 추천 수로 고정)';
    $lang->about_load_extra_vars = '문서의 일반 쿼리시 확장 변수도 같이 읽어들입니다.<br />게시판 EX 에선 필요할때 따로 가져오기 때문에 사용 안함으로 설정시 사이트의 과부하를 조금 줄일 수 있습니다.';

    // 모바일
    $lang->mobile = '모바일';
    $lang->use_mobile = '모바일 뷰 사용';
    $lang->mobile_skin = '모바일 스킨';
    $lang->about_use_mobile = '스마트폰 등을 이용하여 접속할 때 모바일 화면에 최적화된 레이아웃을 이용하도록 합니다.';
    $lang->about_mobile_layout = '';
    $lang->about_mobile_skin = '';

?>
