@extends('layout')


@section('content')

<!-- includes partials -->
@include('partials._hero') 
@include('partials._search')

<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

@if(count($listings) == 0)
    <p>No listings found.</p>
@endif

<!-- List each Listing -->
@foreach($listings as $listing)
    <!-- access component -->
    <x-listing-card :listing="$listing" /> <!-- prefix ':' needed if you want to pass in a variable -->
@endforeach

</div>

@endsection
 