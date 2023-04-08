<?php
$chk_var = "";
?>
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.php" class="logo logo-dark">
            <span class="logo-sm">
                <img src="../assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="../assets/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.php" class="logo logo-light">
            <span class="logo-sm">
                <img src="../assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="../assets/images/logo-light.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>


                <li class="nav-item ">
                    <a class="nav-link menu-link" href="index.php" role="button"
                        aria-controls="sidebarDashboards">
                        <i class="ri-home-3-line fs-3"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li> 

                <li class="nav-item ">
                    <a class="nav-link menu-link" href="calendar.php" role="button">
                        <i class="bx bx-calendar fs-3"></i> <span data-key="t-calendar">Calendar</span>
                    </a>
                </li> 

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Pages</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line fs-3"></i> <span data-key="t-apps">All lists</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="flex-column">
                            <!-- <li class=""> -->
                            <a class="nav-link menu-link" href="employeeList.php" role="button">
                                <i class="bx bx-user fs-3"></i> <span> Employee List</span>
                            </a>
                            <a class="nav-link menu-link" href="projectList.php" role="button">
                                <i class="ri-file-edit-line fs-3"></i> <span> Project List</span>
                            </a>
                            <a class="nav-link menu-link" href="clientlist.php" role="button">
                                <i class="bx bx-group fs-3"></i> <span> Client List</span>
                            </a>    
                        </ul>
                    </div>
                </li>

                <li class="nav-item ">
                    <a class="nav-link menu-link" href="apps-tasks-kanban.php" role="button">
                        <i class=" ri-file-edit-fill fs-3"></i> <span>Task</span>
                    </a>
                </li> 

                <li class="nav-item ">
                    <a class="nav-link menu-link" href="suggestion.php" role="button">
                        <i class="bx bx-bulb fs-3"></i> <span>Suggestions</span>
                    </a>
                </li> 

                <li class="nav-item ">
                    <a class="nav-link menu-link" href="profile.php" role="button">
                        <i class="mdi mdi-account-circle fs-3"></i> <span>Profile</span>
                    </a>
                </li> 

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Components</span></li>


                <li class="nav-item ">
                    <a class="nav-link menu-link" href="chat_user.php" role="button">
                        <i class="ri-chat-3-line fs-3"></i> <span>Chat</span>
                    </a>
                </li> 
                <li class="nav-item ">
                    <a class="nav-link menu-link" href="edit-profile.php" role="button">
                        <i class="mdi mdi-cog-outline fs-3"></i> <span>Settings</span>
                    </a>
                </li> 

                <li class="nav-item ">
                    <a class="nav-link menu-link" href="#" role="button" id="lockscreen">
                        <i class="mdi mdi-lock text-muted fs-3"></i> <span>Lock screen</span>
                    </a>
                </li> 



            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <!-- <div class="sidebar-background"></div> -->
</div>
<div class="vertical-overlay"></div>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">