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
                <th>preference</th>
                <th>status</th>
                <th>date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
            <tr>
                <td>{{ $note->title }}</td>
                <td>{{ $note->content }}</td>
                <td>{{ $note->preference }}</td>
                <td>{{ $note->note_status }}</td>
                <td>{{ $note->add_date }}</td>
                <td>
                    <a href="{{ route('notes.edit', $note->id) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('notes.destroy', $note->id ) }}" method="POST" class="inline">
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