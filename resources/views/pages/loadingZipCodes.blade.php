@extends('layouts.base')

@section('tittle', 'Loading Zip Codes')

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
        <div id="tittle" class="title" style="font-size: 60px;display: inline-flex; margin: 12%">
            <div class="title_content">Loading Zip Codes</div>
            <div class="title_content" id="loading_text" style="margin: -3% 20px; min-width: 40px; text-align: left; font-size: 80px"></div>
        </div>
    </div>
    <script>
        $(document).ready(function (e) {
            loadZipCodes();
        });

    </script>
@endsection