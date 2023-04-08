var flag_fname =
  (flag_email =
  flag_depaertment =
  flag_pass =
  flag_mname =
  flag_lname =
  flag_sdate =
  flag_pname =
  flag_pEndDate =
  flag_pStartDate =
  flag_pDesc =
  flag_clientDept =
  flag_client_name =
  flag_nick_name =
  flag_address =
  flag_email =
  flag_zipcode =
  flag_contact1 =
  flag_contact2 =
  flag_fax =
  flag_website =
  flag_billrate =
  flag_profileimg =
  flag_notes =
  flag_editclient_name =
  flag_editnick_name =
  flag_editaddress =
  flag_editemail =
  flag_editzipcode =
  flag_editcontact1 =
  flag_editcontact2 =
  flag_editfax =
  flag_editwebsite =
  flag_editbillrate =
  flag_editprofileimg =
  flag_editnotes =
    1);
var param1, param2, param3;

function onfocusout_validation(x) {
  param1 = "#".concat(x);
  param2 = "#err_".concat($(param1).attr("id"));
  param3 = "flag_".concat($(param1).attr("id"));

  if ($(param1).val() == "" || $(param1).val() == null) {
    $(param1).removeClass("form-control-success");
    $(param1).addClass("form-control-danger");
    $(param2).text("Required");
    return eval({ param3 }.param3 + " = " + 1 + ";");
  }
}

function oninput_validation(x) {
  var obj = {
    client_name: {
      rgx: "^[A-Za-z ]+$",
      msg: "must be character.",
    },
    nick_name: {
      rgx: "^[A-Za-z ]+$",
      msg: "must be character.",
    },
    editclient_name: {
      rgx: "^[A-Za-z ]+$",
      msg: "must be character.",
    },
    editnick_name: {
      rgx: "^[A-Za-z ]+$",
      msg: "must be character.",
    },
    fname: {
      rgx: "^[A-Za-z ]+$",
      msg: "must be character.",
    },
    email: {
      rgx: "^[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$",
      msg: "abc@xyz.com.",
    },
    editemail: {
      rgx: "^[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$",
      msg: "abc@xyz.com.",
    },
    mname: {
      rgx: "^[A-Za-z ]+$",
      msg: "must be character.",
    },
    lname: {
      rgx: "^[A-Za-z ]+$",
      msg: "must be character.",
    },
    pass: {
      rgx: "^(?=.*\\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$",
      msg: "Invalid password format.",
    },
    zipcode: {
      rgx: "^[0-9]{6}$",
      msg: "must be 6 digit.",
    },
    contact1: {
      rgx: "^[0-9]{10}$",
      msg: "must be 10 digit.",
    },
    contact2: {
      rgx: "^[0-9]{10}$",
      msg: "must be 10 digit.",
    },
    fax: {
      rgx: "^[0-9]{6}$",
      msg: "must be 6 digit.",
    },
    editzipcode: {
      rgx: "^[0-9]{6}$",
      msg: "must be 6 digit.",
    },
    editcontact1: {
      rgx: "^[0-9]{10}$",
      msg: "must be 10 digit.",
    },
    editcontact2: {
      rgx: "^[0-9]{10}$",
      msg: "must be 10 digit.",
    },
    editfax: {
      rgx: "^[0-9]{6}$",
      msg: "must be 6 digit.",
    },
  };

  param1 = "#".concat(x);
  param2 = "#err_".concat($(param1).attr("id"));
  param3 = "flag_".concat($(param1).attr("id"));

  var check = new RegExp(obj[x].rgx);

  if (!check.test($(param1).val())) {
    $(param1).removeClass("form-control-success");
    $(param1).addClass("form-control-danger");
    $(param2).text(obj[x].msg);
    return eval({ param3 }.param3 + " = " + 1 + ";");
  } else {
    $(param1).removeClass("form-control-danger");
    $(param1).addClass("form-control-success");
    $(param2).text("");
    return eval({ param3 }.param3 + " = " + 0 + ";");
  }
}

function nullfield_validation(x) {
  param1 = "#".concat(x);
  param2 = "#err_".concat($(param1).attr("id"));
  param3 = "flag_".concat($(param1).attr("id"));

  if ($(param1).val() == "" || $(param1).val() == null) {
    $(param1).removeClass("form-control-success");
    $(param1).addClass("form-control-danger");
    $(param2).text("Required");
    return eval({ param3 }.param3 + " = " + 1 + ";");
  } else {
    $(param1).removeClass("form-control-danger");
    $(param1).addClass("form-control-success");
    $(param2).text("");
    return eval({ param3 }.param3 + " = " + 0 + ";");
  }
}
