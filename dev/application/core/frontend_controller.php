<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Pada dasarnya ini adalah default controller untuk frontend
class Frontend_Controller extends MY_Controller
{
  function __construct()
  {
    parent::__construct();
    // contoh melemparkan data (dari MY_Controller) ke Welcome Controller 
    // $this->data['site_name'] = 'My Website';

    // Akan berlaku ke semua controller yg menginduk ke Frontend Controller
    $this->load->model(array('User_model'));
  }
}
