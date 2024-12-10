<?php 
/**
 * タイトルタグを出力する
 */
add_theme_support('title-tag');

/**
 * アイキャッチ画像を使用可能にする
 */
add_theme_support('post-thumbnails');

/**
 * カスタムメニュー機能を使用可能にする
 */
add_theme_support('menus');

/**
 * コメント欄の追加HTML5をサポートする
 * タグの意味を分かりやすくする
 */
add_theme_support('html5');

/**
 * タイトルの区切り文字を変更
 */
add_filter('document_title_separator', 'my_document_title_separator');
function my_document_title_separator() {
    return '|';
}

// プラグイン　contact-form-7有効化のとき自動整形機能をオフにする
//問い合わせファーム作成時に自動的に<P>が追加されるのを防ぐ
add_filter('wpcf7_autop_or_not', 'my_wpcf7_autop');
function my_wpcf7_autop()
{
  return false;
}

/**
 * 画面下部のエラー表示をとりあえず消す方法
 * Notice: ob_end_flush(): failed to send buffer of zlib output compression (1) in
 * 原因はデータ圧縮などを行うzlibというライブラリがサーバーにインストールされていないか、
 * ライブラリ自体に問題が起きている可能性。
 */
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );


// ショートコードサンプル
    // ex:直近の記事だけに特定の文章を表示することもできる
    function my_shortcode_sample($args)
    {
      // もし$argsがなかった時のデフォルト値
      $default = [
        'bgcolor' => 'transparent',
      ];
        //   第二引数が優先される
      $args = shortcode_atts($default, $args);

          $html = <<<HTML
            <div style="background-color: {$args['bgcolor']};">
              <h3 class="shortcode-heading">ショートコードサンプル</h3>
              <p>期間限定！ダミー文章、ダミー文章、ダミー文章、ダミー文章、ダミー文章、ダミー文章、ダミー文章、</p>
            </div>
        HTML;

          return $html;
        }
        //　第一引数: ショートコード名
        // 　第二引数: 関数名（コールバック）　
        add_shortcode('my-shortcode', 'my_shortcode_sample');
        add_action('pre_get_posts', 'my_pre_get_posts');

// TOPページの投稿数を3件にする
function my_pre_get_posts($query) {
     // 管理画面、メインクエリ以外は除外
  if (is_admin() || !$query->is_main_query()) {
    return;
  }
  // トップページの場合
  if ($query->is_home()) {
    $query->set('posts_per_page', 3);
    return;
  }
}


/**
 * 保護ページタイトルの「保護中」の文字を削除する
 */
add_filter('protected_title_format', 'my_protected_title');
function my_protected_title()
{
  return '%s';
}

/**
 * パスワード入力フォームのカスタム
 * 問い合わせファームと同様に自動的に<P>が追加される
 */

 add_filter('the_password_form', 'my_password_form');
function my_password_form()
{
  remove_filter('the_content', 'wpautop');
  $wp_login_url = wp_login_url();
  $html = <<<XYZ
  <p>パスワードを入力してください。</p>
  <form action="{$wp_login_url}?action=postpass" method="post" class="post-password-form">
    <input type="password" name="post_password">
    <input type="submit" name="Submit" value="送信">
  </form>
XYZ;
  return $html;
}
