@extends('layouts.base')

@section('tittle', 'Match contacts')

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
        @if(isset($contacts) and $contacts->count()>0 )
            <div class="panel panel-default">
                <div class="panel-body">
                    <center><h1>Contacts</h1></center>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <th>Agent Id</th>
                        <th>Contact Name</th>
                        <th>Zip Code</th>
                        </thead>
                        <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td>{{ $contact->agent->id }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->location->zipcode }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">RETURN</button>
                    </div>
                </div>
            </div>

    </div>
@endsection

