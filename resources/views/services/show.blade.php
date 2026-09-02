@extends('layouts.app')
@section('title', 'liste des services')
@section('content')
    <h1>Liste des services</h1>
    <a href="{{ route('services.index') }}" class="btn-index">Retour à la liste des services</a>
    <button type="button" onclick="window.print()" class="btn-show">Imprimer</button>
    <table>
        <thead>
            <tr>
                <th>nom du service</th>
                <th>description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $services->service_name }}</td>
                <td>{{ $services->description }}</td>
            </tr>
        </tbody>
    </table>
    <a href="{{ route('services.index') }}">Retour à la liste des services</a>
@endsection