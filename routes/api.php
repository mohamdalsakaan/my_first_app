<?php

use App\Http\Controllers\attended;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\contract;
use App\Http\Controllers\create_booked;
use App\Http\Controllers\create_tables;
use App\Http\Controllers\date;
use App\Http\Controllers\employe;
use App\Http\Controllers\equipment;
use App\Http\Controllers\evaluation;
use App\Http\Controllers\event;
use App\Http\Controllers\fav_event;
use App\Http\Controllers\fav_re;
use App\Http\Controllers\favourity;
use App\Http\Controllers\invoice;
use App\Http\Controllers\main_category;
use App\Http\Controllers\order;
use App\Http\Controllers\order_sub;
use App\Http\Controllers\profile_owner;
use App\Http\Controllers\profile_user;
use App\Http\Controllers\re_mang_sys;
use App\Http\Controllers\sub_category;
use App\Http\Controllers\sub_place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/register', [AuthController::class , 'register']);
   Route::post('/login', [AuthController::class , 'login']);
    Route::post('/logout', [AuthController::class , 'logout']);

Route::group(['middleware' => 'auth:sanctum'], function() {
   Route::group(['middleware' => ['ExpetOwner']], function(){
    Route::post('/create_profile_owner', [profile_owner::class , 'create_profile_owner']);
    Route::post('/update_profile_owner', [profile_owner::class , 'update_profile_owner']);
    Route::post('/delete_profile_owner', [profile_owner::class , 'delete_profile_owner']);
    ////////////////////////
    Route::post('/create_re', [re_mang_sys::class , 'create']);
    Route::post('/update_re', [re_mang_sys::class , 'update']);
    Route::post('/destroy_re', [re_mang_sys::class , 'destroy']);
    ///////////////////////
    Route::post('/create_main_category', [main_category::class , 'create_main_category']);
    Route::post('/update_main_category', [main_category::class , 'update_main_category']);
    Route::post('/delete_main_category', [main_category::class , 'delete_main_category']);
    /////////////////////
    Route::post('/create_sub_category', [sub_category::class , 'create_sub_category']);
    Route::post('/update_sub_category', [sub_category::class , 'update_sub_category']);
    Route::post('/delete_sub_category', [sub_category::class , 'delete_sub_category']);
    ////////////////////////////////
    Route::post('/create_invoice', [invoice::class , 'invoice']);
    Route::post('/update_invoice', [invoice::class , 'update_invoice']);
    Route::post('/delete_invoice', [invoice::class , 'delete_invoice']);
    /////////////////////////////////
    Route::post('/create_sub_place', [sub_place::class , 'create_sub_place']);
    Route::post('/update_sub_place', [sub_place::class , 'update_sub_place']);
    Route::post('/delete_sub_place', [sub_place::class , 'delete_sub_place']);
    /////////////////////////////////
    Route::post('/create_event', [event::class , 'create_event']);
    Route::post('/update_event', [event::class , 'update_event']);
    Route::post('/delete_event', [event::class , 'delete_event']);
    //////////////////////////

   });

   Route::group(['middleware' => ['ExpetUser']], function(){
    Route::post('/create_profile_user', [profile_user::class , 'create_profile_user']);
    Route::post('/update_profile_user', [profile_user::class , 'update_profile_user']);
    Route::post('/delete_profile_user', [profile_user::class , 'delete_profile_user']);
    /////////////////////////////
    Route::post('/create_order', [order::class , 'create']);
    Route::post('/update_order', [order::class , 'update']);
    Route::post('/delete_order', [order::class , 'delete']);
    //////////////





   });
    Route::post('/index_profile_user', [profile_user::class , 'index_profile_user']);
    ///////////////////////////////////////////////
    Route::post('/index_profile_owner', [profile_owner::class , 'index']);
    Route::post('/show_profile_owner', [profile_owner::class , 'show']);
    //////////////////////////////////////////////
    Route::post('/index_re', [re_mang_sys::class , 'index']);
    Route::post('/show_re', [re_mang_sys::class , 'show']);
    //////////////////////////////////////////////
    Route::post('/index_main_category', [main_category::class , 'index_main_category']);
    Route::post('/show_main_category', [main_category::class , 'show_main_category']);
    ///////////////////////////////////////////
    Route::post('/index_sub_category', [sub_category::class , 'index_sub_category']);
    Route::post('/show_sub_category', [sub_category::class , 'show_sub_category']);
    /////////////////////////////////////////////
    Route::post('/index_invoice', [invoice::class , 'index_invoice']);
    Route::post('/show_invoice', [invoice::class , 'show_invoice']);
    /////////////////////////////////////////////
    Route::post('/create_order_sub', [order_sub::class , 'create']);
    Route::post('/index_order_sub', [order_sub::class , 'index']);
    Route::post('/show_order_sub', [order_sub::class , 'show']);
    Route::post('/update_order_sub', [order_sub::class , 'update']);
    Route::post('/delete_order_sub', [order_sub::class , 'delete']);
    ///////////////////////////////////////////
    Route::post('/index_order', [order::class , 'index']);
    Route::post('/show_order', [order::class , 'show']);
    ////////////////////////////////////////////
    Route::post('/index_sub_place', [sub_place::class , 'index_sub_place']);
    Route::post('/show_sub_place', [sub_place::class , 'show_sub_place']);
    //////////////////////////////////////////////////////////
    Route::post('/index_event', [event::class , 'index_event']);
    Route::post('/show_event', [event::class , 'show_event']);
    ////////////////////////////////////////////////
    Route::post('/create_employe', [employe::class , 'create_employe']);
    Route::post('/index_employe', [employe::class , 'index_employe']);
    Route::post('/show_employe', [employe::class , 'show_employe']);
    Route::post('/update_employe', [employe::class , 'update_employe']);
    Route::post('/delete_employe', [employe::class , 'delete_employe']);
    /////////////////////////////////////////////
    Route::post('/create_contract', [contract::class , 'create_contract']);
    Route::post('/index_contract', [contract::class , 'index_contract']);
    Route::post('/show_contract', [contract::class , 'show_contract']);
    Route::post('/update_contract', [contract::class , 'update_contract']);
    Route::post('/delete_contract', [contract::class , 'delete_contract']);
    //////////////////////////////////////
    Route::post('/create_table', [create_tables::class , 'create']);
    Route::post('/index_table', [create_tables::class , 'index']);
    Route::post('/show_table', [create_tables::class , 'show']);
    Route::post('/update_table', [create_tables::class , 'update']);
    Route::post('/delete_table', [create_tables::class , 'delete']);
    ////////////////////
    Route::post('/index_booked', [create_booked::class , 'index']);
    Route::post('/show_booked', [create_booked::class , 'show']);
    Route::post('/update_booked', [create_booked::class , 'update']);
    Route::post('/delete_booked', [create_booked::class , 'delete']);
    Route::post('/booked', [create_booked::class , 'booked']);
    ///////////////////////////////////////////////
    Route::post('/insert_date', [date::class , 'insert']);
    Route::post('/index_booked', [create_booked::class , 'index']);
    Route::post('/show_booked', [create_booked::class , 'show']);
    ///////////////////////////////
    Route::get('/review', [order::class , 'review']);
    Route::post('/review_emp', [order::class , 'review_emp']);
    ///////////////////////////////
    Route::post('/date_invoice', [invoice::class , 'date']);
    //////////////////////
    Route::post('/attend', [attended::class , 'attend']);
    ////////////////////////
    Route::post('/pay_order', [invoice::class , 'pay_order']);
    /////////////////////////////////
    Route::post('/searchbydate_event', [event::class , 'searchbydate_event']);
    Route::post('/searchbyartist_event', [event::class , 'searchbyartist_event']);
    ///////////////////////////
    Route::post('/searchbyname_res', [re_mang_sys::class , 'searchbyname_res']);
    ///////////////////////////////
    Route::post('/searchbyname_sub_cat', [sub_category::class , 'searchbyname_sub_cat']);
    ////////////////////////////////
    Route::post('/searchbyname_sub_place', [sub_place::class , 'searchbyname_sub_place']);
    ////////////////////////////
    Route::post('/insert_fav_sub', [favourity::class , 'insert_fav_sub']);
    Route::post('/insert', [favourity::class , 'insert']);
    Route::post('/index_favourity', [favourity::class , 'index_favourity']);
    Route::post('/show_favourity', [favourity::class , 'show']);
    ///////////////////////////
    Route::post('/insert_fav_re', [fav_re::class , 'insert']);
    Route::post('/show_fav_re', [fav_re::class , 'show']);
    //////////////////////////////
    Route::post('/insert_fav_event', [fav_event::class , 'insert']);
    Route::post('/index_fav_event', [fav_event::class , 'index']);
    Route::post('/show_fav_event', [fav_event::class , 'show']);
    /////////////////////////////
    Route::post('/evaluation', [evaluation::class , 'evaluation']);












});
