$(document).ready(function () {
   
    function load_tb4(){
        var events1 = [];
        var s = [];
        $.ajax({
          type: "post",
          url: "../assets/server/employee_ajax.php",
          data: { flag: "test_table4" },
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
            events1[i].description,
            events1[i].priority,
            events1[i].status,
            events1[i].sdate,
            events1[i].edate,
            gridjs.html(events1[i].members),
          ]);
        }
        document.getElementById("table-gridjs4") &&
        new gridjs.Grid({
          columns: [
            {
              name: "No",
              width: "80px",
              formatter: function (e) {
                return gridjs.html(e);
              },
            },
            { name: "Task Name", width: "120px",
            formatter: function (e) {
              return gridjs.html( '<span class="fw-semibold">' + e + "</span>");
            },},
            { name: "Task description", width: "180px",
            formatter: function (e) {
              return gridjs.html( '<span class="fw-semibold">' + e + "</span>");
            },},
            {
              name: "Priority",
              width: "150px",
              formatter: function (e) {
                return gridjs.html( e);
              },
            },
            {
                name: "Status",
                width: "150px",
                formatter: function (e) {
                  return gridjs.html( e);
                },
              },
            { name: "Start date", width: "150px",
            formatter: function (e) {
              return gridjs.html(e);
            }, },
            { name: "Due date", width: "150px",
            formatter: function (e) {
              return gridjs.html(e);
            }, },
            { name: "Team", width: "120px"},
            
          ],
          pagination: { limit: 5},
          sort: !0,
          search: !0,
          data: s
          ,
        }).render(document.getElementById("table-gridjs4"));
      }
      load_tb4();



  });
  