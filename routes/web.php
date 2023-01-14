<?php

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Listing;


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

//All Listings
Route::get('/', [ListingController::class, 'index']);

//Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);



//Common Resource Routes:
//(listing could be any kind of resource)
//index - show all listings - show whole content
//show - show single listing - show single part of content
//create - show form to create new listing - display form on page to create new content
//store - store new listing - submit form and store new content
//edit - show form to edit listing - show edit form on page
//update - update listing - to actually update content (submit edit form to update)
//destroy - delete listing - to delete content

