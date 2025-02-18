@extends('layouts.dashboard')

@section('title', 'Maquinarias')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Tabla de Maquinarias
                    </h2>
                    <div class="panel-toolbar">
                        <button type="button" class="btn btn-info active"
                            onclick="showModalRegistro('Maquinaria', 'add', true);">
                            Agregar <i class="fal fa-plus-square"></i>
                        </button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <table id="dataTableLaravel" class="table table-bordered table-hover table-striped w-100">
                            <thead class="bg-primary-600">
                                <tr>
                                    <th>Id</th>
                                    <th>Equipo o clase</th>
                                    <th>Placa</th>
                                    <th>Marca</th>
                                    <th>Referencia</th>
                                    <th>Modelo</th>
                                    <th>Color</th>
                                    <th>Capacidad</th>
                                    <th>Nro de Serie</th>
                                    <th>Nro Serie de Chasis</th>
                                    <th>Nro de Motor</th>
                                    <th>Rodaje</th>
                                    <th>Run</th>
                                    <th>GPS</th>
                                    <th>Vencimiento del SOAT</th>
                                    <th>Vencimiento de Tecnocomecánica</th>
                                    <th>Nombre del Propietario</th>
                                    <th>Documento del Propietario</th>
                                    <th>Telefono del Propietario</th>
                                    <th>Correo del Propietario</th>
                                    <th>Nombre del Operador</th>
                                    <th>Documento del Operador</th>
                                    <th>Telefono del Operador</th>
                                    <th>Correo del Operador</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <x-ModalForm title="Agregar Maquinaria"
        description="La maquinaria puede ser equipos menores, vehiculos sencillos, de carga pesada, etc..." form>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Equipo o clase: </label>
                <select class="custom-select form-control" id="idTpMaquinaria" name="idTpMaquinaria">
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="placa">Placa o # de Registro: </label>
                <input type="text" onKeyPress="if(this.value.length==20)return false;" class="form-control"
                    id="placa" name="placa" placeholder="Placa o # de Registro" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="marca">Marca: </label>

                <input type="text" onKeyPress="if(this.value.length==50)return false;" class="form-control"
                    id="marca" name="marca" placeholder="Marca de maquinaria" required>
            </div>
            <div class="col-md-4 mb-3">

                <label class="form-label" for="referencia">Referencia o linea: </label>
                <input type="text" onKeyPress="if(this.value.length==30)return false;" class="form-control"
                    id="referencia" name="referencia" placeholder="Referencia de maquinaria" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label" for="modelo">Modelo: </label>
                <input type="text" onKeyPress="if(this.value.length==30)return false;" class="form-control"
                    id="modelo" name="modelo" placeholder="Modelo de maquinaria" required>

            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="color">Color: </label>
                <input type="text" onKeyPress="if(this.value.length==30)return false;" class="form-control"
                    id="color" name="color" placeholder="Color de maquinaria" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="capacidad">Capacidad o potencia: </label>

                <input type="text" onKeyPress="if(this.value.length==30)return false;" class="form-control"
                    id="capacidad" name="capacidad" placeholder="Capacidad de maquinaria" required>
            </div>
            <div class="col-md-4 mb-3">


                <label class="form-label" for="nroSerie">No. Serie: </label>
                <input type="text" onKeyPress="if(this.value.length==30)return false;" class="form-control"
                    id="nroSerie" name="nroSerie" placeholder="Numero de serie" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label" for="nroSerieChasis">No. Serie de chasis: </label>
                <input type="text" onKeyPress="if(this.value.length==30)return false;" class="form-control"
                    id="nroSerieChasis" name="nroSerieChasis" placeholder="Numero de serie de chasis" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label" for="nroMotor">No. del motor: </label>

                <input type="text" onKeyPress="if(this.value.length==30)return false;" class="form-control"
                    id="nroMotor" name="nroMotor" placeholder="Numero de motor" required>
            </div>
            <div class="col-md-3 mb-3">

                <label class="form-label" for="rodaje">Rodaje: </label>
                <input type="text" onKeyPress="if(this.value.length==30)return false;" class="form-control"
                    id="rodaje" name="rodaje" placeholder="Rodaje de maquinaria" required>
            </div>


            <div class="col-md-3 mb-3">
                <label class="form-label" for="run">RUN: </label>
                <input type="text" onKeyPress="if(this.value.length==30)return false;" class="form-control"
                    id="run" name="run" placeholder="Run de maquinaria" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label" for="gps">GPS: </label>
                <input type="text" onKeyPress="if(this.value.length==30)return false;" class="form-control"
                    id="gps" name="gps" placeholder="GPS de maquinaria" required>
            </div>

            <div class="input-group col-md-6 mb-3">
                <input type="text" class="form-control" id="fechaSoat" name="fechaSoat"
                    placeholder="Fecha de vencimiento del SOAT" data-inputmask="'mask': '99/99/9999'" im-insert="true">
                <div class="input-group-append">
                    <span class="input-group-text fs-xl">
                        <i class="fal fa-calendar-check"></i>
                    </span>
                </div>

            </div>
            <div class="input-group col-md-6 mb-3">
                <input type="text" class="form-control" id="fechaTecno" name="fechaTecno"
                    placeholder="Fecha de vencimiento de Tecnocomecánica" data-inputmask="'mask': '99/99/9999'"
                    im-insert="true">
                <div class="input-group-append">
                    <span class="input-group-text fs-xl">
                        <i class="fal fa-calendar-check"></i>


                    </span>
                </div>
            </div>
            <div class="panel-tag col-md-12">


                <p>Campos del propietario de maquinaria: </p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label" for="propietario">Propietario: </label>
                <input type="text" onKeyPress="if(this.value.length==70)return false;" class="form-control"
                    id="propietario" name="propietario" placeholder="Propietario de maquinaria" required>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label" for="documentoPropietario">Nit o C.C: </label>
                <input type="number" onKeyPress="if(this.value.length==15)return false;" class="form-control"
                    id="documentoPropietario" name="documentoPropietario" placeholder="Nit o C.C propietario" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label" for="telefonoPropietario">Teléfono:</label>


                <input type="number" onKeyPress="if(this.value.length==10)return false;" class="form-control"
                    id="telefonoPropietario" name="telefonoPropietario" placeholder="Teléfono de proietario" required>

            </div>


            <div class="col-md-12 mb-3">
                <label class="form-label" for="correoPropietario">Correo electronico de propietario:</label>
                <input type="email" onKeyPress="if(this.value.length==100)return false;" class="form-control"
                    id="correoPropietario" name="correoPropietario" placeholder="Correo electronico de propietario"
                    required>
            </div>
            <div class="panel-tag col-md-12">
                <p>Campos del operador o conductor de maquinaria: </p>
            </div>
            <div class="col-md-6 mb-3">

                <label class="form-label" for="operador">Operador o Conductor: </label>

                <input type="text" onKeyPress="if(this.value.length==70)return false;" class="form-control"
                    id="operador" name="operador" placeholder="Operador o Coductor de maquinaria" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label" for="documentOperador">Nit o C.C: </label>
                <input type="number" onKeyPress="if(this.value.length==15)return false;" class="form-control"
                    id="documentOperador" name="documentOperador" placeholder="Nit o C.C operador" required>
            </div>
            <div class="col-md-3 mb-3">

                <label class="form-label" for="telefonOperador">Teléfono:</label>
                <input type="number" onKeyPress="if(this.value.length==10)return false;" class="form-control"
                    id="telefonOperador" name="telefonOperador" placeholder="Teléfono de operador" required>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label" for="correOperador">Correo electronico de Operador o
                    Conductor:</label>
                <input type="email" onKeyPress="if(this.value.length==100)return false;" class="form-control"
                    id="correOperador" name="correOperador" placeholder="Correo electronico de operador o conductor"
                    required>
            </div>

            <x-InputBase file title="Documentación de maquinaria" label="Adjuntar Archido de Documentacón" accept=".pdf"
                span="Archivo de documentación formato pdf." />
        </div>
    </x-ModalForm>
@endpush

@push('scripts')
    <script>
        $(document).ready(async () => {
            await buildDataTable("maquinarias",
                [{
                        data: "id"
                    },
                    {
                        data: "tipo"
                    },
                    {
                        data: "placa"
                    },
                    {
                        data: "marca"
                    },
                    {
                        data: "referencia"
                    },
                    {
                        data: "modelo"
                    },
                    {
                        data: "color"
                    },
                    {
                        data: "capacidad"
                    },
                    {
                        data: "nroSerie"
                    },
                    {
                        data: "nroSerieChasis"
                    },
                    {
                        data: "nroMotor"
                    },
                    {
                        data: "rodaje"
                    },
                    {
                        data: "run"
                    },
                    {
                        data: "gps"
                    },
                    {
                        data: "fechaSoat"
                    },
                    {
                        data: "fechaTecno"
                    },
                    {
                        data: "propietario"
                    },
                    {
                        data: "documentoPropietario"
                    },
                    {
                        data: "telefonoPropietario"
                    },
                    {
                        data: "correoPropietario"
                    },
                    {
                        data: "operador"
                    },
                    {
                        data: "documentOperador"
                    },
                    {
                        data: "telefonOperador"
                    },
                    {
                        data: "correOperador"
                    },
                    {
                        data: "status"
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]);
            await buildSelectForm("api/select/tp-maquinarias", "idTpMaquinaria",
                "Seleccione el Tipo de Maquinaria");
            $("#fechaSoat, #fechaTecno").datepicker({
                orientation: "buttom left",
                todayHighlight: true,
                templates: vars.controls,
            });
        });

        const crearRegistro = async (form) => {
            await buildCreateRegister("api/maquinarias", form);
        };

        const editarRegistro = async (id) => {
            await buildEditRegister(id, "api/maquinarias",
                [
                    "placa",
                    "marca",
                    "referencia",
                    "modelo",
                    "color",
                    "capacidad",
                    "nroSerie",
                    "nroSerieChasis",
                    "nroMotor",
                    "rodaje",
                    "run",
                    "gps",
                    "fechaSoat",
                    "fechaTecno",
                    "propietario",
                    "documentoPropietario",
                    "telefonoPropietario",
                    "correoPropietario",
                    "operador",
                    "documentOperador",
                    "telefonOperador",
                    "correOperador",
                    "archivo",
                ], ["idTpMaquinaria"], true);
        }

        const statusRegistro = async (id) => {
            await buildStatusRegister(id, "api/maquinarias");
        };

        const eliminarRegistro = async (id) => {
            await buildDeleteRegister(id, "api/maquinarias");
        };
    </script>
@endpush
