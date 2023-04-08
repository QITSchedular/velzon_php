<?php
$page = "ClientList";
?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <title>Admin | Client page</title>

    <?php require 'static/head.php'; ?>
</head>

<body>
    <?php require 'static/header.php'; ?>
    <?php require 'static/side-nav.php'; ?>


    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Client List</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">All List</a></li>
                        <li class="breadcrumb-item active">Client List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade zoomIn" id="AddClientModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header p-1 bg-soft-success d-flex justify-content-center">
                    <h3 class="modal-title" id="exampleModalLabel">Client Information</h3>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button> -->
                </div>
                <form id="add_client_frm" class="tablelist-form" autocomplete="off" method="post">
                    <div class="modal-body">

                        <!-- <input type="hidden" id="clientID" /> -->
                        <div class="row g-3">
                            <div class="col-lg-4">
                                <div>
                                    <label for="client_Id_field" class="form-label">Client ID</label>
                                    <input type="text" id="clientid" class="form-control" name="clientid" disabled />
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div>
                                    <label for="client_Name_field" class="form-label">Name</label>
                                    <span class="text-danger" id="err_client_name"> *</span>

                                    <input type="text" id="client_name" class="form-control" name="client_name" placeholder="Client Name" />
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div>
                                    <label for="client_Nick_Name_field" class="form-label">Nick Name</label>
                                    <span class="text-danger" id="err_nick_name"> *</span>

                                    <input type="text" id="nick_name" class="form-control" name="nick_name" placeholder="Nick Name" />
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div>
                                    <label for="client_address_field" class="form-label">Address</label>
                                    <span class="text-danger" id="err_address"> *</span>
                                    <textarea id="address" class="form-control" rows="1" name="address"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div>
                                    <label for="email-field" class="form-label">Email</label>
                                    <span class="text-danger" id="err_email"> *</span>

                                    <input type="text" id="email" class="form-control" name="email" placeholder="xyz@gmail.com" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label for="country-field" class="form-label">Country</label>
                                <select class="form-control" data-choices data-choices-search-false id="country" name="country">
                                    <option value="" selected>Select Country</option>
                                </select>
                            </div>

                            <div class="col-lg-4">
                                <label for="state-field" class="form-label">State</label>
                                <select class="form-control" data-choices data-choices-search-false id="state" name="state">
                                    <option value="" selected>Select State</option>
                                </select>
                            </div>

                            <div class="col-lg-4">
                                <label for="city-field" class="form-label">City</label>
                                <select class="form-control" data-choices data-choices-search-false id="city" name="city">
                                    <option value="" selected>Select City</option>
                                </select>
                            </div>

                            <div class="col-lg-4">
                                <label for="zipcode-field" class="form-label">Zip Code</label>
                                <span class="text-danger" id="err_zipcode"> *</span>

                                <input type="number" id="zipcode" name="zipcode" class="form-control" />
                            </div>

                            <div class="col-lg-4">
                                <label for="contact1-field" class="form-label">Contact Number 1</label>
                                <span class="text-danger" id="err_contact1"> *</span>

                                <input type="number" id="contact1" name="contact1" class="form-control" />
                            </div>

                            <div class="col-lg-4">
                                <label for="contact2-field" class="form-label">Contact Number 2</label>
                                <span class="text-danger" id="err_contact2"> *</span>

                                <input type="number" id="contact2" name="contact2" class="form-control" />
                            </div>

                            <div class="col-lg-4">
                                <label for="fax-field" class="form-label">Fax Code</label>
                                <span class="text-danger" id="err_fax"> *</span>

                                <input type="number" id="fax" name="fax" class="form-control" />
                            </div>

                            <div class="col-lg-4">
                                <label for="website-field" class="form-label">Website</label>
                                <span class="text-danger" id="err_website"> *</span>

                                <input type="text" id="website" name="website" class="form-control" />
                            </div>
                            <div class="col-lg-4">
                                <label for="billrate-field" class="form-label">Bill Rate</label>
                                <span class="text-danger" id="err_billrate"> *</span>
                                <input type="number" id="billrate" name="billrate" class="form-control" placeholder="0.0000" />
                            </div>


                            <div class="col-lg-8">

                                <label for="client_profile_field" class="form-label">Profile Picture</label>
                                <span class="text-danger" id="err_profileimg"> *</span>

                                <input type="file" id="profileimg" class="form-control" name="profileimg"></input>
                            </div>

                            <div class="col-lg-4 mt-5 ">
                                <input class="form-check-input" type="checkbox" id="disabled" name="disabled" value="">
                                <label for="Disabled-field" class="form-label"> Disabled</label>

                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="client_notes_field" class="form-label">Notes</label>
                                    <span class="text-danger" id="err_notes"> *</span>

                                    <textarea id="notes" class="form-control" rows="2" name="notes"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <input type="submit" class="btn btn-success" id="add_client_btn" value="Add Client">
                            <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end modal-->

    <div class="col-xl-12">
        <div class="card card-height-100">
            <div class="card-header d-flex align-items-center">
                <h4 class="card-title flex-grow-1 mb-0">Client Details</h4>
                <div class="flex-shrink-0">
                    <a href="javascript:void(0);" class="btn btn-soft-info btn-sm pt-2 pb-2 btn-client-export">Export Report</a>
                    <a href="#" class="btn btn-success" data-bs-toggle="modal" id="insert_client_btn" data-bs-target="#AddClientModal"><i class="ri-add-line align-bottom me-1"></i>Add New</a>
                </div>
            </div>
            <div class="card-body">
                <div id="table-gridjs3"></div>
            </div>
        </div>
    </div>
    <!-- </div> -->


    <!-- edit Modal -->
    <div class="modal fade zoomIn" id="EditClientModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header p-1 bg-soft-success d-flex justify-content-center">
                    <h3 class="modal-title" id="exampleModalLabel">Client Information</h3>
                </div>
                <form id="edit_client_frm" class="tablelist-form" autocomplete="off" method="post">
                    <div class="modal-body">
                        <!-- <input type="hidden" id="" /> -->
                        <div class="row g-3">
                            <div class="col-lg-4">
                                <div>
                                    <label for="client_Id_field" class="form-label">Client ID</label>
                                    <input type="text" id="editclientid" class="form-control" name="editclientid" disabled />
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div>
                                    <label for="client_Name_field" class="form-label">Name</label>
                                    <span class="text-danger" id="err_editclient_name"> *</span>

                                    <input type="text" id="editclient_name" class="form-control" name="editclient_name" placeholder="Client Name" />
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div>
                                    <label for="client_Nick_Name_field" class="form-label">Nick Name</label>
                                    <span class="text-danger" id="err_editnick_name"> *</span>

                                    <input type="text" id="editnick_name" class="form-control" name="editnick_name" placeholder="Nick Name" />
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div>
                                    <label for="client_address_field" class="form-label">Address</label>
                                    <span class="text-danger" id="err_editaddress"> *</span>
                                    <textarea id="editaddress" class="form-control" rows="1" name="editaddress"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div>
                                    <label for="email-field" class="form-label">Email</label>
                                    <span class="text-danger" id="err_editemail"> *</span>

                                    <input type="text" id="editemail" class="form-control" name="editemail" placeholder="xyz@gmail.com" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label for="country-field" class="form-label">Country</label>
                                <select class="form-control" data-choices data-choices-search-false id="country" name="country">
                                    <option value="" selected>Select Country</option>
                                </select>
                            </div>

                            <div class="col-lg-4">
                                <label for="state-field" class="form-label">State</label>
                                <select class="form-control" data-choices data-choices-search-false id="state" name="state">
                                    <option value="" selected>Select State</option>
                                </select>
                            </div>

                            <div class="col-lg-4">
                                <label for="city-field" class="form-label">City</label>
                                <select class="form-control" data-choices data-choices-search-false id="city" name="city">
                                    <option value="" selected>Select City</option>
                                </select>
                            </div>

                            <div class="col-lg-4">
                                <label for="zipcode-field" class="form-label">Zip Code</label>
                                <span class="text-danger" id="err_editzipcode"> *</span>

                                <input type="number" id="editzipcode" name="editzipcode" class="form-control" />
                            </div>

                            <div class="col-lg-4">
                                <label for="contact1-field" class="form-label">Contact Number 1</label>
                                <span class="text-danger" id="err_editcontact1"> *</span>

                                <input type="number" id="editcontact1" name="editcontact1" class="form-control" />
                            </div>

                            <div class="col-lg-4">
                                <label for="contact2-field" class="form-label">Contact Number 2</label>
                                <span class="text-danger" id="err_editcontact2"> *</span>

                                <input type="number" id="editcontact2" name="editcontact2" class="form-control" />
                            </div>

                            <div class="col-lg-4">
                                <label for="fax-field" class="form-label">Fax Code</label>
                                <span class="text-danger" id="err_editfax"> *</span>

                                <input type="number" id="editfax" name="editfax" class="form-control" />
                            </div>

                            <div class="col-lg-4">
                                <label for="website-field" class="form-label">Website</label>
                                <span class="text-danger" id="err_editwebsite"> *</span>

                                <input type="text" id="editwebsite" name="editwebsite" class="form-control" />
                            </div>
                            <div class="col-lg-4">
                                <label for="billrate-field" class="form-label">Bill Rate</label>
                                <span class="text-danger" id="err_editbillrate"> *</span>
                                <input type="number" id="editbillrate" name="editbillrate" class="form-control" placeholder="0.0000" />
                            </div>


                            <div class="col-lg-8">

                                <label for="client_profile_field" class="form-label">Profile Picture</label>
                                <span class="text-danger" id="err_editprofileimg"> *</span>

                                <input type="file" id="editprofileimg" class="form-control" name="editprofileimg"></input>
                            </div>

                            <div class="col-lg-4 mt-5 ">
                                <input class="form-check-input" type="checkbox" id="editdisabled" name="editdisabled" value="">
                                <label for="Disabled-field" class="form-label"> Disabled</label>

                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="client_notes_field" class="form-label">Notes</label>
                                    <span class="text-danger" id="err_editnotes"> *</span>

                                    <textarea id="editnotes" class="form-control" rows="2" name="editnotes"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <input type="submit" class="btn btn-success" id="update_client_btn" value="Update">
                            <button type="button" class="btn btn-light" id="close-modal-update" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><br>

    


    <!-- removeClientModal -->
    <div id="removeClientModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="text" id="removeEmp" hidden>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you Sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Client ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal" id="remove-client-close">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="remove-client">Yes, Delete It!</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <?php require 'static/footer.php'; ?>
    <script>
        $(document).ready(function() {
            $("input").on('focusout', function() {
                onfocusout_validation($(this).attr('id'));
            });

            $("input").on('input', function() {
                oninput_validation($(this).attr('id'));
            });
        })

    </script>


</body>

</html>