<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel extends Backend_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Artikel_model'));
  }

  public function index()
  {
    $data = array();
    $this->site->view('artikel', $data);
  }

  public function action($param)
  {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest") {
      if ($param == 'tambah') {
        $rules = $this->Artikel_model->rules;
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
          $post = $this->input->post();
          $data = array(
            'post_author' => get_user_info('ID'),
            'post_title' => $post['post_title'],
            'post_name' => url_title($post['post_title'], '-', TRUE),
            'post_content' => $post['post_content'],
            'post_date' => date('Y-m-d H:i:s')
          );

          if ($this->Artikel_model->insert($data)) {
            $result = array('status' => 'success');
          } else {
            $result = array('status' => 'failed');
          }
        } else {
          $result = array('status' => 'failed');
        }

        echo json_encode($result);
      }
    }
  }
}
