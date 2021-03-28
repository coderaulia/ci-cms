<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel extends Backend_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data = array();
    $this->site->view('artikel', $data);
  }
}
