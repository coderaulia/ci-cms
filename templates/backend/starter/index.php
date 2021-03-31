<?php get_template('header'); ?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span6">

          <div class="widget">
            <div class="widget-header"> <i class="icon-signal"></i>
              <h3> Statistik Website</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <canvas id="area-chart" class="chart-holder" height="250" width="538"> </canvas>
              <!-- /area-chart -->
            </div>
            <!-- /widget-content -->
          </div>
          <!-- /widget -->


          <!-- /widget -->
          <!-- /widget -->
          <div class="widget">
            <div class="widget-header"> <i class="icon-file"></i>
              <h3> Komentar Terbaru</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <ul class="messages_layout">
                <li class="from_user left"> <a href="#" class="avatar"><img src="<?php echo get_template_directory(dirname(__FILE__), 'img'); ?>/message_avatar1.png" /></a>
                  <div class="message_wrap"> <span class="arrow"></span>
                    <div class="info"> <a class="name">John Smith</a> <span class="time">1 hour ago</span>
                      <div class="options_arrow">
                        <div class="dropdown pull-right"> <a class="dropdown-toggle " id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#"> <i class=" icon-caret-down"></i> </a>
                          <ul class="dropdown-menu " role="menu" aria-labelledby="dLabel">
                            <li><a href="#"><i class=" icon-share-alt icon-large"></i> Reply</a></li>
                            <li><a href="#"><i class=" icon-trash icon-large"></i> Delete</a></li>
                            <li><a href="#"><i class=" icon-share icon-large"></i> Share</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="text"> As an interesting side note, as a head without a body, I envy the dead. There's one way and only one way to determine if an animal is intelligent. Dissect its brain! Man, I'm sore all over. I feel like I just went ten rounds with mighty Thor. </div>
                  </div>
                </li>
                <li class="from_user left"> <a href="#" class="avatar"><img src="<?php echo get_template_directory(dirname(__FILE__), 'img'); ?>/message_avatar1.png" /></a>
                  <div class="message_wrap"> <span class="arrow"></span>
                    <div class="info"> <a class="name">Celeste Holm </a> <span class="time">1 Day ago</span>
                      <div class="options_arrow">
                        <div class="dropdown pull-right"> <a class="dropdown-toggle " id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#"> <i class=" icon-caret-down"></i> </a>
                          <ul class="dropdown-menu " role="menu" aria-labelledby="dLabel">
                            <li><a href="#"><i class=" icon-share-alt icon-large"></i> Reply</a></li>
                            <li><a href="#"><i class=" icon-trash icon-large"></i> Delete</a></li>
                            <li><a href="#"><i class=" icon-share icon-large"></i> Share</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="text"> And I'd do it again! And perhaps a third time! But that would be it. Are you crazy? I can't swallow that. And I'm his friend Jesus. No, I'm Santa Claus! And from now on you're all named Bender Jr. </div>
                  </div>
                </li>
                <li class="from_user left"> <a href="#" class="avatar"><img src="<?php echo get_template_directory(dirname(__FILE__), 'img'); ?>/message_avatar1.png" /></a>
                  <div class="message_wrap"> <span class="arrow"></span>
                    <div class="info"> <a class="name">Mark Jobs </a> <span class="time">2 Days ago</span>
                      <div class="options_arrow">
                        <div class="dropdown pull-right"> <a class="dropdown-toggle " id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#"> <i class=" icon-caret-down"></i> </a>
                          <ul class="dropdown-menu " role="menu" aria-labelledby="dLabel">
                            <li><a href="#"><i class=" icon-share-alt icon-large"></i> Reply</a></li>
                            <li><a href="#"><i class=" icon-trash icon-large"></i> Delete</a></li>
                            <li><a href="#"><i class=" icon-share icon-large"></i> Share</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="text"> That's the ONLY thing about being a slave. Now, now. Perfectly symmetrical violence never solved anything. Uh, is the puppy mechanical in any way? As an interesting side note, as a head without a body, I envy the dead. </div>
                  </div>
                </li>
                <li class="from_user left"> <a href="#" class="avatar"><img src="<?php echo get_template_directory(dirname(__FILE__), 'img'); ?>/message_avatar1.png" /></a>
                  <div class="message_wrap"> <span class="arrow"></span>
                    <div class="info"> <a class="name">Celeste Holm </a> <span class="time">1 Day ago</span>
                      <div class="options_arrow">
                        <div class="dropdown pull-right"> <a class="dropdown-toggle " id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#"> <i class=" icon-caret-down"></i> </a>
                          <ul class="dropdown-menu " role="menu" aria-labelledby="dLabel">
                            <li><a href="#"><i class=" icon-share-alt icon-large"></i> Reply</a></li>
                            <li><a href="#"><i class=" icon-trash icon-large"></i> Delete</a></li>
                            <li><a href="#"><i class=" icon-share icon-large"></i> Share</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="text"> And I'd do it again! And perhaps a third time! But that would be it. Are you crazy? I can't swallow that. And I'm his friend Jesus. No, I'm Santa Claus! And from now on you're all named Bender Jr. </div>
                  </div>
                </li>
              </ul>
            </div>
            <!-- /widget-content -->
          </div>
          <!-- /widget -->
        </div>
        <!-- /span6 -->
        <div class="span6">

          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3> Statistik Hari Ini</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                <div class="widget-content">
                  <p class="bigstats">Berikut ringkasan statistik hari ini mulai dari visitor, facebook like+share, twitter share, dan persentase interaksi visitor</p>
                  <div id="big_stats" class="cf">
                    <div class="stat"> <i class="icon-anchor"></i> <span class="value">0</span> </div>
                    <!-- .stat -->

                    <div class="stat"> <i class="icon-thumbs-up-alt"></i> <span class="value">0</span> </div>
                    <!-- .stat -->

                    <div class="stat"> <i class="icon-twitter-sign"></i> <span class="value">0</span> </div>
                    <!-- .stat -->

                    <div class="stat"> <i class="icon-bullhorn"></i> <span class="value">0%</span> </div>
                    <!-- .stat -->
                  </div>
                </div>
                <!-- /widget-content -->

              </div>
            </div>
          </div>

          <div class="widget">
            <div class="widget-header"> <i class="icon-bookmark"></i>
              <h3>Shortcuts</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="shortcuts"> <a href="javascript:;" class="shortcut"><i class="shortcut-icon icon-file"></i><span class="shortcut-label">Tambah Artikel</span> </a><a href="javascript:;" class="shortcut"><i class="shortcut-icon icon-shopping-cart"></i><span class="shortcut-label">Pesanan</span> </a><a href="javascript:;" class="shortcut"><i class="shortcut-icon icon-signal"></i> <span class="shortcut-label">Statistik</span> </a><a href="javascript:;" class="shortcut"> <i class="shortcut-icon icon-comments-alt"></i><span class="shortcut-label">Komentar</span> </a><a href="javascript:;" class="shortcut"><i class="shortcut-icon icon-user"></i><span class="shortcut-label">Member</span> </a><a href="javascript:;" class="shortcut"><i class="shortcut-icon icon-gift"></i><span class="shortcut-label">Tambah Produk</span> </a><a href="javascript:;" class="shortcut"><i class="shortcut-icon icon-list-alt"></i><span class="shortcut-label">Ganti Tampilan</span> </a><a href="javascript:;" class="shortcut"><i class="shortcut-icon icon-bell"></i><span class="shortcut-label">Konfirmasi</span> </a></div>
              <!-- /shortcuts -->
            </div>
            <!-- /widget-content -->
          </div>
          <!-- /widget -->

          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3> Recent News</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <ul class="news-items">
                <li>

                  <div class="news-item-date"> <span class="news-item-day">29</span> <span class="news-item-month">Aug</span> </div>
                  <div class="news-item-detail"> <a href="http://www.egrappler.com/thursday-roundup-40/" class="news-item-title" target="_blank">Thursday Roundup # 40</a>
                    <p class="news-item-preview"> This is our web design and development news series where we share our favorite design/development related articles, resources, tutorials and awesome freebies. </p>
                  </div>

                </li>
                <li>

                  <div class="news-item-date"> <span class="news-item-day">15</span> <span class="news-item-month">Jun</span> </div>
                  <div class="news-item-detail"> <a href="http://www.egrappler.com/retina-ready-responsive-app-landing-page-website-template-app-landing/" class="news-item-title" target="_blank">Retina Ready Responsive App Landing Page Website Template – App Landing</a>
                    <p class="news-item-preview"> App Landing is a retina ready responsive app landing page website.</p>
                  </div>

                </li>
                <li>

                  <div class="news-item-date"> <span class="news-item-day">29</span> <span class="news-item-month">Oct</span> </div>
                  <div class="news-item-detail"> <a href="http://www.egrappler.com/open-source-jquery-php-ajax-contact-form-templates-with-captcha-formify/" class="news-item-title" target="_blank">Open Source jQuery PHP Ajax Contact Form Templates With Captcha: Formify</a>
                    <p class="news-item-preview"> Formify is a contribution to lessen the pain of creating contact forms. The collection contains six different forms that are commonly used. These open source contact forms can be customized as well to suit the need for your website/application.</p>
                  </div>

                </li>
              </ul>
            </div>
            <!-- /widget-content -->
          </div>
          <!-- /widget -->
        </div>
        <!-- /span6 -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /main-inner -->
</div>
<script>var myLine = new Chart(
	document.getElementById("area-chart").getContext("2d")
).Line(lineChartData);
</script>
<?php get_template('footer'); ?>