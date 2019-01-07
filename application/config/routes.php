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


/*############# START  FRONT ROUTE ###############*/

$route['default_controller'] = 'website';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['login']                                                     = 'websiteAuthenticate/login';
$route['register']                                                  = 'websiteAuthenticate/register';
$route['verify-account/(:any)']                                     = 'websiteAuthenticate/accountVerification/$1';
$route['logout']                                                    = 'websiteAuthenticate/logout';

$route['event-detail/(:any)']                                       = 'website/eventDetail/$1';
    //***** Merchant Panel Starts *****//

$route['merchant']                                                  = 'merchant';
$route['merchant/dashboard']                                        = 'merchant';
$route['merchant/profile']                                          = 'merchant/myProfile';
$route['merchant/edit-profile']                                     = 'merchant/editProfile';
$route['merchant/change-password']                                  = 'merchant/changePassword';

$route['merchant/events']                                           = 'merchant/myEvents';
$route['merchant/add-event']                                        = 'merchant/addEvent';
$route['merchant/edit-event/(:any)']                                = 'merchant/editEvent/$1';

$route['merchant/event-gallery/(:any)']                             = 'merchant/eventGallery/$1';
$route['merchant/add-event-gallery/(:any)']                         = 'merchant/addEventGallery/$1';
$route['merchant/edit-event-gallery/(:any)']                        = 'merchant/editEventGallery/$1';

$route['merchant/gallery']                                          = 'merchant/myGallery';
$route['merchant/add-gallery']                                      = 'merchant/addGallery';
$route['merchant/edit-gallery/(:any)']                              = 'merchant/editGallery/$1';

    //***** Merchant Panel Ends *****//


    //***** User Panel Starts *****//

$route['user']                                                      = 'user';
$route['user/dashboard']                                            = 'user';
$route['user/profile']                                              = 'user/myProfile';
$route['user/edit-profile']                                         = 'user/editProfile';
$route['user/change-password']                                      = 'user/changePassword';

    //***** User Panel Ends *****//


/*#############  FRONT ROUTE ENDS ###############*/


/*##################  ADMIN ROUTES STARTS ####################*/

$route['admin/login']                                                = 'authenticate';
$route['admin/logout']                                               = 'authenticate/logout';
$route['admin']                                                      = 'admin/index';
$route['admin/dashboard']                                            = 'admin/index';

$route['admin/edit-company-profile']                                 = 'admin/editCompanyprofile';
$route['admin/change-password']                                      = 'admin/changePassword';

$route['admin/test-setting']                                         = 'admin/testSetting';
$route['admin/edit-test-setting']                                    = 'admin/editTestSetting';

$route['admin/sliders']                                              = 'admin/viewSlider';
$route['admin/add-slider']                                           = 'admin/addSlider';
$route['admin/edit-slider/(:any)']                                   = 'admin/editSlider/$1';

/*##################  ADMIN ROUTES STARTS ####################*/  