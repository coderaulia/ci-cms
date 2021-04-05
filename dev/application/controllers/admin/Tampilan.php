<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tampilan extends Backend_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model(array('Tampilan_model', 'Konfigurasi_model'));
  }

  function index()
  {
    $data = array();
    $this->site->view('tampilan', $data);
  }

  function action($param)
  {
    global $SConfig;

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $post = $this->input->post(NULL, TRUE);

      if ($param == 'ambil') {

        if (!empty($post['template'])) {
          $record = $this->Tampilan_model->get_by(array('template_directory' => $post['template']), NULL, NULL, TRUE);
          $record->template_attribute = unserialize($record->template_attribute);
          echo json_encode(array('data' => $record));
        } else {
          $template_setting = NULL;
          $frontend_template_dir = $SConfig->_document_root . '/templates/frontend';
          $setting = $this->Konfigurasi_model->get_by(array('option_name' => 'template_setting'), NULL, NULL, TRUE);

          if ($setting) {
            $template_setting = unserialize($setting->option_value);
            $template_setting['template_attribute'] = unserialize($template_setting['template_attribute']);
          }

          if (!empty($post['option_name'])) {
            echo json_encode(array(
              'template_setting' => $template_setting
            ));
          } else {
            // mengambil semua nama folder di frontend directory
            foreach (get_list_directory($frontend_template_dir) as  $sub) {
              // mencari isi file di folder tersebut
              foreach (get_list_directory($frontend_template_dir . '/' . $sub) as $nameof) {
                $list[$sub][] = $nameof;
              }

              $template_directory_name_list[] = $sub;

              // cek info_template di dalam folder
              if (in_array('info_template.php', $list[$sub]) && file_exists($frontend_template_dir . '/' . $sub)) {

                // mengecek database jika ada nama yg serupa dengan folder templatenya
                $info_template_db = $this->Tampilan_model->get_by(array('template_directory' => $sub), NULL, NULL, TRUE);

                if ($info_template_db) {
                  require_once $frontend_template_dir . '/' . $sub . '/info_template.php';
                  $this->Tampilan_model->update($info_template, array('template_directory' => $sub));
                } else {
                  require_once $frontend_template_dir . '/' . $sub . '/info_template.php';
                  $this->Tampilan_model->insert($info_template);
                }
              }
            }

            // menghapus data jika di folder frontend tidak ada foldernya.
            if (is_array($template_directory_name_list)) {
              $this->Tampilan_model->delete_where_not_in($template_directory_name_list);
            }

            echo json_encode(array(
              'record' => $this->Tampilan_model->get_by(array('template_directory !=' => $template_setting['template_directory']), NULL, NULL, NULL, 'template_name,template_directory,template_version'),
              'template_setting' => $template_setting
            ));
          }
        }
      } else if ($param == 'update') {
        if (!empty($post['template_directory'])) {
          // mengecek ketersedian pengaturan di database
          $template_setting = $this->Konfigurasi_model->get_by(array('option_name' => 'template_setting'));
          $template_detail = $this->Tampilan_model->get_by(array('template_directory' => $post['template_directory']), NULL, NULL, TRUE);
          $array_template_setting = array(
            'template_directory' => $post['template_directory'],
            'template_name' => $template_detail->template_name,
            'template_attribute' => $template_detail->template_attribute,
          );

          // jika ada maka akan update
          if (count($template_setting) > 0) {
            $this->Konfigurasi_model->update(
              array('option_value' => serialize($array_template_setting)),
              array('option_name' => 'template_setting')
            );
          }
          // jika tidak ada maka insert
          else {
            $this->Konfigurasi_model->insert(array(
              'option_name' => 'template_setting',
              'option_value' => serialize($array_template_setting)
            ));
          }

          echo json_encode(array('status' => 'success'));
        } else {
          /* get old template_setting */
          $setting = $this->Konfigurasi_model->get_by(array('option_name' => 'template_setting'), NULL, NULL, TRUE);

          if ($setting) {
            $template_setting = unserialize($setting->option_value);
            $template_setting['template_attribute'] = unserialize($template_setting['template_attribute']);
          }

          // print_r($template_setting);
          // print_r($post);
          /* di timpa ke yang baru */
          foreach ($post as $key => $value) {
            $template_setting['template_attribute'][$key]['value'] = $value;
          }

          $template_setting['template_attribute'] = serialize($template_setting['template_attribute']);

          $this->Konfigurasi_model->update(array('option_value' => serialize($template_setting)), array('option_name' => 'template_setting'));

          echo json_encode(array('status' => 'success'));
        }
      }
    }
  }
}
