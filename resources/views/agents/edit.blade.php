@extends('layouts.base')

@section('tittle', 'Edit Agent')

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
    {{ $agent->id }}
    {{ $agent->agent_code }}
@endsection