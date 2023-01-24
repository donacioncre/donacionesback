
<li class="nav-item">
    <a href="{{ route('questions.index') }}"
       class="nav-link {{ Request::is('questions*') ? 'active' : '' }}">
        <span>Preguntas</span>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('newCalls.index') }}"
       class="nav-link {{ Request::is('newCalls*') ? 'active' : '' }}">
     
        <span>Noticias</span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('calls.index') }}"
       class="nav-link {{ Request::is('calls*') ? 'active' : '' }}">
      
        <span>Convocatorias</span>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('donation.index') }}"
       class="nav-link {{ Request::is('donation*') ? 'active' : '' }}">
      
        <span>Punto de Donación</span>
    </a>
</li>

<li class="nav-item">
    <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link ">
        Horarios de Donación 
     </a>
     <ul class="collapse list-unstyled" id="apps">
        <li><a href="{{ route('bloodDonationHours.index') }}"
            class=" nav-link  {{ Request::is('bloodDonationHours*') ? 'active' : '' }}  
            dashboard-nav-dropdown-item"> 
                <span>Sangre</span>
            </a>
        </li>
        <li><a href="{{ route('plateletDonationHours.index') }}"
            class=" nav-link  {{ Request::is('plateletDonationHours*') ? 'active' : '' }}  
            dashboard-nav-dropdown-item"> 
                <span>Plaqueta</span>
            </a>
        </li>
   
     </ul>
   
</li>

<li class="nav-item">
    <a href="{{ route('schedule.index') }}"
       class="nav-link {{ Request::is('schedule*') ? 'active' : '' }}">
       
        <span>Agenda Donaciones</span>
    </a>
</li> 

<li class="nav-item">
    <a href="{{ route('histories.index') }}"
       class="nav-link {{ Request::is('histories*') ? 'active' : '' }}">
       
        <span>Historial de Donaciones</span>
    </a>
</li>
@can('ver-provincia')
    <li class="nav-item">
        <a href="{{ route('countries.index') }}"
        class="nav-link {{ Request::is('countries*') ? 'active' : '' }}">
        
            <span>Provincias</span>
        </a>
    </li>
@endcan


<li class="nav-item">
    <a href="{{ route('cities.index') }}"
       class="nav-link {{ Request::is('cities*') ? 'active' : '' }}">
        
        <span>Ciudades</span>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('users.index') }}"
       class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
      </i> 
      <span>Usuarios</span>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('donors') }}"
       class="nav-link {{ Request::is('donors*') ? 'active' : '' }}">
      </i> 
      <span>Donadores</span>
    </a>
</li>



<li class="nav-item">
    <a href="{{ route('roles.index') }}"
       class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
      </i> 
      <span>Roles</span>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('consultDonation') }}"
       class="nav-link {{ Request::is('consultDonation*') ? 'active' : '' }}">
       </i> 
       <span>Consultas Donaciones</span>
    </a>
</li>






