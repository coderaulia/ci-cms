<?php get_template('header'); ?>

<div class="main">
  <div class="main-inner">
    <div class="container">

      <div class="row">
        <div class="span12">

          <div class="widget">
            <div class="widget-header">
              <i class="icon-comments-alt"></i>
              <h3> Daftar Komentar</h3>

            </div>
            <!-- /widget-header -->
            <div class="widget-content">

              <div class="controls pull-right">
                <div class="btn-group">
                  <input type="text" class="form-control" autocomplete="off" id="search" name="search" placeholder="Cari Komentar ... ">
                </div>
              </div>


              <div class="controls pull-left">
                <a class="btn btn-default" id="btn-check-all"><i class="icon-check"></i></a>
              </div>

              <div class="controls pull-left">
                <div class="btn-group">
                  <a class="btn btn-default" href="#">Aksi Komentar</a>
                  <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                  <ul class="dropdown-menu" id="btn-action-komentar">
                    <li><a href="<?= set_url('komentar#mass?action=hapus'); ?>"><i class="icon-trash"></i> Hapus</a></li>
                    <li><a href="<?= set_url('komentar#mass?action=pending'); ?>"><i class="icon-ban-circle"></i> Pending</a></li>
                    <li><a href="<?= set_url('komentar#mass?action=publish'); ?>"><i class="icon-ok"></i> Publish</a></li>
                  </ul>
                </div>
              </div> <!-- /controls -->


              <table id="tbl-komentar" class="table table-striped table-bordered">

                <tbody></tbody>

              </table>

              <div class="controls pull-right">
                <ul id="pagination-komentar" class="pagination"></ul>
              </div>

            </div>
            <!-- /widget-content -->
          </div>


        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /main-inner -->
</div>
<!-- /main -->


<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Edit Komentar</h3>
  </div>

  <div class="modal-body">

    <form role="form" id="form-komentar" action="tambah">

      <fieldset class="form-horizontal">
        <div class="control-group">

          <label class="control-label">Nama</label>
          <div class="controls">
            <input type="text" name="comment_author_name" id="comment_author_name" class="form-control input-block-level" />
          </div>

          <label class="control-label">Email</label>
          <div class="controls">
            <input type="text" name="comment_author_email" id="comment_author_email" class="form-control input-block-level" />
          </div>

          <label class="control-label">Website</label>
          <div class="controls">
            <input type="text" name="comment_author_url" id="comment_author_url" class="form-control input-block-level" />
          </div>

          <label class="control-label">Status Komentar</label>
          <div class="controls">
            <select name="comment_approved" id="comment_approved" class="form-control input-block-level">
              <option value="pending">Pending</option>
              <option value="publish">Publish</option>
            </select>
          </div>

          <label class="control-label">Isi Komentar</label>
          <div class="controls">
            <textarea class="form-control input-block-level vresize" name="comment_content" rows="7" id="comment_content"></textarea>
          </div>
        </div> <!-- /controls -->

      </fieldset>


      <input type="hidden" name="mass_action_type" id="mass_action_type" />
      <input type="hidden" name="comment_ID" id="comment_ID" value="0" />
    </form>
  </div>

  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
    <button class="btn btn-primary" id="submit-komentar">Update!</button>
  </div>

</div>

<?php get_template('footer'); ?>