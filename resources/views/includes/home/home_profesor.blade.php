 <!-- Info boxes -->
 <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list-alt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Materias Asignadas {{date('Y')}}</span>
                <span class="info-box-number">{{$materias}}</span>
            </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-list"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Asistencias {{date('Y')}}</span>
                <span class="info-box-number">{{$asistencias}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    {{-- <div class="col-12 col-sm-6 col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <div id="contenedorFecha" style="flex-direction: column;">
                    <span id="txtFecha"></span>
                    <span id="txtHora"></span>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4>Bienvenido(a) {{Auth::user()->profesor->nombre}} {{Auth::user()->profesor->paterno}} {{Auth::user()->profesor->materno}}</h4>
            </div>
        </div>
    </div>
    <div class="clearfix hidden-md-up"></div>
 </div>