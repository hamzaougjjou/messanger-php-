



function checkLogin(url, redirect, isLogIn) {
    let id = localStorage.getItem("id");
    if (id == null) {
        id = "asfscdfsvdfgvedf76698gvedfcv"
    }
    fetch(`http://localhost/messanger/checkLogin.php`, {
        method: 'POST',
        body: JSON.stringify(
            {
                "id": id
            }
        )
    }).then(response => response.json())
        .then(apiData => {
            // console.log(apiData);
            if (apiData.status == 1) {
                if (redirect) {
                    window.location.href = url;
                }
            } else {
                if (!isLogIn) {
                    window.location.href = "./login.php";
                }

            }
        });
}

