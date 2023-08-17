<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-center">
                <div id="contenedorFecha">
                    <span id="txtFecha"></span>
                    <span id="txtHora"></span>
                </div>
                <h4>Bienvenido(a) {{Auth::user()->estudiante->nombre}} {{Auth::user()->estudiante->paterno}} {{Auth::user()->estudiante->materno}}</h4>
            </div>
        </div>
    </div>
</div>