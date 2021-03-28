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

  public function temporary_register()
  {
    $data_user = array(
      'username' => 'admin',
      'group' => 'admin',
      'password' => bCrypt('admin', 12),
      'email' => 'admin@coderaulia.com',
      'active' => 1

    );
  }
}
