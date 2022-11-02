

let  mainUrl = "http://localhost/";

// ================check if admin already loged in================
let id = localStorage.getItem("id");

// fetch(`${mainUrl}login.php`, {
//     method: 'POST',
//     body: JSON.stringify({"token": adminToken})
// }).then(response => response.json())
//     .then(apiData => {
//         if (apiData.status == 1) {
//             window.open('./home.html', '_self');
//         }
//     });

// ===============loin in manualy==============
let loginError = document.getElementById('login-error');
let emailInput = document.getElementById('email-input');
let passwordInput = document.getElementById('password-input');
let btnLogin = document.getElementById('btn-login');

btnLogin.addEventListener('click', () => {

    loginError.textContent = '';
    if (emailInput.value.trim().length < 1) {
        loginError.textContent = 'Merci de saisir votre Email';
        return false;
    }
    if (emailInput.value.search('@') == -1) {
        loginError.textContent = 'Merci de saisir a valid Email';
        return false;
    }
    if (emailInput.value.search(".") == -1) {
        loginError.textContent = 'Merci de saisir a valid Email';
        return false;
    }
    if (passwordInput.value.trim().length < 1) {
        loginError.textContent = 'Merci de saisir le mot de pass';
        return false;
    }
    if (passwordInput.value.trim().length < 6) {
        loginError.textContent = 'Password doit etre plus de 6 characters';
        return false;
    }

    let info = {
        "email": emailInput.value.trim(),
        "password": passwordInput.value.trim()
    };
    fetch(`${mainUrl}/messanger/login.php`, {
        method: 'POST',
        body: JSON.stringify(info)
    }).then(response => response.json())
        .then(apiData => {
            console.log(apiData);
            if (apiData.status == 1) {
                localStorage.setItem('id', apiData.id);
                window.location.href = './index.php';
            } else if (apiData.status == 0) {
                loginError.textContent = 'Email or password is wrong';
            }
        });

});


