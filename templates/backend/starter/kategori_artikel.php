<?php get_template('header'); ?>

<div class="main">
  <div class="main-inner">
    <div class="container">

      <div class="row">
        <div class="span12">

          <div class="widget">
            <div class="widget-header">
              <i class="icon-file"></i>
              <h3> Daftar Kategori</h3>
              <a class="btn btn-default btn-big" href="<?= set_url('artikel/kategori#tambah'); ?>">Tambah Kategori</a>

            </div>
            <!-- /widget-content -->
            <div class="widget-content" id="list-kategori">

              <ul class="list-group hirarki kategori">
                <li id="ID_9" class="list-group-item "><a class="link-edit" href="kategori#edit?id=9">Bisnis</a>
                  <div class="pull-right"><a href="kategori#edit?id=9" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a> <a href="kategori#hapus?id=9" id="hapus_" class="btn btn-invert btn-small"><i class="btn-icon-only icon-remove"></i> Hapus</a></div>
                </li>
                <li id="ID_2" class="list-group-item li-parent"><a class="link-edit" href="kategori#edit?id=2">Desain</a>
                  <div class="pull-right"><a href="kategori#edit?id=2" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a> <a href="kategori#hapus?id=2" id="hapus_" class="btn btn-invert btn-small"><i class="btn-icon-only icon-remove"></i> Hapus</a></div>
                  <ul class="list-group hirarki kategori">
                    <li id="ID_8" class="list-group-item"><a class="link-edit" href="kategori#edit?id=8">Coloring</a>
                      <div class="pull-right"><a href="kategori#edit?id=8" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a> <a href="kategori#hapus?id=8" id="hapus_" class="btn btn-invert btn-small"><i class="btn-icon-only icon-remove"></i> Hapus</a></div>
                    </li>
                  </ul>
                </li>
              </ul>

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
    <h3 id="myModalLabel"><i class="icon-plus"></i> Tambah Kategori</h3>
  </div>

  <div class="modal-body">
    <form role="form" id="form-kategori-artikel" action="tambah">
      <div class="form-group">
        <input class="input-block-level title" type="text" id="category_name" name="category_name" placeholder="Tuliskan Kategori di sini">
        <textarea class="form-control input-block-level" name="category_description" rows="7" id="category_description" placeholder="Deskripsi kategorinya di sini"></textarea>
        <select class="input-block-level" name="category_parent" id="category_parent">
          <option value="">Pilih Induk Kategori</option>
        </select>
      </div>

      <input type="hidden" name="category_id" id="category_id" />
    </form>
  </div>

  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
    <button class="btn btn-primary" id="submit-kategori-artikel">Tambah!</button>
  </div>
</div>

<?php get_template('footer'); ?>