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
<div style="margin: 10px 10%; text-align: center; align-content: center">
    @unless($agents)
        <div class="panel panel-default">
            <div class="panel-body">
                No agents
            </div>
        </div>
    @endunless

    @if($agents->count()>0)
        <div class="panel panel-default">
            <div class="panel-body">
                <center><h1>Agents</h1></center>
                <table class="table table-bordered table-hover">
                    <thead>
                    <th>Agent_id</th>
                    <th>Agent_code</th>
                    <th>Agent_person_id</th>
                    <th>Agent_person_name</th>
                    <th>Agent_person_location</th>
                    <th>Action</th>
                    </thead>
                    <tbody>
                    @foreach($agents as $agent)
                        <tr>
                            <td>{{ $agent->id }}</td>
                            <td>{{ $agent->agent_code }}</td>
                            <td>{{ $agent->person->id }}</td>
                            <td>{{ $agent->person->name }}</td>
                            <td>{{ $agent->person->location->zipcode }}</td>
                            <td>
                                <a href="/agent/{{ $agent->id }}/edit" class="btn btn-default">Edit</a>
                                <a href="/agent/{{ $agent->id }}" class="btn btn-default">Info</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-body center-block">
                <a href="/agent/create" class="btn btn-info">Create Agent</a>
            </div>
        </div>
    @endif
</div>
@endsection