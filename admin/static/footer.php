</div>
</div>
</div>
<div class="vertical-overlay"></div>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">


    <!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                    document.write(new Date().getFullYear())
                    </script> © Quantum IT Solution LLP.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by Quanta
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- end main content-->


<!-- END layout-wrapper -->



<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

<!--preloader-->


<div class="customizer-setting d-none d-md-block" data-bs-toggle="tooltip" title="Give suggestions">
    <div class="btn-info btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="modal"
        data-bs-target="#flipModal" >
        <i class='ri-question-answer-fill fs-22'></i>
    </div>
</div>
<!-- Modal flip -->
<div id="flipModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle" class="text-center">Suggestion Box
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <div class="mb-3 col">
                                <label class=" ">Enter title :</label><span class="text-danger" id="err_title"></span>
                                <input type="text" class="form-control" id="title" name="title">
                                <input type="text" class="form-control" id="id" name="id"
                                    value="<?php echo $_SESSION['emp_code']; ?>" hidden>
                            </div>
                            <textarea class="form-control" id="suggestion_body" name="suggestion_body"
                                rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-center mb-3">
                    <input type="submit" class="btn btn-primary" id="suggestion" value="MAKE A SUGGESSTION"
                        data-bs-dismiss="modal" aria-label="Close" >
                </div>
            </form>
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- JAVASCRIPT -->
<script src="../assets/javascript/jquery.js"></script>
<script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/libs/simplebar/simplebar.min.js"></script>
<script src="../assets/libs/node-waves/waves.min.js"></script>
<script src="../assets/libs/feather-icons/feather.min.js"></script>
<script src="../assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="../assets/js/plugins.js"></script>
<script src="../assets/javascript/main.js"></script>
<script src="../assets/javascript/Apps.js"></script>
<script src="../assets/javascript/chat.js"></script>
<script src="../assets/libs/sweetalert1/sweetalert2.all.js"></script>
<script src="../assets/libs/sweetalert1/sweet-alert.init.js"></script>
<!-- apexcharts -->
<script src="../assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="../assets/js/pages/project-list.init.js"></script>
<!-- projects js -->
<!-- <script src="../assets/js/pages/dashboard-projects.init.js"></script> -->

<script src="../assets/libs/prismjs/prism.js"></script>
<!-- App js -->
<script src="../assets/js/app.js"></script>
<script src="../assets/js/pages/notifications.init.js"></script>

<!-- calendar min js -->
<script src="../assets/libs/fullcalendar/main.min.js"></script>

<!-- Calendar init -->
<script src="../assets/js/pages/calendar.init.js"></script>


<!-- Calendar init -->
<!-- <script src="../assets/js/pages/calendar.init.js"></script> -->
<script src="../assets/libs/flatpickr/flatpickr.min.js"></script>
<script src="../assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="../assets/js/pages/select2.js"></script>
<script src="../assets/js/pages/bootstrap-select.js"></script>
<script src="../assets/js/pages/forms-selects.js"></script>
<script src="../assets/js/pages/form-validation.init.js"></script>
<script src="../assets/js/pages/jquery.timeago.js"></script>
<script src="../assets/javascript/validate.js"></script>
    <script src="../assets/libs/gridjs/gridjs.umd.js"></script>
    <!-- gridjs init -->
    <script src="../assets/js/pages/gridjs.init.js"></script>
    <script src="../assets/libs/fg-emoji-picker/fgEmojiPicker.js"></script>
    <script src="../assets/js/pages/chat.init.js"></script>
