<li class="nav-item">
    <a href="{{ route('administrativos.index') }}" class="nav-link {{ request()->is('administrativos*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Administrativos</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('estudiantes.index') }}" class="nav-link {{ request()->is('estudiantes*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Estudiantes</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('profesors.index') }}" class="nav-link {{ request()->is('profesors*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Profesores</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('asistencias.index') }}" class="nav-link {{ request()->is('asistencias*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>Asistencias</p>
    </a>
</li>

<li class="nav-item @if(request()->is('materias*') || request()->is('areas*') || request()->is('campos*') || request()->is('nivels*') || request()->is('grados*'))menu-is-opening menu-open active @endif">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-list-alt"></i>
        <p>Materias <i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('materias.index') }}" class="nav-link @if(request()->is('materias*'))active @endif">
                <i class="nav-icon far fa-circle"></i>
                <p>Materias</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('areas.index') }}" class="nav-link @if(request()->is('areas*'))active @endif">
                <i class="nav-icon far fa-circle"></i>
                <p>Áreas</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('campos.index') }}" class="nav-link @if(request()->is('campos*'))active @endif">
                <i class="nav-icon far fa-circle"></i>
                <p>Campos</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item @if(request()->is('inscripcions*') || request()->is('paralelos*'))menu-is-opening menu-open active @endif">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-list-alt"></i>
        <p>Inscripcions <i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('inscripcions.index') }}" class="nav-link @if(request()->is('inscripcions*'))active @endif">
                <i class="nav-icon far fa-circle"></i>
                <p>Inscripcions</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('paralelos.index') }}" class="nav-link @if(request()->is('paralelos*'))active @endif">
                <i class="nav-icon far fa-circle"></i>
                <p>Paralelos</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item @if(request()->is('pago_estudiantes*') || request()->is('plan_pagos*'))menu-is-opening menu-open active @endif">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-list-alt"></i>
        <p>Pagos <i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('pago_estudiantes.index') }}" class="nav-link @if(request()->is('pago_estudiantes*'))active @endif">
                <i class="nav-icon far fa-circle"></i>
                <p>Pagos Estudiantes</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('plan_pagos.index') }}" class="nav-link @if(request()->is('plan_pagos*'))active @endif">
                <i class="nav-icon far fa-circle"></i>
                <p>Plan de Pagos</p>
            </a>
        </li>
    </ul>
</li>


<li class="nav-item">
    <a href="{{ route('reportes.index') }}" class="nav-link {{ request()->is('reportes*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>Reportes</p>
    </a>
</li>
