<section class="comments">
<?php
$args = [
  'title_reply' => 'コメント投稿フォーム',
];
comment_form($args);
if ( have_comments() ) :
?>
  <ol class="commentlist">
      <?php
      $wp_list_comments_args = [
        'avatar_size' => 50,
      ];
      wp_list_comments($wp_list_comments_args);
      ?>
    </ol>
  <?php
   $paginate_comments_links_args = [
     'prev_text' => '←前のコメントページ',
     'next_text' => '次のコメントページ→'
  ];
    paginate_comments_links($paginate_comments_links_args);
  endif;
  ?>
</section>
