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
    global $SConfig;
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest") {
      if ($param == 'tambah' || $param == 'update') {
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

          //mengatur jika ada ID maka update
          if (!empty($post['post_id'])) {
            $this->Artikel_model->update($data, array('post_ID' => $post['post_id']));
            $result = array('status' => 'success');
          } else {
            // jika tidak ada ID maka akan insert data
            if ($this->Artikel_model->insert($data)) {
              $result = array('status' => 'success');
            } else {
              $result = array('status' => 'failed');
            }
          }
        } else {
          $result = array('status' => 'failed', 'errors' => $this->form_validation->error_array);
        }

        echo json_encode($result);
      } else if ($param == 'ambil') {
        $post = $this->input->post(NULL, TRUE);

        // Mengambil ID dari post
        if (!empty($post['id'])) {
          echo json_encode(array(
            'status' => 'success',
            'data' => $this->Artikel_model->get($post['id'])
          ));
        } else {

          $total_rows = $this->Artikel_model->count();
          $offset = NULL;

          if (!empty($post['hal_aktif']) && $post['hal_aktif'] > 1) {
            $offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;
          }

          $record = $this->Artikel_model->get_by(NULL, $SConfig->_backend_perpage, $offset);

          //mengambil record dari db ke json
          echo json_encode(
            array(
              'total_rows' => $total_rows,
              'perpage' => $SConfig->_backend_perpage,
              'record' => $record
            )
          );
        }
      }
    }
  }
}
