<?php
defined('BASEPATH') or exit('No direct script access allowed');

//Contoh pengimplementasian My_Model
class User_model extends MY_Model
{
  protected $_table_name = 'user';
  protected $_primary_key = 'ID';
  protected $_order_by = 'ID';
  protected $_order_by_type = 'DESC';
}
