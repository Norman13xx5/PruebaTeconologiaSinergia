@extends('layouts.dashboard')

@section('title', 'Categorias')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Tabla de Categorias
                    </h2>
                    <div class="panel-toolbar">
                        <button type="button" class="btn btn-info active" onclick="showModalRegistro('Categoría');">
                            Agregar <i class="fal fa-plus-square"></i>
                        </button>
                    </div>
                </div>
                <x-DataTable>
                    <th>Id</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </x-DataTable>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <x-ModalForm title="Agregar Categoría" description="Una categoría es una agrupación de un gasto." form>
        <div class="form-row">
            <x-InputBase col="12" name="description" type="text" label="Nombre Categoria"
                placeholder="Ingresa nombre de categoria" required max="191" />
        </div>
    </x-ModalForm>
@endpush

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Información Detallada</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="panel-toolbar">
                    <button type="button" class="btn btn-info active">
                        Agregar <i class="fal fa-plus-square"></i>
                    </button>
                </div>
                <!-- Card para la tabla -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <strong>Datos de la Tabla</strong>
                    </div>
                    <div class="card-body">
                        <table id="dataTableLaravel1" class="table table-bordered table-hover table-striped w-100">
                            <thead class="bg-light">
                                <tr>
                                    <!-- Agrega aquí las columnas de tu tabla -->
                                    <th>ID</th>
                                    <th>Categoría</th>
                                    <th>Descripción</th>
                                    <th>Monto</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                {{-- <button type="button" class="btn btn-primary">Guardar Cambios</button> --}}
            </div>
        </div>
    </div>
</div>

@push('modals')
    <x-ModalFormDetail modalId="exampleModal2" title="Agregar Categoría"
        description="Una categoría es una agrupación de un gasto." frmId="frmRegistro2" form>
        <div class="form-row">
            {{-- <x-InputBase col="12" name="id" type="number" label=" "
                placeholder="Ingresa nombre de categoria" required max="191" /> --}}
            <div class="col-md-4 mb-3">
                <label class="form-label">Categoría</label>
                <select class="custom-select form-control" id="categoryId" name="categoryId">
                </select>
            </div>
            <x-InputBase col="4" name="description" type="text" label="Descripción"
                placeholder="Ingresa descripción" required max="191" />
            <x-InputBase col="4" name="amount" type="number" label="Monto" placeholder="Ingresa monto" required
                max="191" />
        </div>
    </x-ModalFormDetail>
@endpush


@push('scripts')
    <script>
        $(document).ready(async () => {
            await buildDataTable("categories",
                [{
                        data: "id"
                    },
                    {
                        data: "description"
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]);
            await buildSelectForm("api/select/category", "categoryId", "Seleccione el Categoría");
        });

        const crearRegistro = async (form) => {
            await buildCreateRegister("api/category", form);
        };

        const editarRegistro = async (id) => {
            await buildEditRegister(id, "api/category", ["description"], [], false, "ModalRegistro", "frmRegistro");
        }

        const statusRegistro = async (id) => {
            await buildStatusRegister(id, "api/category");
        };

        const eliminarRegistro = async (id) => {
            await buildDeleteRegister(id, "api/category");
        };

        const buildDataDetails = async (id) => {
            await buildDataTableDetails("gastos/" + id,
                [{
                        data: "id"
                    },
                    {
                        data: "category"
                    },
                    {
                        data: "expense"
                    },
                    {
                        data: "amount"
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]);
            $("#exampleModal").modal({
                backdrop: "static",
                keyboard: false,
            });
            $('#exampleModal').on('shown.bs.modal', function() {
                const agregarButton = $(this).find('.btn-info.active');
                agregarButton.off('click').on('click', function() {
                    showModalRegistro('Gastos', false, 'exampleModal2', 'frmRegistro2', id, 'categoryId');
                });
            });
        }

        const editarRegistroDetalle = async (id) => {
            await buildEditRegister(id, "api/gasto",
                [
                    "id",
                    "description",
                    "amount"
                ], ["categoryId"], false,
                "exampleModal2", "frmRegistro2");
        }

        const crearRegistroDetalle = async (form) => {
            await buildCreateRegister("api/gastos", form);
        };

        const statusRegistroDetalle = async (id) => {
            await buildStatusRegister(id, "api/gastos");
        };

        const eliminarRegistroDetalle = async (id) => {
            await buildDeleteRegister(id, "api/gastos");
        };
    </script>
@endpush
