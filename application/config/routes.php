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
  |	http://codeigniter.com/user_guide/general/routing.html
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
//$route['default_controller'] = 'home/routing';
//$route['(\w{2})/(.*)'] = '$2';
//$route['(\w{2})'] = $route['default_controller'];

/**  About */
$route["deposit-insurance"] = "Pages/deposit_insurance";
$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|gr|my|bg|cs|zh)\/)?ceo"] = "Pages/ceo";
$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|gr|my|bg|cs|zh)\/)?company-news"] = "Pages/companynews";
$route["company-news/(:any)"] = "Pages/companynews/$1";

$route["partnership/friend-referrer"] = "partnership/friend_referrer";

$route["partnership/online-partner"] = "partnership/online_partner";


$route["partnership/local-online-partner"] = "partnership/local_online_partner";


$route["partnership/local-office-partner"] = "partnership/local_office_partner";


$route["informers"] = "Pages/Informers";

$route["showBanner"] = "Pages/BannersShow";
$route["feedback"] = "Pages/feedback";

$route["feedback-email"] = "Pages/FeedbackSendEmail";

$route["get-country-code"] = "Pages/getCountryCode";

$route["24admin82/signin"] = 'Mailer/signin';

$route["terms-of-partnership"] = "Terms_of_partnership";

$route["privacy-policy"] = "Pages/PrivacyPolicy";

$route["partners"] = "Pages/Partners";

$route["aml-policy"] = "Pages/AMLPolicy";

$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|bg|my|gr|zh)\/)?best-execution-policy"] = "Pages/BestExecutionPolicy";


$route["partnership-agreement"] = "Pages/PartnershipAgreement";

$route["unsubscribe/ref/(:any)"] = "unsubscribe/ref/$1";

$route['profile/platform-access'] = 'profile/platform_access';

/** Administration */
$route["administration-news"] = "Administration/News";

$route["administration-feedback"] = "Administration/Feedback";

$route["administration-useraccess"] = "Administration/Access";

$route["administration/accountverification-verified-documents"] = "administration/accountverification_verifieddocuments";

$route["administration/accountverification-unverified-documents"] = "administration/accountverification_unverifieddocuments";

$route["administration/accountverification-request"] = "administration/accountverification_request";

$route["administration/withdrawal-queue"] = "Administration/withdrawalqueue";

$route["administration/manage-accounts/demo"] = "Administration/manage_accounts/0";

$route["administration/manage-accounts/live"] = "Administration/manage_accounts/1";

$route["administration/manage-accounts/affiliates"] = "Administration/manage_affiliates";

$route["administration/manage-accounts"] = "Administration/manage_accounts/0";

$route["administration/manage-news"] = "Administration/manage_news";

$route["administration/manage-access"] = "administration/manageaccess";

//$route["forex-contests/money-fall/ranking"] = "contest/ranking";
//$route["forex-contests/money-fall/winners"] = "contest/winners";
//$route["forex-contests/money-fall/contest-rules"] = "contest/Contest_rules";
$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|cs|zh)\/)?forex-contests/money-fall/ranking"] = "contest/ranking";
$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|cs|zh)\/)?forex-contests/money-fall/winners"] = "contest/winners";
$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|cs|bg|my|gr|zh)\/)?forex-contests/money-fall/contest-rules"] = "contest/Contest_rules";
$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|cs|bg|my|gr|zh)\/)?forex-contests/money-fall/registration"] = "contest/registration";
$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|cs|zh)\/)?forex-contests/money-fall/contest-archive"] = "contest/Contest_archive";
$route["financial_instruments/spots"] = "financial_instruments/spotmetals";
$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|bg|my|gr|zh)\/)?financial-instruments/spots"] = "financial_instruments/spotmetals";
$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|bg|my|gr|zh)\/)?financial_instruments/spots"] = "financial_instruments/spotmetals";
$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|bg|my|gr|zh)\/)?financial-instruments/spots"] = "financial_instruments/spotmetals";

//$route['^(en|jp|ru|id|de|fr|it|sa|es|pt)/financial-instruments/spots/(.+)$'] = "financial_instruments/spots/$2";
//     $route['^(en|jp|ru|id|de|fr|it|sa|es|pt)/financial-instruments/spots$'] = "financial_instruments/spots$2";
//$route['^(en|jp|ru|id|de|fr|it|sa|es|pt)/financial-instruments/spots'] = "financial_instruments/spots";
//$route['vip-winner'] = "pages/vip_winner";
$route['tiket-raffle'] = "pages/vip_winner";
$route['^(en|jp|ru|id|de|bg|fr|it|sa|es|pt|sk|pl|pk|my|gr|cs|zh)/?tiket-raffle'] = "pages/vip_winner";

#$route['how-to-install-ea'] = 'how-to-get-started/how_to_install_ea';

if (strstr($_SERVER['HTTP_HOST'], 'www.forexmart.com')) {
    //var_dump($_SERVER['HTTP_HOST']);
    $route['profile/(:any)'] = '';
    $route['accounts/(:any)'] = '';
    $route['transactions/(:any)'] = '';
} else {
//My Profile
    $route['profile/change-password'] = 'profile/change_password';
    $route['profile/upload-documents'] = 'profile/upload_documents';
    $route['profile/platform-access'] = 'profile/platform_access';

// under Accounts
    $route['accounts/open-demo-account'] = 'accounts/open_demo_account';
    $route['accounts/open-trading-account'] = 'accounts/open_trading_account';
}

$route['thirty-percent-bonus-promo'] = "register/thirty_percent_bonus_promo";
$route['no-deposit-bonus-promo'] = "register/no_deposit_bonus_promo";

$route['landing/no-deposit-bonus'] = "register/no_deposit_bonus";
$route['landing/no-deposit-bonus/thanks'] = "Forexmart_landing/thanks";

// $route["contact-us"] = "Contact_us/contact";

$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|gr|my|bg|cs|zh)\/)?contact-us"] = "Contact_us/contact";
$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|gr|my|bg|cs|zh)\/)?fifty-percent-bonus"] = "Fifty_percent_bonus_agreement";
$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|gr|cs|zh)\/)?awards"] = "awards";


$route['translate_uri_dashes'] = TRUE;

$prepended_lang = "(?:[a-zA-Z]{2}/)?";
$appended_lang = "(?:[a-zA-Z]{2}/?)?";
$lang = "([a-zA-Z]{2}/)?";

$route['(\w{2})/(.*)'] = '$2';
$route['^(en|ru|jp|id|de|fr|it|sa|es|pt|my|bg|sk|pl|pk|gr|zh)/(.+)$'] = "$2";
$route['^(en|ru|jp|id|de|fr|it|sa|es|pt|my|bg|sk|pl|pk|gr|zh)$'] = $route['default_controller'];

$route['default_controller'] = 'home';

$route['^(\w{2})$'] = $route['default_controller'];
$route['404_override'] = '';

//$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|pl|pk)\/)?terms-and-conditions"]= "Terms_and_conditions";

$route['(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|gr|zh)\/)?meet-us-offline'] = "Meet_us_offline";
$route['(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|gr|zh)\/)?meet-us-offline/events/(:any)/(:any)'] = "Meet_us_offline/events/$1/$2";
$route['(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|gr|zh)\/)?meet-us-offline/exhibitions/(:any)/(:any)'] = "Meet_us_offline/exhibitions/$1/$2";

$route['analytical-reviews'] = "Analytical_reviews";
$route['analytical-reviews/update'] = "Analytical_reviews/update";

$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|gr|zh)\/)?cysec"] = 'pages/cysec';
$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|gr|zh)\/)?bafin"] = 'pages/bafin';
$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|gr|zh)\/)?fsp"] = 'pages/fsp';
$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|gr|zh)\/)?fca"] = 'pages/fca';
$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|gr|zh)\/)?amf"] = 'pages/amf';
$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|gr|zh)\/)?consob"] = 'pages/consob';

$route["(^(en|jp|ru|id|de|fr|it|sa|es|pt|sk|pl|pk|gr|zh)\/)?bio/(:any)"] = 'Forex_signals/bio/$1';


//$route['rpj-racing'] = "RPJracing";
$route['HKM_Zvolen'] = "HKM_Zvolen";


//$route['nuSoapServer/getMember/wsdl'] = 'nuSoapServer/index/wsdl';
// all ajax page load route
$route['forex-major-home'] = "AjaxPage_load/forexMajorTab";
#$route['live-account/(:any)'] = 'live_account/index'; //FXPP-7004
$route['cs/register/index'] = "register/index";
