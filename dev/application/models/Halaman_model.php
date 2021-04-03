<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Halaman_model extends MY_Model {
	
	protected $_table_name = 'post';
	protected $_primary_key = 'post_ID';
	protected $_order_by = 'menu_sort';
	protected $_order_type = 'ASC';

	public $rules = array(
		'post_title' => array(
			'field' => 'post_title', 
			'label' => 'Judul Halaman', 
			'rules' => 'trim|required'
		)
	);	

	function __construct() {
		parent::__construct();
	}	
	
}