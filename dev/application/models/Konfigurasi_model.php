<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Konfigurasi_model extends MY_Model
{

  protected $_table_name = 'options';
  protected $_primary_key = 'option_id';
  protected $_order_by = 'option_id';
  protected $_order_type = 'DESC';

  function __construct()
  {
    parent::__construct();
  }
}
