@extends('layouts.auth')
@section('title', '持ち物リスト')

@section('content')
    <div class="container">
        <div class="trip_detail row">
            <div class="col-md-10 mx-auto">
                <div class="title text-center mt-5">
                    <h2 class="page_title">Item list</h2>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-4 d-flex justify-content-center align-items-center">
                        {{ $trip->trip_title }}
                    </div>
                    <div class="col-md-4 mt-4 d-flex justify-content-center align-items-center">
                        {{ date("Y年m月d日", strtotime($trip->trip_start)) }}〜{{ date("Y年m月d日", strtotime($trip->trip_end)) }}
                    </div>
                    <div class="col-md-2 mt-4 d-flex align-items-center justify-content-center">
                       <a href="{{ action('Auth\TripController@edit',['id'=>$trip->id]) }}" ><button type="button" class="edit_btn btn">編集</button></a>
                    </div>
                    <div class="col-md-2 mt-4 d-flex align-items-center justify-content-center">
                    {{-- 持ち物を全て削除するボタン --}}
                        <button type="button" class="delete_btn btn" data-toggle="modal" data-target="#all_item_Modal" >
                        持ち物全削除
                        </button>
                    </div>
                    <!-- 削除選択時の警告文 -->
                    <div class="modal fade" id="all_item_Modal" tabindex="-1" role="dialog" aria-labelledby="all_item_ModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="all_item_ModalLabel">本当に削除しますか？</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                １度削除すると元に戻せません。
                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <a href="{{ action('Auth\ItemController@alldelete',['id'=>$trip->id]) }}" ><button type="button" class="delete_btn btn" id="deletebtn" name="deletebtn">全ての持ち物を削除する</button></a>
                                    <button type="button" class="stop_delete_btn btn" data-dismiss="modal">削除するのをやめる</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--tripとitemの区切り線--}}
                <hr class="item_line">
                <div class="detail_items_title row mt-2 mb-3">
                    <div class="col-md-3 text-center">
                        重要度
                    </div>
                    <div class="col-md-3 text-center">
                        持ち物
                    </div>
                    <div class="col-md-3 text-center">
                        メモ
                    </div>
                </div>    
                {{-- TripController@showで定義した$tripの中の???からItemControllerで定義した$itemを１つ１つ取り出してる--}}
            　　{{--$postデータベースから。comments:hasManyのリレーションを定義したやつ　$commentはforeach(comment as $comment) --}}
                <div class="add_items row">
                @php $count = 0 @endphp
                {{-- @foreach($trip->items as $item) --}}
                    @foreach($items as $item)
                        {{-- 重要度 --}}
                        <div class="col-md-3 form-check d-flex justify-content-center align-items-center">
                            <label class="form-check-label" for="defaultCheck1">
                                    @if($item->importance == "1" || $item->importance == "2")
                                    <div>S rank</div>
                                    @elseif($item->importance == "3")
                                    <div>A rank</div>  
                                    @elseif($item->importance == "4")
                                    <div>B rank</div>                                
                                    @elseif($item->importance == "5")
                                    <div>C rank</div>    
                                    @elseif($item->importance == "6")
                                    <div>D rank</div> 
                                    @endif
                            </label>
                        </div>
                        {{-- 持ち物 --}}
                        <div class="col-md-3 form-check d-flex justify-content-center align-items-center">
                            <label class="form-check-label" for="defaultCheck1">
                                {{ $item->goods }}
                            </label>
                        </div>
                        {{-- メモ --}}
                        <div class="col-md-3 form-check d-flex justify-content-center align-items-center">
                            <label class="form-check-label" for="defaultCheck1">
                                {{ $item->pivot->memo }}
                            </label>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center align-items-center">
                            <a href="{{ action('Auth\ItemController@delete',['id'=>$item->id]) }}" ><button type="button" class="delete_btn btn btn-sm">削除</button></a>
                        </div>

                    
                @php $count += 1 @endphp
                    @if($count > 0)
                {{-- この</div>は1つの持ち物ごとに１本線を引くためのもの--}}
                </div>
                    <hr class="index_line">
                    <div class = "row">
                @php $count = 0 @endphp
                    @endif 
                    @endforeach
                </div>
                {{--<div class="row d-flex justify-content-center mt-5 mb-4">
                  <button type="button" class="btn btn-primary btn-lg">保存する</button>
                </div>--}}
        
        
                <div class="row text-left mt-5">
                    <h2 class="middle_title">Add Item</h2>
                </div>
                <form action="{{ action('Auth\ItemController@create') }}" method="post">
                    <input type="hidden" name="trip_id" value="{{ $trip->id }}"> 
        
                    <div class="row text-center mt-3">
                        <label class ="col-md-3">重要度</label>
                            <div class="col-md-3">
                                持ち物
                            </div>
                            <div class="col-md-3">
                                メモ
                            </div>
                    </div>
                    <div class="form-group row">
                        <div class="dropdown col-md-3 d-flex justify-content-center">
                            <select name="importance" id="importance-select">
                                <option value="">---重要度を選択---</option>
                                <option value="2">S</option>
                                <option value="3">A</option>
                                <option value="4">B</option>
                                <option value="5">C</option>
                                <option value="6">D</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center">
                            <input type="text" class="form-control" name="goods" value="">
                        </div>
                        <div class="col-md-3 d-flex justify-content-center">
                            <input type="text" class="form-control" name="memo" value="">
                        </div>
                        <div class="col-md-3 d-flex justify-content-center">
                            <input type="submit" class="btn" value="追加">
                        </div>
                    </div>
                    {{ csrf_field() }}
                </form>
                <div class="row d-flex justify-content-center mt-5">
                    <a href="{{ action('Auth\TripController@index') }}"><button class="return_all_post btn" type="button">旅行リスト一覧に戻る</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection