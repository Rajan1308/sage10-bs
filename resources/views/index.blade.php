@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  <div class="container mx-auto py-16 hero" id="hero">
    <h1 class="text-4xl font-bold text-center text-gray-800">Welcome to Westpack</h1>
    <p class="mt-4 text-center text-gray-600">Delivering excellence with smooth transitions.</p>
  </div>


  <div class="container mx-auto py-16 hero" id="hero">
    <h1 class="text-4xl font-bold text-center text-gray-800">Welcome to Westpack</h1>
    <p class="mt-4 text-center text-gray-600">Delivering excellence with smooth transitions.</p>
  </div>
  <div class="container hero">
    <h1 class="text-white bg-primary text-center py-3">Hello Bootstrap</h1>
  </div>
  
  <x-card 
  title="My Card Title"
  text="Some description here."
  image="https://via.placeholder.com/286x180"
  link="https://example.com"
  link-text="Visit site"
/>


  </div>
  @if (! have_posts())
    <x-alert type="warning">
      {!! __('Sorry, no results were found.', 'sage') !!}
    </x-alert>

    {!! get_search_form(false) !!}
  @endif

  @while(have_posts()) @php(the_post())
    @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
  @endwhile

  {!! get_the_posts_navigation() !!}
@endsection

@section('sidebar')
  @include('sections.sidebar')
@endsection
