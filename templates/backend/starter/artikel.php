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
            </div>

            <div class="widget-content">
              <!-- Button to trigger modal -->
              <a href="#myModal" role="button" class="btn" data-toggle="modal">Launch demo modal</a>

              <!-- Modal -->
              <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3 id="myModalLabel">Thank you for visiting EGrappler.com</h3>
                </div>
                <div class="modal-body">
                  <p>One fine body…</p>
                </div>
                <div class="modal-footer">
                  <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                  <button class="btn btn-primary">Save changes</button>
                </div>
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

<?php get_template('footer'); ?>