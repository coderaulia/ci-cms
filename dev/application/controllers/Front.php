<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Front extends Frontend_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data = array();

    // memanggil template default/yg dipilih
    $this->site->view('index', $data);
  }

  // fungsi mengirim komentar
  public function komentar()
  {
    $this->load->model(array('Komentar_model'));
    $this->load->library(array('form_validation', 'user_agent'));
    $serv = $_SERVER;

    $rules = $this->Komentar_model->rules;
    $this->form_validation->set_rules($rules);
    if ($this->form_validation->run() == TRUE) {
      $post = $this->input->post(NULL, TRUE);
      $data = array(
        'comment_post_ID'     => $post['post_ID'],
        'comment_author_name'   => $post['comment_author_name'],
        'comment_author_email'   => $post['comment_author_email'],
        'comment_author_url'   => $post['comment_author_url'],
        'comment_author_IP'   => $serv['REMOTE_ADDR'],
        'comment_date'       => date('Y-m-d H:i:s'),
        'comment_content'     => $post['comment_content'],
        'comment_approved'     => 'pending',
        'comment_agent'     => $this->agent->agent_string(),
      );

      if (!empty($post['post_ID'])) {
        $this->Komentar_model->insert($data);
      }

      $status = array('status' => 'success', 'message' => 'Terima kasih! Komentar Anda segera dimoderasi');
      $this->session->set_flashdata($status);
    } else {
      $status = array_merge(array('status' => 'error'), $this->form_validation->error_array());
      $this->session->set_flashdata($status);
      $statusnya = $this->session->flashdata();
    }
    redirect($serv['HTTP_REFERER'] . '#form-komentar');
  }
}
