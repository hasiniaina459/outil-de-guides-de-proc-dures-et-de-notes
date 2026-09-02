@extends('layouts.app')
@section('title', 'afficher les rappels')
@section('content')
    <h1>afficher la rappel</h1>
    <button type="button" onclick="window.print()" class="btn-show">Imprimer</button>
    <a href="{{ route('rappels.index') }}" class="btn-index">Retour à la liste des rappels</a>
    <table>
        <thead>
            <tr>
                <th>titre</th>
                <th>date</th>
                <th>nombre de rappels</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $rappels->remind_title }}</td>
                <td>{{ $rappels->remind_date }}</td>
                <td>{{ $rappels->remind_number }}</td>
            </tr>
        </tbody>
    </table>
@endsection