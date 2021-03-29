<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel_model extends MY_Model
{
  protected $_table_name = 'post';
  protected $_primary_key = 'post_ID';
  protected $_order_by = 'post_ID';
  public $rules = array(
    'post_title' => array(
      'field' => 'post_title',
      'label' => 'Judul Artikel',
      'rules' => 'trim|required'
    ), 'post_content' => array(
      'field' => 'post_content',
      'label' => 'Isi Artikel',
      'rules' => 'trim|required'
    )

  );

  //menginduk ke konstraknya
  function __construct()
  {
    parent::__construct();
  }
}
