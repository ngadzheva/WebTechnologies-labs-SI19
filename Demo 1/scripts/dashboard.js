(function(){
    ajax("src/user.php", {method: "GET"});

    var logoutBtn = document.getElementById("logout");
    logoutBtn.addEventListener("click", logout);
})();

function ajax(url, settings, isLogout) {
    var request = new XMLHttpRequest();

    request.onload = function() {
        if(request.status === 200) {
            if(isLogout){
                window.location = "index.html";
            } else {
                load(JSON.parse(request.responseText));
            }
        } else {
            console.log(request.responseText);
        }
    }

    request.open(settings.method, url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send();
}

function load(response) {
    var userInfo = document.getElementById("user");

    if(response.success) {
        userInfo.innerHTML = `User: ${response.data}`;
    } else {
        console.log(response.data);
    }
}

function logout(event) {
    event.preventDefault();

    ajax("src/logout.php", {method: "GET"}, true);
}