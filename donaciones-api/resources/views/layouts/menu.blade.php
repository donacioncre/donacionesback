<li class="nav-item">

</li>


<li class="nav-item">
    <a href="{{ route('questions.index') }}"
       class="nav-link {{ Request::is('questions*') ? 'active' : '' }}">
        <p>Preguntas</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('newCalls.index') }}"
       class="nav-link {{ Request::is('newCalls*') ? 'active' : '' }}">
        <p>Noticias y Convocatorias</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('donation.index') }}"
       class="nav-link {{ Request::is('donation*') ? 'active' : '' }}">
        <p>Punto de Donación</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('bloodDonationHours.index') }}"
       class="nav-link {{ Request::is('bloodDonationHours*') ? 'active' : '' }}">
        <p>Horarios Donación</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('plateletDonationHours.index') }}"
       class="nav-link {{ Request::is('plateletDonationHours*') ? 'active' : '' }}">
        <p>Horarios Plaqueta</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('schedule.index') }}"
       class="nav-link {{ Request::is('schedule*') ? 'active' : '' }}">
        <p>Agenda Donaciones</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('donationHistories.index') }}"
       class="nav-link {{ Request::is('donationHistories*') ? 'active' : '' }}">
        <p>Historial</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('countries.index') }}"
       class="nav-link {{ Request::is('countries*') ? 'active' : '' }}">
        <p>Provincias</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('cities.index') }}"
       class="nav-link {{ Request::is('cities*') ? 'active' : '' }}">
        <p>Ciudades</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('users.index') }}"
       class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
       <i class="fa fa-user"></i> <p>Usuarios</p>
    </a>
</li>



<li class="nav-item">
    <a href="{{ route('roles.index') }}"
       class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
       <i class="fa fa-user"></i> <p>Roles</p>
    </a>
</li>
