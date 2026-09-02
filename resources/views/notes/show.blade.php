@extends('layouts.app')
@section('title', 'afficher les notes')
@section('content')
    <h1>afficher la note</h1>
    <button type="button" onclick="window.print()" class="btn-show">Imprimer</button>
    <a href="{{ route('notes.index') }}" class="btn-index">Retour à la liste des notes</a>
    <table>
        <thead>
            <tr>
                <th>titre</th>
                <th>contenu</th>
                <th>statut</th>
                <th>date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $notes->note_title }}</td>
                <td>{{ $notes->content }}</td>
                <td>{{ $notes->note_status }}</td>
                <td>{{ $notes->note_date }}</td>
            </tr>
        </tbody>
    </table>
@endsection