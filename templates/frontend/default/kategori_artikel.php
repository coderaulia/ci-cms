<?php get_template('header'); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">

      <?php if (have_post($type = 'artikel')) : ?>
        <?php foreach (post() as $post) : ?>

          <div class="post-preview">
            <a href="<?= permalink($post); ?>">
              <h2 class="post-title"><?= post_title($post); ?></h2>
            </a>
            <p class="post-meta">Posted by
              <?= post_meta('author', $post); ?> on <?= post_meta('time', $post); ?>
              | Category : <?= post_category($post); ?>
            </p>
          </div>

          <hr>
        <?php endforeach; ?>
      <?php endif; ?>
      <hr>
      <!-- Pager -->
      <?= post_pagination($type); ?>
    </div>
  </div>
</div>

<?php get_template('footer'); ?>