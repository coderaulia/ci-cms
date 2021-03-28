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
}
