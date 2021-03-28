<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends Backend_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function login()
  {
    $this->site->view('login');
  }
}
