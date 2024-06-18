<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

# Auth routes
$route['login'] = 'auth/login';
$route['login/auth'] = 'auth/login/authenticate';
$route['register'] = 'auth/register';
$route['register/auth'] = 'auth/register/authenticate';
$route['logout'] = 'auth/logout';

# Admin page routes
$route['admin/dashboard'] = 'admin/dashboard';

# User management routes
$route['admin/users'] = 'admin/user';
$route['admin/users/create'] = 'admin/user/create';
$route['admin/users/(:any)/edit'] = 'admin/user/edit/$1';
$route['admin/users/(:any)/update'] = 'admin/user/update/$1';
$route['admin/users/(:any)/delete'] = 'admin/user/delete/$1';

# Pasien management routes
$route['admin/patients'] = 'admin/pasien';
$route['admin/patients/create'] = 'admin/pasien/create';
$route['admin/patients/(:any)/edit'] = 'admin/pasien/edit/$1';
$route['admin/patients/(:any)/update'] = 'admin/pasien/update/$1';
$route['admin/patients/(:any)/delete'] = 'admin/pasien/delete/$1';

# Dokter management routes
$route['admin/docters'] = 'admin/dokter';
$route['admin/docters/create'] = 'admin/dokter/create';
$route['admin/docters/store'] = 'admin/dokter/store';
$route['admin/docters/(:any)/edit'] = 'admin/dokter/edit/$1';
$route['admin/docters/(:any)/update'] = 'admin/dokter/update/$1';
$route['admin/docters/(:any)/delete'] = 'admin/dokter/delete/$1';

# Obat management routes
$route['admin/obat/(:any)/edit'] = 'admin/obat/edit/$1';
$route['admin/obat/(:any)/update'] = 'admin/obat/update/$1';
$route['admin/obat/(:any)/delete'] = 'admin/obat/delete/$1';

# Kategori obat management routes
$route['admin/obat/kategori-obat'] = 'admin/kategori_obat';
$route['admin/obat/kategori-obat/create'] = 'admin/kategori_obat/create';
$route['admin/obat/kategori-obat/store'] = 'admin/kategori_obat/store';
$route['admin/obat/kategori-obat/(:any)/edit'] = 'admin/kategori_obat/edit/$1';
$route['admin/obat/kategori-obat/(:any)/update'] = 'admin/kategori_obat/update/$1';
$route['admin/obat/kategori-obat/(:any)/delete'] = 'admin/kategori_obat/delete/$1';
