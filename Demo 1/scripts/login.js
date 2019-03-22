(function() {
    var login = document.getElementById('login');

    login.addEventListener('click', sendForm);
})();

function sendForm(event) {
    event.preventDefault();

    var userName = document.getElementById('user-name').value;
    var password = document.getElementById('password').value;

    var user = {
        userName: userName,
        password: password
    };

    ajax('login.php', {method: 'POST', data: `data=${JSON.stringify(user)}`});
} 

function ajax(url, settings) {
    var request = new XMLHttpRequest();

    request.onload = function() {
        if(request.status === 200) {
            load(JSON.parse(request.responseText));
        } else {
            console.log(request.responseText);
        }
    }

    request.open(settings.method, url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(settings.data);
}

function load(response) {
    if(response.success) {
        window.location = "dashboard.html";
    } else {
        var label = document.createElement("label");
        label.innerHTML = response.data;
        label.setAttribute("id", "errors");
        document.getElementById("login-form").appendChild(label);
    }
}