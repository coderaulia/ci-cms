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
