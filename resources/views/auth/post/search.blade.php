@extends('layouts.auth')
@section('title', '方面検索/Trirec')

@section('content')
    <div class="post_search container">
        <div class="row col-md-12">
            <div class="page_title mx-auto mt-5">
                Search
            </div>
        </div>
        @csrf
        <div class="row">
            <div class="text-center col-md-12">
                <a href="{{ action('Auth\PostController@result', ['direction' => 'north_america']) }}"><img src="{{secure_asset('images/north_america.png') }}"  class="direction_img img-fluid" alt="north_america_image"></a>
            </div>
        </div>
        <div class="row">
            <div class="text-center col-md-12">
                <a href="{{ action('Auth\PostController@result', ['direction' => 'south_america']) }}"><img src="{{secure_asset('images/south_america.png') }}" class="direction_img img-fluid" alt="south_america_image"></a>
            </div>
        </div>        
        <div class="row">
            <div class="text-center col-md-12">
                <a href="{{ action('Auth\PostController@result', ['direction' => 'asia']) }}"><img src="{{secure_asset('images/asia.png') }}"  class="direction_img img-fluid" alt="asia_image"></a>
            </div>
        </div>                
        <div class="row">
            <div class="text-center col-md-12">
                <a href="{{ action('Auth\PostController@result' , ['direction' => 'europe'])}}"><img src="{{secure_asset('images/europe.png') }}"  class="direction_img img-fluid" alt="europe_image"></a>
            </div>
        </div>
        <div class="row">
            <div class="text-center col-md-12">
                <a href="{{ action('Auth\PostController@result', ['direction' => 'africa']) }}"><img src="{{secure_asset('images/africa.png') }}"  class="direction_img img-fluid" alt="africa_image"></a>
            </div>
        </div>
        <div class="row">
            <div class="text-center col-md-12">
                <a href="{{ action('Auth\PostController@result', ['direction' => 'middle_east']) }}"><img src="{{secure_asset('images/middle_east.png') }}"  class="direction_img img-fluid" alt="middle_east_image"></a>

            </div>
        </div>
        <div class="row">
            <div class="text-center col-md-12">
                <a href="{{ action('Auth\PostController@result', ['direction' => 'oceania']) }}"><img src="{{secure_asset('images/oceania.png') }}"  class="direction_img img-fluid" alt="oceania_image"></a>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mx-auto mt-5">
                <a href="{{ action('Auth\PostController@index') }}"><button class="btn btn-lg btn-block" type="button">投稿一覧に戻る</button></a>
            </div>
        </div>
    </div>
@endsection