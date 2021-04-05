<?php

function get_site($param)
{
  global $SConfig;
  $display = NULL;

  // Mengambil global value dari configuration.php
  switch ($param) {
    case 'name':
      $display = $SConfig->_site_name;
      break;
    case 'url':
      $display = $SConfig->_site_url;
      break;
    default:
      break;
  }

  return $display;
}

// Mengambil semua directory
function get_list_directory($dir)
{
  if ($handle = opendir($dir)) {

    $dir = array();

    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
      if ($entry != "." && $entry != "..") {
        $dir[] = $entry;
      }
    }

    closedir($handle);
  }

  return $dir;
}
