<?php
$page = "dashboard";
?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-preloader="disable">

<head>
    <title>Admin | index page</title>
    <?php require 'static/head.php'; ?>
    <style>
        /* .sent:hover + .delete {
  display: block;
  background: #f5f5f5;
} */
    </style>
</head>

<body>
    <?php require 'static/header.php'; ?>
    <?php require 'static/side-nav.php'; ?>
    <?php
    if (isset($_SESSION['emp_code']) && $_SESSION['emp_code']) {
        include('../assets/server/Chat.php');
        $chat = new Chat();
        $loggedUser = $chat->getUserDetails($_SESSION['emp_code']);
        $currentSession = '';
        foreach ($loggedUser as $user) {
            $currentSession = $user['current_session'];
        }
    ?>
        <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
            <div class="chat-leftsidebar">
                <div class="px-4 pt-2 mb-3">



                    <ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#chats" role="tab">
                                Chats
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#contacts" role="tab">
                                Contacts
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content text-muted px-4 ">
                    <div class="tab-pane active" id="chats" role="tabpanel">
                        <div class="chat-room-list" data-simplebar  id="show_unread_message">
                            <?php


                            // echo '<ul>';
                            // $count_unread_message = '';
                            $chatUsers = $chat->chatUsers($_SESSION['emp_code']);
                            foreach ($chatUsers as $user) {
                                $count_unread_message = "";
                                $status = 'offline';
                                if ($user['online']) {
                                    $status = 'online';
                                }
                                $activeUser = '';
                                if ($user['emp_code'] == $currentSession) {
                                    $activeUser = "active";
                                }

                                if ($user['profile_picture'] == "") {
                                    $img = "<img src='../assets/img/profile/proc.jpg' widht='30px' height='30px' class='rounded-circle '/>";
                                } else {
                                    $img = "<img src='../assets/img/profile/{$user['profile_picture']}' widht='25px' height='25px' class='rounded-circle '/>";
                                }

                                if ($chat->getUnreadMessageCount($user['emp_code'], $_SESSION['emp_code'])) {
                                    $count_unread_message = "
                                    <div class='bg-soft-success rounded-circle text-center' style='width:20px;height:20px;' data-bs-toggle='tooltip' data-bs-trigger='hover' data-bs-placement='bottom' title='New Message' id='divunread_{$user['emp_code']}'>
                                    <p class='text-dark'><span id='unread_{$user['emp_code']}' class='unread'>{$chat->getUnreadMessageCount($user['emp_code'],$_SESSION['emp_code'])}</span></p>
                                </div>
                                    ";
                                }

                                echo "<div class='d-flex align-items-center pb-2 px-0 pt-3 border-bottom contact {$activeUser}' id='{$user['emp_code']}' data-touserid={$user['emp_code']} data-tousername='{$user['firstname']}'>
                                <div class='flex-grow-0 px-2'>
                                {$img}
                                </div>
                                <div class='flex-grow-1'>
                                    <div class='flex-grow-0 pt-3'>
                                        <h4 class='mb-0 fs-6 text-dark text-uppercase'>{$user['firstname']}</h4>
                                    </div>
                                    <div class='flex-grow-1'>
                                        <p class='preview'><span id='isTyping_{$user['emp_code']}' class='isTyping'></span></p>
                                    </div>
                                </div>
                                <div class='flex-shrink-0'>
                                {$count_unread_message}
                                </div>
                                </div>";
                            }
                            ?>

                        </div>
                    </div>
                    <div class="tab-pane" id="contacts" role="tabpanel">
                        <div class="chat-room-list" data-simplebar>
                            <div class="search-box p-1">
                                <input type="text" class="form-control bg-light border-light" placeholder="Search here...">
                                <i class="ri-search-2-line search-icon"></i>
                            </div>
                            <div class="sort-contact">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end tab contact -->
            </div>
            <!-- end chat leftsidebar -->
            <!-- Start User chat -->
            <div class="user-chat w-100 overflow-hidden">
                <div class="chat-content d-lg-flex">
                    <div class="w-100 overflow-hidden position-relative" id="m_part">
                        <div class="position-relative">
                            <div class="position-relative" id="users-chat">
                                <div class="p-3 user-chat-topbar">
                                    <div class="row align-items-center">
                                        <div class="col-sm-4 col-8">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 d-block d-lg-none me-3">
                                                    <a href="javascript: void(0);" class="user-chat-remove fs-18 p-1"><i class="ri-arrow-left-s-line align-bottom"></i></a>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden" id="userSection">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 col-4">
                                            <ul class="list-inline user-chat-nav text-end mb-0">
                                                <li class="list-inline-item m-0">
                                                    <div class="dropdown">
                                                        <button class="btn btn-ghost-secondary btn-icon" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i data-feather="search" class="icon-sm"></i>
                                                        </button>
                                                        <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg">
                                                            <div class="p-2">
                                                                <div class="search-box">
                                                                    <input type="text" class="form-control bg-light border-light" placeholder="Search here..." onkeyup="searchMessages()" id="searchMessage">
                                                                    <i class="ri-search-2-line search-icon"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="list-inline-item d-none d-lg-inline-block m-0">
                                                    <button type="button" class="btn btn-ghost-secondary btn-icon" data-bs-toggle="offcanvas" data-bs-target="#userProfileCanvasExample" aria-controls="userProfileCanvasExample">
                                                        <i data-feather="info" class="icon-sm"></i>
                                                    </button>
                                                </li>

                                                <li class="list-inline-item m-0">
                                                    <div class="dropdown">
                                                        <button class="btn btn-ghost-secondary btn-icon" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i data-feather="more-vertical" class="icon-sm"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item d-block d-lg-none user-profile-show" href="#"><i class="ri-user-2-fill align-bottom text-muted me-2"></i>
                                                                View Profile</a>
                                                            <a class="dropdown-item" href="#"><i class="ri-inbox-archive-line align-bottom text-muted me-2"></i>
                                                                Archive</a>
                                                            <a class="dropdown-item" href="#"><i class="ri-mic-off-line align-bottom text-muted me-2"></i>
                                                                Muted</a>
                                                            <a class="dropdown-item" href="#"><i class="ri-delete-bin-5-line align-bottom text-muted me-2"></i>
                                                                Delete</a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- end chat user head -->
                                <div class="chat-conversation p-3 p-lg-4 content messages conversation" id="chat-conversation" data-simplebar data-simplebar-track="dark" style="height: 28.6rem;">

                                    <!-- <ul class="list-unstyled chat-conversation-list" id="users-conversation">
                                </ul> -->

                                    <?php
                                    echo $chat->getUserChat($_SESSION['emp_code'], $currentSession);
                                    ?>

                                </div>
                                <div class="alert alert-warning alert-dismissible copyclipboard-alert px-4 fade show " id="copyClipBoard" role="alert">
                                    Message copied
                                </div>
                            </div>
                            <div class="chat-input-section p-3 p-lg-4">
                                <form id="chatinput-form" enctype="multipart/form-data">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-auto">
                                            <div class="chat-input-links me-2">
                                                <div class="links-list-item">
                                                    <button type="button" class="btn btn-link text-decoration-none emoji-btn" id="emoji-btn">
                                                        <i class="bx bx-smile align-middle"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col  message-input">
                                            <div class="chat-input-feedback">
                                                Please Enter a Message
                                            </div>
                                            <input type="text" class="form-control chat-input bg-light border-light chatMessage message-input" id="chatMessage<?php echo $currentSession; ?>" placeholder="Type your message..." autocomplete="off">
                                        </div>
                                        <div class="col-auto">
                                            <div class="chat-input-links ms-2">
                                                <div class="links-list-item">
                                                    <button type="button" class="btn btn-success chat-send waves-effect waves-light submit chatButton" id="chatButton<?php echo $currentSession; ?>">
                                                        <i class="ri-send-plane-2-fill align-bottom"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="replyCard">
                                <div class="card mb-0">
                                    <div class="card-body py-3">
                                        <div class="replymessage-block mb-0 d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <h5 class="conversation-name"></h5>
                                                <p class="mb-0"></p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <button type="button" id="close_toggle" class="btn btn-sm btn-link mt-n2 me-n3 fs-18">
                                                    <i class="bx bx-x align-middle"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 overflow-hidden position-relative" id="m_part1">
                        <img src="../assets/img/backgrounds/chat_back.jpg" alt="" height="615vhm" width="100%">
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- end chat-wrapper -->


    <?php require 'static/footer.php'; ?>

</body>

</html>