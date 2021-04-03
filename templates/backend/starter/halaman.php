<?php get_template('header'); ?>

<div class="main">
  <div class="main-inner">
    <div class="container">

      <div class="row">
        <div class="span12">
          <div class="widget">
            <div class="widget-header">
              <i class="icon-book"></i>
              <h3> Daftar Halaman</h3>
              <a class="btn btn-large btn-primary" href="<?= set_url('halaman#tambah'); ?>">Tambah Halaman</a>
            </div>

            <div class="widget-content" id="list-halaman">
              <!--<ul class="list-group halaman hirarki ui-sortable">
							    <li id="ID_2" class="list-group-item ui-sortable-handle"><a class="link-edit" href="halaman#edit?id=2">Halaman 2</a>
							        <div class="pull-right"><a href="halaman#edit?id=2" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a> <a href="halaman#hapus?id=2" id="hapus_" class="btn btn-invert btn-small"><i class="btn-icon-only icon-remove"></i> Hapus</a></div>
							    </li>
							    <li id="ID_1" class="list-group-item ui-sortable-handle"><a class="link-edit" href="halaman#edit?id=1">Halaman 1</a>
							        <div class="pull-right"><a href="halaman#edit?id=1" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a> <a href="halaman#hapus?id=1" id="hapus_" class="btn btn-invert btn-small"><i class="btn-icon-only icon-remove"></i> Hapus</a></div>
							    </li>
							</ul>-->
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"><i class="icon-plus"></i> Tambah Halaman</h3>
  </div>

  <div class="modal-body">

    <form role="form" id="form-halaman" action="tambah">

      <div class="form-group">
        <input class="input-block-level" type="text" id="post_title" name="post_title" placeholder="Tuliskan Judul Halaman Disini">

        <div class="tabbable onmodal">
          <ul class="nav nav-tabs">
            <li><a href="#hirarki" data-toggle="tab"><i class="icon-sitemap"></i> Hirarki</a></li>
            <li><a href="#komentar" data-toggle="tab"><i class="icon-comment"></i> Komentar</a></li>
            <li><a href="#seo" data-toggle="tab"><i class="icon-search"></i> SEO</a></li>
          </ul>

          <div class="tab-content">

            <div class="tab-pane" id="hirarki">
              <fieldset class="form-horizontal">
                <div class="control-group">
                  <label class="control-label">Halaman Induk</label>
                  <div class="controls">
                    <select name="post_parent" id="post_parent" class="span7">
                      <option>Pilih Halaman Induk</option>
                    </select>

                  </div>
                </div>
              </fieldset>
            </div>


            <div class="tab-pane" id="komentar">
              <fieldset class="form-horizontal">
                <div class="control-group">
                  <label class="control-label" for="komentar">Komentar</label>
                  <div class="controls">
                    <label class="checkbox inline">
                      <input type="checkbox" id="comment_status" name="comment_status" value="open" /> Aktifkan Komentar pada Artikel ini
                    </label>
                  </div> <!-- /controls -->

                  <label class="control-label" for="komentar">Notifikasi</label>
                  <div class="controls">
                    <label class="checkbox inline">
                      <input type="checkbox" id="comment_notification" name="comment_notification" value="yes" /> Email Notifikasi Untuk User dan Admin
                    </label>
                  </div> <!-- /controls -->

                  <p class="help-block controls">(notifikasi ini akan dikirimkan ke user yang telah berkomentar, diskusi terbaru dikomentar tersebut, dan juga dikirimkan ke admin)</p>
                </div> <!-- /control-group -->
              </fieldset>
            </div>

            <div class="tab-pane" id="seo">
              <fieldset class="form-horizontal">
                <div class="control-group">
                  <label class="control-label">Title</label>
                  <div class="controls">
                    <input type="text" name="meta_title" id="meta_title" value="" class="span7">

                  </div>
                  <p class="help-block controls span7">Title ini adalah meta title yang berfungsi untuk SEO Maksimal, karena search engine sangat mengedepankan meta title ini</p>

                  <label class="control-label">Meta Keyword</label>
                  <div class="controls">
                    <textarea class="span7" rows="5" name="meta_keyword" id="meta_keyword"></textarea>
                  </div>
                  <p class="help-block controls span7">Keyword (kata kunci) apa yang akan Anda bidik, agar website Anda muncul di search engine setiap kali orang mencari kata tersebut di Search Engine</p>

                  <label class="control-label">Meta Description</label>
                  <div class="controls">
                    <textarea class="span7" rows="5" name="meta_description" id="meta_description"></textarea>
                  </div>
                  <p class="help-block controls span7">Silahkan isi, Meta Description agar artikel ini memiliki SEO Score yang bagus dalam Search Engine. Dan website Anda memiliki peringkat yang bagus dalam search Engine, seperti Google maupun Bing. </p>
                </div> <!-- /controls -->
              </fieldset>
            </div>
          </div>
        </div>

        <div id="wrap_editor"></div>

      </div>


      <input type="hidden" name="post_id_hidden" id="post_id" value="0" />
    </form>
  </div>

  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
    <button class="btn btn-primary" id="submit-halaman">Tambah!</button>
  </div>

</div>
<?php get_template('footer'); ?>