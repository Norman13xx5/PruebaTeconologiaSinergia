var urlBase = document.querySelector('meta[name="url-global-app"]').getAttribute('content');

const vars = {
    edit: false,
    editDeducible: false,
    id: null,
    url: null,
    peticionDeducible: null,
    idSubSelect: null,
    dataTableLaravel: null,
    controls: {
        leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
        rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>',
    },
    errorRegister: false,
};

const cerrarSesion = async () => {
    await $.ajax({
        dataType: "json",
        url: `${urlBase}api/logout`,
        type: "POST",
        beforeSend: function () {
            $('#loader-container').fadeIn('slow');
        },
        complete: function () {
            $('#loader-container').fadeOut('slow');
        },
        success: function (result) {
            window.localStorage.removeItem("moduloActual");
            window.location.reload();
        },
        error: function (xhr) {
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

const buildDataTable = async (route, columns) => {
    vars.dataTableLaravel = await $('#dataTableLaravel').DataTable({
        processing: true,
        orderClasses: true,
        deferRender: true,
        serverSide: true,
        responsive: true,
        lengthChange: false,
        pageLength: 10,
        ajax: `${urlBase}${route}`,
        dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [{
            extend: "excelHtml5",
            text: "Excel",
            titleAttr: "Generate Excel",
            className: "btn-outline-success btn-sm mr-1",
        },
        {
            extend: "copyHtml5",
            text: "Copy",
            titleAttr: "Copy to clipboard",
            className: "btn-outline-primary btn-sm mr-1",
        },
        {
            extend: "print",
            text: "Print",
            titleAttr: "Print Table",
            className: "btn-outline-primary btn-sm",
        },
        ],
        columns: columns,
        language: {
            lengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },
            sProcessing: "Procesando...",
        },
    });
}

const buildDataTableDetails = async (route, columns) => {
    if ($.fn.dataTable.isDataTable('#dataTableLaravel1')) {
        $('#dataTableLaravel1').DataTable().destroy();
    }
    vars.dataTableLaravel = await $('#dataTableLaravel1').DataTable({
        processing: true,
        orderClasses: true,
        deferRender: true,
        serverSide: true,
        responsive: true,
        lengthChange: false,
        pageLength: 10,
        ajax: `${urlBase}${route}`,
        dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [{
            extend: "excelHtml5",
            text: "Excel",
            titleAttr: "Generate Excel",
            className: "btn-outline-success btn-sm mr-1",
        },
        {
            extend: "copyHtml5",
            text: "Copy",
            titleAttr: "Copy to clipboard",
            className: "btn-outline-primary btn-sm mr-1",
        },
        {
            extend: "print",
            text: "Print",
            titleAttr: "Print Table",
            className: "btn-outline-primary btn-sm",
        },
        ],
        columns: columns,
        language: {
            lengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },
            sProcessing: "Procesando...",
        },
    });
}

const buildCreateRegister = async (route, form) => {
    const respuestavalidacion = validarcampos("#" + form);
    if (respuestavalidacion) {
        const formData = new FormData(document.getElementById(form));
        if (vars.edit == true) {
            formData.append("_method", "PUT");
            vars.url = `${urlBase}${route}/${vars.id}`
        } else {
            vars.url = `${urlBase}${route}`;
        }
        await $.ajax({
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            dataType: "json",
            url: vars.url,
            type: "POST",
            beforeSend: () => {
                $("#loader-container").fadeIn("slow");
            },
            complete: () => {
                $("#loader-container").fadeOut("slow");
            },
            success: (result) => {
                if (vars.edit == false) {
                    Swal.fire({
                        icon: "success",
                        title: "<strong>Registro Creado</strong>",
                        html: "<h5>El Registro se ha creado exitosamente</h5>",
                        showCloseButton: false,
                        confirmButtonText: "Aceptar",
                        confirmButtonColor: "#64a19d",
                        backdrop: true,
                        target: document.body
                    });
                } else {
                    Swal.fire({
                        icon: "success",
                        title: "<strong>Registro Actualizado</strong>",
                        html: "<h5>El Registro se ha actualizado exitosamente</h5>",
                        showCloseButton: false,
                        confirmButtonText: "Aceptar",
                        confirmButtonColor: "#64a19d",
                        backdrop: true,
                        target: document.body
                    });
                }
                vars.errorRegister = false;
                resetForm();
            },
            error: (xhr) => {
                vars.errorRegister = true;
                resetForm();
                Swal.fire({
                    icon: "info",
                    title: "<strong>Error en el registro</strong>",
                    html: xhr.responseJSON.message,
                    showCloseButton: true,
                    showConfirmButton: false,
                    cancelButtonText: "Cerrar",
                    cancelButtonColor: "#dc3545",
                    showCancelButton: true,
                    backdrop: true,
                    target: document.body
                });
            },
        });
    }
}

//Agregué modalId, formId
const buildEditRegister = async (id, route, formFields, formSelects = [], file = false, modalId = "ModalRegistro", formId = "frmRegistro2") => {
    vars.edit = true;
    await $.ajax({
        dataType: "json",
        url: `${urlBase}${route}/${id}`,
        type: "GET",
        beforeSend: () => {
            $("#loader-container").fadeIn("slow");
        },
        complete: () => {
            $("#loader-container").fadeOut("slow");
        },
        success: (result) => {
            $("#btnRegistro").show();
            $("#btnRegistro").text("Editar Registro");
            $("#btnRegistro").attr("onclick", `crearRegistro('${formId}');`);
            $("#btnRegistro").removeClass("btn btn-info");
            $("#btnRegistro").addClass("btn btn-success");

            vars.id = result.data.id ? result.data.id : result.data.nit;

            for (const field of formFields) {
                $(`#${formId} [name="${field}"]`).val(result.data[field]);
            }

            if (formSelects.length > 0) {
                for (const select of formSelects) {
                    $(`#${select}`).val(result.data[select]).trigger("change");
                }
            }

            if (file) {
                $('#archivo').prop('value', '');
                let html = "";
                if (result.data.contentType === "application/pdf") {
                    html += `
                    <button type="button" class="btn btn-outline-danger" onclick="visualizarPDF('${result.data.contentType}', '${result.data.base64}');">
                    Ver Documentación <i class="fal fa-file-pdf"></i></button>`;
                } else {
                    html += `
                    <img class="rounded" src="data:${result.data.contentType};base64,${result.data.base64}" width="100" height="auto">
                    <input type="hidden" id="contentType" name="contentType" value="${result.data.contentType}">
                    <input type="hidden" id="base64" name="base64" value="${result.data.base64}">`;
                }
                $("#archivoBase64").html(html);
            }

            $(`#${modalId}`).modal({
                backdrop: "static",
                keyboard: false,
            });
        },
        error: (xhr) => {
            console.log(xhr);
            Swal.fire({
                icon: "error",
                title: "<strong>Error!</strong>",
                html: "<h5>Se ha presentado un error, por favor informar al area de Sistemas.</h5>",
                showCloseButton: true,
                showConfirmButton: false,
                cancelButtonText: "Cerrar",
                cancelButtonColor: "#dc3545",
                showCancelButton: true,
                backdrop: true,
            });

            console.error("Error al cargar el registro", xhr);
        },
    });
};

const buildStatusRegister = async (id, route) => {
    Swal.fire({
        icon: "warning",
        title: "¿Qué deseas hacer?",
        text: "¡Se cambiará el estado del registro!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Cambiar estado",
        preConfirm: async () => {
            await $.ajax({
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                url: `${urlBase}${route}/${id}`,
                type: "PATCH",
                beforeSend: () => {
                    $("#loader-container").fadeIn("slow");
                },
                complete: () => {
                    $("#loader-container").fadeOut("slow");
                },
                success: (result) => {
                    vars.dataTableLaravel.clear().draw();
                    Swal.fire({
                        icon: "success",
                        title: "<strong>Estado cambiado</strong>",
                        html: "<h5>El estado se ha exitosamente</h5>",
                        showCloseButton: false,
                        confirmButtonText: "Aceptar",
                        confirmButtonColor: "#64a19d",
                        backdrop: true,
                    });
                },
                error: (xhr) => {
                    $("#ModalRegistro").modal("hide");
                    Swal.fire({
                        icon: "info",
                        title: "<strong>Error al cambiar el estado</strong>",
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
    });
};

const buildDeleteRegister = async (id, route) => {
    Swal.fire({
        icon: "warning",
        title: "¿Qué deseas hacer?",
        text: "¡Se eliminará el registro del sistema!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Eliminar registro",
        preConfirm: async () => {
            await $.ajax({
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                url: `${urlBase}${route}/${id}`,
                type: "DELETE",
                beforeSend: () => {
                    $("#loader-container").fadeIn("slow");
                },
                complete: () => {
                    $("#loader-container").fadeOut("slow");
                },
                success: (result) => {
                    vars.dataTableLaravel.clear().draw();
                    Swal.fire({
                        icon: "success",
                        title: "<strong>Registro eliminado</strong>",
                        html: "<h5>El registro se ha eliminado exitosamente</h5>",
                        showCloseButton: false,
                        confirmButtonText: "Aceptar",
                        confirmButtonColor: "#64a19d",
                        backdrop: true,
                    });
                },
                error: (xhr) => {
                    $("#ModalRegistro").modal("hide");
                    Swal.fire({
                        icon: "info",
                        title: "<strong>Error al eliminar registro</strong>",
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
    });
};

const buildSelectForm = async (route, campo, message) => {
    try {
        $("#loader-container").fadeIn("slow");
        const result = await $.ajax({
            dataType: "json",
            url: `${urlBase}${route}`,
            type: "GET"
        });

        if (result.data && result.data.length > 0) {
            let html = "";
            for (let i = 0; i < result.data.length; i++) {
                html += `<option value="${result.data[i].id}">${result.data[i].name}</option>`;
            }
            $(`#${campo}`).html(html);
        } else {
            console.warn("No se encontraron datos en la respuesta.");
        }

        $(`#${campo}`).select2({
            placeholder: message,
            allowClear: true,
        });
        $("#loader-container").fadeOut("slow");
    } catch (xhr) {
        $("#loader-container").fadeOut("slow");
        console.error("Error al cargar el registro", xhr);
        Swal.fire({
            icon: "error",
            title: "<strong>Error!</strong>",
            html: "<h5>Se ha presentado un error, por favor informar al área de Sistemas.</h5>",
            showCloseButton: true,
            showConfirmButton: false,
            cancelButtonText: "Cerrar",
            cancelButtonColor: "#dc3545",
            showCancelButton: true,
            backdrop: true,
        });
    }
};


const buildSubSelects = async (route, id, campo, message) => {
    try {
        $("#loader-container").fadeIn("slow");
        const result = await $.ajax({
            dataType: "json",
            url: `${urlBase}${route}/${id}`,
            type: "GET"
        });

        if (result.data && result.data.length > 0) {
            let html = "";
            for (let i = 0; i < result.data.length; i++) {
                html += `<option value="${result.data[i].id}">${result.data[i].name}</option>`;
            }
            $(`#${campo}`).html(html);
        } else {
            console.warn("No se encontraron datos en la respuesta.");
        }

        $(`#${campo}`).select2({
            placeholder: message,
            allowClear: true,
        });
        $("#loader-container").fadeOut("slow");
    } catch (xhr) {
        $("#loader-container").fadeOut("slow");
        console.error("Error al cargar el registro", xhr);
        Swal.fire({
            icon: "error",
            title: "<strong>Error!</strong>",
            html: "<h5>Se ha presentado un error, por favor informar al área de Sistemas.</h5>",
            showCloseButton: true,
            showConfirmButton: false,
            cancelButtonText: "Cerrar",
            cancelButtonColor: "#dc3545",
            showCancelButton: true,
            backdrop: true,
        });
    }
};

const buildGenerarReporte = async (route, columns) => {
    if (!$("#tpModulo").val() && !$("#tpInforme").val()) {
        Swal.fire({
            icon: "info",
            title: "<strong>Error</strong>",
            html: "Los campos de tipo de módulo y tipo de informe son obligatorios",
            showCloseButton: true,
            showConfirmButton: false,
            cancelButtonText: "Cerrar",
            cancelButtonColor: "#dc3545",
            showCancelButton: true,
            backdrop: true,
        });
        return;
    } else {
        $("#tablaInformes").DataTable({
            processing: true,
            orderClasses: true,
            deferRender: true,
            serverSide: true,
            responsive: true,
            lengthChange: false,
            paging: false,
            columnDefs: [{
                targets: "_all",
                sortable: false,
            },],
            searching: false,
            destroy: true,
            ajax: {
                url: `${urlBase}${route}`,
                type: "POST",
                data: {
                    tpModulo: $("#tpModulo").val(),
                    tpInforme: $("#tpInforme").val(),
                    placa: $("#idMaquinaria").val(),
                    contrato: $("#idContrato").val(),
                    fechaInicio: $("#fechaInicio").val(),
                    fechaFin: $("#fechaFin").val(),
                },
                dataType: "json",
                beforeSend: () => {
                    $("#loader-container").fadeIn("slow");
                },
                complete: () => {
                    $("#loader-container").fadeOut("slow");
                },
            },
            dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [{
                extend: "excelHtml5",
                autoFilter: true,
                text: "Descargar <i class='fal fa-file-excel'></i>",
                titleAttr: "Generate Excel",
                className: "bg-success-900 btn-sm mr-1",
                messageTop: "Relación a cobrar de Alquiler de maquinarias",
                title: "Relación por Alquiler",
            },],
            columns: columns,
            language: {
                lengthMenu: "Mostrar _MENU_ registros",
                zeroRecords: "No se encontraron resultados",
                info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                infoFiltered: "(filtrado de un total de _MAX_ registros)",
                oPaginate: {
                    sFirst: "Primero",
                    sLast: "Último",
                    sNext: "Siguiente",
                    sPrevious: "Anterior",
                },
                sProcessing: "Procesando...",
            },
        });
        $("#ModalInforme").modal({
            backdrop: "static",
            keyboard: false,
        });
    }
};

const redirectNotification = (id) => {
    if (id == 1) {
        window.location.href = urlBase + "acuerdos/";
    }
}

const visualizarPDF = (content, base) => {
    let base64 = base;
    const blob = base64ToBlob(base64, content);
    const url = URL.createObjectURL(blob);
    const pdfWindow = window.open("");
    pdfWindow.document.write(
        "<iframe width='100%' height='100%' src='" + url + "'></iframe>"
    );
    function base64ToBlob(base64, type = "application/octet-stream") {
        const binStr = atob(base64);
        const len = binStr.length;
        const arr = new Uint8Array(len);
        for (let i = 0; i < len; i++) {
            arr[i] = binStr.charCodeAt(i);
        }
        return new Blob([arr], { type: type });
    }
}

const filterFloat = (evt, input) => {
    let key = window.Event ? evt.which : evt.keyCode;
    let chark = String.fromCharCode(key);
    let tempValue = input.value + chark;
    if (key >= 48 && key <= 57) {
        if (filter(tempValue) === false) {
            return false;
        } else {
            return true;
        }
    } else {
        if (key == 8 || key == 13 || key == 0) {
            return true;
        } else if (key == 46) {
            if (filter(tempValue) === false) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}

const filter = (val) => {
    let preg = /^([0-9]+\.?[0-9]{0,2})$/;
    if (preg.test(val) === true) {
        return true;
    } else {
        return false;
    }
}

$("#archivo").bind("change", function () {
    let html = "";
    if (this.files[0].size >= 4000000) {
        html +=
            '<div class="alert border-danger bg-transparent text-info fade show" role="alert">' +
            '<div class="d-flex align-items-center"><div class="alert-icon text-danger">' +
            '<i class="fal fa-exclamation-triangle"></i></div>' +
            '<div class="flex-1 text-danger"><span class="h5 m-0 fw-700">Adjunta un archivo de menor tamaño, el peso maximo es de 4 MB.</span></div>' +
            '<button type="button" class="btn btn-danger btn-pills btn-sm btn-w-m waves-effect waves-themed" data-dismiss="alert" aria-label="Close">' +
            "Cerrar</button></div></div>";
        $(':input[type="file"]').val("");
    } else {
        html +=
            '<div class="alert border-faded bg-transparent text-secondary fade show" role="alert">' +
            '<div class="d-flex align-items-center"><div class="alert-icon"><span class="icon-stack icon-stack-md">' +
            '<i class="base-7 icon-stack-3x color-success-600"></i><i class="fal fa-check icon-stack-1x text-white"></i></span></div>' +
            '<div class="flex-1"><span class="h5 color-success-600">Tamaño del archivo admitido!</span><br>' +
            "el tamaño del archivo es adecuado para guardarlo en el servidor</div>" +
            '<button type="button" class="btn btn-success btn-pills btn-sm btn-w-m waves-effect waves-themed" data-dismiss="alert" aria-label="Close">Cerrar</button></div></div>';
    }
    $("#archivoBase64").html(html);
});

$("#tipoAlquiler").on('input', () => {
    const tipoAlquilerCheckbox = $("#tipoAlquiler")[0];
    if (tipoAlquilerCheckbox.checked) {
        $("#labelStandBy").text("Stand-By(kilometros minimos de trabajo por mes):");
        $("#labelTarifa").text("Valor de tarifa por kilometro:");
        $("#observacion").val("kilometros");
    } else {
        $("#labelStandBy").text("Stand-By(horas minimas de trabajo por mes):");
        $("#labelTarifa").text("Valor de tarifa por hora:");
        $("#observacion").val("horas");
    }
});

//Agregué modalId, formId, id, inputId
const showModalRegistro = (module, file = false, modalId = "ModalRegistro", formId = "frmRegistro", id = null, inputId = null) => {
    console.log('id', id)
    console.log('inputId', inputId)
    if (vars.errorRegister === false) {
        vars.id = null;
        vars.edit = false;
        $("#idRegistro").val("");
        $("#archivoBase64").html("");
        if (file) $('#archivo').prop('value', '');
        vercampos(`#${formId}`, 1); // Usar formId aquí
        limpiarcampos(`#${formId}`); // Usar formId aquí
    }
    if (id !== null && inputId !== null) {
        // Esperar hasta que las opciones estén cargadas
        $(`#${inputId}`).val(id).change(); // Llama al evento 'change' si es necesario
    }
    $("#btnRegistro").show();
    $("#btnRegistro").removeClass("btn btn-success");
    $("#btnRegistro").addClass("btn btn-info");
    $("#btnRegistro").text(`Registrar ${module}`);
    $("#btnRegistro").attr("onclick", `crearRegistro('${formId}');`); // Usar formId aquí
    $(`#${modalId}`).modal({ // Usar modalId aquí
        backdrop: "static",
        keyboard: false,
    });
}

const resetForm = () => {
    if (vars.errorRegister === false) {
        vars.dataTableLaravel.clear().draw();
        vars.edit = false;
        vercampos("#frmRegistro", 1);
        limpiarcampos("#frmRegistro");
    }
    $("#ModalRegistro").modal("hide");
    $("#inputsEditar").html("");
    $("#btnRegistro").removeClass("btn btn-success");
    $("#btnRegistro").addClass("btn btn-info");
}

$(document).ready(() => {
    const urlActual = window.location.href;
    const matchUri = urlActual.match(/\/([^\/]+)\/?$/);
    const moduloActual = matchUri ? matchUri[1] : null;
    localStorage.setItem("moduloActual", moduloActual);
    $('#loader-container').fadeOut('slow');
    const getModulo = localStorage.getItem("moduloActual");

    if (getModulo && getModulo !== 'login' && getModulo !== 'home' && getModulo !== 'error') {
        const menuElement = $("#menu_" + getModulo);

        if (menuElement.length > 0) {
            menuElement.addClass("active");
            menuElement.closest('ul').closest('li').addClass("active open");
        } else {
            console.log("El elemento del menú no se encontró.");
        }
    } else {
        console.log("No se encontró un módulo válido.");
    }
    $(":input").inputmask();
});
