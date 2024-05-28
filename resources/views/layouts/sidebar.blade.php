<div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src=  "{{ asset('dist/img/user2-160x160.jpg') }}"
         class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
          
         @if(Auth::user()->user_type == 1)
          <li class="nav-item">
            
            <ul>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              
             
            </ul>
          </li>
          
        @elseif(Auth::user()->user_type == 2)

       <li class="nav-item">
            <a href="#" class="nav-link">
             
          
             
            </a>
       </li>
       
      @endif
     
      </nav>
    </div>
  </aside>