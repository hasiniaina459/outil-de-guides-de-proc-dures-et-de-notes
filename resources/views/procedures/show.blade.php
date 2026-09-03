@extends('layouts.app')
@section('title', 'afficher les procedures')
@section('content')
    <div class="retour">
        <a href="{{ route('procedures.index') }}" class="btn-index">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                fill="currentColor" viewBox="0 0 24 24">
                <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
                <path d="M15 11H8v2h7v4l6-5-6-5z"></path>
                <path d="M5 21h7v-2H5V5h7V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2"></path>
            </svg>
        </a>
        <h1>Liste des procedures</h1>
    </div>
    <button type="button" onclick="window.print()" class="btn-show">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            fill="currentColor" viewBox="0 0 24 24">
            <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
            <path d="M19 7h-1V2H6v5H5c-1.65 0-3 1.35-3 3v7c0 1.1.9 2 2 2h2v3h12v-3h2c1.1 0 2-.9 2-2v-7c0-1.65-1.35-3-3-3M8 4h8v3H8zm8 16H8v-4h8zm4-3h-2v-3H6v3H4v-7c0-.55.45-1 1-1h14c.55 0 1 .45 1 1z"></path>
            <path d="M14 11h4v1h-4z"></path>
        </svg>imprimer
    </button>
    <table>
        <thead>
            <tr>
                <th>titre</th>
                <th>description</th>
                <th>date</th>
                <th>etat</th>
                <th>services</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $procedures->procedure_title }}</td>
                <td>{{ $procedures->description }}</td>
                <td>{{ $procedures->add_date }}</td>
                <td>{{ $procedures->procedure_status }}</td>
                <td>
                    @foreach($procedures->services as $service)
                        {{ $service->service_name }}{{ !$loop->last ? ', ' : '' }}
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>
@endsection