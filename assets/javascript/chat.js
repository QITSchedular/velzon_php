$(document).ready(function () {
	
	// $('.conversation').scrollTop($('.conversation')[0].scrollHeight);
	// $(".conversation").animate({ scrollTop: $('.conversation').prop("scrollHeight")}, 1000);
	// $(window).load(function() {
	// 	$(".conversation").animate({ scrollTop: $(document).height() }, 1000);
	//   });
  //   var objDiv = $("#chat-conversation");
  //   var h = objDiv.get(0).scrollHeight;
  //   objDiv.animate({ scrollTop: h });
  
	$(document).on("mouseenter ", ".show-image", function () {
	  var id = $(this).attr("id");
	  $(".chatid" + id).css("display", "block");
	  // alert(id);
	});
  
	setInterval(function () {
		$("#show_unread_message").load(location.href + " #show_unread_message");
		updateUserList();
		updateUnreadMessageCount();
		showTypingStatus();
		updateUserChat();
	}, 5000);
	
	$(document).on("click", "#profile-img", function (event) {
	  $("#status-options").toggleClass("active");
	});
	$(document).on("click", ".expand-button", function (event) {
	  $("#profile").toggleClass("expanded");
	  $("#contacts").toggleClass("expanded");
	});
	$(document).on("click", "#status-options ul li", function (event) {
	  $("#profile-img").removeClass();
	  $("#status-online").removeClass("active");
	  $("#status-away").removeClass("active");
	  $("#status-busy").removeClass("active");
	  $("#status-offline").removeClass("active");
	  $(this).addClass("active");
	  if ($("#status-online").hasClass("active")) {
		$("#profile-img").addClass("online");
	  } else if ($("#status-away").hasClass("active")) {
		$("#profile-img").addClass("away");
	  } else if ($("#status-busy").hasClass("active")) {
		$("#profile-img").addClass("busy");
	  } else if ($("#status-offline").hasClass("active")) {
		$("#profile-img").addClass("offline");
	  } else {
		$("#profile-img").removeClass();
	  }
	  $("#status-options").removeClass("active");
	});
	$(document).on("click", ".contact", function () {
	  $(".contact").removeClass("active");
	  $(this).addClass("active");
	  var to_user_id = $(this).data("touserid");
	  showUserChat(to_user_id);
	  $(".chatMessage").attr("id", "chatMessage" + to_user_id);
	  $(".chatButton").attr("id", "chatButton" + to_user_id);
	});
	$(document).on("click", ".submit", function (event) {
	  var to_user_id = $(this).attr("id");
	  to_user_id = to_user_id.replace(/chatButton/g, "");
	  sendMessage(to_user_id);
	});
	$(document).on("focus", ".message-input", function () {
	  var is_type = "yes";
	  $.ajax({
		url: "../assets/server/chat_action.php",
		method: "POST",
		data: { is_type: is_type, action: "update_typing_status" },
		success: function () {},
	  });
	});
	$(document).on("blur", ".message-input", function () {
	  var is_type = "no";
	  $.ajax({
		url: "../assets/server/chat_action.php",
		method: "POST",
		data: { is_type: is_type, action: "update_typing_status" },
		success: function () {},
	  });
	});
  });

  function updateUserList() {
	$.ajax({
	  url: "../assets/server/chat_action.php",
	  method: "POST",
	  dataType: "json",
	  data: { action: "update_user_list" },
	  success: function (response) {
		var obj = response.profileHTML;
		Object.keys(obj).forEach(function (key) {
		  // update user online/offline status
		  if ($("#" + obj[key].userid).length) {
			if (
			  obj[key].online == 1 &&
			  !$("#status_" + obj[key].userid).hasClass("online")
			) {
			  $("#status_" + obj[key].userid).addClass("online");
			} else if (obj[key].online == 0) {
			  $("#status_" + obj[key].userid).removeClass("online");
			}
		  }
		});
	  },
	});
  }

  function sendMessage(to_user_id) {
	message = $(".message-input input").val();
	$(".message-input input").val("");
	if ($.trim(message) == "") {
	  return false;
	}
	var objDiv = $(".chat-conversation");
	var h = objDiv.get(0).scrollHeight;
	objDiv.animate({ scrollTop: h });
	$.ajax({
	  url: "../assets/server/chat_action.php",
	  method: "POST",
	  data: {
		to_user_id: to_user_id,
		chat_message: message,
		action: "insert_chat",
	  },
	  dataType: "json",
	  success: function (response) {
		updateUserChat();
		updateUnreadMessageCount();
		var resp = $.parseJSON(response);
		$(".conversation").html(resp.conversation);
		showUserChat(to_user_id);	 
	  },
	});
  }

  $(".user-chat-remove").on("click",function(){
	$(".user-chat").attr(
		"class",
		"user-chat w-100 overflow-hidden"
	  );
  })

  function showUserChat(to_user_id) {
	$(".user-chat").attr(
	  "class",
	  "user-chat user-chat-show w-100 overflow-hidden"
	);
	$("#m_part").show();
	$("#m_part1").hide();
	$("#show_unread_message").load(location.href + " #show_unread_message");
	$.ajax({
	  url: "../assets/server/chat_action.php",
	  method: "POST",
	  data: { to_user_id: to_user_id, action: "show_chat" },
	  dataType: "json",
	  success: function (response) {
		$("#userSection").html(response.userSection);
		$(".conversation").html(response.conversation);
		$("#unread_" + to_user_id).html("");
  
		var objDiv = $(".chat-conversation");
		var h = objDiv.get(0).scrollHeight;
		objDiv.animate({ scrollTop: h });
	  },
	});
  }

  function updateUserChat() {
	$("div.contact.active").each(function () {
	  var to_user_id = $(this).attr("data-touserid");
	  $.ajax({
		url: "../assets/server/chat_action.php",
		method: "POST",
		data: { to_user_id: to_user_id, action: "update_user_chat" },
		dataType: "json",
		success: function (response) {
		  $(".conversation").html(response.conversation);
		},
	  });
	});
  }

  function updateUnreadMessageCount() {
	$("div.contact").each(function () {
	  if (!$(this).hasClass("active")) {
		var to_user_id = $(this).attr("data-touserid");
		$.ajax({
		  url: "../assets/server/chat_action.php",
		  method: "POST",
		  data: { to_user_id: to_user_id, action: "update_unread_message" },
		  dataType: "json",
		  success: function (response) {
			console.log(response);
			if (response.count) {
			  $("#unread_" + to_user_id).html(response.count);
			//   $("#divunread_"+ to_user_id).load(location.href + " #divunread_"+ to_user_id);
			}
		  },
		});
	  }
	});
  }

  function showTypingStatus() {
	$("div.contact.active").each(function () {
	  var to_user_id = $(this).attr("data-touserid");
	  $.ajax({
		url: "../assets/server/chat_action.php",
		method: "POST",
		data: { to_user_id: to_user_id, action: "show_typing_status" },
		dataType: "json",
		success: function (response) {
		  $("#isTyping_" + to_user_id).html(response.message);
		},
	  });
	});
  }
  
  $(document).on("click", ".delmessage", function () {
	var id = $(this).attr("id");
	$.ajax({
	  url: "../assets/server/chat_action.php",
	  method: "POST",
	  data: { id: id, action: "delete_chat_message" },
	  dataType: "json",
	  success: function (response) {
		  updateUserChat();
	  },
	});
  });
  
  function f1() {
	$.ajax({
	  url: "../assets/server/chat_action.php",
	  method: "POST",
	  data: { action: "reassign_user" },
	  success: function (response) {
		$("#m_part").hide();
	  },
	});
  }
  f1();
  
 