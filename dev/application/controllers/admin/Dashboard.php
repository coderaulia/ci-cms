<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Backend_Controller
{
  public function index()
  {
    $this->site->view('index');
  }
}
