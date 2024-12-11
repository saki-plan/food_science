<!-- <div class="foodCard">
  <a href="#">
    <span class="foodCard_label">オススメ</span>
    <div class="foodCard_pic">
      <img src="assets/img/food/food_img01@2x.png" alt="">
    </div>
    <div class="foodCard_body">
      <h4 class="foodCard_title">タコス</h4>
      <p class="foodCard_price">¥650</p>
    </div>
  </a>
</div> -->
<!-- ====メニュー一覧のセクション=== -->
<div class="foodCard">
  <a href="<?php the_permalink(); ?>">
    <!-- 条件分岐 -->
    <?php if (get_field('recommend')): ?>
      <span class="foodCard_label">オススメ</span>
    <?php endif; ?>
    <div class="foodCard_pic">
      <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail('medium'); ?>
      <?php else: ?>
        <img src="<?= get_template_directory_uri(); ?>/assets/img/common/noimage.png" alt="">
      <?php endif; ?>
    </div>
    <div class="foodCard_body">
      <h4 class="foodCard_title"><?php the_title(); ?></h4>
      <p class="foodCard_price">¥<?php the_field('price'); ?></p>
    </div>
  </a>
</div>