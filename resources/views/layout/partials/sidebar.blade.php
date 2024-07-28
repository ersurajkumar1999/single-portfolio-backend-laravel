<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="{{route('dashboard.index')}}" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="{{auth()->user()->image}}" alt="">
              </span>
              <span class="app-brand-text demo menu-text fw-bold ms-2">{{auth()->user()->username}}</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item {{ (Request::route()->getName() == 'dashboard' || Request::route()->getName() == 'dashboard.index') ? "active": '' }} ">
              <a href="{{route('dashboard.index')}}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Basic">Dashboard </div>
              </a>
            </li>
            <li class="menu-item {{ (Request::route()->getName() == 'about.index') ? "active": '' }} ">
              <a href="{{route('about.index')}}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Basic">About </div>
              </a>
            </li>
            <li class="menu-item {{ (Request::route()->getName() == 'skills.index') ? "active": '' }} ">
              <a href="{{route('skills.index')}}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Basic">Skills </div>
              </a>
            </li>
            <li class="menu-item {{ (Request::route()->getName() == 'resume.index') ? "active": '' }} ">
              <a href="{{route('resume.index')}}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Basic">Resume </div>
              </a>
            </li>
            <li class="menu-item {{ (Request::route()->getName() == 'service.index') ? "active": '' }} ">
              <a href="{{route('service.index')}}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Basic">Service </div>
              </a>
            </li>
            <li class="menu-item {{ (Request::route()->getName() == 'portfolio.index') ? "active": '' }} ">
              <a href="{{route('portfolio.index')}}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Basic">Portfolio </div>
              </a>
            </li>
            <li class="menu-item {{ (Request::route()->getName() == 'project.index') ? "active": '' }} ">
              <a href="{{route('project.index')}}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Basic">Project </div>
              </a>
            </li>
            <li class="menu-item {{ (Request::route()->getName() == 'testimonial.index') ? "active": '' }} ">
              <a href="{{route('testimonial.index')}}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Basic">Testimonial </div>
              </a>
            </li>
            <li class="menu-item {{ (Request::route()->getName() == 'contact.index') ? "active": '' }} ">
              <a href="{{route('contact.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Basic">Contacts </div>
              </a>
            </li>

            <li class="menu-item {{ (Request::route()->getName() == 'open-ai.index') ? "active": '' }} ">
              <a href="{{route('open-ai.index')}}" class="menu-link">
                <i class='bx bx-chat me-2'></i>
                <div data-i18n="Basic"> Chat GPT </div>
              </a>
            </li>

            <li class="menu-item {{ (Request::route()->getName() == 'auth.logout') ? "active": '' }} ">
              <a href="{{route('auth.logout')}}" class="menu-link">
              <i class="bx bx-power-off me-2"></i>
                <div data-i18n="Basic">Logout </div>
              </a>
            </li>

            <!-- Layouts -->
            <!-- <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Layouts</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="layouts-without-menu.html" class="menu-link">
                    <div data-i18n="Without menu">Without menu</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="layouts-without-navbar.html" class="menu-link">
                    <div data-i18n="Without navbar">Without navbar</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="layouts-container.html" class="menu-link">
                    <div data-i18n="Container">Container</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="layouts-fluid.html" class="menu-link">
                    <div data-i18n="Fluid">Fluid</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="layouts-blank.html" class="menu-link">
                    <div data-i18n="Blank">Blank</div>
                  </a>
                </li>
              </ul>
            </li> -->
          </ul>
        </aside>
