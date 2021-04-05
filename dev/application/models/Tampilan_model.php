<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tampilan_model extends MY_Model
{

  protected $_table_name = 'template';
  protected $_primary_key = 'template_id';
  protected $_order_by = 'template_id';
  protected $_order_type = 'DESC';

  function __construct()
  {
    parent::__construct();
  }

  function delete_where_not_in($array)
  {
    $this->db->where_not_in('template_directory', $array);
    parent::delete_by(NULL);
  }
}
