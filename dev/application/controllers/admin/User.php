<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends Backend_Controller
{

  protected $user_detail;

  public function __construct()
  {
    parent::__construct();
  }

  public function login()
  {
    //posting with xss filter
    $post = $this->input->post(NULL, TRUE);

    if (isset($post['username'])) {
      $this->user_detail = $this->User_model->get_by(
        array('username' => $post['username'], 'group' => 'admin'),
        1,
        NULL,
        TRUE

      );
    }

    $this->form_validation->set_message('required', '%s masih kosong nih, tolong diisi ya!');
    $rules = $this->User_model->rules; //memanggil rules yg sudah didefinisikan di User_model
    $this->form_validation->set_rules($rules);

    if ($this->form_validation->run() == FALSE) {

      $this->site->view('login');
    } else {
      $login_data = array(
        'ID' => $this->user_detail->ID,
        'username' => $post['username'],
        'logged_in' => TRUE,
        'active' =>  $this->user_detail->active,
        'last_login' => $this->user_detail->last_login,
        'group' => $this->user_detail->group,
        'email' => $this->user_detail->email
      );

      $this->session->set_userdata($login_data);

      // jika "ingat saya" dicentang, maka set cookie
      if (isset($post['remember'])) {
        $expire = time() + (86400 * 7); // dalam waktu 7 hari
        set_cookie('password', $post['password'], $expire, "/");
        set_cookie('username', $post['username'], $expire, "/");
      }

      redirect(set_url('dashboard'));
    }
  }

  public function password_check($str)
  {
    $user_detail = $this->user_detail;
    if (@$user_detail->password == crypt($str, @$user_detail->password)) {
      return TRUE;
    } elseif (@$user_detail->password) {
      $this->form_validation->set_message('password_check', 'Password salah!');
      return FALSE;
    } else {
      $this->form_validation->set_message('password_check', 'Anda tidak memiliki akses ke Admin Panel!');
      return FALSE;
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect(set_url('login'));
  }

  // mengambil data user, dengan ajax
  public function action($param1, $param2 = NULL)
  {
    global $SConfig;
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      if ($param1 == 'ambil') {
        $record = $this->User_model->get_by(NULL, NULL, NULL, FALSE, $param2);
        echo json_encode(array('record' => $record));
      }
    }
  }

  // public function temporary_register()
  // {
  //   $data_user = array(
  //     'username' => 'admin',
  //     'group' => 'admin',
  //     'password' => bCrypt('admin', 12),
  //     'email' => 'admin@coderaulia.com',
  //     'active' => 1
  //   );

  //   $this->User_model->insert($data_user);
  // }
}
