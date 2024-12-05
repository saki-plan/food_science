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
 * タイトルの区切り文字を変更
 */
add_filter('document_title_separator', 'my_document_title_separator');
function my_document_title_separator() {
    return '|';
}
/**
 * 画面下部のエラー表示をとりあえず消す方法
 * Notice: ob_end_flush(): failed to send buffer of zlib output compression (1) in
 * 原因はデータ圧縮などを行うzlibというライブラリがサーバーにインストールされていないか、
 * ライブラリ自体に問題が起きている可能性。
 */
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );