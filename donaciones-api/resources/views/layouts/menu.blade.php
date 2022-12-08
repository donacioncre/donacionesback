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


