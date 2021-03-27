<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{
  protected $_table_name;
  protected $_order_by;
  protected $_order_by_type;
  protected $_primary_filter = 'intaval';
  protected $_primary_key;
  public $rules;

  function __construct()
  {
    parent::__construct();
  }

  // Batch untuk menginsert query lebih dari sekali
  public function insert($data, $batch = FALSE)
  {
    if($batch == TRUE){
      // Memanggil prefix dari database.php, dan memilih nama tabel dan menginsert data
      $this->db->_insert_batch('{PRE}'.$this->_table_name, $data)
    }
  }
}
