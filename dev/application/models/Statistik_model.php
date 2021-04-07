<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Statistik_model extends MY_Model
{

  protected $_table_name = 'visitor_logs';
  protected $_primary_key = 'visitor_ID';
  protected $_order_by = 'visitor_ID';
  protected $_order_by_type = 'DESC';

  function __construct()
  {
    parent::__construct();
  }


  function get_statistic()
  {

    $this->db->select("Count({PRE}visitor_logs.visitor_ID) AS total_visit,
			  Date_Format({PRE}visitor_logs.visitor_date, '%d/%m') AS date", FALSE);
    $this->db->where(
      "YEAR({PRE}visitor_logs.visitor_date) = YEAR(NOW()) AND
				 DATE({PRE}visitor_logs.visitor_date) >= NOW() - INTERVAL 15 DAY"
    );

    $this->db->group_by('date');
    $this->db->limit(15, 0);
    $this->_order_type = 'ASC';
    return parent::get_by();
  }

  function get_30()
  {
    $this->db->select("*", FALSE);
    $this->db->limit(30, 0);
    $this->_order_type = 'DESC';
    return parent::get_by();
  }

  function get_by_hour()
  {
    $this->db->select("CONCAT(HOUR(visitor_date), ':00-', 
			CONCAT( HOUR(visitor_date)+1, ':00' ) ) AS jam, 
			count(*) as jumlah");
    $this->db->group_by("HOUR(visitor_date)");
    $this->_order_by = 'jam';
    $this->_order_type = 'ASC';
    return parent::get_by("DATE(visitor_date) = CURDATE()");
  }


  function get_by_day()
  {
    $this->db->select("count(*) as jumlah, DATE(visitor_date) as hari");
    $this->db->limit(0, 15);
    $this->db->group_by("hari");
    $this->_order_by = 'hari';
    $this->_order_type = 'DESC';
    return parent::get_by("MONTH(visitor_date) = MONTH(CURDATE())");
  }
}
