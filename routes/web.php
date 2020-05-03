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
//Front Side Site
Route::get(
    'setlocale/{lang}',
    function ($lang) {

        $referer = Redirect::back()->getTargetUrl(); //URL предыдущей страницы
        $parse_url = parse_url($referer, PHP_URL_PATH); //URI предыдущей страницы

        //разбиваем на массив по разделителю
        $segments = explode('/', $parse_url);

        //Если URL (где нажали на переключение языка) содержал корректную метку языка
        if (in_array($segments[1], App\Http\Middleware\Locale::$languages)) {

            unset($segments[1]); //удаляем метку
        }

        //Добавляем метку языка в URL (если выбран не язык по-умолчанию)
        if ($lang != App\Http\Middleware\Locale::$mainLanguage) {
            array_splice($segments, 1, 0, $lang);
        }

        //формируем полный URL
        $url = Request::root() . implode("/", $segments);
//        dd($url);
        //если были еще GET-параметры - добавляем их
        if (parse_url($referer, PHP_URL_QUERY)) {
            $url = $url . '?' . parse_url($referer, PHP_URL_QUERY);
        }
//        dd($url);
        $url = str_replace(env('APP_URL'),"",$url);
        return redirect($url); //Перенаправляем назад на ту же страницу

    }
)->name('setlocale');
Route::get('/', 'HomeController@index')->name('main');
Route::get('/', 'HomeController@index')->name('admin.main');
    Route::get('/rating', 'HomeController@rating')->name('rating.index');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/rating/update', 'HomeController@update_rating')->name('rating.update');
    Route::resource("student", 'StudentController');
    Route::resource("subject", 'SubjectController');

Auth::routes();