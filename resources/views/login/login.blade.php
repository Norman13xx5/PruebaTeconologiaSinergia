@extends('layouts.login')

@section('title', 'Inicio de sesión')

@section('content')
    <form id="frmLogin">
        <x-InputBase login name="emailUser" type="text" label="Usuario" placeholder="Ingresa tu usuario" required
            error="Falta Correo Electronico." help="Escribe tu email" max="191" />
        <x-InputBase login name="pswd" type="password" label="Contraseña" placeholder="Ingresa tu contraseña" required
            error="Falta contraseña." help="Escribe tu contraseña" max="191" />
        <x-BtnBase type="login" />
    </form>
@endsection

@push('modals')
    <x-ModalForm title="Registrarse" description="formulario de registro de empresa">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body justify-content-center">
            <h1 class="text-center text-dark">
                Proximamente podras registrarte.
            </h1>
        </div>
    </x-ModalForm>
@endpush

@push('scripts')
    <script>
        const login = async (form) => {
            const respuestavalidacion = validarcampos("#" + form);
            if (respuestavalidacion) {
                let formData = new FormData(document.getElementById(form));
                await $.ajax({
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    dataType: "json",
                    url: "api/login",
                    type: "POST",
                    beforeSend: () => {
                        $('#loader-container').fadeIn('slow');
                    },
                    complete: () => {
                        $('#loader-container').fadeOut('slow');
                    },
                    success: (result) => {
                        window.location.href = "{{ route('home') }}";
                    },
                    error: (xhr) => {
                        Swal.fire({
                            icon: "info",
                            title: "<strong>Credenciales Incorrectas</strong>",
                            html: xhr.responseJSON.message,
                            showCloseButton: true,
                            showConfirmButton: false,
                            cancelButtonText: "Cerrar",
                            cancelButtonColor: "#dc3545",
                            showCancelButton: true,
                            backdrop: true,
                        });
                    },
                });
            }
        }
    </script>
@endpush
