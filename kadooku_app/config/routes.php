<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'HomeController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* ROUTE PRODUCT */
$route['product_detail/(:any)'] = 'ProductController/getDetailBySlug/$1';
$route['product']               = 'ProductController/index';
$route['product/(:any)']        = 'ProductController/$1';
$route['product/(:any)/(:any)'] = 'ProductController/$1/$2';

/* ROUTE CART */
$route['order-received/(:any)'] = 'CartController/order/index/$1';
$route['cart']                  = 'CartController/index';
$route['cart/update_cart']      = 'CartController/updateCart';
$route['cart/add_to_cart']      = 'CartController/addToCart';
$route['cart/remove_cart']      = 'CartController/removeCart';
$route['cart/(:any)']           = 'CartController/$1';
$route['cart/(:any)/(:any)']    = 'CartController/$1/$2';

/* ROUTE CART */
$route['home']                  = 'HomeController/index';
$route['home/(:any)']           = 'HomeController/$1';
$route['home/(:any)/(:any)']    = 'HomeController/$1/$2';

/* USER */
$route['user']                             = 'UserController/index';
$route['user/(:any)']                      = 'UserController/$1';
$route['user/(:any)/(:any)']               = 'UserController/$1/$2';
$route['user/(:any)/(:any)/(:any)']        = 'UserController/$1/$2/$3';
$route['user/(:any)/(:any)/(:any)/(:any)'] = 'UserController/$1/$2/$3/$4';

/* SCIAL */
$route['social_login']                             = 'SocialController/index';
$route['social_login/(:any)']                      = 'SocialController/$1';
$route['social_login/(:any)/(:any)']               = 'SocialController/$1/$2';
$route['social_login/(:any)/(:any)/(:any)']        = 'SocialController/$1/$2/$3';
$route['social_login/(:any)/(:any)/(:any)/(:any)'] = 'SocialController/$1/$2/$3/$4';

/* ADMIN */
$route['adm_kadooku']                             = 'AdminController/index';
$route['adm_kadooku/(:any)']                      = 'AdminController/$1';
$route['adm_kadooku/(:any)/(:any)']               = 'AdminController/$1/$2';
$route['adm_kadooku/(:any)/(:any)/(:any)']        = 'AdminController/$1/$2/$3';
$route['adm_kadooku/(:any)/(:any)/(:any)/(:any)'] = 'AdminController/$1/$2/$3/$4';
