@if (count($notificacion_estudiantes) > 0)
    @foreach ($notificacion_estudiantes as $notificacion_estudiante)
        <div class="dropdown-divider"></div>
        <a href="{{ route('notificacion_estudiantes.show', $notificacion_estudiante->id) }}" class="dropdown-item">
            <div class="notificacion sin_ver">
                <div class="info_notificacion_estudiante">
                    {{ $notificacion_estudiante->descripcion }}
                </div>
                <span class="float-right text-muted text-sm hora">
                    <div class="txt_hora">{{ date('d/m/Y', strtotime($notificacion_estudiante->created_at)) }}</div>
                </span>
            </div>
        </a>
    @endforeach
@else
    <div class="dropdown-divider"></div>
    <div class="dropdown-item">SIN NOTIFICACIONES</div>
@endif
