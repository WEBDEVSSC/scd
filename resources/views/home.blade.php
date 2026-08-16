@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="m-0 font-weight-bold text-dark">Panel de Control</h1>
            <p class="text-muted mb-0">Bienvenido(a), <strong>{{ $user->name }}</strong></p>
        </div>
        <div class="d-flex align-items-center">
            @if($climaData)
                <!-- WIDGET CLIMA MÁS ANCHO Y ALTO -->
                <div class="weather-header-widget d-none d-sm-flex align-items-center bg-white border rounded-lg px-3 py-2 shadow-sm mr-3">
                    <!-- Ciudad, Icono y Temperatura -->
                    <div class="d-flex align-items-center pr-3 border-right mr-3">
                        <span class="mr-2" style="font-size: 1.6rem; line-height: 1;">{{ $climaData['estado']['icon'] }}</span>
                        <div>
                            <span class="font-weight-bold d-block text-dark line-height-1" style="font-size: 0.95rem;">
                                {{ $climaData['city'] }}
                            </span>
                            <small class="text-muted font-weight-bold line-height-1" style="font-size: 0.85rem;">
                                {{ round($climaData['current']['temperature_2m']) }}{{ $climaData['units']['temperature_2m'] }}
                            </small>
                        </div>
                    </div>

                    <!-- Detalles: Humedad, Viento, Sensación -->
                    <div class="d-flex align-items-center text-muted font-weight-normal" style="font-size: 0.82rem; gap: 14px;">
                        <span title="Humedad" class="d-flex align-items-center">
                            <i class="fas fa-tint text-info mr-1.5 fa-fw"></i>
                            <strong class="text-dark ml-1">{{ $climaData['current']['relative_humidity_2m'] }}{{ $climaData['units']['relative_humidity_2m'] }}</strong>
                        </span>
                        <span title="Viento" class="d-flex align-items-center">
                            <i class="fas fa-wind text-secondary mr-1.5 fa-fw"></i>
                            <strong class="text-dark ml-1">{{ round($climaData['current']['wind_speed_10m']) }} {{ $climaData['units']['wind_speed_10m'] }}</strong>
                        </span>
                        <span title="Sensación Térmica" class="d-flex align-items-center">
                            <i class="fas fa-thermometer-half text-warning mr-1.5 fa-fw"></i>
                            <strong class="text-dark ml-1">{{ round($climaData['current']['apparent_temperature'] ?? $climaData['current']['temperature_2m']) }}°</strong>
                        </span>
                    </div>
                </div>
            @endif

            <button class="btn btn-outline-secondary btn-md shadow-sm px-3" onclick="window.location.reload();">
                <i class="fas fa-sync-alt mr-1"></i> Actualizar
            </button>
        </div>
    </div>
@stop

@section('content')

    <!-- 1. TARJETAS MÉTRICAS PRINCIPALES -->
    <div class="row">
        <!-- Total Registros -->
        <div class="col-xl-3 col-md-6 col-12 mb-3">
            <div class="small-box bg-info elevation-2">
                <div class="inner">
                    <h3>{{ $totalRegistrosSubdireccion ?? 0 }}</h3>
                    <p class="mb-0">Total Recibidos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-folder-open"></i>
                </div>
                <a href="{{ route('documentosRecibidosPanelDeControl') }}" class="small-box-footer">Ver expediente completo <i class="fas fa-arrow-circle-right ml-1"></i></a>
            </div>
        </div>

        <!-- Nuevos -->
        <div class="col-xl-3 col-md-6 col-12 mb-3">
            <div class="small-box bg-warning elevation-2">
                <div class="inner">
                    <h3>{{ $totalRegistrosSubdireccionNuevos ?? 0 }}</h3>
                    <p class="mb-0">Nuevos Sin Revisar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-medical"></i>
                </div>
                <a href="{{ route('documentosRecibidos') }}" class="small-box-footer">Priorizar revisión <i class="fas fa-arrow-circle-right ml-1"></i></a>
            </div>
        </div>

        <!-- Turnados -->
        <div class="col-xl-3 col-md-6 col-12 mb-3">
            <div class="small-box bg-primary elevation-2">
                <div class="inner">
                    <h3>{{ $totalRegistrosSubdireccionTurnados ?? 0 }}</h3>
                    <p class="mb-0">Turnados a Área</p>
                </div>
                <div class="icon">
                    <i class="fas fa-route"></i>
                </div>
                <a href="{{ route('documentosRecibidosTurnados') }}" class="small-box-footer">Ver estatus en áreas <i class="fas fa-arrow-circle-right ml-1"></i></a>
            </div>
        </div>

        <!-- Atendidos -->
        <div class="col-xl-3 col-md-6 col-12 mb-3">
            <div class="small-box bg-success elevation-2">
                <div class="inner">
                    <h3>{{ $totalRegistrosSubdireccionAtendidos ?? 0 }}</h3>
                    <p class="mb-0">Atendidos / Concluidos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <a href="{{ route('documentosRecibidosAtendidos') }}" class="small-box-footer">Ver catálogo de atendidos <i class="fas fa-arrow-circle-right ml-1"></i></a>
            </div>
        </div>
    </div>

    <!-- 2. SECCIÓN DE GRÁFICAS Y ACCIONES RÁPIDAS -->
    <div class="row">
        <!-- Gráfica de Distribución (Dona / Pastel) -->
        <div class="col-lg-7 col-12">
            <div class="card card-outline card-primary elevation-2">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-chart-pie mr-1 text-primary"></i> Estado General de Documentos
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-responsive">
                        <canvas id="documentosStatusChart" height="160"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Accesos Directos / Botones de Acción -->
        <div class="col-lg-5 col-12">
            <div class="card card-outline card-secondary elevation-2">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-rocket mr-1 text-secondary"></i> Acciones Rápidas
                    </h3>
                </div>
                <div class="card-body d-flex flex-column justify-content-around">
                    <a href="#" class="btn btn-outline-primary btn-block text-left p-3 mb-2 shadow-sm action-btn">
                        <i class="fas fa-plus-circle fa-lg mr-2 text-primary"></i>
                        <strong> Registrar Nuevo Documento</strong>
                        <span class="float-right text-muted"><i class="fas fa-chevron-right"></i></span>
                    </a>

                    <a href="#" class="btn btn-outline-warning btn-block text-left p-3 mb-2 shadow-sm action-btn">
                        <i class="fas fa-search fa-lg mr-2 text-warning"></i>
                        <strong> Consultar / Buscar Expediente</strong>
                        <span class="float-right text-muted"><i class="fas fa-chevron-right"></i></span>
                    </a>

                    <a href="#" class="btn btn-outline-success btn-block text-left p-3 mb-0 shadow-sm action-btn">
                        <i class="fas fa-file-excel fa-lg mr-2 text-success"></i>
                        <strong> Exportar Reporte a Excel</strong>
                        <span class="float-right text-muted"><i class="fas fa-chevron-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. BARRAS DE PROGRESO Y DESGLOSE EN PORCENTAJE -->
    <div class="row">
        <div class="col-12">
            <div class="card elevation-2">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-tasks mr-1 text-info"></i> Eficiencia Operativa de la Subdirección
                    </h3>
                </div>
                <div class="card-body">
                    @php
                        $total = $totalRegistrosSubdireccion ?? 1;
                        $total = $total == 0 ? 1 : $total;

                        $pctNuevos = round((($totalRegistrosSubdireccionNuevos ?? 0) / $total) * 100);
                        $pctTurnados = round((($totalRegistrosSubdireccionTurnados ?? 0) / $total) * 100);
                        $pctAtendidos = round((($totalRegistrosSubdireccionAtendidos ?? 0) / $total) * 100);
                    @endphp

                    <label class="mb-1">Porcentaje de Atendidos (Meta: > 80%)</label>
                    <div class="progress mb-3" style="height: 20px;">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" 
                             role="progressbar" 
                             style="width: {{ $pctAtendidos }}%" 
                             aria-valuenow="{{ $pctAtendidos }}" aria-valuemin="0" aria-valuemax="100">
                             {{ $pctAtendidos }}%
                        </div>
                    </div>

                    <label class="mb-1">En Proceso / Turnados</label>
                    <div class="progress mb-3" style="height: 20px;">
                        <div class="progress-bar bg-primary" 
                             role="progressbar" 
                             style="width: {{ $pctTurnados }}%" 
                             aria-valuenow="{{ $pctTurnados }}" aria-valuemin="0" aria-valuemax="100">
                             {{ $pctTurnados }}%
                        </div>
                    </div>

                    <label class="mb-1">Pendientes por Revisar (Nuevos)</label>
                    <div class="progress mb-0" style="height: 20px;">
                        <div class="progress-bar bg-warning" 
                             role="progressbar" 
                             style="width: {{ $pctNuevos }}%" 
                             aria-valuenow="{{ $pctNuevos }}" aria-valuemin="0" aria-valuemax="100">
                             {{ $pctNuevos }}%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .small-box {
            border-radius: 12px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .small-box:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
        }
        .line-height-1 {
            line-height: 1.1;
        }
        .action-btn {
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .action-btn:hover {
            transform: translateX(4px);
        }
        .weather-header-widget {
            min-height: 48px;
            border-color: #e2e8f0 !important;
        }
        .mr-1-5 {
            margin-right: 0.375rem;
        }
    </style>
@stop

@section('js')
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('documentosStatusChart').getContext('2d');

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Nuevos', 'Turnados a Área', 'Atendidos'],
                    datasets: [{
                        data: [
                            {{ $totalRegistrosSubdireccionNuevos ?? 0 }},
                            {{ $totalRegistrosSubdireccionTurnados ?? 0 }},
                            {{ $totalRegistrosSubdireccionAtendidos ?? 0 }}
                        ],
                        backgroundColor: ['#ffc107', '#007bff', '#28a745'],
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>
@stop