$(document).ready(function () {
  $("#cur_date").val();

  // common validation function
  function chk_validate(field, efield, message) {
    if ($("#" + field).val() == "" || $("#" + field).val() == "None") {
      $("#" + efield).text(message);
      $("#" + field).focus();
      return false;
    } else {
      $("#" + efield).text(" * ");
      return true;
    }
  }

  function dateTime() {
    var ndate = new Date();

    var day = ("0" + ndate.getDate()).slice(-2);
    var month = ("0" + (ndate.getMonth() + 1)).slice(-2);
    var today = ndate.getFullYear() + "-" + month + "-" + day;
    $("#cur_date").val(today);

    var hours = ndate.getHours();
    var message =
      hours < 12
        ? "Good Morning"
        : hours < 18
        ? "Good Afternoon"
        : "Good Evening";
    $("#i_message").text(message);
  }
  setInterval(dateTime, 1000);

  $("#wicon").hide();
  function load_api_data() {
    navigator.geolocation.getCurrentPosition(function (position) {
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;
      // $("#loader").show();

      $.ajax({
        url: "../assets/server/ajax.php",
        type: "post",
        data: {
          flag: "load_api_data",
          latitude: latitude,
          longitude: longitude,
        },
        success: function (data) {
          var data1 = JSON.parse(data);
          $("#temperature").html(
            Math.round(data1["main"]["temp"] - 273.15) +
              "<i class='ri-celsius-line fs-4 mt-1'></i> "
          );
          var currentDate = new Date();

          // Get the current date and month
          var day = currentDate.getDate();
          var month = currentDate.getMonth();
          var monthNames = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
          ];
          var monthName = monthNames[month];
          $(".weatherCondition").text(
            data1["weather"][0]["main"] + " | " + day + ", " + monthName
          );

          var iconurl =
            "http://openweathermap.org/img/w/" + data1.weather[0].icon + ".png";
          $("#wicon").attr("src", iconurl);
        },
        complete: function () {
          // $("#loader").css("display", "none");
          $(".a").removeClass("placeholder");
          $("#wicon").show();
        },
      });
    });
  }
  load_api_data();

  //get cookie
  function getCookie() {
    $.ajax({
      url: "assets/server/ajax.php",
      method: "POST",
      data: { flag: "getCookie" },
      success: function (val) {
        if (val != "") {
          $("#email").val(val);
          $("#remember-me").prop("checked", true);
        }
      },
    });
  }
  getCookie();

  //login
  $("#login").on("click", function (e) {
    e.preventDefault();
    if ($("#remember-me").is(":checked")) {
      remember = "true";
    } else {
      remember = "false";
    }
    var data = new FormData(this.form);
    data.append("flag", "login");
    data.append("remember", remember);
    $.ajax({
      url: "assets/server/ajax.php",
      type: "post",
      data: data,
      contentType: false,
      processData: false,
      success: function (val) {
        if (val == "admin") {
          location.href = "admin/";
        } else if (val == "user") {
          location.href = "employee/";
        } else if (val == "manager") {
          location.href = "manager/";
        } else {
          Swal.fire({
            title: "Oops...",
            text: "Check your username or password..!",
            icon: "error",
            confirmButtonClass: "btn btn-primary w-xs mt-2",
            buttonsStyling: !1,
            showCloseButton: !0,
            closeOnEsc: false,
            timer: 3000,
          });
        }
      },
    });
  });

  //signup page register function
  $("#signup-btn").on("click", function (e) {
    e.preventDefault();
    if (
      chk_validate("username-field", "err_issue_fname", " * Required ") &&
      chk_validate("middel_name-field", "err_issue_mname", " * Required ") &&
      chk_validate("last_name-field", "err_issue_lname", " * Required ") &&
      chk_validate("email_id-field", "err_issue_email", " * Required ") &&
      chk_validate("password-field", "err_issue_pass", " * Required ") &&
      chk_validate("cpassword-field", "err_issue_cpass", " * Required ")
    ) {
      if ($("#password-field").val() == $("#cpassword-field").val()) {
        var fd = new FormData(this.form);
        fd.append("flag", "registerdata");
        $.ajax({
          url: "./assets/server/ajax.php",
          method: "POST",
          contentType: false,
          data: fd,
          processData: false,
          success: function (data) {
            if (data == 1) {
              location.href = "index.php";
            } else if (data == 2) {
              Swal.fire({
                title: "Oops...",
                text: "Something wrong..!",
                icon: "error",
                confirmButtonClass: "btn btn-primary w-xs mt-2",
                buttonsStyling: !1,
                showCloseButton: !0,
                closeOnEsc: false,
                timer: 3000,
              });
            } else if (data == 3) {
              Swal.fire({
                title: "Oops...",
                text: "photo size limit achived..!",
                icon: "error",
                confirmButtonClass: "btn btn-primary w-xs mt-2",
                buttonsStyling: !1,
                showCloseButton: !0,
                closeOnEsc: false,
                timer: 3000,
              });
            } else if (data == 4) {
              Swal.fire({
                title: "Oops...",
                text: "User already exist..!",
                icon: "error",
                confirmButtonClass: "btn btn-primary w-xs mt-2",
                buttonsStyling: !1,
                showCloseButton: !0,
                closeOnEsc: false,
                timer: 3000,
              });
            }
          },
        });
      } else {
        Swal.fire({
          title: "Oops...",
          text: "Conform password doesn`t match..!",
          icon: "error",
          confirmButtonClass: "btn btn-primary w-xs mt-2",
          buttonsStyling: !1,
          showCloseButton: !0,
          closeOnEsc: false,
          timer: 3000,
        });
      }
    }
  });

  //logout
  $("#logout").on("click", function () {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "logout" },
      success: function (val) {
        if (val == "logout") {
          location.href = "../Apps/logout";
        }
      },
    });
  });

  // lock
  $("#lockscreen").on("click", function () {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "lockscreen" },
      success: function () {
        location.reload();
      },
    });
  });

  // loading birth data on dashboard
  function load_birthdate() {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "load_birthdate" },
      success: function (data) {
        if (data != 1) {
          $("#bd_div").html(data);
        } else {
          $("#bd_div").html("No birthday..!!");
        }
      },
    });
  }
  load_birthdate();

  // loading event data on dashboard
  function load_event() {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "load_event" },
      success: function (data) {
        if (data != "") {
          $("#load_event").html(data);
        } else {
          $("#load_event").html("No event..!!");
        }
      },
    });
  }
  load_event();

  // title on input check
  $("#title").on("input",function(){
    chk_validate("title","err_title"," * Please enter title");
  })
  $("#suggestion_body").on("input",function(){
    chk_validate("suggestion_body","err_title"," * Please enter suggestion");
  })
  // suggestion insert
  $("#suggestion").on("click", function (e) {
    e.preventDefault();
    if(chk_validate("title","err_title"," * Please enter title") && chk_validate("suggestion_body","err_title"," * Please enter suggestion"))
    {
      var suggest_data = new FormData(this.form);
      suggest_data.append("flag", "suggestion");
      $.ajax({
        url: "../assets/server/ajax.php",
        method: "POST",
        data: suggest_data,
        contentType: false,
        processData: false,
        success: function (data) {
          if (data == 1) {
            swal("Success", "Suggestion submitted..!", "success");
            $("#suggest_frm").trigger("reset");
          } else {
            swal("Cancelled", "Something wrong :(", "error");
          }
          load_suggestion("leadDiscovered1", 1);
          load_suggestion("leadDiscovered2", 2);
          load_suggestion("leadDiscovered3", 3);
        },
      });
    }else{
      swal("Error..", "Please enter suggestion :(", "error");
    }
    
  });

  // remove profile picture
  $("#remove_proc").on("click", function () {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "del_proc_picture",
      },
      success: function (data) {},
    });
  });

  // toaster
  function load_my_toast(type, message) {
    var icon = "";
    switch (type) {
      case "primary":
        icon = `<i class="ri-user-smile-line align-middle"></i>`;
        break;
      case "success":
        icon = `<i class="ri-checkbox-circle-fill align-middle"></i>`;
        break;
      case "warning":
        icon = `<i class="ri-notification-off-line align-middle"></i>`;
        break;
      case "danger":
        icon = `<i class="ri-alert-line align-middle"></i>`;
        break;
    }
    $("#borderedToast1").attr(
      "class",
      "toast toast-border-" + type + " overflow-hidden0 mydivborderfortoast"
    );
    $("#message").text(message);
    $("#addicontoast").html(icon);
    $("#borderedToast1Btn").click();
  }

  function load_toast(message, style) {
    $("#borderedToast1").attr("data-toast-text", message);
    $("#borderedToast1").attr("data-toast-className", style);
    $("#borderedToast1").attr("data-toast-close", "close");
    $("#borderedToast1").click();
  }

  //===========================================operation on Profile===================

  //load data on profile page
  function getuserdetails() {
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "load_user_profile" },
      success: function (data) {
        value = JSON.parse(data);
        //heading

        $("#loadbginprofile").attr(
          "src",
          "../assets/img/profile_background/" + value.bg_cover
        );

        $("#pictureInProfileHeading").attr(
          "src",
          "../assets/img/profile/" + value.profile_picture
        );
        $("#unameProfileHeading").text(value.firstname);
        $("#locationProfile").text(value.city + ", " + value.country);

        // info
        $("#fullname").text(value.firstname + " " + value.lastname);
        $("#emailprofile").text(value.email);
        $("#phonenumberprofile").text(value.personal_phoneNO);
        $("#locationprofile").text(value.city);
        $("#joindateprofile").text(value.hiredate);
        $("#aboutProfile").text(value.description);
        $("#facebookprofile").attr("href", value.facebook_portfolio);
        $("#githubprofile").attr("href", value.github_portfolio);
        $("#linkedinprofile").attr("href", value.linkedin_portfolio);
        $("#instaprofile").attr("href", value.instagram_portfolio);
        $("#h_name").html(value.firstname);

        if (value.profile_picture == "") {
          $("#h_profile").attr("src", "../assets/img/profile/proc.jpg");
        } else {
          $("#h_profile").attr(
            "src",
            "../assets/img/profile/" + value.profile_picture
          );
        }

        var skill = value.skills.split(",");
        var data = "";

        for (var i = 0; i < skill.length; i++) {
          data += `<div class="badge badge-soft-primary">${skill[i]}</div>`;
        }
        $("#skillsProfile").html(data);

        if (value.role == "admin") {
          $("#roleprofile").text("Administrator");
          $("#user_role_profile").text("Administrator");
          $("#h_type").text("Administrator");
        } else if (value.role == "manager") {
          $("#roleprofile").text("Manager");
          $("#user_role_profile").text("Manager");
          $("#h_type").text("Manager");
        } else {
          $("#roleprofile").text("Employee");
          $("#user_role_profile").text("Employee");
          $("#h_type").text("Employee");
        }
      },
      complete: function () {
        $("#loader").css("display", "none");
      },
    });
  }
  getuserdetails();

  //fetch data in edit page
  function load_data_in_profile() {
    $.ajax({
      url: "../assets/server/ajax.php",
      type: "POST",
      data: { flag: "load_data_in_profile" },
      success: function (data) {
        value = JSON.parse(data);

        if (value.bg_cover == "") {
          $("#bgimgload").attr("src", "../assets/images/auth-one-bg.jpg");
        } else {
          $("#bgimgload").attr(
            "src",
            "../assets/img/profile_background/" + value.bg_cover
          );
        }

        $("#firstnameProfileInput").val(value.firstname);
        $("#i_name").text(value.firstname);
        $("#lastnameProfileInput").val(value.lastname);
        $("#phonenumberProfileInput").val(value.personal_phoneNO);
        $("#emailProfileInput").val(value.email);
        $("#JoiningdatProfileInput").val(value.hiredate);
        $("#select2Primary").val(value.skills);
        $("#cityProfileInput").val(value.city);
        $("#countryProfileInput").val(value.country);
        $("#zipcodeProfileInput").val(value.zip_code);
        $("#descriptionProfileInput").val(value.description);
        $("#gitUseridUrl").val(value.github_portfolio);
        $("#facebookidUrl").val(value.facebook_portfolio);
        $("#linkedinidUrl").val(value.linkedin_portfolio);
        $("#instaidUrl").val(value.instagram_portfolio);

        if (value.profile_picture == "") {
          $(".user-profile-image").attr(
            "src",
            "../assets/img/profile/proc.jpg"
          );
        } else {
          $(".user-profile-image").attr(
            "src",
            "../assets/img/profile/" + value.profile_picture
          );
        }
      },
    });
  }
  load_data_in_profile();

  //update data in profile Edit Page
  $(document).on("click", "#updateProfileData", function (e) {
    e.preventDefault();
    var insta = $("#instaidUrl").val();
    var linkedin = $("#linkedinidUrl").val();
    var facebook = $("#facebookidUrl").val();
    var github = $("#gitUseridUrl").val();
    var skill = $("#select2Primary").val();
    var fd = new FormData(this.form);
    fd.append("flag", "UpdateEditProfileData");
    fd.append("skill", skill);
    fd.append("insta", insta);
    fd.append("linkedin", linkedin);
    fd.append("facebook", facebook);
    fd.append("github", github);

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
            text: "Your Profile Update..!!",
          });
          location.href = "profile";
        } else {
          swal({
            type: "error",
            title: "error",
            text: "Something Went Wrong..!!",
          });
        }
      },
    });
  });

  //change profile image
  $(".profileimg").on("change", function (e) {
    e.preventDefault();
    var fd = new FormData(this.form);
    fd.append("flag", "change_profile_Image");
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      contentType: false,
      data: fd,
      processData: false,
      success: function (data) {
        load_data_in_profile();
        getuserdetails();
      },
    });
  });

  //change profile background
  $(".cover_bgbtn").on("change", function () {
    var fd = new FormData(this.form);
    fd.append("flag", "change_background");
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      contentType: false,
      data: fd,
      processData: false,
      success: function (data) {
        load_data_in_profile();
        getuserdetails();
      },
    });
  });

  //load progressbar in profile
  function load_profile_progressbar() {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "load_progressbar" },
      success: function (data) {
        $("#progressbar").attr("aria-valuenow" + data);
        $("#progresslabel").text(data + "%");
        var widthdata = $("#progressbar");
        widthdata.css({ width: data + "%" });
      },
    });
  }
  load_profile_progressbar();

  //load progressbar in edit profile
  function progressbar_editProfile() {
    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: { flag: "edit_profile_progress" },
      success: function (data) {
        $("#editprogressbar").attr("aria-valuenow" + data);
        $("#editprogresslbl").text(data + "%");
        var widthdata = $("#editprogressbar");
        widthdata.css({ width: data + "%" });
      },
    });
  }
  progressbar_editProfile();

  //load img in signup page
  $("#customer-image-input").on("change", function () {
    var img = URL.createObjectURL(this.files[0]);
    $("#customer-img").attr("src", img);
  });


});
