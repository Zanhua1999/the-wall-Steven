function $(id) {
    return document.getElementById(id)
}

var upload_button = $("upload_button"),
    up = $("up");
document.getElementById("page").onclick = function () {
    up.style.display = "none";
    up.style.animationName = "flexGone";
    up.style.animationDuration = "0.5s";
}

upload_button.addEventListener('click', function (e) {
    stopFunc(e);
    up.style.display = "initial";
    up.style.animationName = "uploadFlex";
    up.style.webkitAnimationDuration = "0.5s";
}, false)
up.addEventListener('click', function (e) {
    stopFunc(e);
}, false)

function stopFunc(e) {
    e.stopPropagation ? e.stopPropagation() : e.cancelBubble = true;
}

function sortingNewToOld() {
    document.getElementById("content").style.flexDirection = "column";
    document.getElementById("new_to_old").style.display = "none";
    document.getElementById("old_to_new").style.display = "block";
}

function sortingOldToNew() {
    document.getElementById("content").style.flexDirection = "column-reverse";
    document.getElementById("old_to_new").style.display = "none";
    document.getElementById("new_to_old").style.display = "block";
}

function validateForm() {
    var a = document.forms["uploadForm"]["uploaded_image"].value;
    var b = document.forms["uploadForm"]["title"].value;
    if (a == "") {
        alert("No File Selected");
        return false;
    }
    if (b == "") {
        alert("Create a title for you post");
        return false;
    }
}

function nightLayout() {
    document.getElementById("particles-js").style.backgroundColor = "#262626";
    document.getElementById("night").style.display = none;
}

function dayLayout() {
    document.getElementById("day").style.display = none;
}