<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('test', function () {
	return '<h1> GO AWAY! SHOOOO! </h1>';
});


//MAIN
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showHome'));
Route::get('error_notpermited', array('as' => 'error_permission', 'uses' => 'HomeController@showHome'));


// SU ROUTES
## SU - profile control
Route::post('su/user/profile', array('before' => 'auth|suuser|check_ajax', 'as' => 'sugetprofile', 'uses' => 'SuperuserController@ajax_sushowEdituserprofile'));
Route::post('su/updateprofile', array('before' => 'auth|suuser', 'as' => 'suUpdateprofile', 'uses' => 'SuperuserController@suUpdateprofile'));
Route::get('su/editprofile', array('before' => 'auth|suuser', 'as' => 'sueditprofile', 'uses' => 'SuperuserController@showUserprofile'));
## SU - settings control
Route::get('su/settings', array('before' => 'auth|suuser', 'as' => 'susettings', 'uses' => 'SuperuserController@showSettings'));
Route::post('su/add/settings/{group}', array('before' => 'auth|suuser|csrf', 'as' => 'suaddsettings', 'uses' => 'SuperuserController@addSettings'));
Route::get('su/delete/settings/{group}/{callbackname}', array('before' => 'auth|suuser', 'as' => 'sudeletesettings', 'uses' => 'SuperuserController@deleteSettings'));
Route::post('su/edit/settings/{group}', array('before' => 'auth|suuser', 'as' => 'sueditsettings', 'uses' => 'SuperuserController@editSettings'));
## SU - User Earnings updateUserearnings
Route::get('su/earnings/options/', array('before' => 'auth|suuser', 'as' => 'sushowearnings', 'uses' => 'SuperuserController@showEarningspage'));
Route::post('su/update/earnings/{id}', array('before' => 'auth.basic|suuser|check_ajax', 'as' => 'updateuserearnings', 'uses' => 'EarningsController@updateUserearnings'));
Route::get('su/update/adz/{id}', array('before' => 'auth.basic|suuser', 'as' => 'updateuserearningstest', 'uses' => 'EarningsController@test'));
## SU - WITHDRAWAL REQUESTS
Route::get('su/withdrawals/request', array('before' => 'auth|suuser', 'as' => 'sushowwithdrawals', 'uses' => 'SuperuserController@showWithdrawalspage'));

// Frontend SU
Route::get('su/affiliates/{id}', array('before' => 'auth|suuser', 'as' => 'suaffiliates', 'uses' => 'SuperuserController@showAffiliatespage'));
Route::post('su/add/affiliate', array('before' => 'auth|suuser', 'as' => 'suaddaffiliates', 'uses' => 'SuperuserController@addAffiliate'));
Route::post('su/update/affiliate/{id}', array('before' => 'auth|suuser', 'as' => 'suupdateaffiliate', 'uses' => 'SuperuserController@updateAffiliate'));
Route::get('su/delete/affiliate/{id}', array('before' => 'auth|suuser', 'as' => 'sudeleteaffiliate', 'uses' => 'SuperuserController@deleteAffiliate'));
Route::post('su/add/affiliategroup', array('before' => 'auth|suuser', 'as' => 'suaddaffiliatesgroup', 'uses' => 'SuperuserController@addAffiliategroup'));
// SU ROUTES - END`


// User Profile
Route::get('user/profile', array('before' => 'auth', 'as' => 'profile', 'uses' => 'AccountController@showProfile'));
//Update User Profile
Route::post('user/updateprofile', array('before' => 'auth', 'as' => 'updateprofile', 'uses' => 'AccountController@updateProfile'));

// Add user - Registration Route
Route::post('registration', array('before' => 'check_ajax', 'as' => 'registration', 'uses' => 'AccountController@showRegister'));
Route::post('adduser', 'AccountController@addUser');

//Check User
Route::post('getusers', array('before' => 'auth', 'as' => 'getusers', 'uses' => 'AccountController@getUsers'));
// Login route
Route::post('login', 'AccountController@login');
// Logout route
Route::get('logout', array('as' => 'logout', 'uses' => 'AccountController@logout'));
// Children Accounts
Route::get('user/accounts/children', array('before' => 'auth','as' => 'getchildrenaccounts', 'uses' => 'AccountController@showChildrenaccounts'));

#
#
# CODES AREA
#
#
// Activation codes creation
Route::post('generatecodes', array('before' => 'auth', 'as' => 'generatecodes', 'uses' => 'CodesController@generateCode'));
// Show Codes route
Route::post('showcodesmodule', array('before' => 'auth', 'as' => 'showcodesmodule', 'uses' => 'CodesController@shoCodesgenerator'));
// Codes Allocation
Route::post('allocatecodes', array('before' => 'auth|suuser', 'as' => 'allocatecodes', 'uses' => 'CodesController@allocateCodes'));
Route::post('allocatecodes_master', array('before' => 'auth|suuser', 'as' => 'allocatecodes_master', 'uses' => 'CodesController@allocateCodes_master'));
// CHECK IF CODE IS MASTER
Route::post('checkmastercode', array('as' => 'checkmastercode', 'uses' => 'CodesController@checkMastercode'));



// Get Allocated codes history
Route::post('getAllocations', array('before' => 'auth|suuser', 'as' => 'getAllocations', 'uses' => 'CodesController@getAllocations'));
Route::post('getAllocations_master', array('before' => 'auth|suuser', 'as' => 'getAllocations_master', 'uses' => 'CodesController@getAllocations_master'));

// Get Allocated codes history
Route::post('addvp', array('before' => 'auth|suuser', 'as' => 'addvp', 'uses' => 'SalesController@allocateVP'));

//Member Tree
Route::get('user/cnsstatement/{id}', array('before' => 'auth', 'as' => 'getCnsstatement', 'uses' => 'MembertreeController@getCnsstatement'));
//Unilevel Statement
Route::post('user/cns/{id}', array('before' => 'auth|check_ajax', 'as' => 'getUnilevel', 'uses' => 'MembertreeController@getUnilevel'));
Route::get('user/unilevelstatement/{id}', array('before' => 'auth|check_ajax', 'as' => 'getUnilevelStatement', 'uses' => 'MembertreeController@getUnilevelStatement'));
//Show Member Tree Page
Route::post('user/members/{id}', array('before' => 'auth|check_ajax', 'as' => 'members', 'uses' => 'MembertreeController@showMemberTree'));

Route::post('user/totalearnings', array('before' => 'auth', 'as' => 'totalearnings', 'uses' => 'EarningsController@updateTotalearnings'));



// WITHDRAWAL ROUTES
Route::post('user/request/withdrawal', array('before' => 'auth|check_ajax', 'as' => 'requestwithdrawal', 'uses' => 'EarningsController@requestWithdrawal'));
Route::post('children/withdrawal/requests', array('before' => 'auth.basic|check_ajax|checkmaster', 'as' => 'childrenwithdrawalrequest', 'uses' => 'EarningsController@requestWithdrawaleach'));


// FRONTEND - DATA CONTENT ROUTES
Route::get('info/marketingplan', array('as' => 'marketingplan', function (){
	return View::make('datacontent/marketingplan', array(
		'page_title'   => 'Marketing Plan',
	));
}));
Route::get('info/aboutus', array('as' => 'aboutus', function (){
	return View::make('datacontent/about', array(
		'page_title'   => 'About Us',
	));
}));


Route::get('affiliate/list/{group}', array('before' => 'auth', 'as' => 'affiliate_list', function ($group){

	$affiliates = FrontendAffiliates::where('group', '=', strtolower($group))->get();
	
	return View::make('datacontent/affiliates/list', array(
		'page_title'   => 'Affiliate List',
		'affiliates'   => $affiliates,
		'group'        => $group,
	));
}));