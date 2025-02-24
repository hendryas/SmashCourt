<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Auth
$routes->group('auth', ['namespace' => 'App\Controllers\Auth'], function ($routes) {
    $routes->get('login', 'AuthController::login');
    $routes->post('processLogin', 'AuthController::processLogin');
    $routes->get('register', 'AuthController::register');
    $routes->post('processRegister', 'AuthController::processRegister');
    $routes->get('logout', 'AuthController::logout');
});

// Dashboard
$routes->group('dashboard', ['namespace' => 'App\Controllers\Dashboard'], function ($routes) {
    $routes->get('/', 'DashboardController::index');
});

// Field List
$routes->group('field-list', ['namespace' => 'App\Controllers\FieldList'], function ($routes) {
    $routes->get('/', 'FieldListController::index');
    $routes->get('add-data', 'FieldListController::addData');
    $routes->post('save', 'FieldListController::save');
    $routes->post('delete', 'FieldListController::delete');
    $routes->get('edit-data/(:num)', 'FieldListController::editData/$1');
    $routes->post('update/(:num)', 'FieldListController::update/$1');
});

// field-booking
$routes->group('field-booking', ['namespace' => 'App\Controllers\FieldBooking'], function ($routes) {
    $routes->get('/', 'FieldBookingController::index');
    $routes->get('form-booking/(:num)', 'FieldBookingController::formBooking/$1');
    $routes->post('save', 'FieldBookingController::save');
    $routes->post('delete', 'FieldBookingController::delete');
    $routes->get('edit-data/(:num)', 'FieldBookingController::editData/$1');
    $routes->post('update/(:num)', 'FieldBookingController::update/$1');
});

// user-booking
$routes->group('user-booking', ['namespace' => 'App\Controllers\UserBooking'], function ($routes) {
    $routes->get('/', 'UserBookingController::index');
    $routes->post('confirm-payment/(:num)', 'UserBookingController::confirmPayment/$1');
});

// booking-history
$routes->group('booking-history', ['namespace' => 'App\Controllers\BookingHistory'], function ($routes) {
    $routes->get('/', 'BookingHistoryController::index');
    $routes->post('confirm-payment/(:num)', 'BookingHistoryController::confirmPayment/$1');
});

// daily-booking-list
$routes->group('daily-booking-list', ['namespace' => 'App\Controllers\DailyBookingList'], function ($routes) {
    $routes->get('/', 'DailyBookingListController::index');
    $routes->post('confirm-attendance/(:num)', 'DailyBookingListController::confirmAttendance/$1');
});
