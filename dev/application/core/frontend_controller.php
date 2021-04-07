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
    $this->load->model(array('User_model', 'Artikel_model', 'Komentar_model', 'Konfigurasi_model'));
    $this->load->helper(array('inflector'));
    $this->load->library(array());

    // mengisikan library site -> properti side -> eksekusi via view
    $this->site->side = 'frontend';

    // Mengambil data setting template dari database
    $get_template_setting_db = $this->Konfigurasi_model->get_by(array('option_name' => 'template_setting'), NULL, NULL, TRUE, 'option_value');
    $template_setting = @unserialize($get_template_setting_db->option_value);

    // jika ada maka akan menggunakan template yg telah disetting
    if (!empty($template_setting['template_directory']))
      $this->site->template = $template_setting['template_directory'];
    // jika tidak maka menggunakan template "default"
    else
      $this->site->template = 'default';

    $this->site->template_setting = unserialize($template_setting['template_attribute']);


    // melakukan logging pengunjung website
    $this->site->visitor_log();
  }
}
