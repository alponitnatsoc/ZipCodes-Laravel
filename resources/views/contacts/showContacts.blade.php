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
        @if($contacts->count()==0)
            <div class="panel panel-default">
                <div class="panel-body">
                    No contacts
                </div>
            </div>
        @else
            <div class="panel panel-default">
                <div class="panel-body">
                    <center><h1>Contacts</h1></center>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <th>Contact_person_id</th>
                        <th>Contact_person_name</th>
                        <th>Contact_person_location</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td>{{ $contact->id }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->location->zipcode }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection