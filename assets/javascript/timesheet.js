$(document).ready(function () {
  // $("#stop").hide();
  $(".reset").hide();
  let hour = 00;
  let minute = 00;
  let second = 00;
  let count = 00;

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

  function toSec(t) {
    var b = t.split(/\D/);
    return +b[0] * 60 * 60 + +b[1] * 60 + +b[2];
  }

  function toHr(s) {
    var m = Math.floor(s / 60);
    var h = Math.floor(m / 60);
    if (h <= 9) {
      h = "0" + h;
    }
    m = m % 60;
    if (m <= 9) {
      m = "0" + m;
    }
    s = s % 60;
    if (s <= 9) {
      s = "0" + s;
    }
    return h + ":" + m + ":" + s;
  }


  function show_message_dialog(message)
  {
    $("#show_message_dialog").text(message);
    $("#warning_btn").click();
  }

  var startTime = 0,
    additionTime = "00:00:00";
  var timerInterval;

  function startTimer(start_time, addition_Time = "00:00:00") {
    startTime = new Date(start_time);
    additionTime = addition_Time;
    timerInterval = setInterval(updateTimer, 1000);
  }

  function updateTimer() {
    const diffInMs = Math.abs(Date.now() - startTime); // get the absolute difference in milliseconds

    const hours = Math.floor(diffInMs / (1000 * 60 * 60)); // convert milliseconds to hours
    const minutes = Math.floor((diffInMs % (1000 * 60 * 60)) / (1000 * 60)); // convert remaining milliseconds to minutes
    const seconds = Math.floor((diffInMs % (1000 * 60)) / 1000); // convert remaining milliseconds to seconds
    var new_hour = pad(hours) + ":" + pad(minutes) + ":" + pad(seconds);
    var final_hours = toHr(toSec(new_hour) + toSec(additionTime));

    document.getElementById("timer").textContent = final_hours;
  }

  function pad(num) {
    return ("0" + num).slice(-2);
  }

  function get_timeStamp(subtaskId) {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "get_timeStamp", id: subtaskId },
      success: function (data) {
        var value = JSON.parse(data);
        var start_time = value.start_time;
        startTimer(start_time);
      },
    });
  }

  // load timer on page laod
  function loadTimer() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "get_timeStamp_onLoad" },
      success: function (data) {
        if (data != "") {
          var value = JSON.parse(data);
          var start_time = value.start_time;
          // $("#decrip").val(value.description);
          $("#subTask_Title").val(value.title);
          startTimer(start_time, value.hour);
          $(".reset").show();
          $(".reset").attr("id", value.id);
          $(".start").hide();
        }
      },
    });
  }
  loadTimer();

  // insert timesheet
  $(".start").on("click", function () {
    // var decrip = $("#decrip").val();
    var generator = new IDGenerator("timesheet");
    var tid = generator.generate();
    var title = $("#subTask_Title").val();
    if (title != "") {
      $(".start").hide();

      $.ajax({
        url: "../assets/server/employee_ajax.php",
        method: "POST",
        data: { flag: "insert_timesheet", tid: tid, title: title },
        success: function (data) {
          $(".reset").show();
          $(".reset").attr("id", tid);
          get_timeStamp(tid);
          loadTimeSheet();
        },
      });
    } else {
      show_message_dialog("Please enter sub task title...");
    }
  });

  //load timesheet data
  function loadTimeSheet() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "display_timesheet" },
      success: function (data) {
        $("#timeSheetData").html(data);
      },
    });
  }
  loadTimeSheet();

  //stop timesheet
  function stop_timesheet() {
    clearInterval(timerInterval);
    var hours = $("#timer").text();
    var title = $("#subTask_Title").val();
    var timeSheetId = $(".reset").attr("id");
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: {
        flag: "stop_timesheet",
        hours: hours,
        title: title,
        timeSheetId: timeSheetId,
      },
      success: function (data) {
        if (data == 0) {
          $("#timer").html("00:00:00");
          $("#subTask_Title").val("");
          loadTimeSheet();
          load_total_time();
          $(".start").show();
          $(".reset").attr("id", "");
          $(".reset").hide();
        }
      },
    });
  }
  $(".reset").on("click", function () {
    stop_timesheet();
  });

  $(document).on("click", ".stop-timesheet", function (e) {
    e.preventDefault();
    stop_timesheet();
  });

  //restart timesheet
  $(document).on("click", ".restart-timesheet", function (e) {
    e.preventDefault();
    var timesheetId = $(this).attr("id");
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: {
        flag: "restart_timesheet",
        timeSheetId: timesheetId,
      },
      success: function (data) {
        if (data == 0) {
          show_message_dialog("another task is running please firstly stop it..!!");
        } else if (data == 1) {
          show_message_dialog("timesheet alredy submitted you cant restart it...!!");
        } else {
          var value = JSON.parse(data);
          startTimer(value.start_time, value.hour);
          $(".start").hide();
          $(".reset").attr("id", value.id);
          $(".reset").show();
          $("#timer").html(value.hour);
          $("#subTask_Title").val(value.title);
          loadTimeSheet();
          load_total_time();
        }
      },
    });
  });

  // //description focus
  // $(document).on("click", ".descriTimeSheet", function () {
  //   var id = $(this).attr("id");
  //   $(".mytextarea12"+id).focus();
  // });

  //update description

  function update_desc(id, txt) {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "update_timesheet_desc", timeSheetId: id, txt: txt },
      success: function (data) {
        loadTimeSheet();
      },
    });
  }

  $(document).on("keypress", ".mytextarea", function (e) {
    var code = e.keyCode ? e.keyCode : e.which;
    var id = $(this).attr("id");
    var txt = $(".mytextarea12" + id).val();
    if (code == 13) {
      //Enter keycode
      update_desc(id, txt);
    }
  });

  //delete timesheet entry
  $(document).on("click", ".delete-timesheet", function () {
    var id = $(this).attr("id");
    $(".remove-timeSheet").attr("id", id);
  });

  $(".remove-timeSheet").on("click", function () {
    var timeSheetId = $(this).attr("id");
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "delete_timesheet", timeSheetId: timeSheetId },
      success: function (data) {
        $("#remove-Employee-close").click();
        loadTimeSheet();
      },
    });
  });

  //cancel delete
  $("#remove-Employee-close").on("click", function () {
    $(".remove-timeSheet").attr("id", "");
  });

  // load timesheet total hours
  function load_total_time() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "load_total_time" },
      success: function (data) {
        var temp = data.split(":");
        var houtstr = temp[0] + " hrs " + temp[1] + " min";
        $("#total_time").text(houtstr);
        // loadTimeSheet();
      },
    });
  }
  load_total_time();

  // submit timesheet
  $(".submitTimesheet").on("click", function () {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "submit_timesheet" },
      success: function (data) {
        loadTimeSheet();
      },
    });
  });

  //load save sheet
  function load_saved_sheet() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "load_saved_sheet" },
      success: function (data) {
        $(".load-saved-sheet").html(data);
        // loadTimeSheet();
      },
    });
  }
  load_saved_sheet();

  //load submitted sheet
  function load_submitted_sheet() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "load_submitted_sheet" },
      success: function (data) {
        $(".load-submitted-sheet").html(data);
        // loadTimeSheet();
      },
    });
  }
  load_submitted_sheet();

  //load approved sheet
  function load_approved_sheet() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "load_approved_sheet" },
      success: function (data) {
        $(".load-approved-sheet").html(data);
        // loadTimeSheet();
      },
    });
  }
  load_approved_sheet();

  //load rejected sheet
  function load_rejected_sheet() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "load_rejected_sheet" },
      success: function (data) {
        $(".load-rejected-sheet").html(data);
        // loadTimeSheet();
      },
    });
  }
  load_rejected_sheet();

  //  load total hour of saved timesheet
  function load_total_hour_saved() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "load_total_hour_saved" },
      success: function (data) {
        var temp = data.split(":");
        var houtstr = temp[0] + " hrs " + temp[1] + " min " + temp[2] + " sec";
        $(".load-total-hour-saved").html(houtstr);
        // loadTimeSheet();
      },
    });
  }
  load_total_hour_saved();

  //  load total hour of submitted timesheet
  function load_total_hour_submitted() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "load_total_hour_submitted" },
      success: function (data) {
        var temp = data.split(":");
        var houtstr = temp[0] + " hrs " + temp[1] + " min " + temp[2] + " sec";
        $(".load-total-hour-submitted").html(houtstr);
        // loadTimeSheet();
      },
    });
  }
  load_total_hour_submitted();

  //  load total hour of approved timesheet
  function load_total_hour_approved() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "load_total_hour_approved" },
      success: function (data) {
        var temp = data.split(":");
        var houtstr = temp[0] + " hrs " + temp[1] + " min " + temp[2] + " sec";
        $(".load-total-hour-approved").html(houtstr);
        // loadTimeSheet();
      },
    });
  }
  load_total_hour_approved();

  //  load total hour of rejected timesheet
  function load_total_hour_rejected() {
    $.ajax({
      url: "../assets/server/employee_ajax.php",
      method: "POST",
      data: { flag: "load_total_hour_rejected" },
      success: function (data) {
        var temp = data.split(":");
        var houtstr = temp[0] + " hrs " + temp[1] + " min " + temp[2] + " sec";
        $(".load-total-hour-rejected").html(houtstr);
        // loadTimeSheet();
      },
    });
  }
  load_total_hour_rejected();

  //filter timesheet
  $("#filter_by_date").on("change", function () {
    var id = $("#filter_by_date").val();
    if (id == 0) {
      load_approved_sheet();
      load_rejected_sheet();
      load_submitted_sheet();
      load_saved_sheet();
      load_total_hour_saved();
      load_total_hour_submitted();
      load_total_hour_approved();
      load_total_hour_rejected();
    } else {
      $.ajax({
        url: "../assets/server/employee_ajax.php",
        method: "POST",
        data: { flag: "load_filtered_sheet", id: id },
        success: function (data) {
          var val = JSON.parse(data);
          $(".load-saved-sheet").html(val[0]);
          $(".load-submitted-sheet").html(val[1]);
          $(".load-approved-sheet").html(val[2]);
          $(".load-rejected-sheet").html(val[3]);
        },
      });
    }
  });
});
