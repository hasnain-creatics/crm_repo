<!--aside open-->

<aside class="app-sidebar">
					<div class="app-sidebar__logo">
						<a class="header-brand" href="index.html">
							<img src="{{asset('public')}}/logo/logo.png" class="header-brand-img desktop-lgo" alt="Azea logo">
							<img src="{{asset('public')}}/logo/logo.png" class="header-brand-img dark-logo" alt="Azea logo">
							<img src="{{asset('public')}}/logo/logo.png" class="header-brand-img mobile-logo" alt="Azea logo">
							<img src="{{asset('public')}}/logo/logo.png" class="header-brand-img darkmobile-logo" alt="Azea logo">
						</a>
					</div>
					<ul class="side-menu app-sidebar3">
						<li class="side-item side-item-category">Main</li>
						<li class="slide">
							<a class="side-menu__item"  href="{{route('home')}}">
								<svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/></svg>
							<span class="side-menu__label">Dashboard</span></a>
						</li>
						<li class="side-item side-item-category">Components</li>
						@if (Auth::user()->can('user-view') || Auth::user()->can('role-view'))
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">                               
									<svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"  fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
										<path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
										<path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
										<path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
									</svg>
								<span class="side-menu__label">User Management</span><i class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
								@can('role-view')
                                    <li><a href="{{url('admin/roles')}}" class="slide-item">Roles</a></li>
								@endcan
								
								@can('user-view')
                                    <li><a href="{{url('admin/user')}}" class="slide-item">User</a></li>
								@endcan   
								</ul>
                            </li>
                        @endif

                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
								<svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
									<path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
								</svg>
                                <span class="side-menu__label">Lead Management</span><i class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
								    <li><a href="{{route('leads.home')}}" class="slide-item">Leads List</a></li>
								</ul>
                            </li>
							
					</ul>
                       </aside>

				<!--aside closed-->
