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


    //Show Edit Form
    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }


    //Update Listing
    public function update(Request $request, Listing $listing) { //get request through dependency injection
        //validation
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required', //company name has to be unique
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
        //update in database
        $listing->update($formFields); //formFields contains all of our data      
        return back()->with('message', 'Listing updated successfully!'); //with flash message
    } 

    //Delete Listing
    public function destroy(Listing $listing) {
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }
}
