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
$route['park-detail/(:any)']                                        = 'website/parkDetail/$1';

$route['parks']                                                     = 'website/allParks';
$route['parks/(:any)']                                              = 'website/allParks/$1';

$route['parks/city/(:any)']                                         = 'website/cityParks/$1';
$route['parks/city/(:any)/(:any)']                                  = 'website/cityParks/$1/$2';

$route['events']                                                    = 'website/allEvents';
$route['events/(:any)']                                             = 'website/allEvents/$1';

$route['find']                                                      = 'website/findResult';

$route['search/(:any)']                                             = 'website/searchResult/$1';
$route['search/(:any)/(:any)']                                      = 'website/searchResult/$1/$2';

$route['submit-review']                                             = 'website/submitReview';
$route['ticket-request']                                            = 'website/submitTicketRequest';
$route['billing-detail']                                            = 'website/billingDetails';
$route['pay-now']                                                   = 'website/payNow';
$route['paymentsuccess']                                            = 'website/paymentSuccess';
$route['paymentfailure']                                            = 'website/paymentFailure';
$route['thank-you']                                                 = 'website/thankYou';
$route['payment-failed']                                            = 'website/paymentFailed';

$route['privacy-policy']                                            ='website/privacy'; 
$route['terms-condition']                                           ='website/termsCondition'; 
$route['about-us']                                                  ='website/aboutUs'; 

$route['contact']                                                   ='website/conatctUs'; 

    //***** Merchant Panel Starts *****//

$route['merchant']                                                  = 'merchant';
$route['merchant/dashboard']                                        = 'merchant';
$route['merchant/profile']                                          = 'merchant/myProfile';
$route['merchant/edit-profile']                                     = 'merchant/editProfile';
$route['merchant/change-password']                                  = 'merchant/changePassword';

$route['merchant/timing']                                           = 'merchant/viewTiming';
$route['merchant/edit-timing']                                      = 'merchant/editTiming';

$route['merchant/profile-cover']                                    = 'merchant/profileCover';
$route['merchant/map-location']                                     = 'merchant/mapLocation';

$route['merchant/events']                                           = 'merchant/myEvents';
$route['merchant/add-event']                                        = 'merchant/addEvent';
$route['merchant/edit-event/(:any)']                                = 'merchant/editEvent/$1';

$route['merchant/event-gallery/(:any)']                             = 'merchant/eventGallery/$1';
$route['merchant/add-event-gallery/(:any)']                         = 'merchant/addEventGallery/$1';
$route['merchant/edit-event-gallery/(:any)']                        = 'merchant/editEventGallery/$1';

$route['merchant/gallery']                                          = 'merchant/myGallery';
$route['merchant/add-gallery']                                      = 'merchant/addGallery';
$route['merchant/edit-gallery/(:any)']                              = 'merchant/editGallery/$1';

$route['merchant/bookings']                                         = 'merchant/myBookings';
$route['merchant/enquiries']                                        = 'merchant/myEnquiries';
$route['merchant/reviews']                                          = 'merchant/myReviews';
$route['merchant/compose-message']                                  = 'merchant/composeMessage';
$route['merchant/messages']                                         = 'merchant/myMessages';
$route['merchant/messages/(:num)']                                  = 'merchant/myMessages/$1';
$route['merchant/messages/sent-items']                              = 'merchant/mySentitems';
$route['merchant/messages/sent-items/(:num)']                       = 'merchant/mySentitems/$1';
    //***** Merchant Panel Ends *****//


    //***** User Panel Starts *****//

$route['user']                                                      = 'user';
$route['user/dashboard']                                            = 'user';
$route['user/profile']                                              = 'user/myProfile';
$route['user/edit-profile']                                         = 'user/editProfile';
$route['user/change-password']                                      = 'user/changePassword';

$route['user/bookings']                                             = 'user/myBookings';
$route['user/enquiries']                                            = 'user/myEnquiries';

    //***** User Panel Ends *****//


/*#############  FRONT ROUTE ENDS ###############*/


/*##################  ADMIN ROUTES STARTS ####################*/

$route['admin/login']                                                = 'authenticate';
$route['admin/logout']                                               = 'authenticate/logout';
$route['admin']                                                      = 'admin/index';
$route['admin/dashboard']                                            = 'admin/index';

$route['admin/edit-company-profile']                                 = 'admin/editCompanyprofile';
$route['admin/change-password']                                      = 'admin/changePassword';

$route['admin/commissions']                                           = 'admin/viewCommission';

$route['admin/sliders']                                              = 'admin/viewSlider';
$route['admin/add-slider']                                           = 'admin/addSlider';
$route['admin/edit-slider/(:any)']                                   = 'admin/editSlider/$1'; 

$route['admin/testimonials']                                         = 'admin/viewTestimonial';
$route['admin/add-testimonial']                                      = 'admin/addTestimonial';
$route['admin/edit-testimonial/(:any)']                              = 'admin/editTestimonial/$1'; 

$route['admin/merchant']                                             = 'admin/merchant';
$route['admin/allmerchant']                                          ='admin/allmerchant';
$route['admin/edit-merchant/(:any)']                                 ='admin/edit_merchant/$1';
$route['admin/addevent']                                             = 'admin/addevent';
$route['admin/allevent']                                             ='admin/allevent';  
$route['admin/edit-event/(:any)']                                    = 'admin/editevent/$1'; 
$route['admin/edit-timing/(:any)']                                   ='admin/editTiming/$1'; 

$route['admin/add-gallery/(:any)']                                   ='admin/addgallery/$1'; 
$route['admin/edit-gallery/(:any)/(:any)']                           ='admin/editgallery/$1/$2'; 

$route['admin/event-gallery/(:any)']                                 ='admin/eventgallery/$1'; 
$route['admin/edit-event-gallery/(:any)/(:any)/(:any)']              ='admin/editeventgallery/$1/$2/$3'; 

$route['admin/allusers']                                             ='admin/allusers'; 
$route['admin/bookticket']                                           ='admin/bookticket'; 
$route['admin/enquiry']                                              ='admin/viewEnquiry'; 

$route['admin/compose-message']                                      = 'admin/composeMessage';
$route['admin/messages']                                             = 'admin/myMessages';
$route['admin/messages/(:num)']                                      = 'admin/myMessages/$1';
$route['admin/messages/sent-items']                                  = 'admin/mySentitems';
$route['admin/messages/sent-items/(:num)']                           = 'admin/mySentitems/$1';

$route['admin/reports']                                              ='admin/viewReports'; 
$route['admin/pdf-report']                                           ='admin/pdfReport'; 

$route['admin/subadmin']                                             ='admin/subadmin'; 
$route['admin/edit-subadmin/(:any)']                                 ='admin/updatesubadmin/$1'; 
/*##################  ADMIN ROUTES STARTS ####################*/  