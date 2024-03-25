<li class="nav-item">
    <a href="{{ route('kardex_desempenos.estudiante') }}"
        class="nav-link {{ request()->is('kardex_desempenos*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list-alt"></i>
        <p style="word-wrap: break-word;">Desempeño académico</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('notificacion_estudiantes.index') }}"
        class="nav-link {{ request()->is('notificacion_estudiantes*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-bell"></i>
        <p style="word-wrap: break-word;">Notificaciones</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('horarios.estudiante') }}"
        class="nav-link {{ request()->is('horarios*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p style="word-wrap: break-word;">Horarios</p>
    </a>
</li>

<li class="nav-item @if (request()->is('calificacions*')) menu-is-opening menu-open active @endif">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-list-alt"></i>
        <p>Calificaciones <i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('calificacions.calificacion_estudiante', Auth::user()->estudiante->id) }}"
                class="nav-link {{ request()->is('calificacions/estudiante*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>Ver Notas</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('boleta.boleta_estudiante', Auth::user()->estudiante->id) }}"
                class="nav-link {{ request()->is('calificacions/boleta*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>Boleta de Calificaciones</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('calificacions.historial_academico', Auth::user()->estudiante->id) }}"
                class="nav-link {{ request()->is('calificacions/historial*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>Historial Académico</p>
            </a>
        </li>
    </ul>
</li>
