var myModalEl,
  scroll,
  addNewBoard,
  addMember,
  profileField,
  reader,
  tasks_list = [
    document.getElementById("unassigned-task"),
    document.getElementById("todo-task"),
    document.getElementById("inprogress-task"),
    document.getElementById("reviews-task"),
    document.getElementById("completed-task"),
    document.getElementById("new-task"),
  ];
function noTaskImage() {
  Array.from(document.querySelectorAll("#kanbanboard .tasks-list")).forEach(
    function (e) {
      0 < e.querySelectorAll(".tasks-box").length
        ? e.querySelector(".tasks").classList.remove("noTask")
        : e.querySelector(".tasks").classList.add("noTask");
    }
  );
}
function taskCounter() {
  (task_lists = document.querySelectorAll("#kanbanboard .tasks-list")) &&
    Array.from(task_lists).forEach(function (e) {
      (tasks = e.getElementsByClassName("tasks")),
        Array.from(tasks).forEach(function (e) {
          (task_box = e.getElementsByClassName("tasks-box")),
            (task_counted = task_box.length);
        }),
        (badge = e.querySelector(".totaltask-badge").innerText = ""),
        (badge = e.querySelector(".totaltask-badge").innerText = task_counted);
    });
}
tasks_list &&
  (  (drake = dragula(tasks_list)
    
    .on("drop", function (e) {
      e.className += " ex-moved";
      
      // alert(e.id + "  " + e.className );
      // alert(e.id);
      // alert($("#"+e.id).parent().attr('id'));
      var status=$("#"+e.id).parent().attr('id');
      update_task(e.id,status)
      // alert( e.id.parent().attr('class'));
      // alert($(e.id).parent());
      // console.log($(e.id).parent());
      
    })
   
    ),
  (kanbanboard = document.querySelectorAll("#kanbanboard")) &&
    (scroll = autoScroll([document.querySelector("#kanbanboard")], {
      margin: 20,
      maxSpeed: 100,
      scrollWhenOutside: !0,
      autoScroll: function () {
        return this.down && drake.dragging;
      },
    })),
  (addNewBoard = document.getElementById("addNewBoard")) &&
    document
      .getElementById("addNewBoard")
      .addEventListener("click", newKanbanbaord)) &&
  (document.getElementById("addMember").addEventListener("click", newMemberAdd),
  (profileField = document.getElementById("profileimgInput")),
  (reader = new FileReader()),
  profileField.addEventListener("change", function (e) {
    reader.readAsDataURL(profileField.files[0]),
      (reader.onload = function () {
        var e = reader.result;
        localStorage.setItem(
          "kanbanboard-member",
          '<img src="' + e + '" alt="profile" class="rounded-circle avatar-xs">'
        );
      });
  }));


  function update_task(id,status)
  {
    if(status=="todo-task")
    {
      status1="todo";
    }
    else if(status=="unassigned-task")
    {
      status1="unassigned";
    }
    else if(status=="inprogress-task")
    {
      status1="inprogress";
    }
    else if(status=="reviews-task"){
      status1="reviews";
    }
    else if(status=="completed-task"){
      status1="completed";
    }

    $.ajax({
      url: "../assets/server/ajax.php",
      method: "POST",
      data: {
        flag: "update_kanban_cards",
        id:id,
        status : status1,
      },
      success: function (data) {
        // alert(data);
        dynamic_load_kanban_cards_count_by_project("unassigned");
        dynamic_load_kanban_cards_count_by_project("todo");
        dynamic_load_kanban_cards_count_by_project("inprogress");
        dynamic_load_kanban_cards_count_by_project("reviews");
        dynamic_load_kanban_cards_count_by_project("completed");

        // alert(data);
        // $(".unassigned-task").html(data);
        // $("."+id_url).html(data);
      },
    });
  }


  
// kanban cards count load
function dynamic_load_kanban_cards_count_by_project(status1) {
    $.ajax({
        url: "../assets/server/ajax.php",
        method: "POST",
        data: {
            flag: "dynamic_load_kanban_cards_count_by_project",
            status: status1,
        },
        success: function(data) {
            $("." + status1).html(data);
        },
    });
}

dynamic_load_kanban_cards_count_by_project("unassigned");
dynamic_load_kanban_cards_count_by_project("todo");
dynamic_load_kanban_cards_count_by_project("inprogress");
dynamic_load_kanban_cards_count_by_project("reviews");
dynamic_load_kanban_cards_count_by_project("completed");


