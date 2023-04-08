<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <title>Admin | calendar page</title>
    <?php require 'static/head.php'; ?>

</head>

<body>
    <?php require 'static/header.php'; ?>
    <?php require 'static/side-nav.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-xl-9">
                        <div class="card card-h-100">
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-xl-3">
                        <div class="card card-h-100">
                            <div class="card-body">
                                <button class="btn btn-primary w-100" id="btn-new-event"><i class="mdi mdi-plus"></i>
                                    Create New Event</button>

                                <div id="external-events">
                                    <br>
                                    <p class="text-muted">Drag and drop your event or click in the calendar
                                    </p>
                                    <div class="external-event fc-event bg-soft-success text-success"
                                        data-class="bg-soft-success">
                                        <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>New
                                        Event Planning
                                    </div>
                                    <div class="external-event fc-event bg-soft-info text-info"
                                        data-class="bg-soft-info">
                                        <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Meeting
                                    </div>
                                    <div class="external-event fc-event bg-soft-warning text-warning"
                                        data-class="bg-soft-warning">
                                        <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Generating
                                        Reports
                                    </div>
                                    <div class="external-event fc-event bg-soft-danger text-danger"
                                        data-class="bg-soft-danger">
                                        <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Create
                                        New theme
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div>
                            <h5 class="mb-1">Upcoming Events</h5>
                            <p class="text-muted">Don't miss scheduled events</p>
                            <div class="pe-2 me-n1 mb-3" data-simplebar style="height: 350px">
                                <div id="upcoming-event-list"></div>
                            </div>
                        </div>

                    </div>
                    <!-- end col-->


                </div>
                <!--end row-->

                <div style='clear:both'></div>

                <!-- Add New Event MODAL -->
                <div class="modal fade" id="event-modal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0">
                            <div class="modal-header p-3 bg-soft-info">
                                <h5 class="modal-title" id="modal-title">Event</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-hidden="true"></button>
                            </div>
                            <div class="modal-body p-4">
                                <form class="needs-validation" name="event-form" id="form-event" novalidate>
                                    <div class="text-end">
                                        <a href="#" class="btn btn-sm btn-soft-primary" id="edit-event-btn"
                                            data-id="edit-event" onclick="editEvent(this)" role="button">Edit</a>
                                    </div>
                                    <div class="event-details">
                                        <div class="d-flex mb-2">
                                            <div class="flex-grow-1 d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <i class="ri-calendar-event-line text-muted fs-16"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="d-block fw-semibold mb-0" id="event-start-date-tag"></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="ri-time-line text-muted fs-16"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="d-block fw-semibold mb-0"><span
                                                        id="event-timepicker1-tag"></span> - <span
                                                        id="event-timepicker2-tag"></span></h6>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="ri-map-pin-line text-muted fs-16"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="d-block fw-semibold mb-0"> <span
                                                        id="event-location-tag"></span></h6>
                                            </div>
                                        </div>
                                        <div class="d-flex mb-3">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="ri-discuss-line text-muted fs-16"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="d-block text-muted mb-0" id="event-description-tag"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row event-form">

                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Event Name</label>
                                                <input class="form-control d-none" placeholder="Enter event name"
                                                    type="text" name="title" id="event-title" required value="" />
                                                <div class="invalid-feedback">Please provide a valid event
                                                    name</div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label>Event Date</label>
                                                <div class="input-group d-none">
                                                    <input type="text" id="event-start-date"
                                                        class="form-control flatpickr flatpickr-input"
                                                        placeholder="Select date" readonly required>
                                                    <span class="input-group-text"><i
                                                            class="ri-calendar-event-line"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        
                                        <div class="col-12">
                                            <div class="row">
                                            <div class="col-6">
                                                    <!-- Custom Switches -->
                                                    <div class="form-check form-switch form-switch-lg mt-4" dir="ltr">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="allday" checked="">
                                                        <label class="form-check-label" for="customSwitchsizelg">All Day Event</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Type</label>
                                                        <select class="form-select d-none" name="category"
                                                            id="event-category" required>
                                                            <option value="bg-soft-danger">Personal</option>
                                                            <option value="bg-soft-success">Holiday</option>
                                                            <option value="bg-soft-primary">Business</option>
                                                            <!-- <option value="bg-soft-dark">Dark</option> -->
                                                            <option value="bg-soft-warning">Family</option>
                                                            <option value="bg-soft-info">Other</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid event
                                                            category</div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <!--end col-->


                                        <div class="col-12" id="event-time">
                                            <div class="row">
                                            <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Start Time</label>
                                                        <div class="input-group d-none">
                                                            <input id="timepicker1" type="text"
                                                                class="form-control flatpickr flatpickr-input"
                                                                placeholder="Select start time" readonly>
                                                            <span class="input-group-text"><i
                                                                    class="ri-time-line"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">End Time</label>
                                                        <div class="input-group d-none">
                                                            <input id="timepicker2" type="text"
                                                                class="form-control flatpickr flatpickr-input"
                                                                placeholder="Select end time" readonly>
                                                            <span class="input-group-text"><i
                                                                    class="ri-time-line"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="event-location">Location</label>
                                                <div>
                                                    <input type="text" class="form-control d-none" name="event-location"
                                                        id="event-location" placeholder="Event location">
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <input type="hidden" id="eventid" name="eventid" value="" />
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control d-none" id="event-description"
                                                    placeholder="Enter a description" rows="3" name="event-description"
                                                    spellcheck="false"></textarea>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-soft-danger" id="btn-delete-event"><i
                                                class="ri-close-line align-bottom"></i>
                                            Delete</button>
                                        <button type="button" class="btn btn-success" id="btn-save-event">Add
                                            Event</button>
                                         
                                    </div>
                                    <input type="text" name="eId" id="eId" hidden>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php require 'static/footer.php'; ?>
</body>

</html>