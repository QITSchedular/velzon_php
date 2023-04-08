
  new FgEmojiPicker({
    trigger: [".emoji-btn"],
    removeOnSelection: !1,
    closeButton: !0,
    position: ["top", "right"],
    preFetch: !0,
    dir: "../assets/js/pages/plugins/json",
    insertInto: document.querySelector(".chat-input"),
  });
  document.getElementById("emoji-btn").addEventListener("click", function () {
    
    setTimeout(function () {
      var e,
        t = document.getElementsByClassName("fg-emoji-picker")[0];
      t &&
        (e = window.getComputedStyle(t)
          ? window.getComputedStyle(t).getPropertyValue("left")
          : "") &&
        ((e = e.replace("px", "")), (t.style.left = e = e - 40 + "px"));
    }, 0);
  });

