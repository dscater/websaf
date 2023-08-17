
<li class="nav-item @if(request()->is('calificacions*'))menu-is-opening menu-open active @endif">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-list-alt"></i>
        <p>Calificaciones <i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('calificacions.calificacion_estudiante',Auth::user()->estudiante->id) }}" class="nav-link {{ request()->is('calificacions/estudiante*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>Ver Notas</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('boleta.boleta_estudiante',Auth::user()->estudiante->id) }}" class="nav-link {{ request()->is('calificacions/boleta*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>Boleta de Calificaciones</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('calificacions.historial_academico',Auth::user()->estudiante->id) }}" class="nav-link {{ request()->is('calificacions/historial*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>Historial Académico</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item @if(request()->is('pagos*'))menu-is-opening menu-open active @endif">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-list-alt"></i>
        <p>Pagos <i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('pagos.pagos_estudiante',Auth::user()->estudiante->id) }}" class="nav-link {{ request()->is('pagos/pagos_estudiante*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>Ver Pagos</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('pagos.historial_pagos',Auth::user()->estudiante->id) }}" class="nav-link {{ request()->is('pagos/historial_pagos*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>Historial de Pagos</p>
            </a>
        </li>
    </ul>
</li>