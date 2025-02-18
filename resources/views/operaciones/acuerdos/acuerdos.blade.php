@extends('layouts.dashboard')

@section('title', 'Acuerdos')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-content">
                            <div class="panel-tag">
                                Los acuerdos son tarifas negoseadas con los clientes y provedores.
                            </div>
                            <div class="card-group">
                                <div class="card bg-success">
                                    <div class="card-body text-center">
                                        <h3 class="card-title text-white">Acuerdos Clientes</h3>
                                        <h1 class="text-white">
                                            <i class="fal fa-building fa-4x"></i>
                                        </h1>
                                        <p class="card-text text-white">
                                            En este area se pueden generar acuerdos de clientes
                                        </p>
                                        <a class="btn btn-outline-light btn-pills waves-effect waves-themed"
                                            href="{{ route('acuerdos.clientes.alquiler') }}">Alquiler <i
                                                class="fal fa-hands-usd"></i></i></a>
                                        <a class="btn btn-outline-light btn-pills waves-effect waves-themed"
                                            href="{{ route('acuerdos.clientes.fletes') }}">Fletes <i
                                                class="fal fa-route"></i></a>
                                        <a class="btn btn-outline-light btn-pills waves-effect waves-themed"
                                            href="{{ route('acuerdos.clientes.movimientos') }}">Movimientos <i
                                                class="fal fa-truck-container"></i></a>
                                    </div>
                                </div>
                                <div class="card bg-primary">
                                    <div class="card-body text-center">
                                        <h3 class="card-title text-white">Acuerdos Proveedores</h3>
                                        <h1 class="text-white"><i class="fal fa-handshake fa-4x"></i></h1>
                                        <p class="card-text text-white">
                                            En este area se pueden generar acuerdos de proveedores
                                        </p>
                                        <a class="btn btn-outline-light btn-pills waves-effect waves-themed"
                                            href="{{ route('acuerdos.proveedores.alquiler') }}">Alquiler <i
                                                class="fal fa-hands-usd"></i></i></a>
                                        <a class="btn btn-outline-light btn-pills waves-effect waves-themed"
                                            href="{{ route('acuerdos.proveedores.fletes') }}">Fletes <i
                                                class="fal fa-route"></i></a>
                                        <a class="btn btn-outline-light btn-pills waves-effect waves-themed"
                                            href="{{ route('acuerdos.proveedores.movimientos') }}">Movimientos <i
                                                class="fal fa-truck-container"></i></a>
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
