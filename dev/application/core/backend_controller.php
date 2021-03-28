<?php
defined('BASEPATH') or exit('No direct script access allowed');

// ini adalah default controller untuk backend
class Backend_Controller extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->load->helper(array());
    $this->load->library(array());
    $this->load->model(array());

    // mengisikan library site -> properti side -> eksekusi via view
    $this->site->side = 'backend';
    // testing memanggil template
    $this->site->template = 'default';
  }
}
