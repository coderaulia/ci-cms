<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site
{
  //properti digunakan untuk method bawaan CI: view, sesuai apa yg didefinisikan di backend atau frontend controller
  public $side;
  public $template;
  public $template_setting;
  public $website_setting;
  public $_isHome = FALSE;
  public $_isCategory = FALSE;
  public $_isSearch = FALSE;
  public $_isDetail = FALSE;

  function view($pages, $data = NULL)
  {
    $_this = &get_instance();

    $data ?
      //memanggil side (backend/frontend), lalu memanggil template (cyan/default), ex: backend/cyan/index
      $_this->load->view($this->side . '/' . $this->template . '/' . $pages, $data)
      : $_this->load->view($this->side . '/' . $this->template . '/' . $pages);
  }

  function is_logged_in()
  {
    $_this = &get_instance();

    $user_session = $_this->session->userdata;

    if ($this->side == 'backend') {
      if ($_this->uri->segment(2) == 'login') {
        //redirect jika mengakses login tapi punya session dan statusnya admin
        if (isset($user_session['logged_in']) && $user_session['logged_in'] == TRUE && $user_session['group'] == 'admin') {
          redirect(set_url('dashboard'));
        }

        // restriksi jika mengakses laman admin tanpa session login dan status admin
      } else {
        if (!isset($user_session['logged_in']) || $user_session['group'] != 'admin') {
          $_this->session->sess_destroy();
          redirect(set_url('login'));
        }
      }

      // user side (frontend)
    } else {
      if (!isset($user_session['logged_in'])) {
        $_this->session->sess_destroy();
        redirect(set_url('user/login'));
      }
    }
  }

  function visitor_log()
  {

    $_this = &get_instance();
    $_this->load->library('user_agent');
    $_this->load->model('Statistik_model');

    if ((!$_this->session->userdata('user_online'))) {
      $sessId = session_id();

      //$ip = $_SERVER['REMOTE_ADDR']; ketika sudah diupload ke hosting
      $ip = '112.215.36.142'; // IP dummy
      //$ip = '127.0.0.1';
      $date = date('Y-m-d H:i:s');
      $agent = $_this->agent->agent_string();
      (!empty($_SERVER['HTTP_REFERER'])) ? $reff = $_SERVER['HTTP_REFERER'] : $reff = '';

      // gunakan IP dari API untuk data detailnya
      @$var = file_get_contents("http://ip-api.com/json/$ip");
      $var = json_decode($var);

      $visitorLogs = array(
        'visitor_IP' => $var->query,
        'visitor_IP' => $ip,
        'visitor_referer' => $reff,
        'visitor_date' => $date,
        'visitor_agent' => $agent,
        'visitor_session' => $sessId,
        'visitor_city' => @$var->city,
        'visitor_region' => @$var->regionName,
        'visitor_country' => @$var->country,
        'visitor_os' => $_this->agent->platform(),
        'visitor_browser' => $_this->agent->browser() . ' ' . $_this->agent->version(),
        'visitor_isp' => @$var->isp
      );

      $_this->Statistik_model->insert($visitorLogs);

      $_this->session->set_userdata(array('user_online' => session_id()));
    }

    return TRUE;
  }
}
