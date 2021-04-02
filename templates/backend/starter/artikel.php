<?php get_template('header'); ?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="widget">
            <div class="widget-header">
              <i class="icon-file"></i>
              <h3>Daftar Artikel</h3>
              <a href="<?php echo set_url('artikel#tambah') ?>" class="btn btn-large btn-primary">Tambah Artikel</a>
            </div>

            <div class="widget-content">

              <div class="controls pull-right">
                <div class="btn-group">
                  <input type="text" class="form-control" autocomplete="off" id="search" name="search" placeholder="Pencarian artikel...">
                </div>
              </div>

              <div class="controls pull-left">
                <a class="btn btn-default" id="btn-check-all"><i class="icon-check"></i></a>
              </div>

              <div class="controls pull-left">
                <div class="btn-group">
                  <a class="btn btn-default" dropdown-toggle" data-toggle="dropdown" href="#">Aksi Artikel</a>
                  <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>

                  <ul class="dropdown-menu" id="btn-action-artikel">
                    <li><a href="<?= set_url('artikel#mass?action=hapus'); ?>"><i class="icon-trash"></i> Hapus</a></li>
                    <li><a href="<?= set_url('artikel#mass?action=pending'); ?>"><i class="icon-ban-circle"></i> Pending</a></li>
                    <li><a href="<?= set_url('artikel#mass?action=publish'); ?>"><i class="icon-ok"></i> Publish</a></li>
                  </ul>

                </div>
              </div>

              <div class="controls pull-right">
                <div class="btn-group">
                  <a class="btn btn-default" id="lbl-filter-artikel">Filter Artikel</a>
                  <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                  <ul class="dropdown-menu" id="btn-filter-artikel">
                    <li><a href="#">Kategori...</a></li>
                  </ul>
                </div>
              </div>

              <table id="tbl-artikel" class="table table-striped table-bordered">
                <tbody>

                </tbody>
              </table>

              <div class="controls pull-right">
                <ul id="pagination-artikel" class="pagination"></ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /main-inner -->
</div>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"><i class="icon-plus"></i> Tambah Artikel</h3>
  </div>

  <div class="modal-body">
    <form role="form" id="form-artikel" action="tambah">
      <div class="form-group">
        <input class="input-block-level" type="text" id="post_title" name="post_title" placeholder="Tuliskan Judul Artikel Disini">
        <!-- <textarea class="form-control input-block-level" placeholer="Message" name="post_content" rows="20" id="post_content"></textarea> -->
        <div class="tabbable onmodal">
          <ul class="nav nav-tabs">
            <li><a href="#kategori" data-toggle="tab"><i class="icon-folder-close"></i> Kategori</a></li>
            <li><a href="#waktu" data-toggle="tab"><i class="icon-time"></i> Waktu</a></li>
            <li><a href="#komentar" data-toggle="tab"><i class="icon-comment"></i> Komentar</a></li>

            <li><a href="#penulis" data-toggle="tab"><i class="icon-user"></i> Penulis</a></li>
            <li><a href="#seo" data-toggle="tab"><i class="icon-search"></i> SEO</a></li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane" id="kategori">
              <fieldset>
                <div class="control-group">
                  <ul class="list-group check-list-group-kategori">
                    <li class="list-group-item"><label class="checkbox inline"><input type="checkbox" name="category_slug[]" value="bisnis"> Bisnis</label></li>
                    <li class="list-group-item"><label class="checkbox inline"><input type="checkbox" name="category_slug[]" value="featured"> Featured</label></li>
                    <li class="list-group-item"><label class="checkbox inline"><input type="checkbox" name="category_slug[]" value="desain"> Desain</label></li>
                    <ul class="list-group check-list-group-kategori">
                      <li class="list-group-item"><label class="checkbox inline"><input type="checkbox" name="category_slug[]" value="coloring"> Coloring</label></li>
                      <li class="list-group-item"><label class="checkbox inline"><input type="checkbox" name="category_slug[]" value="typography"> Typography</label></li>
                      <li class="list-group-item"><label class="checkbox inline"><input type="checkbox" name="category_slug[]" value="nirmana"> Nirmana</label></li>
                    </ul>
                    <li class="list-group-item"><label class="checkbox inline"><input type="checkbox" name="category_slug[]" value="komputer"> Komputer</label></li>
                  </ul>
                </div>
              </fieldset>
            </div>


            <div class="tab-pane" id="waktu">
              <br /><br />
              <br />
            </div>

            <div class="tab-pane" id="komentar">
              <br /><br />
              <br />
            </div>

            <div class="tab-pane" id="penulis">
              <br /><br />
              <br />
            </div>

            <div class="tab-pane" id="seo">
              <br /><br />
              <br />
            </div>
          </div>
        </div>
        <div id="wrap_editor"></div>
      </div>
      <input type="hidden" name="mass_action_type" id="mass_action_type" />
      <input type="hidden" name="post_id" id="post_id" />
    </form>
  </div>

  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
    <button class="btn btn-primary" id="submit-artikel">Tambah!</button>
  </div>
</div>

<?php get_template('footer'); ?>