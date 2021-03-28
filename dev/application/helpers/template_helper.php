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
