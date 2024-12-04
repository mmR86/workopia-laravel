<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/jobs', function() {
    $title = 'Available jobz';
    $jobs = ['Web Developerz', 'Database Adminz', 'Software Engineer', 'Systems Analyst'];

    return view('jobs.index', compact('title', 'jobs'));
})->name('jobs');

Route::get('/jobs/create', function() {
    return view('jobs.create');
})->name('jobs.create');
