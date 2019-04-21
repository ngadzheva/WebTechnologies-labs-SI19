(function() {
    fetch('https://jsonplaceholder.typicode.com/users', { method: 'GET'})
    .then(response => response.json())
    .then((data) => {
        document.getElementById('users').innerHTML = JSON.stringify(data);
    }).catch((error) => {
        console.log('Request failed', error);
    });
}());