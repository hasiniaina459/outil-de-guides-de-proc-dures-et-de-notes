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
                                <button type="submit" onclick="return confirm('Accepter cette demande') ">approuver</button>
                            </form>
                            <form action="{{ route('admin.demandes.reject',$demande) }}" method="post" style="display: inline;">
                                @csrf
                                <button type="submit" onclick="return confirm('refuser cette demande') ">refuser</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection