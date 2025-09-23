<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default: arahkan ke login
$routes->get('/', 'Auth::index');

// Auth
$routes->get('/login', 'Auth::index');    // tampilkan form login
$routes->post('/login', 'Auth::login');   // proses login
$routes->get('/logout', 'Auth::logout');  // logout

// Student Pages (dengan autentikasi)
$routes->group('student', ['filter' => 'auth:student'], function ($routes) {
    $routes->get('dashboard', 'Student::dashboard');
    $routes->get('courses', 'Student::courses');
    $routes->get('enroll/(:num)', 'Student::enroll/$1');
    $routes->get('profile', 'Student::profile');
    $routes->get('delete_enroll/(:num)', 'Student::deleteEnroll/$1');
    $routes->post('enroll_multiple', 'Student::enrollMultiple');
});

// API Routes (tanpa filter autentikasi untuk saat ini, akan ditambahkan nanti)
$routes->group('api', function ($routes) {
    $routes->get('courses', 'Student::getCourses');
    $routes->post('enroll', 'Student::enrollCourse');
});

// Admin
$routes->group('admin', ['filter' => 'auth:admin'], function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('courses', 'Admin::courses');
    $routes->get('courses/create', 'Admin::createCourse');
    $routes->post('courses/store', 'Admin::storeCourse');
    $routes->get('courses/edit/(:num)', 'Admin::editCourse/$1');
    $routes->post('courses/update/(:num)', 'Admin::updateCourse/$1');
    $routes->get('courses/delete/(:num)', 'Admin::deleteCourse/$1');

    $routes->get('students', 'Admin::students');
    $routes->get('students/create', 'Admin::createStudent');
    $routes->post('students/store', 'Admin::storeStudent');
    $routes->get('students/edit/(:num)', 'Admin::editStudent/$1');
    $routes->post('students/update/(:num)', 'Admin::updateStudent/$1');
    $routes->get('students/delete/(:num)', 'Admin::deleteStudent/$1');
    $routes->get('students/detail/(:num)', 'Admin::detail/$1');

    $routes->get('manage_students', 'Admin::students');
    $routes->get('manage_courses', 'Admin::courses');
});

// Enrollment Management
$routes->get('/enrollment', 'Enrollment::index', ['filter' => 'auth:admin']);
$routes->post('/enrollment/store', 'Enrollment::store', ['filter' => 'auth:admin']);
$routes->get('/enrollment/delete/(:num)', 'Enrollment::delete/$1', ['filter' => 'auth:admin']);