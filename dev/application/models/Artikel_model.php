<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel_model extends MY_Model
{
  protected $_table_name = 'post';
  protected $_primary_key = 'post_ID';
  protected $_order_by = 'post_ID';
  protected $_order_by_type = 'DESC';
  protected $_type = 'artikel';
  public $rules = array(
    'post_title' => array(
      'field' => 'post_title',
      'label' => 'Judul Artikel',
      'rules' => 'trim|required'
    )

  );

  //menginduk ke konstraknya
  function __construct()
  {
    parent::__construct();
  }

  // menampilkan artikel
  function get_artikel($where = NULL, $limit = NULL, $offset = NULL, $single = FALSE, $select = NULL)
  {
    // $this->db->join('table_name', 'table_name.field = table_name.field')
    $this->db->join('{PRE}user', '{PRE}' . $this->_table_name . '.post_author = {PRE}user.ID', 'LEFT');
    $this->db->where('post_type', $this->_type);
    return parent::get_by($where, $limit, $offset, $single, $select);
  }
}
