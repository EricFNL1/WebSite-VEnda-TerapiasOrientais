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
                            <select class="form-select" id="service" name="service_id" required onchange="updateServiceValue()">
                                <option selected disabled>Selecione um serviço</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" data-value="{{ $service->valor }}" data-name="{{ $service->name }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Campo oculto para salvar o nome do serviço -->
                        <input type="hidden" id="service_name" name="service"> 
                        <div class="mb-4">
                            <label for="appointment_date" class="form-label">Data do Agendamento</label>
                            <input type="date" class="form-control" id="appointment_date" name="appointment_date" required onchange="fetchAvailableTimes()">
                        </div>
                        <div class="mb-4">
                            <label for="appointment_time" class="form-label">Horário</label>
                            <select id="appointment_time" name="appointment_time" class="form-select @error('appointment_time') is-invalid @enderror" required>
                                <option selected disabled>Selecione um horário</option>
                            </select>
                            @error('appointment_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="valor" class="form-label">Valor</label>
                            <input type="text" id="valor" name="valor" class="form-control" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Agendar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Botão Voltar -->
<div class="mb-4 container text-center mt-4">
    <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Voltar</a>
</div>

<!-- Script para buscar horários disponíveis dinamicamente -->
<script>
    // Função para atualizar o valor do serviço
    function updateServiceValue() {
        const serviceSelect = document.getElementById('service');
        const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
        const serviceValue = selectedOption.getAttribute('data-value');
        const serviceName = selectedOption.getAttribute('data-name');

        // Atualiza os campos ocultos
        document.getElementById('valor').value = serviceValue;
        document.getElementById('service_name').value = serviceName;
    }

    // Função para buscar horários disponíveis dinamicamente
    function fetchAvailableTimes() {
    const date = document.getElementById('appointment_date').value;

    if (date) {
        fetch(`/appointments/available-times?date=${date}`)
            .then(response => response.json())
            .then(data => {
                console.log(data); // Verificar a resposta
                const timeSelect = document.getElementById('appointment_time');
                timeSelect.innerHTML = '<option selected disabled>Selecione um horário</option>';

                // Transformar os horários disponíveis em um array, se necessário
                const availableTimes = Object.values(data.availableTimes);

                // Verifica se há horários disponíveis
                if (availableTimes.length > 0) {
                    availableTimes.forEach(time => {
                        timeSelect.innerHTML += `<option value="${time}">${time}</option>`;
                    });
                } else {
                    timeSelect.innerHTML = '<option selected disabled>Nenhum horário disponível</option>';
                }
            })
            .catch(error => console.error('Erro ao buscar horários disponíveis:', error));
    }
}

</script>
@endsection
