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
function dynamic_load_chart_data(a,b,c,d,e,f){
  var dountchartUserDeviceColors = getChartColorsArray("dashboard_pie_charts");
  (options = {
      series: [a, b, c,d,e,f],
      labels: ["Started", "On Hold", "In Progress","Cancelles","Completed","Deffered"],
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
      document.querySelector("#dashboard_pie_charts"),
      options
    )).render();
}


  $(document).ready(function(){
     function load_chart_data_status(flag1) {
      // alert();
      var flagdata;
      $.ajax({
        url: "../assets/server/ajax.php",
        method: "POST",
        async: false,
        data: { flag: "load_chart_data_status",status : flag1},
        success: function (data) {
          // alert();
          flagdata = data;
        },
      });
      
      return flagdata;
    }
    async function load_chart_data(){
      // var success = load_chart_data_status("Started");
      var success =  load_chart_data_status("Started");
      var onhold =  load_chart_data_status("onhold");
      var inprogress =  load_chart_data_status("inprogress");
      var cancelled =  load_chart_data_status("cancelled");
      var completed =  load_chart_data_status("completed");
      var deffered =  load_chart_data_status("deffered");
      dynamic_load_chart_data(
       parseInt(success),parseInt(onhold),parseInt(inprogress),parseInt(cancelled),parseInt(completed),parseInt(deffered));
       var total = parseInt(success)+parseInt(onhold)+parseInt(inprogress)+parseInt(cancelled)+parseInt(completed)+parseInt(deffered);
       $("#star").text(Math.round((parseInt(success)/parseInt(total))*100) + " %");
       $("#hold").text(Math.round((parseInt(onhold)/parseInt(total))*100) + " %");
       $("#prog").text(Math.round((parseInt(inprogress)/parseInt(total))*100) + " %");
       $("#can").text(Math.round((parseInt(cancelled)/parseInt(total))*100) + " %");
       $("#comp").text(Math.round((parseInt(completed)/parseInt(total))*100) + " %");
       $("#deff").text(Math.round((parseInt(deffered)/parseInt(total))*100) + " %");
    }
    load_chart_data();
  })
