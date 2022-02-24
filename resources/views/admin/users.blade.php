@extends('admin.layout.index')
 
@section('title', 'Admin Panel')
 
@section('sidebar')
    @parent
@endsection
 
@section('content')
    <table class="table table-stripped text-center">
        <thead>
            <th>Users Names</th>
        </thead>
    @for($i=0;$i<count($firstNames);$i++)
        @php
            $firstname=$firstNames[$i];
            $lastname=$lastNames[$i];
            $name=$firstname." ".$lastname;
        @endphp
        <tr>
            <td>{{$name}}</td>
        </tr>
    @endfor
    </table>
@endsection