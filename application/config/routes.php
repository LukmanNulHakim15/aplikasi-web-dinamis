<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// $route['default_controller'] = 'welcome';
// $route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;
$route = [

	'default_controller'		=> 'Login',
	'404_override'				=> '',
	'login'						=> 'Login/login',
	'v_registrasi'				=> 'Login/v_registrasi',
	'registrasi-save'			=> 'Login/registrasi',
	'konfirmas-password'		=> 'Dashboard/konfirmasiPassword',
	'table-kategori'			=> 'Dashboard/kategoriTable',
	'save-kategori'				=> 'Dashboard/saveKategori',
	'table-kategori-id'			=> 'Dashboard/kategoriId',
	'update-kategori'			=> 'Dashboard/updateKategori',
	'table-delete-kategori'		=> 'Dashboard/deleteTableKategori',
	'save-artikel'				=> 'Dashboard/saveArtikel',
	'kategori-dropdown'			=> 'Artikel/kategoriDropdown',
	'table-artikel'				=> 'Artikel/tableArtikel',
	'artikel-id'				=> 'Artikel/idArtikel',
	'update-artikel'			=> 'Artikel/updateArtikel',
	'artikel-delete'			=> 'Artikel/deleteArtikel',

	//=================================================================================

	'table-pages'				=> 'Pages/getTablePages',
	'save-pages'				=> 'Pages/savePages',
	'pages-id'					=> 'Pages/pagesId',
	'update-pages'				=> 'Pages/updatePages',
	'delete/pages'				=> 'Pages/deletePages',
	'update-profile'			=> 'Dashboard/updateProfile',
	'save-pengaturan'			=> 'Dashboard/savePengaturan',
	'get-data-pengaturan'		=> 'Dashboard/getDataUbahPengaturan',
	'get-data'					=> 'Dashboard/getDataPengaturan',
	
];
