<?php get_header(); ?>

<main>
  <section class="section section-foodList">
    <div class="section_inner">
      <div class="section_header">
        <h2 class="heading heading-primary"><span>フード紹介</span>FOOD</h2>
      </div>

      <?php
      $menu_terms = get_terms([
        'taxonomy' => 'menu',
      ]);
      ?>
      <?php if (!empty($menu_terms)): ?>
        <?php foreach ($menu_terms as $menu): ?>
          <section class="section_body">
            <h3 class="heading heading-secondary">
              <a href="<?= get_term_link($menu); ?>"><?= $menu->name; ?></a><span><?= strtoupper($menu->slug); ?></span>
            </h3>
            <ul class="foodList">
              <?php
              $args = [
                // 条件を指定
                //「food」投稿タイプ限定
                'post_type' => 'food',
                // 全件取得(最後に戻るため)
                'posts_per_page' => -1,
                // タクソノミーに関する条件指定
                //配列:条件1 [],条件2 [],条件3 []
                'tax_query' => [
                  // それぞれの関係性がAND
                  //SQL文なので大文字
                  'relation' => 'AND',
                  [
                    'taxonomy' => 'menu',
                    'field' => 'slug',
                    'terms' => $menu->slug,
                  ],
                ],
              ];
              $the_query = new WP_Query($args);
              ?>
              <?php if ($the_query->have_posts()): ?>
                <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                  <li class="foodList_item">
                    <?php get_template_part('template-parts/loop', 'food'); ?>
                  </li>
                  <!-- サブクエリ必須 -->
                  <?php endwhile;
                wp_reset_postdata();
              endif; ?>

            </ul>
          </section>
        <?php endforeach; ?>
      <?php endif; ?>

    </div>
  </section>
</main>

<?php get_footer(); ?>