@extends('layouts.dashboard')

@section('title', 'Generador de Informes')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Generador de Informes
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <form class="m-6" id="frmGenerarInforme">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <select class="custom-select form-control" id="tpModulo" name="tpModulo">
                                        <option value="alquiler">Alquiler</option>
                                        <option value="fletes">Fletes</option>
                                        <option value="movimientos">Movimientos</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <select class="custom-select form-control" id="tpInforme" name="tpInforme">
                                        <option value="cliente">Cliente</option>
                                        <option value="proveedor">Proveedor</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <select class="custom-select form-control" id="idMaquinaria" name="idMaquinaria">
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <select class="custom-select form-control" id="idContrato" name="idContrato">
                                    </select>
                                </div>
                                <div class="input-group col-md-4 mb-3">
                                    <input type="text" class="form-control" id="fechaInicio" name="fechaInicio"
                                        placeholder="Fecha Inicial" data-inputmask="'mask': '99/99/9999'" im-insert="true">
                                    <div class="input-group-append">
                                        <span class="input-group-text fs-xl"><i class="fal fa-calendar-check"></i></span>
                                    </div>
                                </div>
                                <div class="input-group col-md-4 mb-3">
                                    <input type="text" class="form-control" id="fechaFin" name="fechaFin"
                                        placeholder="Fecha Final" data-inputmask="'mask': '99/99/9999'" im-insert="true">
                                    <div class="input-group-append">
                                        <span class="input-group-text fs-xl"><i class="fal fa-calendar-check"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" onclick="generarReporte();"
                                    class="btn btn-info  mx-auto d-inline-block mt-3 ml-2">
                                    Generar el Informe <i class="fas fa-file-excel"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <x-ModalInforme title="Informe de Clientes">
        <th>Id</th>
        <th>Codigo ficha</th>
        <th>Placa</th>
        <th>Manifiesto</th>
        <th>fecha Inicio</th>
        <th>fecha Fin</th>
        <th>Titulo del Contrato</th>
        <th>Hra Operario inicial</th>
        <th>Hra Operario Final</th>
        <th>Horometro Inicial</th>
        <th>Horometro Final</th>
        <th>Total Horas Trabjadas</th>
        <th>Stand-By</th>
        <th>Valor Hora</th>
        <th>Sub Total</th>
        <th>Deducible Administrativo</th>
        <th>Deducible Retefuente</th>
        <th>Deducible Reteica</th>
        <th>Deducible Anticipo</th>
        <th>Otros Deducibles</th>
        <th>Total</th>
    </x-ModalInforme>
@endpush

@push('scripts')
    <script>
        $(document).ready(async () => {
            await buildSelectForm("api/select/maquinarias", "idMaquinaria", "Seleccione la placa");
            await buildSelectForm("api/select/contratos", "idContrato", "Seleccione el contrato");
            limpiarcampos("#frmGenerarInforme");
            $("#tpModulo").select2({
                placeholder: "Seleccione un modulo",
                allowClear: true,
            });
            $("#tpInforme").select2({
                placeholder: "Seleccione un informe",
                allowClear: true,
            });
            $("#fechaInicio, #fechaFin").datepicker({
                orientation: "buttom left",
                todayHighlight: true,
                templates: vars.controls,
            });
        });

        const generarReporte = async () => {
            buildGenerarReporte('api/informes/alquiler',
                [{
                        data: "id"
                    },
                    {
                        data: "codFicha"
                    },
                    {
                        data: "placa"
                    },
                    {
                        data: "manifiesto"
                    },
                    {
                        data: "fechaInicio"
                    },
                    {
                        data: "fechaFin"
                    },
                    {
                        data: "titulo"
                    },
                    {
                        data: "hraOpInicio"
                    },
                    {
                        data: "hraOpFin"
                    },
                    {
                        data: "horometroInicio"
                    },
                    {
                        data: "horometroFin"
                    },
                    {
                        data: "totalHoras"
                    },
                    {
                        data: "standBy"
                    },
                    {
                        data: "tarifa"
                    },
                    {
                        data: "subTotal"
                    },
                    {
                        data: "admon"
                    },
                    {
                        data: "reteFuente"
                    },
                    {
                        data: "reteica"
                    },
                    {
                        data: "anticipo"
                    },
                    {
                        data: "otros"
                    },
                    {
                        data: "total"
                    },
                ]);
        };
    </script>
@endpush
