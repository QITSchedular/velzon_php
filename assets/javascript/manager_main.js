$(document).ready(function () {
    //logout
    $('#logout').on('click', function () {
        $.ajax({
            url: "../assets/server/ajax.php",
            method: "POST",
            data: { "flag": "logout" },
            success: function (val) {
                if (val == 'logout') {
                    location.href = "../index";
                }
            }
        })
    })

    //load project of manager on dashboard
    function loadManager() {
        $.ajax({
            url: "../assets/server/manager_ajax.php",
            method: "POST",
            data: {
                row_no: 1,
                flag: "load_project_for_manager"
            },
            success: function(data) {
                // alert(data);
                $("#load_project_tb").html(data)
            },
        });
    }
    loadManager();
    $(document).on('click','#pTask',function(e){
        e.preventDefault();
        swal("info", "Project is diactive..!", "info");
    })

    $(document).on('click','#pTeam',function(e){
        e.preventDefault();
        swal("info", "Project is diactive..!", "info");
    })

        // add manager to employee team 
        $(document).on("click", ".empManChk", function () {
            let isChecked = $(this).prop('checked');
            var ptid = $(this).attr("id");
            if (isChecked) {
                swal({
                    title: "Are you sure?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes, I am sure!',
                    cancelButtonText: "No, cancel it!",
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "../assets/server/ajax.php",
                            method: "POST",
                            data: {
                                flag: "addProjManager",
                                ptid: ptid
                            },
                            success: function (data) {
                                alert(data);
                                if (data == 1) {
                                    swal("Success", "Successfully added..!", "success");
                                    loadEmployeeDataForProject();
                                    loadEmployeeData();
                                    loadManTeamLeader();
                                }
                            },
                        });
                    } else {
                        swal("Cancelled", "You cancelled :(", "error");
                        $(this).prop('checked', false);
                    }
                });
            }
            else {
                $.ajax({
                    url: "../assets/server/ajax.php",
                    method: "POST",
                    data: {
                        flag: "removeProjManager",
                        ptid: ptid
                    },
                    success: function (data) {
                        alert(data);
                        if (data == 1) {
                            swal("Success", "Successfully deleted..!", "success");
                            loadEmployeeDataForProject();
                            loadEmployeeData();
                            loadManTeamLeader();
                        }
                    },
                });
            }
        })

    // load data on profile page
    function load_profile(){
        $.ajax({
            url : "../assets/server/ajax.php",
            type : "POST",
            data : {"flag":"load_profile"},
            success : function(data){
                value = JSON.parse(data);
                $("#emp_name_pro").text(value.firstname + " " + value.middlename );
                $("#full_name").text(value.firstname + " " + value.middlename + " " + value.lastname);
                if(value.e_status == "active"){
                    $("#Status_emp").text("Active");
                }else{
                    $("#Status_emp").text("Deactive");
                }
                if(value.role=="admin"){
                    $("#role_emp").text("Administrator");
                    $("#emp_type_pro").text("Administrator");
                }else if(value.role=="manager"){
                    $("#role_emp").text("Manager");
                    $("#emp_type_pro").text("Manager");
                }else{
                    $("#role_emp").text("Employee");
                    $("#emp_type_pro").text("Employee");
                }
                $("#contact_emp").text(value.personal_phoneNO);
                $("#email_emp").text(value.email);
                if(value.profile_picture==''){
                    $("#proc_picture").attr('src','../assets/img/avatars/1234.png');
                }else{
                    $("#proc_picture").attr('src','../assets/img/profile/'+value.profile_picture);
                }
            }
        })
    }
    load_profile();

    // remove profile picture
    $("#remove_proc").on("click",function(){
            $.ajax({
                url: "../assets/server/ajax.php",
                method: "POST",
                data: {
                    "flag": "del_proc_picture"
                },
                success: function(data) {
                    
                }
        })
    })
        

     // suggestion insert
     $("#suggestion").on("click",function(e){
        e.preventDefault();
        var suggest_data = new FormData(this.form);
        suggest_data.append('flag','suggestion');
        $.ajax({
            url: "../assets/server/ajax.php",
            method: "POST",
            data: suggest_data,
            contentType: false,
            processData: false,
            success: function(data) {
                if(data==1){
                    swal("Success", "Suggestion submitted..!", "success");
                    $('#suggest_frm').trigger("reset");
                }else{
                    swal("Cancelled", "Something wrong :(", "error");
                }
            }
        })
    })
})