@extends('layouts.base')

@section('tittle', 'Load Fail')

@section('fonts')
    @parent
@endsection
@section('styles')
    @parent
@endsection
@section('scripts')
    @parent
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <div class="content center-block" style=" text-align: center; height:100%;vertical-align: middle;">
        <div id="tittle" class="title center-block" style="font-size: 60px; margin: 12%">
            <h1>Error, @if($error != null){{ $error }}@else message missing @endif</h1>
            <a id="error_msg" class="btn center-block" style="font-size: 41px;margin-top: 25px;font-weight: 700;padding: 1px 40px;border: 1px solid lightblue;width: 20%;background-color:#e6f9ff " href="{{route('loading')}}">Reload</a>
        </div>
    </div>
@endsection