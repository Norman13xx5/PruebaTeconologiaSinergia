@if ($type == 'login')
    <div class="row no-gutters">
        <div class="col-lg-12 pr-lg-1 my-2">
            <a class="btn btn-info btn-block btn-lg text-white" id="btnLoginIngresar" onclick="login('frmLogin');">Iniciar
                Sesión <i class="fal fa-sign-in"></i></a>
        </div>
        <div class="col-lg-12 pl-lg-1 my-2">
            <a id="js-login-btn" class="btn btn-primary btn-block btn-lg text-white" data-toggle="modal"
                data-target="#ModalRegistro">
                Registrate <i class="fal fa-user-plus"></i>
            </a>
        </div>
    </div>
@endif
