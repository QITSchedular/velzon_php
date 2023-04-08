<?php
$chk_var = "";
?>
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="../assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="../assets/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
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
                    <a class="nav-link menu-link" href="index" role="button"
                        aria-controls="sidebarDashboards">
                        <i class="ri-home-3-line fs-3"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li> 

                <li class="nav-item ">
                    <a class="nav-link menu-link" href="myTask" role="button"
                        aria-controls="sidebarDashboards">
                        <i class="ri-newspaper-fill fs-3"></i> <span data-key="t-dashboards">My Task</span>
                    </a>
                </li>
                
                <li class="nav-item ">
                    <a class="nav-link menu-link" href="myTimesheet" role="button"
                        aria-controls="sidebarDashboards">
                        <i class="ri-file-edit-fill fs-3"></i> <span data-key="t-dashboards">My Timesheet</span>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link menu-link" href="profile" role="button">
                        <i class="mdi mdi-account-circle fs-3"></i> <span>Profile</span>
                    </a>
                </li> 

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Components</span></li>

                <li class="nav-item ">
                    <a class="nav-link menu-link" href="chat_user" role="button">
                        <i class="ri-chat-3-line fs-3"></i> <span>Chat</span>
                    </a>
                </li> 
                <li class="nav-item ">
                    <a class="nav-link menu-link" href="edit-profile" role="button">
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

    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">