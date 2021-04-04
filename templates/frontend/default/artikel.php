<?php get_template('header'); ?>

<article>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">

				<h1 class="section-heading"><?= post_title(); ?></h1>
				<p class="post-meta">Posted by
					<?= post_meta('author'); ?> on <?= post_meta('time'); ?>
					| Category : <?= post_category(); ?>
				</p>

				<?= post_content(); ?>


				<?php $comment_list = comment_list();
				if (count($comment_list) > 0) : ?>
					<div class="comment-list">
						<div class="page-header">
							<h2><small class="pull-right"><?php echo count($comment_list); ?> komentar</small> Daftar Komentar</h2>
						</div>
						<div class="comments-list">
							<?php foreach ($comment_list as $comment) : ?>
								<div class="media">
									<p class="pull-right"><small><?= $comment->comment_date; ?></small></p>
									<a class="media-left" href="#">
										<img src="http://lorempixel.com/40/40/people/1/">
									</a>
									<div class="media-body">
										<h4 class="media-heading user_name"><?= $comment->comment_author_name; ?></h4>
										<p><?= $comment->comment_content; ?></p>
										<!-- <p><small><a href=""><i class="glyphicon glyphicon-thumbs-up"></i> Like</a> <a href=""><i class="glyphicon glyphicon-share-alt"></i> Share</a> </small></p> -->
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

				<div class="comment-form">
					<div class="page-header">
						<a name="form-komentar"></a>
						<h2>Form Komentar</h2>

						<?= comment_message('<p class="help-block alert alert-success">', 'message', '</p>'); ?>
					</div>
					<form id="form-komentar" class="form-horizontal" action="<?= set_url('komentar/kirim'); ?>" role="form" method="post">
						<div class="form-group">
							<label for="comment_author_name" class="col-sm-2 control-label">Nama</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="comment_author_name" name="comment_author_name" placeholder="Nama Lengkap" value="">
								<?= comment_message('<p class="help-block alert alert-danger" role="alert">', 'comment_author_name', '</p>'); ?>
							</div>

						</div>
						<div class="form-group">
							<label for="comment_author_email" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="comment_author_email" name="comment_author_email" placeholder="email@website.com" value="">
								<?= comment_message('<p class="help-block alert alert-danger" role="alert">', 'comment_author_email', '</p>'); ?>
							</div>
						</div>
						<div class="form-group">
							<label for="comment_author_url" class="col-sm-2 control-label">Website</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="comment_author_url" name="comment_author_url" placeholder="http://" value="">

							</div>
						</div>
						<div class="form-group">
							<label for="comment_content" class="col-sm-2 control-label">Komentar</label>
							<div class="col-sm-10">
								<textarea class="form-control" rows="4" name="comment_content"></textarea>
								<?= comment_message('<p class="help-block alert alert-danger" role="alert">', 'comment_content', '</p>'); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-10 col-sm-offset-2">
								<input type="hidden" name="post_ID" id="post_ID" value="<?= post_detail(NULL, 'post_ID'); ?>" />
								<input id="submit" name="submit" type="submit" value="Kirim Komentar!" class="btn btn-primary input-block">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
</article>

<?php get_template('footer'); ?>