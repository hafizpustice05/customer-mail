 <header class="p-3 mb-3 border-bottom">
     <div class="container">
         <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
             <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                 <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                     <use xlink:href="#bootstrap" />
                 </svg>
             </a>

             <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                 <li><a href="#" class="nav-link px-2 link-secondary">Report</a></li>
                 <li><a href="{{ url('admin/post') }}" class="nav-link px-2 link-body-emphasis">Post</a></li>
                 <li><a href="{{ url('admin/category') }}" class="nav-link px-2 link-body-emphasis">Category</a></li>
                 <li><a href="#" class="nav-link px-2 link-body-emphasis">Blog</a></li>
             </ul>

             <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                 <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
             </form>

             <div class="dropdown text-end">
                 <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                     data-bs-toggle="dropdown" aria-expanded="false">
                     <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
                         class="rounded-circle">
                 </a>
                 <ul class="dropdown-menu text-small">
                     <li><a class="dropdown-item" href="#">{{ Auth::user()->name }}</a></li>
                     <li><a class="dropdown-item" href="#">Settings</a></li>
                     <li><a class="dropdown-item" href="#">Profile</a></li>
                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     <li>
                         <form action="{{ route('logout') }}" method="POST">
                             @csrf
                             <button class="dropdown-item" href="#">Sign out</button>
                         </form>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </header>
