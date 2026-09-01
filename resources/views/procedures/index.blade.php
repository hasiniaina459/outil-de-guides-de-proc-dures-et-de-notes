@extends('layouts.app')
@section('title', 'Procedures')
@section('content')
    <h1>Procedures</h1>
    <p>This is the procedures index page.</p>
    <a href="{{ route('procedures.create') }}" class="btn-create">Create</a>
    <table>
        <thead>
            <tr>
                <th>title</th>
                <th>description</th>
                <th>date</th>
                <th>etat</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($procedures as $procedure)
            <tr>
                <td>{{ $procedure->title }}</td>
                <td>{{ $procedure->description }}</td>
                <td>{{ $procedure->add_date }}</td>
                <td>{{ $procedure->procedure_status }}</td>
                <td>
                    <a href="{{ route('procedures.edit', $procedure->id) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('procedures.destroy', $procedure->id ) }}" method="POST" class="inline">
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
