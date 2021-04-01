<?php
defined('BASEPATH') or exit('No direct script access allowed');

//Contoh pengimplementasian My_Model
class User_model extends MY_Model
{
  protected $_table_name = 'user';
  protected $_primary_key = 'ID';
  protected $_order_by = 'ID';
  protected $_order_by_type = 'DESC';

  public $rules = array(
    'username' => array(
      'field' => 'username',
      'label' => 'Username',
      'rules' => 'trim|required',
    ), 'password' => array(
      'field' => 'password',
      'label' => 'Password',
      'rules' => 'trim|required|callback_password_check',
    )

  );

  function __construct()
  {
    parent::__construct();
  }
}
