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
        if (isset($user_session['logged_in']) && $user_session['logged_in'] == TRUE && $user_session['group'] == 'admin') {
          redirect(set_url('dashboard'));
        }
      } else {
        if (!isset($user_session['logged_in']) or $user_session['group'] != 'admin') {
          $_this->session->sess_destroy();
          redirect(set_url('login'));
        }
      }
    } else {
      if (!isset($user_session['logged_in'])) {
        $_this->session->sess_destroy();
        redirect(set_url('user/login'));
      }
    }
  }
}
