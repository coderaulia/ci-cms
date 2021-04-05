<?php
	global $SConfig;

	/* *************** TEMPLATE INFORMATION  *************** */
	$info_template = array(
		'template_name' 		=> 'Default Blog',
		'template_directory'	=> 'default',
		'template_author' 		=> 'Loka Dwiartara, ST',
		'template_version' 		=> '1.0',
		'template_description'  => '<p>Basic CMS Blog</p>',

		/* yang ini nantinya akan digunakan untuk merubah setting tampilan */
		'template_attribute'	=> serialize(array(			
			'posted_by'			=> array('type' => 'text', 'value' => 'Posted by'),
			'on'				=> array('type' => 'text', 'value' => 'on'),
			'category'			=> array('type' => 'text', 'value' => 'Category'),
			'daftar_komentar'	=> array('type' => 'text', 'value' => 'Daftar Komentar'),
			'komentar'			=> array('type' => 'text', 'value' => 'Komentar'),
			'form_komentar'		=> array('type' => 'text', 'value' => 'Form Komentar'),
			'nama'				=> array('type' => 'text', 'value' => 'Nama'),
			'email'				=> array('type' => 'text', 'value' => 'Email'),
			'website'			=> array('type' => 'text', 'value' => 'Website'),
			'kirim_komentar' 	=> array('type' => 'text', 'value' => 'Kirim Komentar'),			
		))
	);
