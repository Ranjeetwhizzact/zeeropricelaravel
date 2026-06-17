@extends('layout.app')

@section('title', 'Whizzact | Job list')

@section('style')
    {{-- <link rel="stylesheet" href="{{ url('/assests/css/careerlist.css') }}"> --}}
@endsection

@section('content')
    @include('admin.common.header')
     <div class="flex max-w-1980 mx-auto">
@include('admin.common.sidenavbar')
  <div id="main-content" class="flex-grow min-h-screen pt-4 lg:pt-0 pb-12 transition-all duration-300 ease-in-out">
            
     

        </div>


</div>
  @include('admin.common.footer')
@endsection

@section('script')
    <script src="{{ url('/assests/js/home.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
