@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Novo Agendamento</h1>
    <form method="POST" action="{{ route('appointments.store') }}">
        @csrf
        <div class="mb-3">
            <label for="service" class="form-label">Serviço</label>
            <input type="text" class="form-control" id="service" name="service" required>
        </div>
        <div class="mb-3">
            <label for="appointment_date" class="form-label">Data do Agendamento</label>
            <input type="datetime-local" class="form-control" id="appointment_date" name="appointment_date" required>
        </div>
        <button type="submit" class="btn btn-primary">Agendar</button>
    </form>
</div>
@endsection
