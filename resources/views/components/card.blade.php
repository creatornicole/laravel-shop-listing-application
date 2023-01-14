<div {{$attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6'])}}> <!-- add attributes like this to component -->

    <!-- use slot for wrapping component -->
    {{$slot}}

</div>