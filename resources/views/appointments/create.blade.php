@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 style="font-family: 'Lora', serif;">Novo Agendamento</h1>
        <p class="lead">Escolha um horário e aproveite nossos serviços de terapias orientais para restaurar seu equilíbrio e bem-estar.</p>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('appointments.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="service" class="form-label">Serviço</label>
                            <select class="form-select" id="service" name="service" required>
                                <option selected disabled>Selecione um serviço</option>
                                <option value="Acupuntura">Auriculoterapia</option>
                                <option value="Shiatsu">Shiatsu</option>
                                <option value="Kanrenbuí">Kanrenbuí</option>
                                <option value="Aromaterapia">Aromaterapia</option>
                                <option value="Cromoterapia">Cromoterapia</option>
                                <option value="Spiral Taping">Spiral Taping</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="appointment_date" class="form-label">Data do Agendamento</label>
                            <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
                        </div>
                        <div class="mb-4">
                            <label for="appointment_time" class="form-label">Horário</label>
                            <select id="appointment_time" name="appointment_time" class="form-select" required>
                                <option selected disabled>Selecione um horário</option>
                                <option value="08:00">08:00</option>
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Agendar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Botão Voltar -->
<div class="mb-4 container text-center">
    <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
