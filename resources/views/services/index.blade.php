@extends('layouts.app')

@section('title', 'Services')

@section('content')
    <h1>Services</h1>
    <p>This is the services index page.</p>
    <a href="{{ route('services.create') }}" class="btn-create">create</a>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
            <tr>
                <td>{{ $service->nom }}</td>
                <td>{{ $service->description }}</td>
                <td>
                    <a href="{{ route('services.edit', $service->id) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('services.destroy', $service->id ) }}" method="POST" class="inline">
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