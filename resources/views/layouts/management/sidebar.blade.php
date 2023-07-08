<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="index.html">
            <div class="logo-img">
                <img src="{{ URL::to('images/Judiciary-Logo.png') }}" class="header-brand-img" alt="lavalite"
                    style="height:30px; width:30px;">
            </div>
            <span class="text">e-WAKILI</span>
        </a>
        <button type="button" class="nav-toggle"><i data-toggle="expanded"
                class="ik ik-toggle-right toggle-icon"></i></button>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    <div class="sidebar-content">
          <?php
                               $roleId = Auth::user()->roles()->pluck('role_id')->first();
                        ?>
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-lavel">Navigation</div>
                <div @if (\Request::is('auth/dashboard')) class="nav-item active" @endif class="nav-item">
                    <a href="{{ url('auth/dashboard') }}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                </div>

                <div @if (\Request::is('advocate/roll')) class="nav-item active" @endif class="nav-item">
                    <a href="{{ url('advocate/roll') }}"><i class="ik ik-users"></i><span>Roll of Advocates</span></a>
                </div>

                <div class="nav-lavel">Petition for Admission</div>

                <div @if (\Request::is('sessions/petition-session') || \Request::is('sessions/pending-admission')) class="nav-item has-sub active open" @endif
                    class="nav-item has-sub">
                    @if($roleId ==1 || $roleId == 5 )
                    <a class="dropdown" href="javascript:void(0)"><i class="ik ik-repeat"></i><span>Sessions
                            Management</span></a>
                    <div class="submenu-content">
                        <a @if (\Request::is('sessions/petition-session')) class="menu-item active" @endif
                            href="{{ url('settings/petition-session') }}" class="menu-item">Petition Sessions </a>
                        <a @if (\Request::is('sessions/pending-admission')) class="menu-item active" @endif
                            href="{{ url('sessions/pending-admission') }}" class="menu-item">Pending Admission </a>
                    </div>
                    @endif
                </div>

                <div @if (
                    \Request::is('petition/under-review') ||
                        \Request::is('petition/rhc-review') ||
                        \Request::is('petition/cle-inspection') ||
                        \Request::is('petition/cj-appearance') ||
                        \Request::is('petition/new-applicant')) class="nav-item has-sub active open" @endif
                    class="nav-item has-sub">
                    <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Petition
                            Applications</span></a>
                      
                    <div class="submenu-content">
                     
                        @if($roleId ==1  || $roleId == 4 || $roleId == 5)
                        <a @if (\Request::is('petition/under-review')) class="menu-item active" @endif
                            href="{{ url('petition/under-review') }}" class="menu-item">Under Review </a>
                        @endif    
                         @if($roleId == 1 || $roleId == 6 || $roleId == 7)
                        <a @if (\Request::is('petition/rhc-review')) class="menu-item active" @endif
                            href="{{ url('petition/rhc-review') }}" class="menu-item">RHC Review </a>
                        @endif
                        @if($roleId == 1 || $roleId == 8 || $roleId == 2 || $roleId == 13 )
                         <a @if (\Request::is('petition/cle-inspection')) class="menu-item active" @endif
                            href="{{ url('petition/cle-inspection') }}" class="menu-item">CLE Inspection </a>
                       @endif
                        @if($roleId == 1 || $roleId == 10 )
                      <a @if  (\Request::is('petition/cj-appearance')) class="menu-item active" @endif
                            href="{{ url('petition/cj-appearance') }}" class="menu-item">CJ Appearance </a>
                        @endif    
                        <a @if (\Request::is('petition/new-applicant')) class="menu-item active" @endif
                            href="{{ url('petition/new-applicant') }}" class="menu-item">New Applicants </a>
                    </div>
                </div>
                  @if($roleId ==1 || $roleId == 13 )
                  <div @if (\Request::is('advocate/roll')) class="nav-item active" @endif class="nav-item">
                    <a href="{{ url('petition/legal-objections') }}"><i class="ik ik-users"></i><span>Legal Professional Objections</span></a>
                </div>
                @endif
                <div @if (
                    \Request::is('petition-resume/rhc-inspection') ||
                        \Request::is('petition-resume/cle-approval') ||
                        \Request::is('petition-resume/cj-approval')) class="nav-item has-sub active open" @endif
                    class="nav-item has-sub">
                    <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Resume
                            Petition</span></a>
                    <div class="submenu-content">
                         @if($roleId == 1 || $roleId == 6 || $roleId == 7)
                        <a @if (\Request::is('petition-resume/rhc')) class="menu-item active" @endif
                            href="{{ url('resume/resume-petition/rhc') }}" class="menu-item">RHC Inspection </a>
                        @endif
                        @if($roleId == 1 || $roleId == 8 || $roleId == 2 || $roleId == 13 )
                        <a @if (\Request::is('petition-resume/cle-approval')) class="menu-item active" @endif
                            href="{{ url('resume/resume-petition/cle-approval') }}" class="menu-item">CLE Approval </a>
                        @endif
                        @if($roleId == 1 || $roleId == 10 )    
                        <a @if (\Request::is('resume/resume-petition/cj')) class="menu-item active" @endif
                            href="{{ url('resume/resume-petition/cj-approval') }}" class="menu-item">CJ Approval </a>
                          @endif    
                    </div>
                  
                </div>

                <div @if (
                    \Request::is('miscellaneous/postponed') ||
                        \Request::is('miscellaneous/deferred') ||
                        \Request::is('miscellaneous/objected') ||
                        \Request::is('miscellaneous/abandoned')) class="nav-item has-sub active open" @endif
                    class="nav-item has-sub">
                    <a class="dropdown" href="javascript:void(0)"><i
                            class="ik ik-file-text"></i><span>Miscellaneous</span></a>
                    <div class="submenu-content">
                        <a @if (\Request::is('miscellaneous/postponed')) class="menu-item active" @endif
                            href="{{ url('miscellaneous/postponed') }}" class="menu-item">Postponed </a>
                        <a @if (\Request::is('miscellaneous/deferred')) class="menu-item active" @endif
                            href="{{ url('miscellaneous/deferred') }}" class="menu-item">Deferred </a>
                        <a @if (\Request::is('miscellaneous/objected')) class="menu-item active" @endif
                            href="{{ url('miscellaneous/objected') }}" class="menu-item">Objected </a>
                        <a @if (\Request::is('miscellaneous/abandoned')) class="menu-item active" @endif
                            href="{{ url('miscellaneous/abandoned') }}" class="menu-item">Abandoned </a>
                    </div>
                </div>

                <div @if (\Request::is('firm/pending') || \Request::is('firm/approved')) class="nav-item has-sub active open" @endif
                    class="nav-item has-sub">
                    <a class="dropdown" href="javascript:void(0)"><i class="ik ik-repeat"></i><span>Firms &
                            Workplaces</span></a>
                    <div class="submenu-content">
                        <a @if (\Request::is('firm/pending')) class="menu-item active" @endif
                            href="{{ url('firm/pending') }}" class="menu-item">Pending Approval </a>
                        <a @if (\Request::is('firm/approved')) class="menu-item active" @endif
                            href="{{ url('firm/approved') }}" class="menu-item">Approved Firms </a>
                    </div>
                </div>

                <div class="nav-lavel">Permit Applications</div>

                @if($roleId ==1  || $roleId == 4 || $roleId == 5 || $roleId == 6 || $roleId == 7 || $roleId == 10)
                <div @if (
                    \Request::is('out-of-time/under-review') ||
                        \Request::is('out-of-time/rhc-review') ||
                        \Request::is('out-of-time/cj-approval')) class="nav-item has-sub active open" @endif
                    class="nav-item has-sub">
                    <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Late
                            Renewals</span></a>
                    <div class="submenu-content">
                        @if($roleId ==1  || $roleId == 4 || $roleId == 5)
                        <a @if (\Request::is('permit/late-renewal/under-review')) class="menu-item active" @endif
                            href="{{ url('permit/late-renewal/under-review') }}" class="menu-item">Under Reveiw </a>
                        @endif    
                        @if($roleId == 1 || $roleId == 6 || $roleId == 7)
                        <a @if (\Request::is('permit/late-renewal/rhc')) class="menu-item active" @endif
                            href="{{ url('permit/late-renewal/rhc') }}" class="menu-item">RHC Review </a>
                        @endif  
                        @if($roleId == 1 || $roleId == 10 )   
                        <a @if (\Request::is('permit/late-renewal/cj')) class="menu-item active" @endif
                            href="{{ url('permit/late-renewal/cj') }}" class="menu-item">CJ Approval </a>
                        @endif    
                    </div>
                </div>

                <div @if (\Request::is('resume/under-review') || \Request::is('resume/rhc-review') || \Request::is('resume/cj-approval')) class="nav-item has-sub active open" @endif
                    class="nav-item has-sub">
                    <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Resume
                            Practising</span></a>
                    <div class="submenu-content">
                        @if($roleId ==1  || $roleId == 4 || $roleId == 5)
                        <a @if (\Request::is('permit/resume-practising/under-review')) class="menu-item active" @endif
                            href="{{ url('permit/resume-practising/under-review') }}" class="menu-item">Under Review </a>
                        @endif
                        @if($roleId == 1 || $roleId == 6 || $roleId == 7)    
                        <a @if (\Request::is('permit/resume-practising/rhc')) class="menu-item active" @endif
                            href="{{ url('permit/resume-practising/rhc') }}" class="menu-item">RHC Review </a>
                        @endif
                        @if($roleId == 1 || $roleId == 10 )     
                        <a @if (\Request::is('permit/resume-practising/cj')) class="menu-item active" @endif
                            href="{{ url('permit/resume-practising/cj') }}" class="menu-item">CJ Approval </a>
                        @endif    
                    </div>
                </div>

                <div @if (\Request::is('suspend/under-review') || \Request::is('suspend/rhc-review') || \Request::is('suspend/cj-approval')) class="nav-item has-sub active open" @endif
                    class="nav-item has-sub">
                    <a class="dropdown" href="javascript:void(0)"><i
                            class="ik ik-file-text"></i><span>Suspending</span></a>
                    <div class="submenu-content">
                        @if($roleId ==1  || $roleId == 4 || $roleId == 5)
                        <a @if (\Request::is('permit/suspend/under-review')) class="menu-item active" @endif
                            href="{{ url('permit/suspend/under-review') }}" class="menu-item">Under Review </a>
                        @endif
                        @if($roleId == 1 || $roleId == 6 || $roleId == 7)    
                        <a @if (\Request::is('permit/suspend/rhc-review')) class="menu-item active" @endif
                            href="{{ url('permit/suspend/rhc') }}" class="menu-item">RHC Review </a>
                       @endif
                        @if($roleId == 1 || $roleId == 10 )    
                        <a @if (\Request::is('permit/suspend/cj')) class="menu-item active" @endif
                            href="{{ url('permit/suspend/cj') }}" class="menu-item">CJ Approval </a>
                        @endif    
                    </div>
                </div>

                <div @if (
                    \Request::is('non-practising/under-review') ||
                        \Request::is('non-practising/rhc-review') ||
                        \Request::is('non-practising/cj-approval')) class="nav-item has-sub active open" @endif
                    class="nav-item has-sub">
                    <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>None
                            Practising</span></a>
                    <div class="submenu-content">
                        @if($roleId ==1  || $roleId == 4 || $roleId == 5)
                        <a @if (\Request::is('permit/non-practising/under-review')) class="menu-item active" @endif
                            href="{{ url('permit/non-practising/under-review') }}" class="menu-item">Under Review </a>
                        @endif    
                         @if($roleId == 1 || $roleId == 6 || $roleId == 7)     
                        <a @if (\Request::is('permit/non-practising/rhc')) class="menu-item active" @endif
                            href="{{ url('permit/non-practising/rhc') }}" class="menu-item">RHC Review </a>
                        @endif    
                         @if($roleId == 1 || $roleId == 10 )     
                        <a @if (\Request::is('permit/non-practising/cj')) class="menu-item active" @endif
                            href="{{ url('permit/non-practising/cj') }}" class="menu-item">CJ Approval </a>
                        @endif    
                    </div>
                </div>

                <div @if (\Request::is('retire-practising/under-review') || \Request::is('retire/under-review') || \Request::is('retire/cj-approval')) class="nav-item has-sub active open" @endif
                    class="nav-item has-sub">
                    <a class="dropdown" href="javascript:void(0)"><i
                            class="ik ik-file-text"></i><span>Retiring</span></a>
                    <div class="submenu-content">
                        @if($roleId ==1  || $roleId == 4 || $roleId == 5)
                        <a @if (\Request::is('permit/retire-practising/under-review')) class="menu-item active" @endif
                            href="{{ url('permit/retire-practising/under-review') }}" class="menu-item">Under Review </a>
                        @endif    
                        @if($roleId == 1 || $roleId == 6 || $roleId == 7)    
                        <a @if (\Request::is('permit/retire-practising/rhc')) class="menu-item active" @endif
                            href="{{ url('permit/retire-practising/rhc') }}" class="menu-item">RHC Review </a>
                        @endif    
                        @if($roleId == 1 || $roleId == 10 )    
                        <a @if (\Request::is('permit/retire-practising/cj')) class="menu-item active" @endif
                            href="{{ url('permit/retire-practising/cj') }}" class="menu-item">CJ Approval </a>
                        @endif    
                    </div>
                </div>

                <div @if (
                    \Request::is('not-profit/under-review') ||
                        \Request::is('not-profit/rhc-review') ||
                        \Request::is('not-profit/cj-approval')) class="nav-item has-sub active open" @endif
                    class="nav-item has-sub">
                    <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Not for
                            Profit</span></a>
                    <div class="submenu-content">
                        @if($roleId ==1  || $roleId == 4 || $roleId == 5)
                        <a @if (\Request::is('permit/non-profit/under-review')) class="menu-item active" @endif
                            href="{{ url('permit/non-profit/under-review') }}" class="menu-item">Under Review </a>
                        @endif    
                        @if($roleId == 1 || $roleId == 6 || $roleId == 7)    
                        <a @if (\Request::is('permit/non-profit/rhc')) class="menu-item active" @endif
                            href="{{ url('permit/non-profit/rhc') }}" class="menu-item">RHC Review </a>
                        @endif    
                        @if($roleId == 1 || $roleId == 10 )    
                        <a @if (\Request::is('permit/non-profit/cj')) class="menu-item active" @endif
                            href="{{ url('permit/non-profit/cj') }}" class="menu-item">CJ Approval </a>
                        @endif    
                    </div>
                </div>

                <div @if (
                    \Request::is('name-change/under-review') ||
                        \Request::is('name-change/rhc-review') ||
                        \Request::is('name-change/jk-approval')) class="nav-item has-sub active open" @endif
                    class="nav-item has-sub">
                    <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Name
                            Change</span></a>
                    <div class="submenu-content">
                        @if($roleId ==1  || $roleId == 4 || $roleId == 5)
                        <a @if (\Request::is('permit/name-change/under-review')) class="menu-item active" @endif
                            href="{{ url('permit/name-change/under-review') }}" class="menu-item">Under Review </a>
                        @endif    
                        @if($roleId == 1 || $roleId == 6 || $roleId == 7)    
                        <a @if (\Request::is('permit/name-change/rhc-review')) class="menu-item active" @endif
                            href="{{ url('permit/name-change/rhc') }}" class="menu-item">RHC Review </a>
                        @endif    
                        @if($roleId == 1 || $roleId == 10 )    
                        <a @if (\Request::is('permit/name-change/jk')) class="menu-item active" @endif
                            href="{{ url('permit/name-change/jk') }}" class="menu-item">JK Approval </a>
                        @endif    
                    </div>
                </div>
              @endif
                <div @if (
                    \Request::is('temp-admission/new-application') ||
                        \Request::is('temp-admission/rhc-review') ||
                        \Request::is('temp-admission/cj-approval') ||
                        \Request::is('temp-admission/temp-advocates')) class="nav-item has-sub active open" @endif
                    class="nav-item has-sub">
                    <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Temporary
                            Admission</span></a>
                    <div class="submenu-content">
                        <a @if (\Request::is('temp-admission/new-application')) class="menu-item active" @endif
                            href="{{ url('temporary-advocate/temporary-admission/new-application') }}" class="menu-item">New Applications
                        </a>
                        @if($roleId ==1  || $roleId == 4 || $roleId == 5)
                        <a @if (\Request::is('temporay-admission/rhc-review')) class="menu-item active" @endif
                            href="{{ url('temporary-admission/rhc-review') }}" class="menu-item">RHC Review </a>
                        @endif    
                        @if($roleId == 1 || $roleId == 6 || $roleId == 7)     
                        <a @if (\Request::is('temp-admission/cj-approval')) class="menu-item active" @endif
                            href="{{ url('temporay-admission/temporary-admission/cj') }}" class="menu-item">CJ Approval </a>
                        @endif    
                        @if($roleId == 1 || $roleId == 10 )      
                        <a @if (\Request::is('temp-admission/temp-advocates')) class="menu-item active" @endif
                            href="{{ url('temporary-admission/temporary-admission/temp-advocates') }}" class="menu-item">Temporary Advocates
                        </a>
                       @endif 
                    </div>
                </div>

                <div @if (
                    \Request::is('trace-application/petition') ||
                        \Request::is('trace-application/permit') ||
                        \Request::is('trace-application/temp-admission') ||
                        \Request::is('trace-application/resume-petition')) class="nav-item has-sub active open" @endif
                    class="nav-item has-sub">
                    <a class="dropdown" href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Application
                            Tracking</span></a>
                    <div class="submenu-content">
                        <a @if (\Request::is('permit/trace-application/petition')) class="menu-item active" @endif
                            href="{{ url('permit/trace-application/petition-application') }}" class="menu-item">Petition Applications
                        </a>
                        <a @if (\Request::is('permit/trace-application/permit')) class="menu-item active" @endif
                            href="{{ url('permit/trace-application/permit-request') }}" class="menu-item">Permit Requests </a>
                        <a @if (\Request::is('permit/trace-application/temporary-admission')) class="menu-item active" @endif
                            href="{{ url('permit/trace-application/temporary-admission') }}" class="menu-item">Temporary Admissions
                        </a>
                        <a @if (\Request::is('permit/trace-application/resume-petition')) class="menu-item active" @endif
                            href="{{ url('permit/trace-application/resume-petition') }}" class="menu-item">Resume Petition
                        </a>
                    </div>
                </div>
               @if($roleId == 1 || $roleId == 20 ) 
                <div @if (
                    \Request::is('bills/pending') ||
                        \Request::is('bills/paid') ||
                        \Request::is('bills/cancelled') ||
                        \Request::is('bills/expired') ||
                        \Request::is('bills/reconciliation')) class="nav-item has-sub active open" @endif
                    class="nav-item has-sub">
                    <a class="dropdown" href="javascript:void(0)"><i class="ik ik-clipboard"></i><span>Payments &
                            Bills</span></a>
                    <div class="submenu-content">
                        <a @if (\Request::is('permit/bills/pending')) class="menu-item active" @endif
                            href="{{ url('permit/bills/pending') }}" class="menu-item">Pending </a>
                        <a @if (\Request::is('permit/bills/paid')) class="menu-item active" @endif
                            href="{{ url('permit/bills/paid') }}" class="menu-item">Paid </a>
                        <a @if (\Request::is('permit/bills/cancelled')) class="menu-item active" @endif
                            href="{{ url('permit/bills/cancelled') }}" class="menu-item">Cancelled </a>
                        <a @if (\Request::is('permit/bills/expired')) class="menu-item active" @endif
                            href="{{ url('permit/bills/expired') }}" class="menu-item">Expired </a>
                             <a @if (\Request::is('permit/bills/payments')) class="menu-item active" @endif
                            href="{{ url('permit/bills/payments') }}" class="menu-item">Client Payments </a>
                        <a @if (\Request::is('permit/bills/reconciliation')) class="menu-item active" @endif
                            href="{{ url('permit/bills/reconciliation') }}" class="menu-item">Reconciliation </a>
                       
                    </div>
                </div>
               @endif 
                @if($roleId == 1 ) 
                <div class="nav-lavel">Reports & Settings</div>
                <div @if (
                    \Request::is('manage/personal-details') ||
                        \Request::is('manage/qualifications') ||
                        \Request::is('manage/experience') ||
                        \Request::is('manage/lst') ||
                        \Request::is('manage/firm') ||
                        \Request::is('manage/add-firm') ||
                        \Request::is('manage/finish')) class="nav-item has-sub active open" @endif
                    class="nav-item has-sub">
                    <a class="dropdown" href="javascript:void(0)"><i
                            class="ik ik-layers"></i><span>Reports</span></a>
                    <div class="submenu-content">
                        <a @if (\Request::is('manage/personal-details')) class="menu-item active" @endif
                            href="{{ url('manage/personal-details') }}" class="menu-item">Statistical Reports </a>
                        <a @if (\Request::is('manage/qualifications')) class="menu-item active" @endif
                            href="{{ url('report/petition') }}" class="menu-item">Petition Report </a>
                        <a @if (\Request::is('report/permit')) class="menu-item active" @endif
                            href="{{ url('report/permit') }}" class="menu-item">Permit Reports </a>
                        <a @if (\Request::is('report/advocate')) class="menu-item active" @endif
                            href="{{ url('report/advocate') }}" class="menu-item">Advocate Report </a>
                        <a @if (\Request::is('manage/lst')) class="menu-item active" @endif
                            href="{{ url('manage/lst') }}" class="menu-item">Temporary Admission Reports </a>
                        <a @if (\Request::is('report/revenue')) class="menu-item active" @endif
                            href="{{ url('report/revenue') }}" class="menu-item">Revenue Collection </a>
                    </div>
                </div>

                <div @if (
                    \Request::is('user-management/role') ||
                        \Request::is('user-management/permission') ||
                        \Request::is('user-management/user') ||
                        \Request::is('user-management/cle') ||
                        \Request::is('user-management/role/add') ||
                        \Request::is('user-management/adv-committee') ||
                        \Request::is('user-management/legal-professional') ||
                        \Request::is('user-management/profile')) class="nav-item has-sub active open" @endif
                    class="nav-item has-sub">
                    <a class="dropdown" href="javascript:void(0)"><i class="ik ik-user"></i><span>User
                            Management</span></a>
                    <div class="submenu-content">
                        <a @if (\Request::is('user-management/role') || \Request::is('user-management/role/add')) class="menu-item active" @endif
                            href="{{ url('user-management/role') }}" class="menu-item">Roles </a>
                        <a @if (\Request::is('user-management/permission')) class="menu-item active" @endif
                            href="{{ url('user-management/permission') }}" class="menu-item">Permissions </a>
                        <a @if (\Request::is('user-management/user')) class="menu-item active" @endif
                            href="{{ url('user-management/user') }}" class="menu-item">Users </a>
                        <a @if (\Request::is('user-management/cle')) class="menu-item active" @endif
                            href="{{ url('user-management/cle-members') }}" class="menu-item">CLE </a>
                        <a @if (\Request::is('user-management/adv-committee')) class="menu-item active" @endif
                            href="{{ url('user-management/adv-committee') }}" class="menu-item">Advocate Committee
                        </a>
                        <a @if (\Request::is('user-management/legal-professional')) class="menu-item active" @endif
                            href="{{ url('user-management/legal-professional') }}" class="menu-item">Legal
                            Professionals </a>
                        <a @if (\Request::is('user-management/profile')) class="menu-item active" @endif
                            href="{{ url('user-management/profile') }}" class="menu-item">Profile </a>
                    </div>
                </div>

                <div @if (
                    \Request::is('settings/advocate-category') ||
                        \Request::is('settings/request-type') ||
                        \Request::is('settings/region') ||
                        \Request::is('settings/petition-session') ||
                        \Request::is('settings/venue') ||
                        \Request::is('settings/stage') ||
                        \Request::is('settings/batch') ||
                        \Request::is('settings/district')) class="nav-item has-sub active open" @endif
                    class="nav-item has-sub">
                    <a class="dropdown" href="javascript:void(0)"><i class="ik ik-clipboard"></i><span>Master
                            Data</span></a>
                    <div class="submenu-content">
                        <a @if (\Request::is('settings/advocate-category')) class="menu-item active" @endif
                            href="{{ url('settings/advocate-category') }}" class="menu-item">Advocate Category </a>
                        <a @if (\Request::is('settings/request-types')) class="menu-item active" @endif
                            href="{{ url('settings/request-types') }}" class="menu-item">Request Types </a>
                        <a @if (\Request::is('settings/country')) class="menu-item active" @endif
                            href="{{ url('settings/country') }}" class="menu-item">Country </a>
                        <a @if (\Request::is('settings/attachment')) class="menu-item active" @endif
                            href="{{ url('settings/attachment') }}" class="menu-item">Attachment Type</a>
                        <a @if (\Request::is('settings/appearance')) class="menu-item active" @endif
                            href="{{ url('settings/appearance') }}" class="menu-item">Appearance Venue</a>
                        <a @if (\Request::is('settings/region')) class="menu-item active" @endif
                            href="{{ url('settings/region') }}" class="menu-item">Region </a>
                        <a @if (\Request::is('settings/district')) class="menu-item active" @endif
                            href="{{ url('settings/district') }}" class="menu-item">District </a>
                        <a @if (\Request::is('settings/petition-session')) class="menu-item active" @endif
                            href="{{ url('settings/petition-session') }}" class="menu-item">Petition Sessions </a>
                        <a @if (\Request::is('settings/batch')) class="menu-item active" @endif
                            href="{{ url('settings/batch') }}" class="menu-item">Renewal Batches </a>
                        <a @if (\Request::is('settings/fee-types')) class="menu-item active" @endif
                            href="{{ url('settings/fee-types') }}" class="menu-item">Fee Types </a>
                        <a @if (\Request::is('settings/qualifications')) class="menu-item active" @endif
                            href="{{ url('settings/qualifications') }}" class="menu-item">Qualifications </a>
                        <a @if (\Request::is('settings/fees')) class="menu-item active" @endif
                            href="{{ url('settings/fees') }}" class="menu-item">Fees</a>

                        <a @if (\Request::is('settings/stage')) class="menu-item active" @endif
                            href="{{ url('settings/stage') }}" class="menu-item">Action Stages </a>
                    </div>
                </div>

                <div class="nav-item">
                    <a href="{{ url('settings/system/logs') }}"><i class="ik ik-paperclip"></i><span>System Logs</span></a>
                </div>
            @endif
            </nav>
        </div>
    </div>
</div>
