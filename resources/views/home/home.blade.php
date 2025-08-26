@extends('layouts.dashboard')

@section('title', 'Inicio')

@section('content')
    <div class="row">

        <div class="col-lg-9 col-xl-9 order-lg-1 order-xl-1" id="workSpace">
            <div class="card mb-g rounded-top">
                <div class="row no-gutters row-grid">
                    <div class="col-12">
                        <div class="d-flex flex-column align-items-center justify-content-center p-4">
                            <img src="data:{{ Auth::user()->contentType }};base64,{{ Auth::user()->base64 }}"" width="100"
                                height="100" class="rounded-circle shadow-2 img-thumbnail" alt="">
                            <h5 class="mb-0 fw-700 text-center mt-3">
                                BIENVENIDO A
                                {{ env('APP_NAME') }}®
                                <small class="text-muted mb-0">
                                    NIT:
                                    {{ Auth::user()->nit }}
                                </small>
                            </h5>

                        </div>

                    </div>
                    <div class="col-12">
                        <div class="p-3 text-center">
                            <a href="javascript:void(0);" class="btn-link font-weight-bold">
                                Estamos en funcionamiento al 65% en este momento...
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <div class="col-lg-3 col-xl-3 order-lg-2 order-xl-3">
            <!-- add : -->
            <div class="card mb-2">
                <div class="card-body">
                    <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                        <div class='icon-stack display-3 flex-shrink-0'>
                            <i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
                            <i class="fas fa-graduation-cap icon-stack-1x opacity-100 color-primary-500"></i>
                        </div>
                        <div class="ml-3">
                            <strong>
                                Calificaciones
                            </strong>
                            <br>
                            Califica y deja tus comentarios en nuestras redes.
                        </div>
                    </a>
                </div>
            </div>
            <div class="card mb-g">
                <div class="card-body">
                    <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                        <div class='icon-stack display-3 flex-shrink-0'>
                            <i class="fal fa-circle icon-stack-3x opacity-100 color-warning-400"></i>
                            <i class="fas fa-handshake icon-stack-1x opacity-100 color-warning-500"></i>
                        </div>
                        <div class="ml-3">
                            <strong>
                                Soporte
                            </strong>
                            <br>
                            Estamos para ayudarte en cualquier tipo de error que presentes.
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
