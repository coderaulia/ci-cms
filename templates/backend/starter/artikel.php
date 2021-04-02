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

              <fieldset class="form-horizontal">
                <div class="control-group">

                  <label class="control-label">Tanggal : dd/mm/yyyy </label>
                  <div class="controls">
                    <input type="input" id="date" name="date" value="" class="short"> /
                    <select name="month" id="month">
                      <option value="1">Januari</option>
                      <option value="2">Februari</option>
                      <option value="3">Maret</option>
                      <option value="4">April</option>
                      <option value="5">Mei</option>
                      <option value="6">Juni</option>
                      <option value="7">Juli</option>
                      <option value="8">Agustus</option>
                      <option value="9">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                    </select> /
                    <input type="input" id="year" name="year" value="" class="short">
                  </div>

                  <label class="control-label">Pukul : hh/mm </label>
                  <div class="controls">
                    <input type="input" id="hour" name="hour" value="" class="short"> /
                    <input type="input" id="minute" name="minute" value="" class="short">
                  </div>

                  <p class="help-block controls">Silahkan klik untuk mengganti waktunya ....</p>
                </div> <!-- /controls -->
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

            <div class="tab-pane" id="penulis">
              <fieldset class="form-horizontal">
                <div class="control-group">

                  <label class="control-label">Pilih Penulis</label>
                  <div class="controls">
                    <select name="post_author" id="post_author"></select>
                  </div>

                  <p class="help-block controls">Dalam artikel terdapat fitur artikel yang mengaitkan antara artikel dengan reputasi penulis nantinya....</p>
                </div> <!-- /controls -->
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