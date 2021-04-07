<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Statistik extends Backend_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Statistik_model'));
  }

  public function index()
  {
    $data = array();
    $this->site->view('statistik', $data);
  }

  public function action($param)
  {
    global $SConfig;
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      if ($param == 'ambil') {
        $post = $this->input->post(NULL, TRUE);

        if (!empty($post['id'])) {
          echo json_encode($this->Statistik_model->get_by(array('visitor_ID' => $post['id'])));
        } else {
          $statistik = $this->Statistik_model->get_statistic();
          $date_statistik = array();
          $visit_statistik = array();
          if (!empty($statistik)) {
            foreach ($statistik as $row) {
              $date_statistik[] = $row->date;
              $visit_statistik[] = intval($row->total_visit);
            }
          }

          echo json_encode(array(
            'date_statistik' => $date_statistik,
            'visit_statistik' => $visit_statistik,
            'visitor_30' => $this->Statistik_model->get_30(),
            'visitor_perjam' => $this->Statistik_model->get_by_hour(),
            'visitor_total_hari_ini' => $this->Statistik_model->count("DATE(visitor_date) = CURDATE()"),
            'visitor_perhari' => $this->Statistik_model->get_by_day(),
            'visitor_total_bulan_ini' => $this->Statistik_model->count("MONTH(visitor_date) = MONTH(CURDATE())"),
          ));
        }
      }
    }
  }
}
