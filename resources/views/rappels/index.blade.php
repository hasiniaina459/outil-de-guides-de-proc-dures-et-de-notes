@extends('layouts.app')
@section('title', 'rappels')
@section('content')
    <h1>rappels</h1>
    <p>This is the rappels index page.</p>
    
    <a href="{{ route('rappels.create') }}" class="btn-create">Create</a>
    <table>
        <thead>
            <tr>
                <th>title</th>
                <th>date</th>
                <th>remind number</th>
        </thead>
        <tbody>
            @foreach($rappels as $rappel)
            <tr>
                <td>{{ $rappel->remind_title }}</td>
                <td>{{ $rappel->remind_date }}</td>
                <td>{{ $rappel->remind_number }}</td>
                <td>        
                    <a href="{{ route('rappels.show', $rappel->id_rappel) }}" class="btn-show">Show</a>
                    <a href="{{ route('rappels.edit', $rappel->id_rappel) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('rappels.destroy', $rappel->id_rappel) }}" method="POST" style="display: inline-block;">
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