  <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
      <!--begin::Sidebar Brand-->
      <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="./index.html" class="brand-link">
              <!--begin::Brand Image-->
              <img src="{{ asset('admin/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                  class="brand-image opacity-75 shadow" />
              <!--end::Brand Image-->
              <!--begin::Brand Text-->
              <span class="brand-text fw-light">AdminLTE 4</span>
              <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
      </div>
      <!--end::Sidebar Brand-->
      <!--begin::Sidebar Wrapper-->
      <div class="sidebar-wrapper">
          <nav class="mt-2">
              <!--begin::Sidebar Menu-->
              <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                  aria-label="Main navigation" data-accordion="false" id="navigation">
                  <li class="nav-item menu-open">
                      <a href="#" class="nav-link active">
                          <i class="nav-icon bi bi-speedometer"></i>
                          <p>
                              Dashboard
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="./index.html" class="nav-link active">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Dashboard v1</p>
                              </a>
                          </li>
                          <li class="nav-item">
                               <a href="{{ route('cliente.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-people"></i>
                                        <p>Clientes</p>
                                    </a>
                                     <a href="{{ route('factura.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-receipt"></i>
                                        <p>Facturas</p>
                                    </a>

                                     <a href="{{ route('servicio.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-scissors"></i>
                                        <p>Servicios</p>
                                    </a>

                                    <a href="{{ route('reserva.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-calendar-check"></i>
                                        <p>Reservas</p>
                                    </a> 

                          </li>
                          
                      </ul>
                  </li>
                
                 <li class="nav-item">
                      <a href="{{route('barbero.index')}}" class="nav-link">
                          <i class="nav-icon bi bi-palette"></i>
                          <p>   Barberos</p>
                      </a>
                  </li>
              </ul>
              <!--end::Sidebar Menu-->
          </nav>
      </div>
      <!--end::Sidebar Wrapper-->
  </aside>
