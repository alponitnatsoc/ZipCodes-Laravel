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
 <div style="margin: 10px;display: inline-flex">
     <style>
         .badge{
             padding: 3px 15px !important;
             font-size: 14px;
             min-width: 20px !important;
             border-radius: 2px !important;
             margin-left: 10px;
         }
     </style>
     <div class="panel panel-default">
         <div class="panel-body">
             <ul class="list-group">
                 <li class="list-group-item">
                     <span class="badge"> {{ $agent->id }}</span>
                     Agent_id
                 </li>
                 <li class="list-group-item">
                     <span class="badge"> {{ $agent->agent_code }}</span>
                     Agent_code
                 </li>
                 <li class="list-group-item">
                     <span class="badge"> {{ $agent->person->id }}</span>
                     Agent_person_id
                 </li>
                 <li class="list-group-item">
                     <span class="badge"> {{ $agent->person->name }}</span>
                     Agent_person_name
                 </li>
                 <li class="list-group-item">
                     <span class="badge"> {{ $agent->person->location->zipcode }}</span>
                     Agent_person_location
                 </li>
             </ul>
         </div>
     </div>

     @unless($agent->contacts->count() >0)
         <div class="panel panel-default">
             <div class="panel-body">
                 No contacts
             </div>
         </div>
     @endunless

     @if($agent->contacts->count()>0)
         <div class="panel panel-default">
             <div class="panel-body">
                 <center><h1>Contacts</h1></center>
                 <table class="table table-bordered table-hover">
                     <thead>
                     <th>Person_id</th>
                     <th>Person_name</th>
                     <th>Person_location</th>
                     </thead>
                     <tbody>
                     @foreach($agent->contacts as $contact)
                         <tr>
                             <td>{{ $contact->id }}</td>
                             <td>{{ $contact->name }}</td>
                             <td>{{ $contact->location->zipcode }}</td>
                         </tr>
                     @endforeach
                     </tbody>
                 </table>
             </div>
         </div>
     @endif
 </div>
 <script>
     $(document).ready(function () {
         var maxWidth = 0;
         $("span").each(function () {
             maxWidth = ($(this).width()>maxWidth)?$(this).width():maxWidth;
         });
         $("span").each(function () {
             $(this).width(maxWidth);
         });
     });
 </script>
@endsection