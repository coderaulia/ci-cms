<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Komentar_model extends MY_Model
{

  protected $_table_name = 'comment';
  protected $_primary_key = 'comment_ID';
  protected $_order_by = 'comment_ID';
  protected $_order_by_type = 'DESC';

  public $rules = array(
    'comment_author_name' => array(
      'field' => 'comment_author_name',
      'label' => 'Nama',
      'rules' => 'trim|required'
    ),
    'comment_author_email' => array(
      'field' => 'comment_author_email',
      'label' => 'Email',
      'rules' => 'trim|required'
    ),
    'comment_content' => array(
      'field' => 'comment_content',
      'label' => 'Komentar',
      'rules' => 'required'
    ),

  );

  function __construct()
  {
    parent::__construct();
  }

  function get_komentar($where = NULL, $limit = NULL, $offset = NULL, $single = FALSE, $select = NULL)
  {
    // $this->db->join('table_name', 'table_name.field = table_name.field')
    $this->db->join('{PRE}post', '{PRE}' . $this->_table_name . '.comment_post_ID = {PRE}post.post_ID', 'LEFT');
    return parent::get_by($where, $limit, $offset, $single, $select);
  }
}
