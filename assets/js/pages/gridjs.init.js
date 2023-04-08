$(document).ready(function () {
  function load_tb1(){
    var events1 = [];
    var s = [];
    $.ajax({
      type: "post",
      url: "assets/server/ajax.php",
      data: { flag: "test_table" },
      async: false,
      success: function (data) {
        var value = JSON.parse(data);
        events1 =value;
      },
    });
    for(i=0;i<events1.length;i++){
      s.push([
        events1[i].cnt,
        events1[i].name,
        events1[i].status,
        events1[i].edate,
        gridjs.html(events1[i].members),
        events1[i].task,
        events1[i].client,
        events1[i].detail,
      ]);
    }
    document.getElementById("table-gridjs1") &&
    new gridjs.Grid({
      columns: [
        {
          name: "No",
          width: "80px",
          formatter: function (e) {
            return gridjs.html('<span class="fw-semibold">' + e + "</span>");
          },
        },
        { name: "Project Name", width: "120px",
        formatter: function (e) {
          return gridjs.html( e );
        },},
        {
          name: "Status",
          width: "150px",
          formatter: function (e) {
            return gridjs.html( e);
          },
        },
        { name: "End date", width: "150px",
        formatter: function (e) {
          return gridjs.html('<span class="fw-semibold">' + e + "</span>");
        }, },
        { name: "Team", width: "180px"},
        { name: "Task", width: "180px" ,formatter: function (e) {
          return gridjs.html( e);
        },},
        {
          name: "Client name",
          width: "150px",
          formatter: function (e) {
            return gridjs.html(
              e
            );
          },
        },
        { name: "", width: "50px",
        formatter: function (e) {return gridjs.html(e);}
       },
      ],
      pagination: { limit: 5},
      sort: !0,
      search: !0,
      data: s
      ,
    }).render(document.getElementById("table-gridjs1"));
  }
  load_tb1();

  function load_tb2(){
    var events1 = [];
    var s = [];
    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: { flag: "test_table2" },
      async: false,
      success: function (data) {
        var value = JSON.parse(data);
        events1 =value;
      },
    });
    for(i=0;i<events1.length;i++){
      s.push([
        events1[i].cnt,
        events1[i].name,
        events1[i].status,
        events1[i].edate,
        gridjs.html(events1[i].members),
        events1[i].Progress,
        events1[i].plead,
        events1[i].detail,
      ]);
    }
    document.getElementById("table-gridjs2") &&
    new gridjs.Grid({
      columns: [
        {
          name: "No",
          width: "80px",
          formatter: function (e) {
            return gridjs.html('<span class="fw-semibold">' + e + "</span>");
          },
        },
        { name: "Project Name", width: "120px",
        formatter: function (e) {
          return gridjs.html( e );
        },},
        {
          name: "Status",
          width: "150px",
          formatter: function (e) {
            return gridjs.html( e);
          },
        },
        { name: "Due date", width: "150px",
        formatter: function (e) {
          return gridjs.html('<span class="fw-semibold">' + e + "</span>");
        }, },
        { name: "Team", width: "180px"},
        { name: "Progress", width: "180px" ,formatter: function (e) {
          return gridjs.html( e);
        },},
        {
          name: "Project Lead",
          width: "150px",
          formatter: function (e) {
            return gridjs.html(e);
          },
        },
      ],
      pagination: { limit: 5},
      sort: !0,
      search: !0,
      data: s
      ,
    }).render(document.getElementById("table-gridjs2"));
  }
  load_tb2();

  function load_tb3(){
    var events1 = [];
    var s = [];

    $.ajax({
      type: "post",
      url: "../assets/server/ajax.php",
      data: { flag: "loadClientData" },
      async: false,
      success: function (data) {
        var value = JSON.parse(data);
        events1 =value;
      },
    });
    for(i=0;i<events1.length;i++){
      s.push([
        events1[i].cnt,
        events1[i].name,
        events1[i].profile,
        events1[i].email,
        events1[i].conatct,
        events1[i].edit,
        events1[i].delete,
      ]);
    }
    document.getElementById("table-gridjs3") &&
    new gridjs.Grid({
      columns: [
        {
          name: "No",
          width: "50px",
          formatter: function (e) {return gridjs.html('<span class="fw-semibold">' + e + "</span>");},
        },
        { name: "Client Name", 
          width: "120px",
          formatter: function (e) {return gridjs.html('<span class="fw-semibold">' + e + "</span>");},
        },
        {
          name: "Profile picture",
          width: "100px",
          formatter: function (e) {return gridjs.html( e);},
        },
        { 
          name: "Email",
          width: "200px",
          formatter: function (e) {return gridjs.html('<span class="fw-semibold">' + e + "</span>");},
        },
        {
          name: "Contact No", 
          width: "180px",
          formatter: function (e) {return gridjs.html('<span class="fw-semibold">' + e + "</span>");},
        },
        { 
          name: "Edit", 
          width: "50px",
          formatter: function (e) {return gridjs.html( e);},
        },
        {
          name: "Delete",
          width: "50px",
          formatter: function (e) {return gridjs.html(e);},
        },
      ],
      pagination: { limit: 5},
      sort: !0,
      search: !0,
      data: s
      ,
    }).render(document.getElementById("table-gridjs3"));
  }
  load_tb3();

});
