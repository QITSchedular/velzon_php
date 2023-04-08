function getChartColorsArray(e) {
    if (null !== document.getElementById(e)) {
      var t = document.getElementById(e).getAttribute("data-colors");
      if (t)
        return (t = JSON.parse(t)).map(function (e) {
          var t = e.replace(" ", "");
          return -1 === t.indexOf(",")
            ? getComputedStyle(document.documentElement).getPropertyValue(t) || t
            : 2 == (e = e.split(",")).length
            ? "rgba(" +
              getComputedStyle(document.documentElement).getPropertyValue(e[0]) +
              "," +
              e[1] +
              ")"
            : t;
        });
      console.warn("data-colors atributes not found on", e);
    }
  }
  function dynamic_load_chart_data(a,b,c,d){
    var dountchartUserDeviceColors = getChartColorsArray("dashboard_pie_charts1");
    (options = {
        series: [a, b, c, d],
        labels: ["Saved", "Submitted", "Approved","Rejected"],
        chart: { type: "donut", height: 219 },
        plotOptions: { pie: { size: 100, donut: { size: "76%" } } },
        dataLabels: { enabled: !1 },
        legend: {
          show: !1,
          position: "bottom",
          horizontalAlign: "center",
          offsetX: 0,
          offsetY: 0,
          markers: { width: 20, height: 6, radius: 2 },
          itemMargin: { horizontal: 12, vertical: 0 },
        },
        stroke: { width: 0 },
        yaxis: {
          labels: {
            formatter: function (e) {
              return e + " Projects";
            },
          },
          tickAmount: 4,
          min: 0,
        },
        colors: dountchartUserDeviceColors,
      }),
      (chart = new ApexCharts(
        document.querySelector("#dashboard_pie_charts1"),
        options
      )).render();
  }
  
    $(document).ready(function(){
       function load_chart_data_status(flag1) {
        var flagdata;
        $.ajax({
          url: "../assets/server/employee_ajax.php",
          method: "POST",
          async: false,
          data: { flag: "load_chart_data_status1",status : flag1},
          success: function (data) {
            flagdata = data;
            if(flag1 == "Submitted")
            {
              $("#total_comp_tasks").attr("data-target",data);
            }
          },
        });
        return flagdata;
      }
      async function load_chart_data(){
        var Saved =  load_chart_data_status("Saved");
        var Submitted =  load_chart_data_status("Submitted");
        var Approved =  load_chart_data_status("Approved");
        var Rejected =  load_chart_data_status("Rejected");
        dynamic_load_chart_data(
         parseInt(Saved),parseInt(Submitted),parseInt(Approved),parseInt(Rejected));
         var total = parseInt(Saved)+parseInt(Submitted)+parseInt(Approved)+parseInt(Rejected);
         $("#Saved").text(Math.round((parseInt(Saved)/parseInt(total))*100) + " %");
         $("#Submitted").text(Math.round((parseInt(Submitted)/parseInt(total))*100) + " %");
         $("#Approved").text(Math.round((parseInt(Approved)/parseInt(total))*100) + " %");
         $("#Rejected").text(Math.round((parseInt(Rejected)/parseInt(total))*100) + " %");
      }
      load_chart_data();
    })
  