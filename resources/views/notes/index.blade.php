@extends('layouts.app')
@section('title', 'notes')
@section('content')
    <h1>notes</h1>      
    <p>This is the notes index page.</p>
    <a href="{{ route('notes.create') }}" class="btn-create">Create</a>
    <table>
        <thead> 
            <tr>
                <th>title</th>
                <th>content</th>
                <th>status</th>
                <th>date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
            <tr>
                <td>{{ $note->note_title }}</td>
                <td>{{ $note->content }}</td>
                <td>{{ $note->note_status }}</td>
                <td>{{ $note->note_date }}</td>
                <td>
                    <a href="{{ route('notes.show', $note->id_note) }}" class="btn-show">Show</a>
                    <a href="{{ route('notes.edit', $note->id_note) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('notes.destroy', $note->id_note) }}" method="POST" class="inline">
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