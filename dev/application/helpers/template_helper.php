<?php

function get_template_directory($path, $dir_file)
{
  global $SConfig;

  $replace_path = str_replace('\\', '/', $path);
  $get_digit_doc_root = strlen($SConfig->_document_root);
  $full_path = substr($replace_path, $get_digit_doc_root);
  return $SConfig->_site_url . $full_path . '/' . $dir_file;
}

function get_template($view)
{
  $_this = &get_instance();

  return $_this->site->view($view);
}

// Fungsi untuk mengatur folder admin jika berada di backend side
function set_url($sub)
{
  $_this = &get_instance();
  if ($_this->site->side == 'backend') {
    return site_url('admin/' . $sub);
  } else {
    return site_url($sub);
  }
}

// Fungsi untuk mengatur css class active
function is_active_page_print($page, $class)
{
  $_this = &get_instance();
  if ($_this->site->side == 'backend' && $page == $_this->uri->segment(2)) {
    return $class;
  }
}

// Fungsi dynamic title
function title()
{
  $_this = &get_instance();
  global $SConfig;

  $array_backend_page = array(
    'dashboard'     => 'Dashboard',
    'artikel'     => 'Kelola Artikel',
    'halaman'     => 'Kelola Laman',
    'produk'     => 'Kelola Produk',
    'komentar'     => 'Kelola Komentar',
    'tampilan'     => 'Pengaturan Tampilan',
    'konfigurasi'     => 'Pengaturan',
    'user'     => 'Kelola User'
  );

  $title = NULL;
  if ($_this->site->side == 'backend' && (array_key_exists($_this->uri->segment(2), $array_backend_page))) {
    return $array_backend_page[$_this->uri->segment(2)] . " - " . $SConfig->_cms_name;
  }
}

// Frontend 

function have_post($tipe = NULL)
{
  global $post;
  global $SConfig;
  $_this = &get_instance();

  $perpage = $SConfig->_frontend_perpage;
  $have_post = FALSE;
  $result = '';
  $offset = 0;

  if ($_this->uri->segment(2) == 'hal') {
    (!empty($_this->uri->segment(3))) ? $offset = ($_this->uri->segment(3) - 1) * $perpage : $offset = 0;
    $array_where = array('post_status' => 'publish');
  } else {
    (!empty($_this->uri->segment(4))) ? $offset = ($_this->uri->segment(4) - 1) * $perpage : $offset = 0;
    $kategori = $_this->uri->segment(2);
    $array_where = array('post_status' => 'publish', "post_category LIKE" => "%$kategori%");
  }


  // Memilih tipe "post" jika didefinisikan dalam tbl
  if (!empty($tipe)) {
    $result = $_this->Artikel_model->get_artikel($array_where, $perpage, $offset);
  }

  // jika resultnya ada, maka...
  if (count($result) > 0) {
    $post = $result;
    $have_post = TRUE;
  }


  return $have_post;
}

function post()
{
  global $post;
  return $post;
}

function permalink($post = NULL, $category = NULL)
{
  $url = NULL;

  if (!empty($category)) {
    $url = set_url($post->post_type) . '/' . $category;
  } else {
    if (!empty($post->post_category)) {
      $split_category = explode(',', $post->post_category);
      (count($split_category) > 0) ? $category = $split_category[0] : $category = $post->post_category;
      $url = set_url($post->post_type) . '/' . $category . '/' . $post->post_name;
    }
  }

  return $url;
}

function post_meta($type = NULL, $post = NULL)
{
  global $post_detail;
  $display = NULL;

  if (empty($post)) $post = $post_detail;


  switch ($type) {
    case 'time':
      $display = mdate('%d/%m/%Y', strtotime($post->post_date));
      break;
    case 'author':
      $display = $post->username;
      break;

    default:
      break;
  }

  return $display;
}

function post_pagination($type = NULL)
{
  global $SConfig;
  $_this = &get_instance();
  $_this->load->library('pagination');
  $load_model = ucfirst($type) . '_model';
  $perpage = $SConfig->_frontend_perpage;

  /* pagination config for post category */
  if ($_this->uri->segment(2) == 'hal') {
    $base_url = set_url($type) . '/hal';
    $total_rows = $_this->$load_model->count(array('post_type' => $type, 'post_status' => 'publish'));
  } else {
    $kategori = $_this->uri->segment(2);
    $total_rows = $_this->$load_model->count(array('post_type' => $type, 'post_status' => 'publish', "post_category LIKE" => "%$kategori%"));
    $base_url = set_url($type) . '/' . $kategori . '/hal';
  }

  $config['base_url'] = $base_url;
  $config['total_rows'] = $total_rows;
  $config['per_page'] = $perpage;
  $config['full_tag_open'] = '<ul class="pagination">';
  $config['full_tag_close'] = '</ul>';
  $config['prev_link'] = '&laquo;';
  $config['prev_tag_open'] = '<li>';
  $config['prev_tag_close'] = '</li>';
  $config['next_link'] = '&raquo;';
  $config['next_tag_open'] = '<li>';
  $config['next_tag_close'] = '</li>';
  $config['cur_tag_open'] = '<li class="active"><a href="#">';
  $config['cur_tag_close'] = '</a></li>';
  $config['num_tag_open'] = '<li>';
  $config['num_tag_close'] = '</li>';
  $config['first_link'] = '&laquo; First';
  $config['first_tag_open'] = '<li class="prev page">';
  $config['first_tag_close'] = '</li>';
  $config['last_link'] = 'Last &raquo;';
  $config['last_tag_open'] = '<li class="next page">';
  $config['last_tag_close'] = '</li>';
  $config['use_page_numbers'] = TRUE;


  $_this->pagination->initialize($config);

  return $_this->pagination->create_links();
}

function post_title($post = NULL)
{
  global $post_detail;
  $_this = &get_instance();

  if (!empty($post)) {
    $post_title = $post->post_title;
  } else {
    $post_name = $_this->uri->segment(3);
    $post_detail = $_this->Artikel_model->get_artikel(array('post_name' => $post_name), NULL, NULL, TRUE);
    $post_title = $post_detail->post_title;
  }

  return $post_title;
}

function post_content($post = NULl)
{
  global $post_detail;
  $_this = &get_instance();

  if (!empty($post)) {
    $post_content = $post->post_content;
  } else {
    $post_content = $post_detail->post_content;
  }

  return $post_content;
}

function post_category($post = NULL)
{
  global $post_detail;
  $_this = &get_instance();

  if (empty($post)) {
    $post = $post_detail;
  }

  if (!empty($post->post_category)) {
    $categories = explode(',', $post->post_category);
    if (count($categories) > 0) {
      foreach ($categories as $category) {
        return '<a href="' . permalink($post, $category) . '">' . humanize($category) . '</a>';
      }
    } else {
      return '<a href="' . permalink($post, $categories) . '">' . humanize($post->post_category) . '</a>';
    }
  }
}

function post_detail($post = NULL, $param = NULL)
{
  global $post_detail;
  $_this = &get_instance();

  if (empty($post)) {
    $post = $post_detail;
  }

  return $post->$param;
}

function comment_message($tag_open = NULL, $field = NULL, $tag_close = NULL)
{
  $_this = &get_instance();
  $message = $_this->session->flashdata();
  $display = NULL;
  if (array_key_exists($field, $message)) {
    $display = $tag_open . @$message[$field] . $tag_close;
  }

  return $display;
}

function comment_list()
{
  $_this = &get_instance();
  $array_where = array(
    'comment_post_ID' => post_detail(NULL, 'post_ID'),
    'comment_approved' => 'publish'
  );

  $display = $_this->Komentar_model->get_by($array_where);

  return $display;
}
