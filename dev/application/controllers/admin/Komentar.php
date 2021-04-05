<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Komentar extends Backend_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Komentar_model'));
  }

  public function index()
  {
    $data = array();
    $this->site->view('komentar', $data);
  }

  public function action($param)
  {
    global $SConfig;
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      if ($param == 'update') {
        $post = $this->input->post(NULL, TRUE);
        $rules = $this->Komentar_model->rules;
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
          $post = $this->input->post();
          $data = array(
            'comment_author_name'   => $post['comment_author_name'],
            'comment_author_email'   => $post['comment_author_email'],
            'comment_author_url'   => $post['comment_author_url'],
            'comment_content'     => $post['comment_content'],
            'comment_approved'     => $post['comment_approved'],
          );


          if (!empty($post['comment_ID'])) {
            $this->Komentar_model->update($data, array('comment_ID' => $post['comment_ID']));
            $result = array('status' => 'success');
          }
        } else {
          $result = array('status' => 'failed', 'errors' => $this->form_validation->error_array());
        }

        echo json_encode($result);
      } else if ($param == 'ambil') {
        $post = $this->input->post(NULL, TRUE);


        if (!empty($post['id'])) {
          $record = $this->Komentar_model->get($post['id']);
          echo json_encode(array('status' => 'success', 'data' => $record));
        } else {


          $offset = NULL;

          if (!empty($post['hal_aktif']) && $post['hal_aktif'] > 1)
            $offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;

          if (!empty($post['cari']) && ($post['cari'] != 'null')) {
            $cari = $post['cari'];
            $total_rows = $this->Komentar_model->count(array("comment_content LIKE" => "%$cari%"));
            $record = $this->Komentar_model->get_komentar(array("comment_content LIKE" => "%$cari%"), $SConfig->_backend_perpage, $offset);
          } else {
            $total_rows = $this->Komentar_model->count();
            $record = $this->Komentar_model->get_komentar(NULL, $SConfig->_backend_perpage, $offset);
          }

          echo json_encode(
            array(
              'total_rows' => $total_rows,
              'perpage' => $SConfig->_backend_perpage,
              'record' => $record,
            )
          );
        }
      } else if ($param == 'edit') {
      } else if ($param == 'hapus') {
        $post = $this->input->post();
        if (!empty($post['comment_ID'])) {
          $this->Komentar_model->delete($post['comment_ID']);
          $result = array('status' => 'success');
        }

        echo json_encode($result);
      } else if ($param == 'mass') {
        $post = $this->input->post(NULL, TRUE);
        if ($post['mass_action_type'] == 'hapus') {
          if (count($post['comment_ID']) > 0) {
            foreach ($post['comment_ID'] as $id)
              $this->Komentar_model->delete($id);
            $result = array('status' => 'success');
            echo json_encode($result);
          }
        } else if ($post['mass_action_type'] == 'pending' || $post['mass_action_type'] == 'publish') {
          if (count(@$post['comment_ID']) > 0) {
            foreach ($post['comment_ID'] as $id)
              $this->Komentar_model->update(array('comment_approved' => $post['mass_action_type']), array('comment_ID' => $id));
            $result = array('status' => 'success');
            echo json_encode($result);
          }
        }
      }
    }
  }
}
