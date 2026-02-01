<?php
    /**
     * @file   jp.lang.php
     * @author phidel (phidel@foxb.kr) (翻訳)HIRO
     * @brief  掲示板 EX (bodex) モジュールの日本語パック
     **/
    $lang->cmd_Insert_bodex = '掲示板生成';
    $lang->new_declared = '最近申告された文書';
    $lang->declared_count = '申告された回数';
    $lang->about_bodex = '掲示板を生成して管理することができるモジュールです. 詳細オプション修正は掲示板リストで該当の掲示板の設定ボタンを押してください.';

    $lang->cmd_bodex_content = '初期ページ';

    $lang->new_document = '最近文書';
    $lang->new_comment = '最近コメント';
    $lang->new_download_log = '最近ダウンロード(ポイント使用方式がダウンロードなら記録されます)';

    $lang->use_load_extra_vars = '拡張変数読み取り';
    $lang->about_load_extra_vars = '文書の一般クイーリーの時拡張変数も一緒に読み込みます.<br />掲示板 EX では必要する時別に読み込みますので使用しないことで設定の時サイトの過負荷を少し減らすことができます.';

    $lang->write_comment = 'コメントを書き取り';
    $lang->msg_not_allow_mobile ='モバイル器機では作動しません.';

    $lang->bodex = '掲示板 EX';
    $lang->list_target_item = '対象項目';
    $lang->list_display_item = '表示項目';
    $lang->list_sort_item = '整列使用';
    $lang->search_display_item = '検索項目';
    $lang->visitor = '訪問者';
    $lang->count = '個数';
    $lang->sort = '整列';
    $lang->option = 'オプション';
    $lang->etcetera = 'その他';
    $lang->previous = '以前';
    $lang->next = '次';

    $lang->always = '毎回';
    $lang->first = '最初';
    $lang->cancel = '取り消し';
    $lang->my_point = '私のポイント';
    $lang->anonymous = '匿名';
    $lang->restore = '復元';
    $lang->admin = '管理者';
    $lang->rating = '評価';
    $lang->registrant = '登録者';
    $lang->user = '使用者';
    $lang->image = 'イメージ';
    $lang->media = 'メディア';
    $lang->filelink_url = 'ファイルリンク住所';
    $lang->display = '出力';
    $lang->adopted = '採択';
    $lang->not_adopted = '未採択';
    $lang->date_range = '日付範囲';

    $lang->file_last_update= '最近アップデート';
    $lang->file_total_download= '全体ダウンロード';

    $lang->point_configs = 'ポイント設定';
    $lang->point_insert_document = '書き込み作成';
    $lang->point_insert_comment = 'コメント作成';
    $lang->point_read_document = '書き込み閲覧';
    $lang->point_upload_file = 'アップロード';
    $lang->point_download_file = 'ダウンロード';

    // 목록항목
    $lang->reward_point = 'ポイント';
    $lang->blamed_count = '非推薦数';
    $lang->trackback_count = 'トラックバック数';
    $lang->uploaded_count = 'アップロード数';
    $lang->vote_point = '推薦(星数)';
    $lang->voted_people = '投票';
    $lang->summary = '要約';
    $lang->thumbnail = 'サムネイル';
    $lang->doc_state = '状態';
    $lang->last_updater = '最近コメント';
    $lang->random = 'ランダム';

    // 항목
    $lang->search_result = '検索結果';

    $lang->except_notice = '告知事項除外';
    $lang->consultation = '相談機能';
    $lang->thisissecret = '秘密文書です.';
    $lang->admin_mail = '管理者メール';
    $lang->auto_reply = '自動コメント';
    $lang->anonymous_phase = '匿名段階';
    $lang->notify_message_type = 'お知らせ方法';
    $lang->best_document = 'ベスト文書';
    $lang->best_comment = 'ベストコメント';

    $lang->use_doc_state ='状態機能';
    $lang->use_doc_state_default_value = '待機,検討,完了,保留';

    $lang->use_category_none = '使用しない';
    $lang->use_category_comb = 'コンボボックス';
    $lang->use_category_tab = 'タブページ';
    $lang->use_category_left = '左側メニュー';
    $lang->use_category_right = '右側メニュー';

    $lang->use_vote = '推薦使用';
    $lang->use_vote_none = '使用しない';
    $lang->use_vote_yes = '推薦:選択使用';
    $lang->use_vote_require = '推薦:必須使用';
    $lang->use_vote_star = '星数:選択使用';
    $lang->use_vote_star_require = '星数:必須使用';

    $lang->use_vote_empty = '推薦/非推薦点数を修正(削除) 可能になるように許可する';
    $lang->use_vote_bonus = '推薦/非推薦を受ければ上の点数位ポイントボーナスをもらう (星点の時,推薦点数 * 星点数)';
    $lang->use_vote_not_checkip = '推薦/非推薦の時 IP チェックをしない (同じ IPを使わなければならない環境に使用)';

    $lang->use_reward = 'ポイント使用';
    $lang->use_reward_none = '使用しない';
    $lang->use_reward_yes = '選択使用';
    $lang->use_reward_require = '必須使用';
    $lang->use_reward_down = 'ダウンロード';

    $lang->use_secret = '秘密機能';
    $lang->use_secret_none = '使用しない';
    $lang->use_secret_yes = '選択使用';
    $lang->use_secret_require = '常時使用';

    $lang->use_anonymous = '匿名使用';
    $lang->use_anonymous_none = $lang->use_secret_none;
    $lang->use_anonymous_yes = $lang->use_secret_yes;
    $lang->use_anonymous_require = $lang->use_secret_require;

    $lang->use_down_point_images = 'イメージファイルにもポイント適用';
    $lang->use_down_point_medias = 'メディアファイルにもポイント適用';
    $lang->use_down_point_always = 'ファイル別で毎回適用';
    $lang->use_down_point_one = 'ファイル別に 1回適用';

    $lang->use_allow = '許可';
    $lang->use_allow_none = '許可しない';
    $lang->use_allow_require = '常時許可';
    $lang->use_allow_yes = '選択使用';

    $lang->display_extra_images = 'アイコン表示';
    $lang->about_display_extra_images = 'リストの題目に表示されるアイコンを指定することができます.';
    $lang->use_extra_image_new = '新しい文書';
    $lang->use_extra_image_update = 'アップデート';
    $lang->use_extra_image_secret = '秘密文書';
    $lang->use_extra_image_image = 'イメージ';
    $lang->use_extra_image_movie = '動画';
    $lang->use_extra_image_file = 'ファイル';

    // 버튼에 사용되는 언어
    $lang->cmd_reward = 'ポイントバッティング';
    $lang->cmd_adopt_comment = '返事採択';
    $lang->cmd_search_not_adopt_post = '未採択文書探し';
    $lang->cmd_bodex_list = '掲示板リスト';
    $lang->cmd_view_info = '掲示板情報';
    $lang->cmd_list_setting = 'リスト設定';
    $lang->cmd_vote_empty = '推薦初期化';
    $lang->cmd_change_state = '状態変更';
    $lang->cmd_get_tags = 'タグリスト読み込み';
    $lang->cmd_recount_voted = '推薦数新たに更新';
    $lang->cmd_adopted_comment = '採択された返事';
    $lang->cmd_adopted_comment_view = '採択された返事 表示';
    $lang->cmd_search_setting = '検索設定';
    $lang->cmd_history_all = '以前文書記録';
    $lang->cmd_view_filelist = '添付ファイルリスト表示';
    $lang->cmd_file_link = '外部ファイル添付';

    $lang->send_notify = 'メッセージ発送';
    $lang->send_mail = 'メール発送';

    // 메세지에 사용되는 언어
    $lang->success_adopt = '採択されました.';

    $lang->confirm_recount_voted = "データ量によって多少時間がかかることがあります.\n推薦数更新を続きますか?";

    $lang->msg_alert = 'お知らせ!';
    $lang->msg_apply_with = '%sも含む';
    $lang->msg_not_skin_info = "スキン情報の読み込みができません.\n掲示板情報のスキン選択を確認してください";
    $lang->msg_please_login ='ログインしてください.';
    $lang->msg_please_use = '%sを使用してください.';
    $lang->msg_acted_current_document = 'この文書に %s しました.';
    $lang->msg_act_not_permitted = '%sできる権限がありません.';
    $lang->msg_reward_point_adopt = '返事採択の時 %s ポイント補償';
    $lang->msg_reward_point_download = 'てダウンロードの時 %s ポイント使用';
    $lang->msg_writer_same_user = '著者と同一人物です.';
    $lang->msg_not_enough_point = 'ポイントが不足です.';
    $lang->msg_reward_please_adopt = "未採択文書が 3個以上存在します.\n先に採択をしてください.";
    $lang->msg_invalid_upload_format = 'アップロードできないファイルフォーマットです.';
    $lang->msg_please_select_rating = '点数を選択してください.';

    // 주절 주절..
    $lang->about_except_notice = 'リスト上端の告知事項を一般リストで出力しないようにします.';
    $lang->about_use_anonymous = '著者の情報を無くして匿名で掲示板の使用をできるようにします.';
    $lang->about_consultation = '相談機能は管理権限のない会員は自分が書いた文書だけ見えるようにする機能です.<br />会員だけ書き込みが許容されて匿名機能使用の時保安段階は 1段階に調整されます.';
    $lang->about_secret = '掲示板及びコメントに秘密書き込みができるようにします. 必須の場合該当文書は自動的に秘密文書になります.';
    $lang->about_admin_mail = '文書やコメントが登録される時登録されたメールアドレスでメールが発送されます<br />,(コンマ)で連結すると多数のメールアドレスに発送することができます. (送信者と受信者が同じな場合には発送されません.)';
    $lang->about_list_config = '掲示板のリストで必要項目で配置できます. (項目をダブルクリックすれば追加/ 除去になります)';
    $lang->about_use_category = '分類のスタイルをコンボボックス, タブページ, 左側メニュー, 右側メニュー形態に指定することができます.';
    $lang->about_use_vote = '推薦方法を指定することができます.  (ただし,非会員は投票から除外)<br /><br /><span style="color:red">推薦数新たに更新</span>: 推薦形態が変わった時現状態に合うように数を更新します.<br />*注意 * 推薦数の新たな更新はdbの値を直接修正することなので安全のためにバックアップの後行ってください.';
    $lang->about_use_reward_alert = '参照: 追加設定のポイント値と重複適用されます.';
    $lang->about_use_reward_value = '使うことができるポイント値のリストを指定することができます. (ex: 10,30,50,100,300,500,1000)';
    $lang->about_use_reward = 'ポイントをかけて返事を採択すれば採択された会員に 50%,著者に 50%のポイントが戻ります.<br />返事があるにも採択をしてない文書が 3個以上存在すると書き込みが制限されます. (ただし,採択すると解除されます.)<br /><br />ダウンロードをするには添付ファイルをダウンロードする会員が 50%ポイントを著者に支払います.';
    $lang->about_use_doc_state_value = '使うことができる状態値のリストを指定することができます. (HTML タグ使用可能)<br />複数登録 ,(コンマ) で区分します. (最大 10個使用可能 ex: 待機,検討,完了,保留)';
    $lang->about_use_doc_state = '文書の状態を設定し表示します. (リストで現在状態を表示するにはリスト設定で状態を使ってください.)';
    $lang->about_search_setting = '掲示板の検索を設定することができます.(拡張変数検索は拡張変数の検索項目を選択)';
    $lang->about_auto_reply = '新しい文書が登録されればその文書に自動で該当の内容のコメントを入力します. (HTML タグ使用可能)';
    $lang->about_notify_message_type = '新しい文書やコメントが登録されれば上位文書にお知らせ機能がある時お知らせ方法を指定することができます.';
    $lang->about_module_text = '該当の掲示板モジュールの上,下端に出力される内容を指定することができます.';
    $lang->about_file_link = '外部ファイルの住所を連結してファイルを登録します.';
    $lang->about_use_allow = '掲示板にコメントまたはトラックバックの許可を選択することができます.';
    $lang->about_use_anonymous_phase = '匿名使用の時保安をどの位にするか設定することができます.<br /><br />1. 一番低い段階で管理者には会員情報が見えます. (相談掲示板でも見えます)<br />2. 基本的な段階ですべての会員情報を隠すが最高管理者は dbを分析して分かる方法があります.<br />3. 最高段階で会員情報をその誰もわからないしログアウト後には文書作成者も修正/削除をする事ができません.';
    $lang->about_category_list = 'グループ制限を適用させた分類の文書は該当のグループのみ書き込みが可能です.';
    $lang->about_extra_vars = '検索をチェックすると検索設定を通じて検索が可能になります.';
    $lang->about_order_target = 'リストの基本整列項目と整列方式を指定します.<br />ランダムを選択すればいつも無作為に表示します.';
    $lang->about_best_document = '選択したオプションにあたる文書を上端に配置して多くの人が閲覧することができるようにします. (コメントの整列対象は推薦数に固定)';

    // 모바일
    $lang->mobile = 'モバイル';
    $lang->use_mobile = 'モバイルビュー使用';
    $lang->mobile_skin = 'モバイルスキン';
    $lang->about_use_mobile = 'スマトホンなどを利用して接続する時モバイル画面に最適化されたレイアウトを利用するようにします.';
    $lang->about_mobile_layout = '';
    $lang->about_mobile_skin = '';
?>
