@extends('layouts.app')
@section('title', 'afficher les procedures')
@section('content')
    <h1>afficher la procedure</h1>
    <button type="button" onclick="window.print()" class="btn-show">Imprimer</button>
    <a href="{{ route('procedures.index') }}" class="btn-index">Retour à la liste des procedures</a>
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