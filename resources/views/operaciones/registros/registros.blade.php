@extends('layouts.dashboard')

@section('title', 'Registros')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-content">
                            <div class="panel-tag">
                                Las areas de registros son los diferentes modos o tipos de facturación u operaciones que
                                ejecutan las maquinarias y por lo tanto la forma de realizar sus respectivos calculos son
                                totalmente diferentes para cada una de ellas.
                            </div>
                            <div class="card-group">
                                <div class="card bg-success">
                                    <div class="card-body text-center">
                                        <h3 class="card-title text-white">Modo Alquiler</h3>
                                        <h1 class="text-white"><i class="fal fa-hands-usd fa-4x"></i></i></h1>
                                        <p class="card-text text-white">En el modo alquiler se calcula el Stand By de horas,
                                            u horometro final menos horometro inicial.</p>
                                        <a type="button" class="btn btn-outline-light btn-pills waves-effect waves-themed"
                                            href="{{ route('registros.alquiler') }}">Ingresar al area de registros de
                                            Alquiler</a>
                                    </div>
                                </div>
                                <div class="card bg-info">
                                    <div class="card-body text-center">
                                        <h3 class="card-title text-white">Modo Flete</h3>
                                        <h1 class="text-white"><i class="fal fa-route fa-4x"></i></h1>
                                        <p class="card-text text-white">En el modo flete se calcula solo un valor pactado
                                            por viaje con el socio o dueño del vehículo.</p>
                                        <a type="button" class="btn btn-outline-light btn-pills waves-effect waves-themed"
                                            href="{{ route('registros.fletes') }}">Ingresar al area de registros de
                                            Fletes</a>
                                    </div>
                                </div>
                                <div class="card bg-primary">
                                    <div class="card-body text-center">
                                        <h3 class="card-title text-white">Modo Movimiento</h3>
                                        <h1 class="text-white"><i class="fal fa-truck-container fa-4x"></i></h1>
                                        <p class="card-text text-white">Calculo de nro de viajes, tarifa de ruta pactada,
                                            metraje cubico y kilometros recorridos.</p>
                                        <a type="button" class="btn btn-outline-light btn-pills waves-effect waves-themed"
                                            href="{{ route('registros.movimientos') }}">Ingresar al area de registros de
                                            Movimientos</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
