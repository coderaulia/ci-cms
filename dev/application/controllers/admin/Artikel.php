<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel extends Backend_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Artikel_model', 'Kategori_model'));
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
          $category = 'tanpa-kategori';
          if (!empty($post['category_slug'])) $category = implode(",", $post['category_slug']);

          $data = array(
            'post_author' => get_user_info('ID'),
            'post_title' => $post['post_title'],
            'post_name' => url_title($post['post_title'], '-', TRUE),
            'post_content' => $post['post_content'],
            'post_date' => date('Y-m-d H:i:s'),
            'post_type' => 'artikel',
            'post_category' => $category
          );

          // jika ada id maka akan update
          if (!empty($post['post_id'])) {
            $this->Artikel_model->update($data, array('post_ID' => $post['post_id']));
            $result = array('status' => 'success');
          } else {
            /* jika ada judul artikel yang sama, maka berikan imbuhan 2 di belakangnya */
            $is_exist = $this->Artikel_model->count(array('post_title' => $data['post_title']));
            if ($is_exist > 0) {
              $data['post_title'] = $data['post_title'] . ' 2';
              $data['post_name'] = url_title($data['post_title'], '-', TRUE);
              unset($data['post_date']);
            }
            $this->Artikel_model->insert($data);
            $result = array('status' => 'success');
          }
        } else {
          $result = array('status' => 'failed', 'errors' => $this->form_validation->error_array());
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
      } else if ($param == 'hapus') {

        $post = $this->input->post(NULL, TRUE);
        if (!empty($post['post_id'])) {
          $this->Artikel_model->delete($post['post_id']);
          $result = array(
            'status' => 'success'
          );
        }
        echo json_encode($result);
      }
    }
  }

  public function kategori($action = '')
  {
    global $SConfig;
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      if ($action == 'tambah' || $action == 'update') {
        $rules = $this->Kategori_model->rules;
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
          $post = $this->input->post();

          // jika tidak ada ID maka akan insert
          $data = array(
            'category_name' => xss_clean($post['category_name']),
            'category_slug' => url_title($post['category_name'], '-', TRUE),
            'category_description' => $post['category_description'],
            'category_parent' => $post['category_parent'],
            'category_type' => 'artikel'
          );

          // jika ada ID maka akan update
          if (!empty($post['category_id'])) {
            $this->Kategori_model->update($data, array('category_ID' => $post['category_id']));
          } else {
            // ditambahkan "2" jika namanya sama
            $is_exist = $this->Kategori_model->count(array('category_name' => $data['category_name']));
            if ($is_exist > 0) {
              $data['category_name'] = $data['category_name'] . ' 2';
              $data['category_slug'] = url_title($data['category_name'], '-', TRUE);
            }
            $this->Kategori_model->insert($data);
          }

          $result = array('status' => 'success');

          echo json_encode($result);
        } else {
          echo json_encode(array('status' => 'failed'));
        }
      } else if ($action == 'ambil') {
        $post = $this->input->post(NULL, TRUE);

        if (!empty($post['id'])) {
          echo json_encode(array('data' => $this->Kategori_model->get($post['id'])));
        } else {
          $record = $this->Kategori_model->get();
          echo json_encode(array('record' => $record));
        }
      } else if ($action == 'hapus') {
        $post = $this->input->post();
        if (!empty($post['category_id'])) {
          $this->Kategori_model->delete($post['category_id']);
          // Jika ada child category, maka keduanya akan dihapus
          $this->Kategori_model->delete_by(array('category_parent' => $post['category_id']));
          $result = array('status' => 'success');
        }

        echo json_encode($result);

        // Mengatur hierarki jika kategori disortir
      } else if ($action == 'sortir') {
        $post = $this->input->post(NULL, TRUE);
        foreach ($post['ID'] as $sort => $id)
          $this->Kategori_model->update(array('category_sort' => $sort + 1), array('category_ID' => $id));
      }
    } else {
      $data = array();
      $this->site->view('kategori_artikel', $data);
    }
  }
}
