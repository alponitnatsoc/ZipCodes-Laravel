@extends('layouts.base')

@section('tittle', 'agents')

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
    @extends('layouts.base')

@section('tittle', 'List Agent')

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
    <style>
        .zipcode{
            width: 50%;
        }
        .control-label{
            text-align: left;!important;
        }
    </style>
    <div style="margin: 10px 25%; text-align: center; align-content: center">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1>Agents Location</h1>
                <form class="form-horizontal" action="/match" method="POST">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="inputZipcode1" placeholder="Zip Code Agent 1">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="inputZipcode2" placeholder="Zip Code Agent 2">
                            </div>
                        </div>
                    </div>
                    <div style="align-content: center;text-align: center">
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">MATCH</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@endsection

