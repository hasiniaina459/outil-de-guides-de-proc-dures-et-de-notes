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
            <td>{{ $procedure->procedure_title }}</td>
            <td>{{ $procedure->description }}</td>
            <td>{{ $procedure->add_date }}</td>
            <td>{{ $procedure->procedure_status }}</td>
            <td>
                <a href="{{ route('procedures.show', $procedure->id_procedure) }}" class="btn-show">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="currentColor" viewBox="0 0 24 24">
                        <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
                        <path d="m19.94 7.68-.03-.09a.8.8 0 0 0-.2-.29l-5-5c-.09-.09-.19-.15-.29-.2l-.09-.03a.8.8 0 0 0-.26-.05c-.02 0-.04-.01-.06-.01H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-12s-.01-.04-.01-.06c0-.09-.02-.17-.05-.26ZM6 20V4h7v4c0 .55.45 1 1 1h4v11z"></path>
                        <path d="M8 11h8v2H8zm0 4h8v2H8zm0-8h3v2H8z"></path>
                    </svg>
                </a>
                <a href="{{ route('procedures.edit', $procedure->id_procedure) }}" class="btn-edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="currentColor" viewBox="0 0 24 24">
                        <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
                        <path d="M5 21h14c1.1 0 2-.9 2-2v-7h-2v7H5V5h7V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2"></path>
                        <path d="M7 13v3c0 .55.45 1 1 1h3c.27 0 .52-.11.71-.29l9-9a.996.996 0 0 0 0-1.41l-3-3a.996.996 0 0 0-1.41 0l-9.01 8.99A1 1 0 0 0 7 13m10-7.59L18.59 7 17.5 8.09 15.91 6.5zm-8 8 5.5-5.5 1.59 1.59-5.5 5.5H9z"></path>
                    </svg>
                </a>
                <form action="{{ route('procedures.destroy', $procedure->id_procedure ) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
                            <path d="M17 6V4c0-1.1-.9-2-2-2H9c-1.1 0-2 .9-2 2v2H2v2h2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8h2V6zM9 4h6v2H9zM6 20V8h12v12z"></path>
                            <path d="M9 10h2v8H9zm4 0h2v8h-2z"></path>
                        </svg>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection