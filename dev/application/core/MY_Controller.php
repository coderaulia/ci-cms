<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Induk dari semua controller
class MY_Controller extends CI_Controller
{

  public $data = array();

  function __construct()
  {
    parent::__construct();

    $this->load->helper(array('template_helper', 'user_helper'));
    $this->load->library(array('Site', 'session'));
    $this->load->model(array('User_model'));
  }
}
