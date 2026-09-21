@extends('layouts.app')
@section('title','demande d\' accés')
@section('content')
<h1>demande d'accés</h1>
@if($demandes->isEmpty())
<p>aucun demande</p>
@else
<table>
    <thead>
        <tr>
            <th>individu</th>
            <th>email</th>
            <th>date demande</th>
            <th>approuve\refuse</th>
        </tr>
    </thead>
    <tbody>
        @foreach($demandes as $demande)
        <tr>
            <td>{{ $demande->individu->name}} {{$demande->individu->firstname}}</td>
            <td>{{ $demande->individu->email}}</td>
            <td>{{ $demande->demande_at->format('d/m/Y H:i')}}</td>
            <td>
                <form action="{{ route('admin.demandes.approve',$demande) }}" method="post" style="display: inline;">
                    @csrf
                    <button type="submit" onclick="return confirm('Accepter cette demande') ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
                            <path d="M13.29 7.29 7 13.58l-2.29-2.29L3.3 12.7l3 3c.2.2.45.29.71.29s.51-.1.71-.29l7-7-1.41-1.41Zm-.29 6.3-.79-.79-1.41 1.41 1.5 1.5c.2.2.45.29.71.29s.51-.1.71-.29l7-7-1.41-1.41-6.29 6.29Z"></path>
                        </svg>
                    </button>
                </form>
                <form action="{{ route('admin.demandes.reject',$demande) }}" method="post" style="display: inline;">
                    @csrf
                    <button type="submit" onclick="return confirm('refuser cette demande') ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
                            <path d="m7.76 14.83-2.83 2.83 1.41 1.41 2.83-2.83 2.12-2.12.71-.71.71.71 1.41 1.42 3.54 3.53 1.41-1.41-3.53-3.54-1.42-1.41-.71-.71 5.66-5.66-1.41-1.41L12 10.59 6.34 4.93 4.93 6.34 10.59 12l-.71.71z"></path>
                        </svg>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection