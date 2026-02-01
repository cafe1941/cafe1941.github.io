<?php
    /**
     * @file   zh-CN.lang.php
     * @author phidel (phidel@foxb.kr)
     * @brief  留言板 EX (bodex) 模块简体中文语言包 by DuRi
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

    $lang->date_range = '日期范围';
    $lang->best_document = '最优秀的文章';
    $lang->best_comment = '最优秀的贴子';
    $lang->about_best_document = '把被选的稿子显示到上框供众人阅读. (用以推荐数固定铁子的排列对象)';
    $lang->about_use_anonymous_phase = '使用匿名时可按需设定保安级别.<br /><br />1. 会员信息以最低的级别供管理这审阅. (在咨询留言板也可看到)<br />2. 以基本级别可隐藏所有信息但管理者可通过分析数据库查出信息.<br />3. 最高级别则任何人都没发了解会员信息发稿者推出网页后不可修改或删除自己的文稿.';

    $lang->bodex = '留言板 EX';
    $lang->list_target_item = '备选项目';
    $lang->list_display_item = '显示项目';
    $lang->list_sort_item = '使用分类';
    $lang->search_display_item = '搜索项目';
    $lang->visitor = '访问者';
    $lang->count = '个数';
    $lang->sort = '排列';
    $lang->option = '选项';
    $lang->etcetera = '其它';
    $lang->previous = '上一个';
    $lang->next = '下一个';

    $lang->always = '每次';
    $lang->first = '首次';
    $lang->cancel = '取消';
    $lang->my_point = '我的积分';
    $lang->anonymous = '匿名';
    $lang->restore = '复原';
    $lang->admin = '管理者';
    $lang->rating = '评价';
    $lang->registrant = '注册人';
    $lang->user = '使用者';
    $lang->image = '图像';
    $lang->media = '多媒体';
    $lang->filelink_url = '文档连接地址';
    $lang->display = '输出';
    $lang->adopted = '采纳';
    $lang->not_adopted = '未采纳';

    $lang->file_last_update= '最新更新';
    $lang->file_total_download= '全部下载';

    $lang->point_configs = '积分设置';
    $lang->point_insert_document = '发表新帖';
    $lang->point_insert_comment = '发表评论';
    $lang->point_read_document = '查看主题';
    $lang->point_upload_file = '上传文件';
    $lang->point_download_file = '下载文件 (图片除外)';

    // 목록항목
    $lang->reward_point = '积分';
    $lang->blamed_count = '非推荐次数';
    $lang->trackback_count = '引用次数';
    $lang->uploaded_count = '上载次数';
    $lang->vote_point = '推荐(星积分)';
    $lang->voted_people = '投票';
    $lang->summary = '摘要';
    $lang->thumbnail = '缩图';
    $lang->doc_state = '状况';
    $lang->last_updater = '最近贴子';
    $lang->random = '随机';

    // 항목
    $lang->search_result = '搜索结果';

    $lang->except_notice = '公告除外';
    $lang->consultation = '咨询功能';
    $lang->thisissecret = '这是一个隐藏文.';
    $lang->admin_mail = '管理者的邮件';
    $lang->auto_reply = '自动发贴';
    $lang->anonymous_phase = '匿名级别';
    $lang->notify_message_type = '提示方法';

    $lang->use_doc_state ='状态功能';
    $lang->use_doc_state_default_value = '待审,审阅,已完成,保留';

    $lang->use_category_none = '不使用';
    $lang->use_category_comb = '选择框';
    $lang->use_category_tab = '标签页';
    $lang->use_category_left = '左菜单';
    $lang->use_category_right = '右菜单';

    $lang->use_vote = '使用推荐';
    $lang->use_vote_none = '不使用';
    $lang->use_vote_yes = '推荐:选择使用';
    $lang->use_vote_require = '推荐:必须使用';
    $lang->use_vote_star = '星积分:选择使用';
    $lang->use_vote_star_require = '星积分:必须使用';

    $lang->use_vote_empty = '允许可以修正或删除推荐/非推荐点数';
    $lang->use_vote_bonus = '受到推荐或非推荐时将获得点数相应的积分奖励 (星积分, 推荐点数 * 星点数)';
    $lang->use_vote_not_checkip = '推荐/非推荐时无需进行IP确认(如同实际网络使用在相同的IP的环境)';

    $lang->use_reward = '使用积分';
    $lang->use_reward_none = '不使用';
    $lang->use_reward_yes = '选择使用';
    $lang->use_reward_require = '必须使用';
    $lang->use_reward_down = '下载';

    $lang->use_secret = '密码功能';
    $lang->use_secret_none = '不使用';
    $lang->use_secret_yes = '选择使用';
    $lang->use_secret_require = '始终使用';

    $lang->use_anonymous = '使用匿名';
    $lang->use_anonymous_none = $lang->use_secret_none;
    $lang->use_anonymous_yes = $lang->use_secret_yes;
    $lang->use_anonymous_require = $lang->use_secret_require;

    $lang->use_down_point_images = '图像文件也实行积分制';
    $lang->use_down_point_medias = '以多媒体文档应用积分';
    $lang->use_down_point_always = '每次应用于不同文件类别';
    $lang->use_down_point_one = '仅限于1件文档资料';

    $lang->use_allow = '允许';
    $lang->use_allow_none = '不允许';
    $lang->use_allow_require = '始终允许';
    $lang->use_allow_yes = '选择使用';

    $lang->display_extra_images = '显示图标';
    $lang->about_display_extra_images = '你可以指定项目题目旁产出的图标.';
    $lang->use_extra_image_new = '新的文字';
    $lang->use_extra_image_update = '更新';
    $lang->use_extra_image_secret = '隐藏文';
    $lang->use_extra_image_image = '图表';
    $lang->use_extra_image_movie = '影响';
    $lang->use_extra_image_file = '文档';

    // 버튼에 사용되는 언어
    $lang->cmd_reward = '积分投注';
    $lang->cmd_adopt_comment = '采纳答辩';
    $lang->cmd_search_not_adopt_post = '找出未被采纳贴子';
    $lang->cmd_bodex_list = '留言板目录';
    $lang->cmd_view_info = '留言板信息';
    $lang->cmd_list_setting = '设置目录';
    $lang->cmd_search_setting = '设定搜索';
    $lang->cmd_vote_empty = '推荐初始化';
    $lang->cmd_change_state = '状态变更';
    $lang->cmd_get_tags = '求一个标记列表';
    $lang->cmd_recount_voted = '更新推荐次数';
    $lang->cmd_adopted_comment = '被采纳答辩';
    $lang->cmd_adopted_comment_view = '被采纳答辩 查看';
    $lang->cmd_history_all = '过去文书记录';
    $lang->cmd_view_filelist = '查看附件文档目录';
    $lang->cmd_file_link = '附加外部文档';

    $lang->send_notify = '发送条子';
    $lang->send_mail = '发送邮件';

    // 메세지에 사용되는 언어
    $lang->success_adopt = '已被采纳.';

    $lang->confirm_recount_voted = "消耗的时间取决于数据量.\n要继续推荐次数的更新吗?";

    $lang->msg_alert = '告知!';
    $lang->msg_apply_with = '包括%s';
    $lang->msg_not_skin_info = "无法读取皮肤信息.\n请确认留言板信息皮肤选择项";
    $lang->msg_please_login ='请登入.';
    $lang->msg_please_use = '请用%s.';
    $lang->msg_acted_current_document = '该文档资料已%s了.';
    $lang->msg_act_not_permitted = '你没有权力%s.';
    $lang->msg_reward_point_adopt = '采纳答辩时积分奖励%s';
    $lang->msg_reward_point_download = '下载,使用积分%s';
    $lang->msg_writer_same_user = '与发贴者是同一个人.';
    $lang->msg_not_enough_point = '积分不够.';
    $lang->msg_reward_please_adopt = "已有三个以上未被采纳的贴子.\n请须先选择.";
    $lang->msg_invalid_upload_format = '不能下载的文档格式.';
    $lang->msg_please_select_rating = '请选择分数.';

    // 주절 주절..
    $lang->about_except_notice = '在一般的列表上不让显示列表的顶部经常出现的公告显示.';
    $lang->about_use_anonymous = '删除发贴者的个人信息,可以用匿名发贴.';
    $lang->about_consultation = '咨询功能即没有管理权限的会员只允许查看自己的发稿的功能.<br />只限会员可以发稿对使用匿名者保安级别调整到一级.';
    $lang->about_secret = '留言板可以使用隐藏贴子. 必要时可以自动转化成隐藏格式.';
    $lang->about_admin_mail = '贴子被注册,则按注册的邮箱地址发送邮件.<br />,以(豆号)连接时可同时发送多个邮箱地址. (如果同一个发件人和收件人被排除在外.)';
    $lang->about_list_config = '当使板的列表格式时,可以按需设置其项目. (备选项目/ 重复点击显示项目就会被添加或删除)';
    $lang->about_use_category = '风格选择框可以指定标签页,左菜单中,右菜单.';
    $lang->about_use_vote = '可以指定推荐方法.  (非会员除外)<br /><br /><span style="color:red">更新推荐数</span>:当推荐形态改变时要以按现行形态数更新.<br />* 주의 * 추천 수 새로 갱신은 디비의 값을 직접 수정하는 것이므로 안전을 위해서 백업후 실행 하세요.';
    $lang->about_use_reward_alert = '注意：其他设置点值将结合使用.';
    $lang->about_use_reward = '如果用积分投注选择答辩,则会员和发贴者各得50%.<br />如果答辩之后仍有三个以上未被采纳的贴子就会受到限制发贴. (采纳时被解除.)<br /><br />下载附件的会员给发贴者支付50%的积分.';
    $lang->about_use_doc_state = '显示该文件的设置状态. (如果目录列表上查看当前状态请使用设置目录列表状.)';
    $lang->about_search_setting = '留言板搜索可以设定所需项目. (扩张变数的搜索选择搜索项目才能看到)';
    $lang->about_use_doc_state_value = '可以指定可使用状态值的目录. (HTML 可使用标签)<br />同时多数的注册以豆号区分. (提供最多可使用10个 ex:待审,审阅,已完成,保留)';
    $lang->about_use_reward_value = '可以指定可使用积分值的目录.<br />首值尽量最低以便和我的积分比较使用. (ex: 10,30,50,100,300,500,1000)';
    $lang->about_auto_reply = '登载新的论坛自动输入相应的贴子. (HTML 可使用标签)';
    $lang->about_notify_message_type = '如果登载新贴子如有提示功能可指定提示方法.';
    $lang->about_module_text = '可指定相关留言板模块上,下段输出的内容.';
    $lang->about_file_link = '连接外部文档地址登记文档.';
    $lang->about_use_allow = '在留言板上可选择是否允许贴子或引用通告.';
    $lang->about_category_list = '被设定限制使用所分类的文仅限于该群组.';
    $lang->about_extra_vars = '如果点击搜索可通过搜索功能搜索.';
    $lang->about_order_target = '指定项目清单和默认的排序.<br />如果您选择一个随机就回始终随机的输出.';

    // 모바일
    $lang->mobile = '모바일';
    $lang->use_mobile = '모바일 뷰 사용';
    $lang->mobile_skin = '모바일 스킨';
    $lang->about_use_mobile = '스마트폰 등을 이용하여 접속할 때 모바일 화면에 최적화된 레이아웃을 이용하도록 합니다.';
    $lang->about_mobile_layout = '';
    $lang->about_mobile_skin = '';
?>
