<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //Show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6) //calls function in Listing Model for filtering by tag with scope filter
        ]);
    }

    //Show single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //Show create job form
    public function create() {
        return view('listings.create');
    }

    //Store new listing
    public function store(Request $request) { //get request through dependency injection
        //validation
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')], //company name has to be unique
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'], //has to be formatted like email
            'tags' => 'required',
            'description' => 'required'
        ]); //if any of this fails it is gonna send back an error (@error in create file)

        //check if logo is uploaded
        if($request->hasFile('logo')) {
            //add to form field
            //set to path and upload at the same time
            $formFields['logo'] = $request->file('logo')->store('logos', 'public'); //create folder logos in storage/app/public
        }


        //create in database
        Listing::create($formFields); //formFields contains all of our data      

        return redirect('/')->with('message', 'Listing created successfully!'); //with flash message
    }
}
