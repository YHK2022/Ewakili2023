
   <div class="app-sidebar colored">
      <div class="sidebar-header">
          <a class="header-brand" href="index.html">
              <div class="logo-img">
                  <img src="{{ URL::to('images/Judiciary-Logo.png') }}" class="header-brand-img" alt="lavalite" style="height:30px; width:30px;">
              </div>
              <span class="text">e-WAKILI</span>
          </a>
          <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
          <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
      </div>

      <div class="sidebar-content">
          <div class="nav-container">
              <nav id="main-menu-navigation" class="navigation-main">
                  <div class="nav-lavel">Navigation</div>
                   @php           
                  
                        if(\App\Profile::where('user_id', Auth()->user()->id)->exists()){
                          $advocate = Auth::user()->is_advocate;
                          $temporary_advocate = -1;
                         }else{
                            $advocate = -1;
                            $temporary_advocate = Auth::user()->temporary_advocate;
                         }
                @endphp
                 @if($advocate > 0)
                  <div @if(\Request::is('auth/advocate-profile')) class="nav-item active" @endif class="nav-item">
                      <a href="{{ url('auth/advocate-profile') }}"><i class="ik ik-bar-chart-2"></i><span>Profile</span></a>
                  </div>
                  @elseif($temporary_advocate > 0)
                   <div @if(\Request::is('auth/temporary-advocate-profile')) class="nav-item active" @endif class="nav-item">
                      <a href="{{ url('auth/temporary-advocate-profile') }}"><i class="ik ik-bar-chart-2"></i><span>Temporary Advocate Profile</span></a>
                  </div>
                  @else
                   <div @if(\Request::is('auth/advocate-profile')) class="nav-item active" @endif class="nav-item">
                      <a href="{{ url('auth/petitioner-profile') }}"><i class="ik ik-bar-chart-2"></i><span>Petitioner Profile</span></a>
                  </div>
                  @endif
               
    
                 <div @if(\Request::is('temporary/temporary') ||
                           \Request::is('temporary/temporary')) class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Temporary Application</span></a>
                      <div class="submenu-content">
                        <a @if(\Request::is('temporary/personal-detail')) class="menu-item active" @endif href="{{ url('temporary/personal-detail') }}" class="menu-item">Personal Details @if($profile) - <span style="color:DeepSkyBlue;">&#10003;</span>@endif</a>
                        <a @if(\Request::is('petition/application-form')) class="menu-item active" @endif href="{{ url('temporary/application-form') }}" class="menu-item">Application Form @if($qualification) - <span style="color:DeepSkyBlue;">&#10003;</span>@endif</a>
                        <a @if(\Request::is('temporary/temporary-attachment')) class="menu-item active" @endif href="{{ url('temporary-temporary/attachment') }}" class="menu-item">Attachments @if($petition_form) @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span>@endif @endif</a>  
                        <a @if(\Request::is('temporary/submission')) class="menu-item active" @endif href="{{ url('temporary/submission') }}" class="menu-item">Finish @if($progress) @if($progress->finish == 1) - <span style="color:DeepSkyBlue;">&#10003;</span>@endif @endif</a>
                      </div>
                  </div>
    
               

                   <div @if(\Request::is('my-application')) class = "nav-item active open" @endif class="nav-item">
                      <a href="{{ url('my-application') }}"><i class="ik ik-edit"></i><span>My Applications</span></a>
                  </div>

                  <div @if(\Request::is('request')) class = "nav-item active open" @endif class="nav-item">
                      <a href="{{ url('request') }}"><i class="ik ik-paperclip"></i><span>Requests</span></a>
                  </div>

            
                  <div @if(\Request::is('bill/bill') ||
                           \Request::is('bill/payment')) class="nav-item has-sub active open" @endif class="nav-item has-sub">
                      <a class="dropdown" href="javascript:void(0)"><i class="ik ik-clipboard"></i><span>Bills & Payments</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('bill/bill')) class="menu-item active" @endif href="{{ url('bill/bill') }}" class="menu-item">Bills</a>
                          <a @if(\Request::is('bill/payment')) class="menu-item active" @endif href="{{ url('bill/payment') }}" class="menu-item">Payments</a>
                      </div>
                  </div>

              <div @if(\Request::is('firm')) class = "nav-item active open" @endif class="nav-item">
                      <a href="{{ url('firm') }}"><i class="ik ik-layers"></i><span>Temporary Application Form</span></a>
              </div>
                  <div class="nav-lavel">Settings</div>
                  <div @if(\Request::is('user/change-password') ||
                        \Request::is('user/update-profile')) class="nav-item active open has-sub" @endif class="nav-item has-sub">
                      <a href="#"><i class="ik ik-user"></i><span>User Management</span></a>
                      <div class="submenu-content">
                          <a @if(\Request::is('user/change-password')) class="menu-item active"  @endif href="{{ url('user/change-password') }}" class="menu-item">Change Password</a>
                          <a @if(\Request::is('user/update-profile')) class="menu-item active"  @endif href="{{ url('user/profile') }}" class="menu-item">Profile Update</a>
                      </div>
                  </div>

              </nav>
          </div>
      </div>
  </div>
