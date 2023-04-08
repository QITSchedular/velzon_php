$(document).ready(function () {
  $("#insertProjTask").show();
  $("#updateProjTask").hide();
  $("#updateProj").hide();

  // country loading
  function load() {
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "load_country" },
      success: function (data) {
        $("#countryId").html(data);
        $("#countryId1").html(data);
      },
    });
  }
  load();

  $(document).on("change", "#countryId", function () {
    var id = $("#countryId").val();
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "load_state", id: id },
      success: function (data) {
        $("#stateId").html(data);
      },
    });
  });

  $(document).on("change", "#stateId", function () {
    var id = $("#stateId").val();
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "load_city", id: id },
      success: function (data) {
        $("#cityId").html(data);
      },
    });
  });

  function load_state(id) {
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "load_state", id: id },
      success: function (data) {
        $("#stateId1").html(data);
      },
    });
  }

  $(document).on("change", "#countryId1", function () {
    var id = $("#countryId1").val();
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "load_state", id: id },
      success: function (data) {
        $("#stateId1").html(data);
      },
    });
  });

  $(document).on("change", "#stateId1", function () {
    var id = $("#stateId1").val();
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "load_city", id: id },
      success: function (data) {
        $("#cityId1").html(data);
      },
    });
  });


  function loadDept() {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "loadDept" },
      success: function (data) {
        $("#dept").html(data);
        $("#depaertment").html(data);
        $("#load_depart").html(data);
        $("#load_depart1").html(data);
        $("#load_depart_proj").html(data);
        $("#load_depart_proj_overview").html(data);
        $("#load_depart12").html(data);
      },
    });
  }
  loadDept();

  // loading location
  $(document).on("change", "#dept", function () {
    var dept_id = $("#dept").val();
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "loadLocation", id: dept_id },
      success: function (data) {
        $("#location").html(data);
      },
    });
  });



  // live search using deparment of employee
  $(document).on("change", "#load_depart", function () {
    var val = $(this).val();
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "live_search_depart", id: val },
      success: function (data) {
        $("#empData").html(data);
      },
    });
  });

  // live search using country of client
  $(document).on("change", "#countryId1", function () {
    var val = $(this).val();
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "live_search_country", id: val },
      success: function (data) {
        $("#clientData").html(data);
      },
    });
  });


  // add manager to employee team
  $(document).on("click", ".empManChk", function () {
    let isChecked = $(this).prop("checked");
    var ptid = $(this).attr("id");
    if (isChecked) {
      swal({
        title: "Are you sure?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, I am sure!",
        cancelButtonText: "No, cancel it!",
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "../assets/server/ajax.php",
            method: "POST",
            data: {
              flag: "addProjManager",
              ptid: ptid,
            },
            success: function (data) {
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
          $(this).prop("checked", false);
        }
      });
    } else {
      $.ajax({
        url: "../assets/server/ajax.php",
        method: "POST",
        data: {
          flag: "removeProjManager",
          ptid: ptid,
        },
        success: function (data) {
          if (data == 1) {
            swal("Success", "Successfully deleted..!", "success");
            loadManTeamLeader();
            loadEmployeeDataForProject();
            loadEmployeeData();
          }
        },
      });
    }
  });

  //live search project data
  $("#live_search_project").on("input", function () {
    var data = $("#live_search_project").val();
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "live_search_project", data: data },
      success: function (data) {
        $("#projectData").html(data);
      },
    });
  });

  // live search using status of project
  $(document).on("change", "#project_data", function () {
    var val = $(this).val();
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "project_data", id: val },
      success: function (data) {
        $("#projectData").html(data);
      },
    });
  });

  // swal({
  //     title: "Are you sure?",
  //     text: "You will not be able to recover this data!",
  //     type: "warning",
  //     showCancelButton: true,
  //     confirmButtonColor: '#DD6B55',
  //     confirmButtonText: 'Yes, I am sure!',
  //     cancelButtonText: "No, cancel it!",
  //  }).then((result) => {
  //    if (result.value){
  //      swal("Success", "Successfully deleted..!", "success");
  //     } else {
  //       swal("Cancelled", "You cancelled :(", "error");
  //     }
  //  });

  // ================================================== suggestion


  // load suggestion
  function load_suggestion(dname, v) {
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "load_suggestion", v: v },
      success: function (data) {
        $("#" + dname).html(data);
      },
    });
  }
  load_suggestion("leadDiscovered1", 1);
  load_suggestion("leadDiscovered2", 2);
  load_suggestion("leadDiscovered3", 3);

  setInterval(function () {
    load_suggestion("leadDiscovered1", 1);
    load_suggestion("leadDiscovered2", 2);
    load_suggestion("leadDiscovered3", 3);
  }, 60000);

  // delete suggestion
  $(document).on("click", ".del_suggestion", function () {
    var id = $(this).attr("id");
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, I am sure!",
      cancelButtonText: "No, cancel it!",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "../assets/server/ajax.php",
          method: "POST",
          data: {
            flag: "del_suggestion",
            id: id,
          },
          success: function (data) {
            if (data == 1) {
              // swal("Success", "Successfully deleted..!", "success");
              load_suggestion("leadDiscovered1", 1);
              load_suggestion("leadDiscovered2", 2);
              load_suggestion("leadDiscovered3", 3);
            } else {
              swal("Error", "Something wrong :(", "error");
            }
          },
        });
      } else {
        swal("Cancelled", "You cancelled :(", "error");
      }
    });
  });

  // live search using deparment of suggestions
  $(document).on("change", "#load_depart12", function () {
    var val = $(this).val();
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "live_search_depart12", id: val },
      success: function (data) {
        $("#suggestion_card").html(data);
      },
    });
  });

  //live search suggestion data
  $("#live_search_suggestion").on("input", function () {
    var data = $("#live_search_suggestion").val();
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "live_search_suggestion", data: data },
      success: function (data) {
        $("#suggestion_card").html(data);
      },
    });
  });


  // ================================================= notifications

  // // notification_suggestion
  // function notification_suggestion() {
  //   $.ajax({
  //     url: "../assets/server/ajax.php",
  //     method: "POST",
  //     data: {
  //       flag: "notification_suggestion",
  //     },
  //     success: function (data) {
  //       $("#notification_suggestion").html(data);
  //     },
  //   });
  // }
  // notification_suggestion();

  // // reading notification
  // $(document).on("click", ".notification_card", function () {
  //   var id = $(this).attr("id");
  //   $.ajax({
  //     url: "../assets/server/ajax.php",
  //     method: "POST",
  //     data: {
  //       flag: "read_notification_suggestion",
  //       id: id,
  //     },
  //     success: function (data) {
  //       notification_suggestion();
  //       cnt_notification();
  //     },
  //   });
  // });

  // // count notification
  // function cnt_notification() {
  //   $.ajax({
  //     url: "../assets/server/ajax.php",
  //     method: "POST",
  //     data: {
  //       flag: "cnt_notification",
  //     },
  //     success: function (data) {
  //       $("#cnt_notification").html(data);
  //     },
  //   });
  // }
  // cnt_notification();

  //==================================Notifications======================================================

  // notification_suggestion
  function notification_suggestion() {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "notification_suggestion",
      },
      success: function (data) {
        $("#notification_suggestion").html(data);
      },
    });
  }
  notification_suggestion();

  // reading notification
  $(document).on("click", ".notification_card", function () {
    var id = $(this).attr("id");
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "read_notification_suggestion",
        id: id,
      },
      success: function (data) {
        notification_suggestion();
        cnt_notification();
      },
    });
  });

  //mark all as read  notification suggestions
  $(document).on("click", "#mark_all_read_suggestion", function () {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "mark_all_read_suggestion",
      },
      success: function (data) {
        notification_suggestion();
        cnt_notification();
      },
    });
  });

  // count notification
  function cnt_notification() {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "cnt_notification",
      },
      success: function (data) {
        $("#cnt_notification").html(data);
      },
    });
  }
  cnt_notification();

  //notification tasks
  function notification_tasks_employee() {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "notification_tasks_employee",
      },
      success: function (data) {
        $("#notification_suggestion_employee").html(data);
      },
    });
  }
  notification_tasks_employee();

  // count task notification
  function cnt_notification_employee() {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "cnt_notification_employee",
      },
      success: function (data) {
        $("#cnt_notification_employee").html(data);
      },
    });
  }
  cnt_notification_employee();

  // reading notification tasks
  $(document).on("click", ".notification_card_employee", function () {
    var id = $(this).attr("id");
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "read_notification_tasks",
        id: id,
      },
      success: function (data) {
        notification_tasks_employee();
        cnt_notification_employee();
      },
    });
  });

  //mark all as read tasks notification
  $(document).on("click", "#mark_all_read_emp", function () {
    var id = $(this).attr("id");
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "mark_all_read_emp_tasks",
      },
      success: function (data) {
        notification_tasks_employee();
        cnt_notification_employee();
      },
    });
  });

  // ====================================================================================
  // tasks and projects

  // setting display type
  function chk_type_list(f1) {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: f1 },
      success: function (data) {
        loadProjectData("loadProjectData");
      },
    });
  }
  $(".listview").on("click", function () {
    chk_type_list("listview");
  });
  $(".gridview").on("click", function () {
    chk_type_list("gridview");
  });

  //load Project data
  function loadProjectData(flag1) {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: flag1 },
      success: function (data) {
        $("#projectData").html(data);
      },
    });
  }
  loadProjectData("loadProjectData");
  // loadProjectData("loadProjectData_listview");

  $(document).on("click", "#pTask", function (e) {
    e.preventDefault();
    swal("info", "Project is diactive..!", "info");
  });

  $(document).on("click", "#pTeam", function (e) {
    e.preventDefault();
    swal("info", "Project is diactive..!", "info");
  });

  //load client in project
  function loadClientDataInpro() {
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "loadClientDataInpro" },
      success: function (data) {
        $("#clientLoad").html(data);
      },
    });
  }
  loadClientDataInpro();

  //projectlist validation
  function chkClient() {
    var client = $("#clientLoad").val();
    if (client == "") {
      $("#err_clientLoad").text("* Please select client");
      return false;
    } else {
      $("#err_clientLoad").text("*");
      return true;
    }
  }

  function chkStatus() {
    var status = $("#pstatus").val();
    if (status == "") {
      $("#err_pstatus").text("* Please select status");
      return false;
    } else {
      $("#err_pstatus").text("*");
      return true;
    }
  }

  //project insert
  $("#insertProj").on("click", function () {
    // var file = $("#project_files").val().split("\\").pop();
    // alert(file);
    var fd = new FormData(this.form);
    fd.append("flag", "insertProj");
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      contentType: false,
      processData: false,
      data: fd,
      success: function (data) {
        // loadProjectData();
        swal("Success", "Successfully added..!", "success");
        location.href = "projectList";
      },
    });
  });

  // kanban cards
  function dynamic_load_kanban_cards(status1, id_url) {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "dynamic_load_kanban_cards",
        status: status1,
      },
      success: function (data) {
        $("." + id_url).html(data);
      },
    });
  }
  function dynamic_load_kanban_cards_by_project(status1, id_url) {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "dynamic_load_kanban_cards_by_project",
        status: status1,
      },
      success: function (data) {
        $("." + id_url).html(data);
      },
    });
  }
  dynamic_load_kanban_cards("unassigned", "unassigned-task");
  dynamic_load_kanban_cards("todo", "todo-task");
  dynamic_load_kanban_cards("inprogress", "inprogress-task");
  dynamic_load_kanban_cards("reviews", "reviews-task");
  dynamic_load_kanban_cards("completed", "completed-task");
  dynamic_load_kanban_cards_by_project("unassigned", "unassigned-task_project");
  dynamic_load_kanban_cards_by_project("todo", "todo-task_project");
  dynamic_load_kanban_cards_by_project("inprogress", "inprogress-task_project");
  dynamic_load_kanban_cards_by_project("reviews", "reviews-task_project");
  dynamic_load_kanban_cards_by_project("completed", "completed-task_project");

  // kanban cards count load
  function dynamic_load_kanban_cards_count(status1) {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "dynamic_load_kanban_cards_count",
        status: status1,
      },
      success: function (data) {
        $("." + status1).html(data);
      },
    });
  }

  dynamic_load_kanban_cards_count("unassigned");
  dynamic_load_kanban_cards_count("todo");
  dynamic_load_kanban_cards_count("inprogress");
  dynamic_load_kanban_cards_count("reviews");
  dynamic_load_kanban_cards_count("completed");

  // loading project
  function load_project() {
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "load_project" },
      success: function (val) {
        $("#pname").html(val);
      },
    });
  }
  load_project();

  function IDGenerator(pass_type) {
    this.length = 8;
    this.timestamp = +new Date();
    var _getRandomInt = function (min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    };
    this.generate = function () {
      var ts = this.timestamp.toString();
      var parts = ts.split("").reverse();
      var id = "";

      for (var i = 0; i < this.length; ++i) {
        var index = _getRandomInt(0, parts.length - 1);
        id += parts[index];
      }

      return pass_type + id;
    };
  }

  // add task
  //project Task insert
  $("#insertProjTask").on("click", function (e) {
    e.preventDefault();
    var id = $(".empLoad").val();
    var generator = new IDGenerator("Task");
    var tid = generator.generate();

    var fd = new FormData(this.form);
    fd.append("tid", tid);
    fd.append("ids", id);
    fd.append("flag", "insertProjTask");
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      contentType: false,
      processData: false,
      data: fd,
      success: function (data) {
        $("#closeProjTask").click();
        dynamic_load_kanban_cards("unassigned", "unassigned-task");
        dynamic_load_kanban_cards("todo", "todo-task");
        dynamic_load_kanban_cards("inprogress", "inprogress-task");
        dynamic_load_kanban_cards("reviews", "reviews-task");
        dynamic_load_kanban_cards("completed", "completed-task");
        dynamic_load_kanban_cards_by_project(
          "unassigned",
          "unassigned-task_project"
        );
        dynamic_load_kanban_cards_by_project("todo", "todo-task_project");
        dynamic_load_kanban_cards_by_project(
          "inprogress",
          "inprogress-task_project"
        );
        dynamic_load_kanban_cards_by_project("reviews", "reviews-task_project");
        dynamic_load_kanban_cards_by_project(
          "completed",
          "completed-task_project"
        );
        dynamic_load_kanban_cards_count("unassigned");
        dynamic_load_kanban_cards_count("todo");
        dynamic_load_kanban_cards_count("inprogress");
        dynamic_load_kanban_cards_count("reviews");
        dynamic_load_kanban_cards_count("completed");
        load_toast("Task Added Successfully..!!", "warning");
      },
    });
  });

  // delete task
  $(document).on("click", ".delete-task", function () {
    var id = $(this).attr("id");
    $(".btn_delete").val(id);
  });

  $("#delete-record").on("click", function () {
    var id = $(".btn_delete").val();
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "delete_task", id: id },
      success: function (data) {
        if (data == 0) {
          alert("somwthing wrong");
        } else {
          $("#delete-btn-close").click();
          dynamic_load_kanban_cards("unassigned", "unassigned-task");
          dynamic_load_kanban_cards("todo", "todo-task");
          dynamic_load_kanban_cards("inprogress", "inprogress-task");
          dynamic_load_kanban_cards("reviews", "reviews-task");
          dynamic_load_kanban_cards("completed", "completed-task");
          dynamic_load_kanban_cards_count("unassigned");
          dynamic_load_kanban_cards_count("todo");
          dynamic_load_kanban_cards_count("inprogress");
          dynamic_load_kanban_cards_count("reviews");
          dynamic_load_kanban_cards_count("completed");
          load_toast("Task deleted Successfully..!!", "success");
        }
      },
    });
  });

  $("#closeProjTask").on("click", function () {
    $("#frmtask").trigger("reset");
  });

  // edit task
  $(document).on("click", ".edit_task_btn", function () {
    $("#insertProjTask").hide();
    $("#updateProjTask").show();
    var id = $(this).attr("id");
    $("#tid").val(id);
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "edit_task", id: id },
      success: function (data) {
        var value = JSON.parse(data);
        $("#pname").val(value.p_id);
        // alert(value.emp_code);
        // loadEmployee(value.p_id,value.emp_code);
        loadEmployee_task(value.p_id, value.emp_code);
        $("#sub-tasks").val(value.title);
        $("#task-description").val(value.description);
        $("#start-date").val(value.sdate);
        $("#Priority").val(value.priority);

        $("#due-date").attr("readonly", false);
        var disableFuturedate1 = $("#start-date").val();
        var todaysDate = new Date(disableFuturedate1);
        var year = todaysDate.getFullYear();
        var month = ("0" + (todaysDate.getMonth() + 1)).slice(-2);
        var day = ("0" + todaysDate.getDate()).slice(-2);
        var dtToday = year + "-" + month + "-" + day;
        $("#due-date").attr("type", "date");
        $("#due-date").attr("min", dtToday);
      },
    });
  });

  // edit task
  $(document).on("click", "#updateProjTask", function (e) {
    e.preventDefault();
    var empLoad = $(".empLoad").val();
    var fd = new FormData(this.form);
    fd.append("flag", "editProjTask");
    fd.append("empLoad", empLoad);
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      contentType: false,
      processData: false,
      data: fd,
      success: function (data) {
        $("#closeProjTask").click();
        dynamic_load_kanban_cards("unassigned", "unassigned-task");
        dynamic_load_kanban_cards("todo", "todo-task");
        dynamic_load_kanban_cards("inprogress", "inprogress-task");
        dynamic_load_kanban_cards("reviews", "reviews-task");
        dynamic_load_kanban_cards("completed", "completed-task");
        load_toast("Task edited Successfully..!!", "info");
      },
    });
  });

  //load Employee in projectTask
  function loadEmployee(id) {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "loadEmployee",
        id: id,
      },
      success: function (data) {
        $(".empLoad").html(data);
      },
    });
  }

  //load Employee in projectTask
  function loadEmployee_task(id, empid) {
    // alert(empid);
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "loadEmployee_task",
        id: id,
        empid: empid,
      },
      success: function (data) {
        $(".empLoad").html(data);
      },
    });
  }

  //  dynamic select emplyee for project
  $(document).on("change", "#pname", function () {
    var id = $("#pname").val();
    loadEmployee(id);
  });


  // redirect_overview_page
  $(document).on("click", ".redirect_overview_page", function () {
    var id = $(this).attr("id");
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "redirect_overview_page",
        id: id,
      },
      success: function (data) {
        location.href = "project_overview";
      },
    });
  });

  // open file exploere
  $(".upload_btn").on("click", function () {
    $(".upload_file").click();
  });

  function load_project_overview_data(id) {
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "load_project_overview_data",
        id: id,
      },
      success: function (data) {
        value = JSON.parse(data);
        $("#project_title").html(value.project_name);
        $("#project_start_date").html(value.start_date);
        $("#project_end_date").html(value.end_date);
        $("#summary").html(value.project_desc);
        $("#summary").html(value.project_desc);
        $("#cliname").html(value.client_name);
        if (value.status == "started") {
          $("#pstatus").attr("class", "badge bg-info fs-12");
          $("#pstatus").html(value.status);
        } else if (value.status == "inprogress") {
          $("#pstatus").attr("class", "badge bg-primary fs-12");
          $("#pstatus").html(value.status);
        } else if (value.status == "onhold") {
          $("#pstatus").attr("class", "badge bg-warning fs-12");
          $("#pstatus").html(value.status);
        } else if (value.status == "cancelled") {
          $("#pstatus").attr("class", "badge bg-danger fs-12");
          $("#pstatus").html(value.status);
        } else if (value.status == "completed") {
          $("#pstatus").attr("class", "badge bg-success fs-12");
          $("#pstatus").html(value.status);
        } else if (value.status == "deffered") {
          $("#pstatus").attr("class", "badge bg-light fs-12");
          $("#pstatus").html(value.status);
        }
      },
    });
  }

  // calling project overview data
  function load_project_overview() {
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "get_project_id",
      },
      success: function (data) {
        load_project_overview_data(data);
      },
    });
  }

  load_project_overview();

  $("#project_multiple_files").on("change", function () {
    var form_data = new FormData(this.form);

    form_data.append("flag", "multiplefile");
    // AJAX request
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "post",
      data: form_data,
      contentType: false,
      processData: false,
      success: function (response) {
        file_show();
      },
    });
  });

  // file show on page
  function file_show(id, flag1) {
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: flag1,
      },
      success: function (data) {
        $("#" + id).html(data);
      },
    });
  }
  file_show("file_load", "file_show");
  file_show("file_load_edit", "file_show_edit");

  // delete file
  $(document).on("click", ".del_file", function () {
    var id = $(this).attr("id");
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, I am sure!",
      cancelButtonText: "No, cancel it!",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "../assets/server/ajax.php",
          method: "POST",
          data: { flag: "del_file", id: id },
          success: function (data) {
            swal("Success", "Successfully deleted..!", "success");
            file_show();
          },
        });
      } else {
        swal("Cancelled", "You cancelled :(", "error");
      }
    });
  });

  // clear_session_id of project
  $(".clear_session_id").on("click", function () {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "clear_session_id" },
      success: function (data) {
        if (data == 1) {
          location.href = "app-create-project";
        }
      },
    });
  });

  // edit project
  $(document).on("click", ".edit_project_btn", function () {
    var id = $(this).attr("id");
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "load_project_edit_data", id: id },
      success: function (data) {
        if (data == 1) {
          location.href = "app-create-project";
        }
      },
    });
  });

  // update project
  $(document).on("click", "#updateProj", function () {
    var fd = new FormData(this.form);
    fd.append("flag", "Update_project_data");
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      contentType: false,
      processData: false,
      data: fd,
      success: function (data) {
        swal("Success", "Project Updated..!", "success");
        location.href = "projectList";
      },
    });
  });

  // edit page load data of project
  function load_dynamic_edit_project_data() {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "load_dynamic_edit_project_data" },
      success: function (data) {
        if (data != "") {
          $(".changeable_text").text("Edit Project");
          $("#insertProj").hide();
          $("#updateProj").show();
          value = JSON.parse(data);
          $("#clientLoad").val(value.client_id);
          $("#project_title").val(value.project_name);
          $("#project_desc").val(value.project_desc);
          $("#project_status").val(value.status);
          $("#project_sdate").val(value.start_date);
          $("#project_deadline").val(value.end_date);
        } else {
          $(".changeable_text").text("Create Project");
          $("#updateProj").hide();
          $("#insertProj").show();
        }
      },
    });
  }
  load_dynamic_edit_project_data();

  // delete project
  $(document).on("click", ".delete-project", function () {
    var id = $(this).attr("id");
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, I am sure!",
      cancelButtonText: "No, cancel it!",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "../assets/server/ajax.php",
          method: "POST",
          data: { flag: "delProjectData", id: id },
          success: function (data) {
            // load_toast("Project deleted Successfully..!!","success");
            load_my_toast("success", "Project deleted Successfully..!!");
            loadProjectData("loadProjectData");
            file_show();
          },
        });
      } else {
        swal("Cancelled", "You cancelled :(", "error");
      }
    });
  });


  //=========================Operation in Client=========================================
  //load Client Data
  // function loadClientData() {
  //   $.ajax({
  //     url: "../assets/server/ajax.php",
  //     method: "POST",
  //     data: {flag: "loadClientData" },
  //     success: function (data) {
  //       $("#clientload").html(data);
  //     },
  //   });
  // }
  // loadClientData();

  //delete client data
  $(document).on("click", ".delClient", function (e) {
    e.preventDefault();

    var id = $(this).attr("id");
    $("#removeEmp").val(id);
  });

  $("#remove-client").on("click", function () {
    var id = $("#removeEmp").val();
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "delClientData", id: id },
      success: function (data) {
        $("#clientPagi").load(location.href + " #clientPagi");
        loadClientData();
        $("#remove-client-close").click();
      },
    });
  });

  //load ClientID in add form
  $("#insert_client_btn").on("click", function (e) {
    e.preventDefault();

    var generator = new IDGenerator("Client");
    var uid = generator.generate();

    $("#clientid").val(uid);
  });

  //Insert A New Client
  $("#add_client_btn").on("click", function (e) {
    e.preventDefault();
    alert();
    nullfield_validation("client_name");
    nullfield_validation("nick_name");
    nullfield_validation("address");
    nullfield_validation("email");
    nullfield_validation("zipcode");
    nullfield_validation("contact1");
    nullfield_validation("contact2");
    nullfield_validation("fax");
    nullfield_validation("website");
    nullfield_validation("billrate");
    nullfield_validation("profileimg");
    nullfield_validation("notes");

    if (
      flag_client_name == 0 &&
      flag_nick_name == 0 &&
      flag_address == 0 &&
      flag_email == 0 &&
      flag_zipcode == 0 &&
      flag_contact1 == 0 &&
      flag_contact2 == 0 &&
      flag_fax == 0 &&
      flag_website == 0 &&
      flag_billrate == 0 &&
      flag_profileimg == 0 &&
      flag_notes == 0
    ) {
      oninput_validation("client_name");
      oninput_validation("nick_name");
      oninput_validation("email");
      oninput_validation("fax");
      oninput_validation("zipcode");
      oninput_validation("contact1");
      oninput_validation("contact2");
      if (
        flag_client_name == 0 &&
        flag_nick_name == 0 &&
        flag_address == 0 &&
        flag_email == 0 &&
        flag_zipcode == 0 &&
        flag_contact1 == 0 &&
        flag_contact2 == 0 &&
        flag_fax == 0 &&
        flag_website == 0 &&
        flag_billrate == 0 &&
        flag_profileimg == 0 &&
        flag_notes == 0
      ) {
        var img = $("#profileimg").val().split("\\").pop();
        var id = $("#clientid").val();
        var client_data = new FormData(this.form);
        client_data.append("flag", "addclient");
        client_data.append("id", id);
        client_data.append("img", img);
        $.ajax({
          url: "../assets/server/ajax.php",
          method: "POST",
          data: client_data,
          contentType: false,
          processData: false,
          success: function (data) {
            if (data == 1) {
              // alert(data);
              swal("Success", "Client Data submitted..!", "success");
              $("#add_client_frm").trigger("reset");
              $("#close-modal").click();
              loadClientData();
            } else {
              swal("Cancelled", "Something wrong :(", "error");
            }
          },
        });
      }
    }
  });

  //load edit_client_data
  $(document).on("click", ".edit_client", function () {
    var id = $(this).attr("id");
    $("#editclientid").val(id);
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "load_edit_client", cid: id },
      success: function (data) {
        value = JSON.parse(data);
        $("#editclient_name").val(value.client_name);
        $("#editnick_name").val(value.client_nick_name);
        $("#editaddress").val(value.address);
        $("#editemail").val(value.email);
        $("#editzipcode").val(value.zipcode);
        $("#editcontact1").val(value.phone_number1);
        $("#editcontact2").val(value.phone_number2);
        $("#editfax").val(value.fax);
        $("#editwebsite").val(value.website);
        $("#editbillrate").val(value.billing_rate);
        $("#editnotes").val(value.notes);
        $("#editprofileimg").val(value.img);
      },
    });
  });

  //update client data
  $("#update_client_btn").on("click", function (e) {
    e.preventDefault();
    nullfield_validation("editclient_name");
    nullfield_validation("editnick_name");
    nullfield_validation("editaddress");
    nullfield_validation("editemail");
    nullfield_validation("editzipcode");
    nullfield_validation("editcontact1");
    nullfield_validation("editcontact2");
    nullfield_validation("editfax");
    nullfield_validation("editwebsite");
    nullfield_validation("editbillrate");
    nullfield_validation("editprofileimg");
    nullfield_validation("editnotes");
    if (
      flag_editclient_name == 0 &&
      flag_editnick_name == 0 &&
      flag_editaddress == 0 &&
      flag_editemail == 0 &&
      flag_editzipcode == 0 &&
      flag_editcontact1 == 0 &&
      flag_editcontact2 == 0 &&
      flag_editfax == 0 &&
      flag_editwebsite == 0 &&
      flag_editbillrate == 0 &&
      flag_editprofileimg == 0 &&
      flag_editnotes == 0
    ) {
      oninput_validation("editclient_name");
      oninput_validation("editnick_name");
      oninput_validation("editemail");
      oninput_validation("editfax");
      oninput_validation("editzipcode");
      oninput_validation("editcontact1");
      oninput_validation("editcontact2");
      if (
        flag_editclient_name == 0 &&
        flag_editnick_name == 0 &&
        flag_editaddress == 0 &&
        flag_editemail == 0 &&
        flag_editzipcode == 0 &&
        flag_editcontact1 == 0 &&
        flag_editcontact2 == 0 &&
        flag_editfax == 0 &&
        flag_editwebsite == 0 &&
        flag_editbillrate == 0 &&
        flag_editprofileimg == 0 &&
        flag_editnotes == 0
      ) {
        var img = $("#editprofileimg").val().split("\\").pop();

        var id = $("#editclientid").val();
        var fd = new FormData(this.form);
        fd.append("flag", "clientDataUpdate");
        fd.append("id", id);
        fd.append("img", img);
        $.ajax({
          url: "../assets/server/ajax.php",
          method: "POST",
          contentType: false,
          processData: false,
          data: fd,
          success: function (data) {
            // alert(data);
            if (data == 1) {
              swal({
                type: "success",
                title: "success",
                text: "Client data updated..!!",
              });
              $("#close-modal-update").click();
              loadClientData();
            } else {
              swal({
                type: "error",
                title: "error",
                text: "Something wrong..!!",
              });
            }
          },
        });
      }
    }
  });

  // ====================================== employee details

  //loading child table
  function loadChildTB(id) {
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: {
        flag: "load_personal_child_details",
        id: id,
      },
      success: function (data) {
        if (data == "") {
        } else {
          $("#childInfo").html(data);
        }
      },
    });
  }

  //reflect employee extra personal info
  $(document).on("click", ".ePersonalInfo", function () {
    $("#cid").val("");
    $("#name").val("");
    $("#cbd").val("");
    var id = $(this).attr("id");
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: {
        flag: "load_personal_details",
        id: id,
      },
      success: function (data) {
        if (data == "") {
        } else {
          var value = JSON.parse(data);
          if (value.emp_gender == "female") {
            $("#female").prop("checked", true);
          } else {
            $("#male").prop("checked", true);
          }
          $("#empIdEP").val(value.emp_code);
          $("#spouse_name").val(value.spouse_name);
          $("#spouse_bd").val(value.spouse_birthdate);
          $("#emp_bd").val(value.emp_birthdate);
          $("#anni_date").val(value.anniversary_date);
          loadChildTB(id);
        }
      },
    });
  });

  //add children
  $("#cInsert").on("click", function () {
    var id = $("#empIdEP").val();
    var name = $("#name").val();
    var cbd = $("#cbd").val();
    var today = new Date();
    var birthDate = new Date(cbd);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }
    var gender = $(".cgender:checked").val();
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        name: name,
        cbd: cbd,
        cage: age,
        cgender: gender,
        flag: "insertChild",
        id: id,
      },
      success: function (data) {
        $("#cid").val("");
        $("#name").val("");
        $("#cbd").val("");
        loadChildTB(id);
      },
    });
  });

  //edit child
  $(document).on("click", ".cEdit", function (e) {
    e.preventDefault();
    var id = $(this).attr("id");
    $("#cInsert").hide();
    $("#cUpdate").show();
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "reflectChild",
        id: id,
      },
      success: function (data) {
        var value = JSON.parse(data);
        $("#cid").val(value.child_id);
        $("#name").val(value.name);
        $("#cbd").val(value.birthdate);
        if (value.gender == "girl") {
          $("#girl").prop("checked", true);
        } else {
          $("#boy").prop("checked", true);
        }
      },
    });
  });

  //delete child
  $(document).on("click", ".cDelete", function (e) {
    e.preventDefault();
    var eid = $("#empIdEP").val();
    var id = $(this).attr("id");

    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, I am sure!",
      cancelButtonText: "No, cancel it!",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "../assets/server/ajax.php",
          method: "POST",
          data: {
            flag: "deleteChild",
            id: id,
          },
          success: function (data) {
            swal("Success", "Successfully deleted..!", "success");
            loadChildTB(eid);
          },
        });
      } else {
        swal("Cancelled", "You cancelled :(", "error");
      }
    });
  });

  //update child
  $("#cUpdate").on("click", function () {
    var id = $("#empIdEP").val();
    var cid = $("#cid").val();
    var name = $("#name").val();
    var cbd = $("#cbd").val();
    var today = new Date();
    var birthDate = new Date(cbd);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }
    var gender = $(".gender:checked").val();

    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        name: name,
        cbd: cbd,
        cage: age,
        gender: gender,
        flag: "updateChild",
        cid: cid,
      },
      success: function (data) {
        $("#cid").val("");
        $("#name").val("");
        $("#cbd").val("");
        loadChildTB(id);
      },
    });
  });

  //update employee extra info
  $("#updateEmp").on("click", function (e) {
    // e.preventDefault();
    var gender = $(".gender:checked").val();
    var id = $("#empIdEP").val();
    alert(id);
    var fd = new FormData(this.form);
    fd.append("flag", "updateEPEmp");
    fd.append("gender", gender);
    fd.append("empId", id);
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      contentType: false,
      processData: false,
      data: fd,
      success: function (data) {
        if (data == 1) {
          swal({
            type: "success",
            title: "success",
            text: "Employee data updated..!!",
          });
        } else {
          swal({
            type: "error",
            title: "error",
            text: "Something wrong..!!",
          });
        }
      },
    });
  });

  function loadEmpData(page, query1 = "", query2 = "") {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { page: page, query1: query1, query2: query2, flag: "loadEmpData" },
      success: function (data) {
        $("#empData").html(data);
      },
    });
  }
  loadEmpData(1);

  $(document).on("click", ".page-link", function () {
    var page = $(this).data("page_number");
    var query1 = $("#live_search").val();
    var query2 = $("#load_depart").val();
    loadEmpData(page, query1, query2);
  });

  $("#live_search").keyup(function () {
    var query1 = $("#live_search").val();
    var query2 = $("#load_depart").val();
    loadEmpData(1, query1, query2);
  });

  // live search using deparment of employee
  $(document).on("change", "#load_depart", function () {
    var val = $(this).val();
    var query1 = $("#live_search").val();
    loadEmpData(1, query1, val);
  });

  // delete employee
  $(document).on("click", ".delete", function (e) {
    e.preventDefault();
    var id = $(this).attr("id");
    // alert(id);
    $("#removeEmp").val(id);
  });
  $("#remove-Employee").on("click", function () {
    var id = $("#removeEmp").val();
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "deleteEmpData", id: id },
      success: function (data) {
        $("#remove-Employee-close").click();
        $("#empPagi").load(location.href + " #empPagi");
        loadEmpData(1);
      },
    });
  });

  function send_email_new_emp(name,email,password){
    var formData = {
      name: name,
      email: email,
      password: password,
    };
    $.ajax({
      url: "https://send-email-n74i.onrender.com/sendmail/",
      method: "POST",
      data: formData,
      dataType: "JSON",
      success: function (data) {
          if(data)
          {
            location.reload();
          }
      }
    });
  }

  

  //insert employee
  $("#add-emp").on("click", function (e) {
    e.preventDefault();
    var pass = $("#pass").val();
    var pass1 = $("#pass1").val();
    var email = $("#email").val();
    var name = $("#fname").val();
    if (pass == pass1) {
      var fd = new FormData(this.form);
      fd.append("flag", "addEmp");
      $.ajax({
        url: "../assets/server/ajax.php",
        method: "POST",
        contentType: false,
        processData: false,
        data: fd,
        success: function (data) {
          loadEmpData(1);
          $("#cancle").click();
          $("#empPagi").load(location.href + " #empPagi");
          $("#addEmpForm").trigger("reset");
          send_email_new_emp(name,email,pass);
        },
      });
    }
  });

  // add member
  function addMemberInTask(tid, query1 = "", query2 = "") {
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "loadProjectTaskTeamData",
        tid: tid,
        query1: query1,
        query2: query2,
      },
      success: function (data) {
        $("#employeeData").html(data);
      },
    });
  }

  $(document).on("click", ".add-member", function () {
    var id = $(this).attr("id");
    $(".cancelEmpModal").val(id);
    addMemberInTask(id);
  });

  //add
  $(document).on("click", ".addempTaskChk", function () {
    var tid = $(".cancelEmpModal").val();
    var eid = $(this).attr("id");
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "addTaskTeam",
        tid: tid,
        empCode: eid,
      },
      success: function (data) {
        if (data == 1) {
          addMemberInTask(tid);
          dynamic_load_kanban_cards("unassigned", "unassigned-task");
          dynamic_load_kanban_cards("todo", "todo-task");
          dynamic_load_kanban_cards("inprogress", "inprogress-task");
          dynamic_load_kanban_cards("reviews", "reviews-task");
          dynamic_load_kanban_cards("completed", "completed-task");
          load_my_toast("success", "Task team updated Successfully..!!");
        }
      },
    });
  });

  //delete
  $(document).on("click", ".delempTaskChk", function () {
    var tid = $(".cancelEmpModal").val();
    var eid = $(this).attr("id");
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "delTaskTeam",
        tid: tid,
        empCode: eid,
      },
      success: function (data) {
        // alert(data);
        if (data == 1) {
          addMemberInTask(tid);
          dynamic_load_kanban_cards("unassigned", "unassigned-task");
          dynamic_load_kanban_cards("todo", "todo-task");
          dynamic_load_kanban_cards("inprogress", "inprogress-task");
          dynamic_load_kanban_cards("reviews", "reviews-task");
          dynamic_load_kanban_cards("completed", "completed-task");
          // load_toast("Task team updated Successfully..!!", "info");
          load_my_toast("success", "Task team updated Successfully..!!");
        }
      },
    });
  });

  //live search using name
  $("#live_search1").keyup(function () {
    var tid = $(".cancelEmpModal").val();
    var query1 = $("#live_search1").val();
    var query2 = $("#load_depart1").val();
    addMemberInTask(tid, query1, query2);
  });

  // live search using deparment of employee
  $(document).on("change", "#load_depart1", function () {
    var query2 = $(this).val();
    var query1 = $("#live_search1").val();
    var tid = $(".cancelEmpModal").val();
    addMemberInTask(tid, query1, query2);
  });


  //load Leader for project team in modal
  function addManagerInProj(pid) {
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "loadManagerInProject",
        pid: pid,
      },
      success: function (data) {
        $("#ManagerData").html(data);
      },
    });
  }

  //add employee to project team
  $(document).on("click", ".addEmpToProjTeam", function () {
    var pid = $(this).attr("id");
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "loadProjectTeamData",
        pid: pid,
      },
      success: function (data) {
        if (data == 1) {
          location.href = "project_overview";
          // addMemberInProj(pid);
          // loadProjectData();
          // load_toast("Task team updated Successfully..!!", "info");
        }
      },
    });
  });

  //add Leader to project team
  $(document).on("click", ".addLeaderToProjTeam", function () {
    var id = $(this).attr("id");
    $(".cancelLeaderModal").attr("id", id);
    addManagerInProj(id);
  });

  //add
  $(document).on("click", ".addempProjChk", function () {
    var pid = $(".cancelEmpModal").attr("id");
    var eid = $(this).attr("id");
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "addProjTeam",
        pid: pid,
        empCode: eid,
      },
      success: function (data) {
        if (data == 1) {
          addMemberInProj(pid);
          loadProjectData("loadProjectData");

          load_my_toast("success", "Task team added Successfully..!!");
        }
      },
    });
  });

  //delete
  $(document).on("click", ".delempProjChk", function () {
    var pid = $(".cancelLeaderModal").attr("id");
    var eid = $(this).attr("id");
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "delProjTeam",
        pid: pid,
        empCode: eid,
      },
      success: function (data) {
        if (data == 1) {
          addMemberInProj(pid);
          loadProjectData("loadProjectData");
          load_my_toast("success", "Task team deleted Successfully..!!");
        }
      },
    });
  });

  //add leader
  $(document).on("click", ".addLeaderProjChk", function () {
    var pid = $(".cancelLeaderModal").attr("id");
    var eid = $(this).attr("id");
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "addLeaderProjChk",
        pid: pid,
        empCode: eid,
      },
      success: function (data) {
        if (data == 1) {
          addManagerInProj(pid);
          loadProjectData("loadProjectData");

          load_my_toast("success", "Task team added Successfully..!!");
        }
      },
    });
  });

  //delete leader
  $(document).on("click", ".delLeaderProjChk", function () {
    // alert("hello1");
    var pid = $(".cancelLeaderModal").attr("id");
    var eid = $(this).attr("id");
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "delLeaderProjChk",
        pid: pid,
        empCode: eid,
      },
      success: function (data) {
        if (data == 1) {
          addManagerInProj(pid);
          loadProjectData("loadProjectData");
          load_my_toast("success", "Task team deleted Successfully..!!");
        }
      },
    });
  });

  //live search using name
  $("#live_search_proj").keyup(function () {
    var pid = $(".cancelEmpModal").val();
    var query1 = $("#live_search_proj").val();
    var query2 = $("#load_depart_proj").val();
    addMemberInProj(pid, query1, query2);
  });

  // live search using deparment of employee
  $(document).on("change", "#load_depart_proj", function () {
    var query2 = $(this).val();
    var query1 = $("#live_search_proj").val();
    var pid = $(".cancelEmpModal").val();
    addMemberInProj(pid, query1, query2);
  });

  //add employee to project team on project overview page
  function addMemberInProjOverview(query1 = "", query2 = "") {
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "loadProjectTeamDataOverview",
        query1: query1,
        query2: query2,
      },
      success: function (data) {
        $("#employeeDataOverview").html(data);
        addManagerOverviewTeam();
      },
    });
  }

  $("#addMemberOverview").on("click", function () {
    addMemberInProjOverview();
  });

  $("#addMemberOverviewTeam").on("click", function () {
    addMemberInProjOverview();
  });

  //add
  $(document).on("click", ".addempProjOverviewChk", function () {
    var eid = $(this).attr("id");
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "addProjOverviewTeam",
        empCode: eid,
      },
      success: function (data) {
        if (data == 1) {
          addMemberInProjOverview();
          load_toast("Task team updated Successfully..!!", "info");
          pageOverviewEmployee();
          projectTeamOverview();
        }
      },
    });
  });

  //delete
  $(document).on("click", ".delempProjOverviewChk", function () {
    var eid = $(this).attr("id");
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "delProjOverviewTeam",
        empCode: eid,
      },
      success: function (data) {
        if (data == 1) {
          addMemberInProjOverview();
          load_toast("Task team updated Successfully..!!", "info");
          pageOverviewEmployee();
          projectTeamOverview();
        }
      },
    });
  });

  //load employee on project overview team
  function projectTeamOverview(query1, query2) {
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "loadProjectTeamOverview",
        query1: query1,
        query2: query2,
      },
      success: function (data) {
        // alert(data);
        $("#loadEmpOverTeam").html(data);
      },
    });
  }
  projectTeamOverview();

  //live search using name
  $("#live_search_proj_overview").keyup(function () {
    var query1 = $("#live_search_proj_overview").val();
    var query2 = $("#load_depart_proj_overview").val();
    addMemberInProjOverview(query1, query2);
  });

  // live search using deparment of employee
  $(document).on("change", "#load_depart_proj_overview", function () {
    var query2 = $(this).val();
    var query1 = $("#live_search_proj_overview").val();
    addMemberInProjOverview(query1, query2);
  });

  //load employee on project page overview
  function pageOverviewEmployee() {
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "loadEmpDataOverview",
      },
      success: function (data) {
        // alert(data);
        $("#loadEmpDataOverview").html(data);
      },
    });
  }
  pageOverviewEmployee();

  //delete employee from project team list
  $(document).on("click", ".delempProjOverview", function () {
    var empid = $(this).attr("id");
    $("#removeEmpFromProj").val(empid);
  });

  $("#remove-Employee-projOve").click(function () {
    var empid = $("#removeEmpFromProj").val();
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "delempProjOverview",
        empid: empid,
      },
      success: function (data) {
        if (data == 1) {
          $("#remove-Employee-projOve-close").click();
          pageOverviewEmployee();
        }
      },
    });
  });

  //load manager for select team leader
  function loadManTeamLeader() {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "load_magnager_leader",
      },
      success: function (data) {
        $("#load_magnager_leader").html(data);
      },
    });
  }
  loadManTeamLeader();

  //load team leader
  function loadTeamLeader() {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "load_leader",
      },
      success: function (data) {
        loadManTeamLeader2(data);
      },
    });
  }
  loadTeamLeader();

  function loadManTeamLeader2(nid) {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "load_magnager_leader",
      },
      success: function (data) {
        $("#load_magnager_leader").html(data);
        $("#load_magnager_leader").val(nid);
      },
    });
  }

  //select team leader
  $(document).on("change", "#load_magnager_leader", function () {
    var val = $(this).val();
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "add_teamLeader",
        ptid: val,
      },
      success: function (data) {
        projectTeamOverview();
        // alert(data);
      },
    });
  });

  function addManagerOverviewTeam(query1 = "", query2 = "") {
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "loadManagerTeamOverview",
        query1: query1,
        query2: query2,
      },
      success: function (data) {
        $("#managerDataOverview").html(data);
      },
    });
  }
  addManagerOverviewTeam();

  //live search using name
  // $("#live_search_proj_overview").keyup(function () {
  //   var query1 = $("#live_search_proj_overview").val();
  //   var query2 = $("#load_depart_proj_overview").val();
  //   addMemberInProjOverview(query1, query2);
  // });

  // // live search using deparment of employee
  // $(document).on("change", "#load_depart_proj_overview", function () {
  //   var query2 = $(this).val();
  //   var query1 = $("#live_search_proj_overview").val();
  //   addMemberInProjOverview(query1, query2);
  // });

  //add
  $(document).on("click", ".addManagerProjOverviewChk", function () {
    var eid = $(this).attr("id");
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "addManProjOverviewTeam",
        empCode: eid,
      },
      success: function (data) {
        // alert(data);
        // if (data == 1) {
        projectTeamOverview();
        addManagerOverviewTeam();
        load_toast("Manager added Successfully..!!", "info");
        loadManTeamLeader2(data);
        // }
      },
    });
  });

  //delete
  $(document).on("click", ".delManagerProjOverviewChk", function () {
    var eid = $(this).attr("id");
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: {
        flag: "delManProjOverviewTeam",
        empCode: eid,
      },
      success: function (data) {
        // alert(data);
        // if (data == 1) {
        projectTeamOverview();
        addManagerOverviewTeam();
        load_toast("Manager removed Successfully..!!", "info");
        loadManTeamLeader2(data);
        // }
      },
    });
  });

  // =================================event============================================


  
  // =============================================== events

  // delete event
  $("#delete_event").on("click", function () {
    var title = $("#eventTitle").val();
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, I am sure!",
      cancelButtonText: "No, cancel it!",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "../assets/server/ajax.php",
          method: "POST",
          data: { flag: "delete_event", title: title },
          success: function (data) {
            if (data == 1) {
              swal("Success", "Successfully deleted..!", "success");
              location.reload();
            } else {
              swal({
                type: "error",
                title: "error",
                text: "Something wrong..!!",
              });
            }
          },
        });
      } else {
        swal("Cancelled", "You cancelled :(", "error");
      }
    });
  });

  // unique title
  $("#eventTitle").on("input", function () {
    var title = $("#eventTitle").val();
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "unique_title", title: title },
      success: function (data) {
        if (data == 1) {
          swal({
            type: "info",
            title: "info",
            text: "Event alredy exist..!!",
          });
        }
      },
    });
  });

  // update title
  $("#eventTitle").on("input", function () {
    var title = $("#eventTitle").val();
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "unique_title", title: title },
      success: function (data) {
        if (data == 1) {
          swal({
            type: "info",
            title: "info",
            text: "Event alredy exist..!!",
          });
        }
      },
    });
  });

  // update event
  $(document).on("click", ".btn-update-event", function () {
    var fd = new FormData(this.form);
    if ($("#allday").prop("checked") == true) {
      fd.append("allday", "!0");
    } else {
      fd.append("allday", "!1");
    }
    fd.append("flag", "update_event");
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: fd,
      contentType: false,
      processData: false,
      success: function (data) {
        if (data == 1) {
          swal({
            type: "success",
            title: "success",
            text: "Event updated..!!",
          });
        } else {
          swal({
            type: "error",
            title: "error",
            text: "Something wrong..!!",
          });
        }
      },
    });
  });

  //add event
  $(document).on("click", ".btn-add-event", function () {
    var fd = new FormData(this.form);
    if ($("#allday").prop("checked") == true) {
      fd.append("allday", "!0");
    } else {
      fd.append("allday", "!1");
    }
    fd.append("flag", "addEvent");
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      contentType: false,
      processData: false,
      data: fd,
      success: function (data) {
        if (data == 1) {
          location.reload();
        } else {
          swal({
            type: "error",
            title: "error",
            text: "Something wrong..!!",
          });
        }
      },
    });
  });


  // update event
  $(document).on("click", "#btn-save-event", function () {
    // if()
    var fd = new FormData(this.form);
    fd.append("eventStartDate", $("#event-start-date").val().split("to")[0]);
    fd.append("eventEndDate", $("#event-start-date").val().split("to")[1]);
    if ($("#allday").prop("checked") == true) {
      fd.append("allday", "!0");
    } else {
      fd.append("allday", "!1");
    }
    var btnUp = $("#btn-save-event").text();
    if (btnUp == "Update Event") {
      var title = $("#event-title").val();
      $.ajax({
        url: "../assets/server/ajax.php",
        method: "POST",
        data: { flag: "unique_title", title: title },
        success: function (data) {
          if (data == 1) {
            fd.append("flag", "update_event");
            $.ajax({
              url: "../assets/server/ajax.php",
              method: "POST",
              data: fd,
              contentType: false,
              processData: false,
              success: function (data) {
                if (data == 1) {
                  swal({
                    type: "success",
                    title: "success",
                    text: "Event updated..!!",
                  });
                  location.reload();
                } else {
                  swal({
                    type: "error",
                    title: "error",
                    text: "Something wrong..!!",
                  });
                }
              },
            });
          } else {
            fd.append("flag", "addEvent");
            $.ajax({
              url: "../assets/server/ajax.php",
              method: "POST",
              contentType: false,
              processData: false,
              data: fd,
              success: function (data) {
                if (data == 1) {
                  location.reload();
                } else {
                  swal({
                    type: "error",
                    title: "error",
                    text: "Something wrong..!!",
                  });
                }
              },
            });
          }
        },
      });
    } else {
      var title = $("#event-title").val();
      $.ajax({
        url: "../assets/server/ajax.php",
        method: "POST",
        data: { flag: "unique_title", title: title },
        success: function (data) {
          if (data == 1) {
            swal({
              type: "error",
              title: "error",
              text: "Something title wrong..!!",
            });
          } else {
            fd.append("flag", "addEvent");
            $.ajax({
              url: "../assets/server/ajax.php",
              method: "POST",
              contentType: false,
              processData: false,
              data: fd,
              success: function (data) {
                if (data == 1) {
                  location.reload();
                } else {
                  swal({
                    type: "error",
                    title: "error",
                    text: "Something wrong..!!",
                  });
                }
              },
            });
          }
        },
      });
    }
  });

  //delete event
  $("#btn-delete-event").on("click", function (e) {
    e.preventDefault();
    var title = $("#modal-title").text();
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "delete_event", title: title },
      success: function (data) {
        if (data == 1) {
          swal("Success", "Successfully deleted..!", "success");
          location.reload();
        } else {
          swal({
            type: "error",
            title: "error",
            text: "Something wrong..!!",
          });
        }
      },
    });
  });

  // ========================================= dashboard on admin side

  function load_dashboard_admin_data() {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "load_dashboard_admin_data" },
      success: function (data) {
        $(".cnt-value").attr("data-target", data);
      },
    });
  }
  load_dashboard_admin_data();

  // =================================================================================
  $(".btn-client-export").on("click", function () {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "btn-client-export" },
      success: function (data) {
        var link = document.createElement("a");
        link.href = "data:text/csv;charset=utf-8," + encodeURI(data);
        link.download = "client.csv";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      },
    });
  });


  //  load total hour of timesheet
  function load_total_hour_rejected() {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "load_total_hour_dashboard" },
      success: function (data) {
        var temp = data.split(":");
        $("#total_hour").attr("data-target", temp[0]);
        $("#total_min").attr("data-target", temp[1]);
      },
    });
  }
  load_total_hour_rejected();
  
});
