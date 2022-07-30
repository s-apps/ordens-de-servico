var loginForm = document.getElementById('login-form');
var erro = document.getElementById('erro');

loginForm.addEventListener('submit', function(event){
    event.preventDefault();
    var login = document.getElementById('login').value;
    var senha = document.getElementById('senha').value;
    var formData = new FormData();
    formData.append('login', login);
    formData.append('senha', senha)
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           if(request.responseText != ''){
              erro.textContent = request.responseText;
              return;
           }
           window.location.href = '/'; 
        }
    };
    request.open('POST', '/auth/entrar.php');
    request.send(formData);    
});