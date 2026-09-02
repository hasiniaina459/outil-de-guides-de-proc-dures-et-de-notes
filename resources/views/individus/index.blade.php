@extends('layouts.app')

@section('title', 'Individus')

@section('content')
    <h1>Individus</h1>
    <p>This is the individus index page.</p>
    <a href="{{ route('individus.create') }}" class="btn-create">Create</a>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>telephone</th>
                <th>Email</th>
                <th>Préférences de notification</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($individus as $individu)
            <tr>
                <td>{{ $individu->name }}</td>
                <td>{{ $individu->firstname }}</td>
                <td>{{ $individu->phone }}</td>
                <td>{{ $individu->email }}</td>
                <td>{{ implode(', ', $individu->notif_preference) }}</td>
                <td>
                    <a href="{{ route('individus.show', $individu->id_individu) }}" class="btn-show">Show</a>
                    <a href="{{ route('individus.edit', $individu->id_individu) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('individus.destroy', $individu->id_individu ) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
