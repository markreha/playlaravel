<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

/*  !!!!!!!!!!!!!!!!!!!!!!!!!! NOTE NOTE NOTE NOTE NOTE !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! */
/*  !!!! When you start this class you will need to disable the Security Middleware !!!! *?
/*  !!!!!!!!!!!!!!!!!!!!!!!!!! NOTE NOTE NOTE NOTE NOTE !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! */

Route::get('/', function () 
{
//   return view('welcome');
//   return view('index');              // Added for Activity 5 Part 1a
    return view('index1');              // Added for Activity 5 Part 1b
});

// This Route is mapped to the '/hello' URI and will return the text Hello World to be rendered in the browser
Route::get('/hello', function ()
{
    return "Hello World";
});


// This Route is mapped to the '/helloworld' URI and will return the Hello World View (i.e. file at resources/view/helloworld.blade.php)
Route::get('/helloworld', function ()
{
    return view('helloworld');
});

// This Route is mapped to the '/test' URI and will return the Hello World from the Test Controller test()
Route::get('/test', 'TestController@test2');

// This Route is mapped to the '/testrest' URI and will expose all the standard REST verbs in the Test Rest Controller
Route::resource('/testrest', 'TestRestController');

// This Route is mapped to the '/testsingleaction' URI and will expose a single method in the Test Single Action Controller
Route::get('/testsingleaction', 'TestSingleActionController');

// This Route is mapped to the '/whoami' URI and will process the What's My Name Form in the WhatsMyNameController Controller
//  Another Route is mapped to the '/askme' URL to render the Who Am I View (an HTML Form)
Route::post('/whoami','WhatsMyNameController@index');
Route::get('/askme', function ()
{
    return view('whoami');
});

// ********* END OF ACTIVITY 1 Part 2 and Activitity 2 Part 1 *****************************

Route::get('/login', function ()
{
    return view('login');
});

Route::post('/dologin','LoginController@index');

// ********* END OF ACTIVITY 2  Part 2 *****************************

Route::get('/login2', function ()
{
    return view('login2');
});

Route::post('/dologin2','Login2Controller@index');

// ********* END OF ACTIVITY 2 Part 3 *****************************

Route::get('/login3', function ()
{
    return view('login3');
});

Route::post('/dologin3','Login3Controller@index');

// ********* END OF ACTIVITY 3 Part 1 *****************************

Route::get('/login4', function ()
{
    return view('login4');
});
Route::post('/dologin4','Login4Controller@index');

// ********* END OF ACTIVITY 4 Part 3 *****************************

Route::get('/login5', function ()
{
    return view('login5');
});
Route::post('/dologin5','Login5Controller@index');

Route::get('/login6', function ()
{
    return view('login6');
});
Route::post('/dologin6','Login6Controller@index');

// ********* END OF ACTIVITY 5 Part 1 *****************************

Route::resource('/usersrest', 'UsersRestController');
Route::get('/restclient','RestClientController@index');

// ********* END OF ACTIVITY 5 Part 2 *****************************

Route::get('/loggingservice','TestLoggingController@index');

// ********* END OF ACTIVITY 5 Part 4 *****************************
