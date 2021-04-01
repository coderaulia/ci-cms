<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{
  protected $_table_name;
  protected $_order_by;
  protected $_order_by_type;
  protected $_primary_filter = 'intval';
  protected $_primary_key;
  protected $_type;
  public $rules;

  function __construct()
  {
    parent::__construct();
  }

  // Batch untuk menginsert query lebih dari sekali
  public function insert($data, $batch = FALSE)
  {
    if ($batch == TRUE) {
      // Memanggil prefix dari database.php, dan memilih nama tabel dan menginsert data
      $this->db->_insert_batch('{PRE}' . $this->_table_name, $data);
    } else {
      // Insert tanpa batch atau berulang kali
      $this->db->set($data);
      $this->db->insert('{PRE}' . $this->_table_name);
      // Last inserted ID
      $id = $this->db->insert_id();
      return $id;
    }
  }

  public function update($data, $where = array())
  {
    $this->db->set($data);
    $this->db->where($where);
    $this->db->update('{PRE}' . $this->_table_name);
  }

  public function get($id = NULL, $single = FALSE)
  {
    if ($id != NULL) {
      $filter = $this->_primary_filter;
      $id = $filter($id);
      $this->db->where($this->_primary_key, $id);
      $method = 'row';
    } elseif ($single == TRUE) {
      $method = 'row';
    } else {
      $method = 'result';
    }

    if ($this->_order_by_type) {
      $this->db->order_by($this->_order_by, $this->_order_by_type);
      // contoh untuk pemanggilan order by $this->db->order_by('ID', 'DESC'); atau ASC

    } else {
      $this->db->order_by($this->_order_by);
    }

    return $this->db->get('{PRE}' . $this->_table_name)->$method();
  }

  // Offset untuk pagination, Single untuk memilih jumlah record yg ditampilkan (True=1, FALSE=Semua data), Select membatasi pemilihan field di db
  public function get_by($where = NULL, $limit = NULL, $offset = NULL, $single = FALSE, $select = NULL)
  {
    if ($select != NULL) {
      $this->db->select($select);
    }

    // Jika Where digunakan/ TRUE
    if ($where) {
      $this->db->where($where);
    }

    //Jika menggunakan limit dan offsetnya
    if (($limit) && ($offset)) {
      $this->db->limit($limit, $offset);
    } elseif ($limit) {
      // Jika hanya menggunakan LIMIT
      $this->db->limit($limit);
    }

    // Mereturn value menggunakan public function "get" di atas
    return $this->get(NULL, $single);
  }

  public function delete($id)
  {
    $filter = $this->_primary_filter;
    $id = $filter($id);

    if (!$id) {
      return FALSE;
    }

    //primary key berguna untuk memilih id primary dalam table untuk menghapus data
    $this->db->where($this->_primary_key, $id);
    $this->db->limit(1);
    $this->db->delete('{PRE}' . $this->_table_name);
  }

  public function delete_by($where = NULL)
  {
    if ($where) {
      $this->db->where($where);
    }
    $this->db->delete('{PRE}' . $this->_table_name);
  }

  public function count($where = NULL)
  {
    if (!empty($this->_type)) {
      $where['post_type'] = $this->_type;
    }

    if ($where) {
      $this->db->where($where);
    }

    $this->db->from('{PRE}' . $this->_table_name);
    return $this->db->count_all_results();
  }
}
