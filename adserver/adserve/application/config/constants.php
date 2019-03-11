<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/

/**	Custom Constant										*/
define('CAMPAIGN_REMNANT', 'The default campaign type. Remnant campaigns have lots of different
	delivery options, and you should ideally always have at least one Remnant campaign linked to every zone, to ensure
	that there is always something to show. Use Remnant campaigns to display house banners, ad-network banners, or even
	direct advertising that has been sold, but where there is not a time-critical performance requirement for the
	campaign to adhere to.');
define('CAMPAIGN_CONTRACT', 'Contract campaigns are for smoothly delivering the impressions
    required to achieve a specified time-critical performance requirement. That is, Contract campaigns are for when
    an advertiser has paid specifically to have a given number of impressions, clicks and/or conversions to be
    achieved either between two dates, or per day.');
define('CAMPAIGN_OVERRIDE', "Override campaigns are a special campaign type specifically to
	override (i.e. take priority over) Remnant and Contract campaigns. Override campaigns are generally used with
    specific targeting and/or capping rules to ensure that the campaign banners are always displayed in certain
    locations, to certain users, and perhaps a certain number of times, as part of a specific promotion. (This campaign
    type was previously known as 'Contract (Exclusive)'.)");




define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

$corePath	    = $_SERVER['DOCUMENT_ROOT']."/adserver/delivery/core/";
$targetDirImage	= $_SERVER['DOCUMENT_ROOT'].'/adserver/delivery/banners/images/';
$targetDirVideo	= $_SERVER['DOCUMENT_ROOT'].'/adserver/delivery/banners/videos/';
$cacheDir 		= $_SERVER['DOCUMENT_ROOT'].'/adserver/delivery/cache/';
$videoPath		= $_SERVER['DOCUMENT_ROOT'].'/adserver/delivery/banners/videos/';
$deliveryPath		= 'http://localhost/adserver/delivery/';
$deliveryCorePath	= 'http://localhost/adserver/delivery/core/';





/* End of file constants.php */
/* Location: ./application/config/constants.php */