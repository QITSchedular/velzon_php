$(document).ready(function () {
  // ========================================================= my task

  // kanban cards
  function dynamic_load_kanban_cards(status1, id_url) {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
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

  dynamic_load_kanban_cards("unassigned", "unassigned-task");
  dynamic_load_kanban_cards("todo", "todo-task");
  dynamic_load_kanban_cards("inprogress", "inprogress-task");
  dynamic_load_kanban_cards("reviews", "reviews-task");
  dynamic_load_kanban_cards("completed", "completed-task");

  // kanban cards count load
  function dynamic_load_kanban_cards_count(status1) {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: {
        flag: "dynamic_load_kanban_cards_count",
        status: status1,
      },
      success: function (data) {
        if (data == " ") {
          $("." + status1).text("0");
        } else {
          $("." + status1).html(data);
        }
      },
    });
  }

  dynamic_load_kanban_cards_count("unassigned");
  dynamic_load_kanban_cards_count("todo");
  dynamic_load_kanban_cards_count("inprogress");
  dynamic_load_kanban_cards_count("reviews");
  dynamic_load_kanban_cards_count("completed");

  //redirect to task overview page and store task id in session
  $(document).on("click", ".tasks-box", function () {
    var tid = $(this).attr("id");
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: {
        flag: "redirect_task_overview",
        tid: tid,
      },
      success: function (data) {
        if (data == 1) {
          location.href = "task_overView";
        }
      },
    });
  });

  //load summury
  function load_summry() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: {
        flag: "load_task_summary",
      },
      success: function (data) {
        var value = JSON.parse(data);
        $("#summary_txt").text(value.description);
        $("#task_no").text(value.id);
        $("#task_title").text(value.title);
        $("#project_name").text(value.project_name);
        var priority = value.priority;
        if (priority == "Important") {
          $("#priority").text("Important");
          $("#priority").attr("class", "badge badge-soft-warning");
        } else if (priority == "Urgent") {
          $("#priority").text("Urgent");
          $("#priority").attr("class", "badge badge-soft-info");
        } else if (priority == "Important and urgent") {
          $("#priority").text("Important and urgent");
          $("#priority").attr("class", "badge badge-soft-danger");
        } else if (priority == "Neither") {
          $("#priority").text("Neither");
          $("#priority").attr("class", "badge badge-soft-primary");
        }
        var status = value.status;
        $("#select_status").val(status);
        if (status == "unassigned") {
          $("#status12").text("Unassigned");
          $("#status12").attr("class", "badge badge-soft-success");
        } else if (status == "todo") {
          $("#status12").text("To do");
          $("#status12").attr("class", "badge badge-soft-primary");
        } else if (status == "inprogress") {
          $("#status12").text("Inprogress");
          $("#status").attr("class", "badge badge-soft-warning");
        } else if (status == "reviews") {
          $("#status12").text("InReview");
          $("#status12").attr("class", "badge badge-soft-secondary");
        } else if (status == "completed") {
          $("#status12").text("Completed");
          $("#status12").attr("class", "badge badge-soft-info");
        }
        $("#due_date").text(value.due_date);
        load_teamMate();
      },
    });
  }
  load_summry();

  //load team mate
  function load_teamMate() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: {
        flag: "load_team_mate",
      },
      success: function (data) {
        $("#load_team_mate").html(data);
      },
    });
  }

  // attachments
  // open file exploere
  $(".upload_btn").on("click", function () {
    $(".upload_file").click();
  });

  $("#task_multiple_files").on("change", function () {
    var form_data = new FormData(this.form);

    form_data.append("flag", "task_multiplefile");
    // AJAX request
    $.ajax({
      url: "../assets/server/employee_ajax.php",
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
  function file_show() {
    $.ajax({
      type: "post",
      url: "../assets/server/employee_ajax.php",
      data: {
        flag: "task_file_show",
      },
      success: function (data) {
        load_total_file();

        $("#file_load").html(data);
      },
    });
  }
  file_show();

  // delete project task file
  $(document).on("click", ".del_file", function () {
    var id = $(this).attr("id");
    $(".removeTaskFile").attr("id", id);
  });

  $(".removeTaskFile").on("click", function () {
    var id = $(".removeTaskFile").attr("id");
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "del_task_file", id: id },
      success: function (data) {
        if (data == 1) {
          $("#removeTaskFileclose").click();
          file_show();
        }
        // swal("Success", "Successfully deleted..!", "success");
      },
    });
  });

  // load file total
  function load_total_file() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "load_total_file" },
      success: function (data) {
        $("#total_file").text(data);
        // loadTimeSheet();
      },
    });
  }
  load_total_file();


  //notification tasks
  function notification_tasks_employee() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
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
      url: "../assets/server/employee_ajax.php",
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
      url: "../assets/server/employee_ajax.php",
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
      url: "../assets/server/employee_ajax.php",
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

  // counting total hours and minutes on dashboard
  function load_hm() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "load_hm" },
      success: function (data) {
        $("#load_hm_hour").attr("data-target", data.split(":")[0]);
        $("#load_hm_minute").attr("data-target", data.split(":")[1]);
      },
    });
  }
  // load_hm();

  load_hm();

  function load_hm_compare() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "load_hm_compare" },
      success: function (data) {
        abc = parseInt(data).toFixed(2);
        $("#load_hm_compare").text(abc);
        if (parseInt(data) < 0) {
          $("#compare_css").attr("class", "badge badge-soft-danger fs-12");
          $("#compare_css1").attr(
            "class",
            "ri-arrow-down-s-line fs-13 align-middle me-1"
          );
        } else {
          $("#compare_css").attr("class", "badge badge-soft-success fs-12");
          $("#compare_css1").attr(
            "class",
            "ri-arrow-up-s-line fs-13 align-middle me-1"
          );
        }
      },
    });
  }
  load_hm_compare();

  // calculate the task with previous month
  function load_campare_task() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "load_campare_task" },
      success: function (data) {
        abc = parseInt(data).toFixed(2);
        $("#compare_comp_task").text(abc);
        if (parseInt(data) < 0) {
          $("#compare_comp_css").attr("class", "badge badge-soft-danger fs-12");
          $("#compare_comp_css1").attr(
            "class",
            "ri-arrow-down-s-line fs-13 align-middle me-1"
          );
        } else {
          $("#compare_comp_css").attr(
            "class",
            "badge badge-soft-success fs-12"
          );
          $("#compare_comp_css1").attr(
            "class",
            "ri-arrow-up-s-line fs-13 align-middle me-1"
          );
        }
      },
    });
  }
  load_campare_task();

  // load total remaining tasks
  function load_total_remain_tasks() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "load_total_remain_tasks" },
      success: function (data) {
        $("#total_remain_tasks").attr("data-target", data);
      },
    });
  }
  load_total_remain_tasks();

  // calculate the remaining task with previous month
  function load_remain_task() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "load_remain_task" },
      success: function (data) {
        abc = parseInt(data).toFixed(2);
        $("#compare_remain_task").text(abc);
        if (parseInt(data) < 0) {
          $("#compare_remain_css").attr(
            "class",
            "badge badge-soft-danger fs-12"
          );
          $("#compare_remain_css1").attr(
            "class",
            "ri-arrow-down-s-line fs-13 align-middle me-1"
          );
        } else {
          $("#compare_remain_css").attr(
            "class",
            "badge badge-soft-success fs-12"
          );
          $("#compare_remain_css1").attr(
            "class",
            "ri-arrow-up-s-line fs-13 align-middle me-1"
          );
        }
      },
    });
  }
  load_remain_task();
});
