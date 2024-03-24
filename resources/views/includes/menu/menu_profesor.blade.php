<li class="nav-item">
    <a href="{{ route('profesor_materias.materias_asignadas',Auth::user()->profesor->id) }}" class="nav-link {{ request()->is('profesor_materias*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>Asignación de Materias</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('calificacions.index',Auth::user()->profesor->id) }}" class="nav-link {{ request()->is('calificacions*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>Administrar calificaciones</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('reportes.index') }}" class="nav-link {{ request()->is('reportes*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>Reportes</p>
    </a>
</li>
