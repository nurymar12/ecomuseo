@extends('layouts.pdf_layout')
@section('content')
<h4>
    Reporte de donaciones solicitadas -
    del {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}
    al {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
</h4>
<table style="width: 100%; border-collapse: collapse; font-size: 12px;">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tipo</th>
            <th scope="col">Estado</th>
            <th scope="col">Fecha Solicitud</th>
            <th scope="col">Fecha Aprobación</th>
            <th scope="col">Razón Social</th>
            <th scope="col">Contacto</th>
            <th scope="col">Telefono</th>
            <th scope="col">Email</th>
            <th scope="col">Info</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($donations as $donation)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ ucfirst($donation->type) }}</td>
                <td>{{ ucfirst($donation->status) }}</td>
                <td>{{ $donation->requested_date }}</td>
                <td>{{ $donation->approved_date ? $donation->approved_date : 'N/A' }}</td>
                <td>{{ $donation->razon_social }}</td>
                <td>{{ $donation->persona_contacto }}</td>
                <td>{{ $donation->celular_contacto }}</td>
                <td>{{ $donation->email_contacto }}</td>
                <td>{{ $donation->additional_info }}</td>
            </tr>
        @empty
            <tr><td colspan="10"><strong>No hay datos</strong></td></tr>
        @endforelse
    </tbody>
</table>
@endsection
