<ul>
    @php
    $persona = App\Models\Persona::where('id',Auth::user()->id)->get()->first();
    $rol = $persona->rol;
    @endphp
    <li class="menu-title">Main</li>
    @if ($rol == 'PACIENTE')
        <li>
            <a href="{{ route('paciente.detalles', Auth::user()->id) }}"><i class="fa fa-vcard"></i>
                <span>Perfil</span></a>
        </li>
        <li>
            <a href="{{ route('citas') }}"><i class="fa fa-calendar"></i> <span>Citas</span></a>
        </li>
        <li>
            <a href="{{ route('teleconsulta') }}"><i class="fa fa-video-camera"></i> <span>TeleConsulta</span></a>
        </li>
    @elseif($rol == 'MEDICO' || $rol == 'ADMIN')
        <li>
            <a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> <span>Inicio</span></a>
        </li>
        <li>
            <a href="{{ route('doctores') }}"><i class="fa fa-user-md"></i> <span>Doctores</span></a>
        </li>
        <li>
            <a href="{{ route('pacientes') }}"><i class="fa fa-wheelchair"></i> <span>Pacientes</span></a>
        </li>
        <li>
            <a href="{{ route('citas') }}"><i class="fa fa-calendar"></i> <span>Citas</span></a>
        </li>
        
        <li>
            <a href="{{ route('teleconsulta') }}"><i class="fa fa-video-camera"></i> <span>TeleConsulta</span></a>
        </li>
        <li>
            <a href="{{ route('departamento') }}"><i class="fa fa-hospital-o"></i> <span>Departamentos</span></a>
        </li>
        <li>
            <a href="{{ route('ajustes') }}"><i class="fa fa-cog"></i> <span>Ajustes</span></a>
        </li>
    @endif
</ul>
