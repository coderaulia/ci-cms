<?php get_template('header'); ?>

<div class="main">
  <div class="main-inner">
    <div class="container">

      <div class="row">
        <div class="span12">

          <div class="widget">
            <div class="widget-header">
              <i class="icon-list-alt"></i>
              <h3> Tampilan</h3>
            </div>
            <!-- /widget-content -->
            <div class="widget-content" id="wrap-tampilan">

              <p class="help-block">Template yang sedang digunakan saat ini ... </p>
              <div class="row">
                <div class="span4 single-tampilan" id="template-now">
                  <img src="<?= base_url(); ?>assets/images/blank.png" />
                  <a href="#setting" role="button" class="btn btn-primary">Setting Tampilan</a>
                </div>
              </div>

              <h3>Berikut template yang bisa Anda gunakan : </h3>
              <p class="help-block">Template yang bisa Anda gunakan, Anda pun bisa mengkostumisasinya! </p>

              <div class="row" id="list-tampilan"></div>

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
    <h3 id="myModalLabel">Setting Tampilan</h3>
  </div>

  <div class="modal-body">
    <form id="form-tampilan">

      <fieldset class="form-horizontal">
        <div class="control-group"></div>
      </fieldset>
      <input type="hidden" name="template_directory" value="" id="template_directory" />
    </form>
  </div>


  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
    <button class="btn btn-primary" id="submit-tampilan">Simpan!</button>
  </div>
</div>

<?php get_template('footer'); ?>