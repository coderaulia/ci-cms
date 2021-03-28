<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Dashboard - Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link href="<?php echo get_template_directory(dirname(__FILE__), 'css/'); ?>bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo get_template_directory(dirname(__FILE__), 'css/'); ?>bootstrap-responsive.min.css" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
  <link href="<?php echo get_template_directory(dirname(__FILE__), 'css/'); ?>font-awesome.css" rel="stylesheet">
  <link href="<?php echo get_template_directory(dirname(__FILE__), 'css/'); ?>style.css" rel="stylesheet">
  <link href="<?php echo get_template_directory(dirname(__FILE__), 'css/'); ?>pages/dashboard.css" rel="stylesheet">
  <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
  <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="index.html">Admin Panel </a>
        <div class="nav-collapse">
          <ul class="nav pull-right">
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i> Account <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="javascript:;">Settings</a></li>
                <li><a href="javascript:;">Help</a></li>
              </ul>
            </li>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> EGrappler.com <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="javascript:;">Profile</a></li>
                <li><a href="javascript:;">Logout</a></li>
              </ul>
            </li>
          </ul>
          <form class="navbar-search pull-right">
            <input type="text" class="search-query" placeholder="Search">
          </form>
        </div>
        <!--/.nav-collapse -->
      </div>
      <!-- /container -->
    </div>
    <!-- /navbar-inner -->
  </div>
  <!-- /navbar -->
  <div class="subnavbar">
    <div class="subnavbar-inner">
      <div class="container">
        <ul class="mainnav">
          <li class="active"><a href="index.html"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
          <li><a href="reports.html"><i class="icon-list-alt"></i><span>Reports</span> </a> </li>
          <li><a href="guidely.html"><i class="icon-facetime-video"></i><span>App Tour</span> </a></li>
          <li><a href="charts.html"><i class="icon-bar-chart"></i><span>Charts</span> </a> </li>
          <li><a href="shortcodes.html"><i class="icon-code"></i><span>Shortcodes</span> </a> </li>
          <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-long-arrow-down"></i><span>Drops</span> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="icons.html">Icons</a></li>
              <li><a href="faq.html">FAQ</a></li>
              <li><a href="pricing.html">Pricing Plans</a></li>
              <li><a href="login.html">Login</a></li>
              <li><a href="signup.html">Signup</a></li>
              <li><a href="error.html">404</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- /container -->
    </div>
    <!-- /subnavbar-inner -->
  </div>
  <!-- /subnavbar -->
  <div class="main">
    <div class="main-inner">
      <div class="container">
        <div class="row">
          <div class="span6">

            <div class="widget">
              <div class="widget-header"> <i class="icon-signal"></i>
                <h3> Statistik Website (23 - 29 Maret 2016)</h3>
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
  <!-- /main -->
  <!-- /main -->

  <div class="footer">
    <div class="footer-inner">
      <div class="container">
        <div class="row">
          <div class="span12"> &copy; 2016 <a href="http://www.ilmuwebsite.com/">Ilmuwebsite.com</a> </div>
          <!-- /span12 -->
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /footer-inner -->
  </div>
  <!-- /footer -->
  <!-- Le javascript
================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="<?php echo get_template_directory(dirname(__FILE__), 'js/'); ?>jquery-1.7.2.min.js"></script>
  <script src="<?php echo get_template_directory(dirname(__FILE__), 'js/'); ?>excanvas.min.js"></script>
  <script src="<?php echo get_template_directory(dirname(__FILE__), 'js/'); ?>chart.min.js" type="text/javascript"></script>
  <script src="<?php echo get_template_directory(dirname(__FILE__), 'js/'); ?>bootstrap.js"></script>
  <script language="javascript" type="text/javascript" src="<?php echo get_template_directory(dirname(__FILE__), 'js/'); ?>full-calendar/fullcalendar.min.js"></script>

  <script src="<?php echo get_template_directory(dirname(__FILE__), 'js/'); ?>base.js"></script>
  <script>
    var lineChartData = {
      labels: ["January", "February", "March", "April", "May", "June", "July"],
      datasets: [{
          fillColor: "rgba(220,220,220,0.5)",
          strokeColor: "rgba(220,220,220,1)",
          pointColor: "rgba(220,220,220,1)",
          pointStrokeColor: "#fff",
          data: [65, 59, 90, 81, 56, 55, 40]
        },
        {
          fillColor: "rgba(151,187,205,0.5)",
          strokeColor: "rgba(151,187,205,1)",
          pointColor: "rgba(151,187,205,1)",
          pointStrokeColor: "#fff",
          data: [28, 48, 40, 19, 96, 27, 100]
        }
      ]

    }

    var myLine = new Chart(document.getElementById("area-chart").getContext("2d")).Line(lineChartData);


    var barChartData = {
      labels: ["January", "February", "March", "April", "May", "June", "July"],
      datasets: [{
          fillColor: "rgba(220,220,220,0.5)",
          strokeColor: "rgba(220,220,220,1)",
          data: [65, 59, 90, 81, 56, 55, 40]
        },
        {
          fillColor: "rgba(151,187,205,0.5)",
          strokeColor: "rgba(151,187,205,1)",
          data: [28, 48, 40, 19, 96, 27, 100]
        }
      ]

    }

    $(document).ready(function() {
      var date = new Date();
      var d = date.getDate();
      var m = date.getMonth();
      var y = date.getFullYear();
      var calendar = $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        selectable: true,
        selectHelper: true,
        select: function(start, end, allDay) {
          var title = prompt('Event Title:');
          if (title) {
            calendar.fullCalendar('renderEvent', {
                title: title,
                start: start,
                end: end,
                allDay: allDay
              },
              true // make the event "stick"
            );
          }
          calendar.fullCalendar('unselect');
        },
        editable: true,
        events: [{
            title: 'All Day Event',
            start: new Date(y, m, 1)
          },
          {
            title: 'Long Event',
            start: new Date(y, m, d + 5),
            end: new Date(y, m, d + 7)
          },
          {
            id: 999,
            title: 'Repeating Event',
            start: new Date(y, m, d - 3, 16, 0),
            allDay: false
          },
          {
            id: 999,
            title: 'Repeating Event',
            start: new Date(y, m, d + 4, 16, 0),
            allDay: false
          },
          {
            title: 'Meeting',
            start: new Date(y, m, d, 10, 30),
            allDay: false
          },
          {
            title: 'Lunch',
            start: new Date(y, m, d, 12, 0),
            end: new Date(y, m, d, 14, 0),
            allDay: false
          },
          {
            title: 'Birthday Party',
            start: new Date(y, m, d + 1, 19, 0),
            end: new Date(y, m, d + 1, 22, 30),
            allDay: false
          },
          {
            title: 'EGrappler.com',
            start: new Date(y, m, 28),
            end: new Date(y, m, 29),
            url: 'http://EGrappler.com/'
          }
        ]
      });
    });
  </script><!-- /Calendar -->
</body>

</html>