

let mainUrl = "http://localhost";

// =============================

// let loginError = document.getElementById('login-error');
let users = document.getElementById('users');

let btnCancelSearch = document.getElementById('btn-cancel-search');
let inputSearch = document.getElementById('input-search');

btnCancelSearch.addEventListener("click", () => {
    inputSearch.value = '';
    getSearchUsers('');
})
inputSearch.addEventListener("keyup", () => {

    users.innerHTML = ` <i class="fas fa-spinner fa-pulse loading"></i>`;

    getSearchUsers(inputSearch.value.trim());

})



getSearchUsers('');


async function getSearchUsers(text) {
    await fetch(`${mainUrl}/messanger/userSearch.php`, {
        method: 'POST',
        body: JSON.stringify(
            {
                "id":  localStorage.getItem("id"),
                "text": text
            }
        )
    }).then(response => response.json())
        .then(apiData => {
            let template = ``;
            // console.log(apiData);
            if (apiData.status == 1) {
                for (let i = 0; i < apiData.data.length; i++) {
                    const item = apiData.data[i];
                    if (item[2] != 0) {
                        // noProfile
                        template += `
                        <div class="user-item">
                            <div class="img" style="background: url('${item[2]}');">
                            </div>
                            <p class="name">
                                ${item[1]}
                            </p>
                            <a href="./messanger.php?id=${item[0]}">
                                Send message
                            </a>
                        </div>
                    `
                    }else{
                        template += `
                        <div class="user-item">
                            <div class="img" style="background: url('./img/noProfile.png');">
                            </div>
                            <p class="name">
                                ${item[1]}
                            </p>
                            <a href="./messanger.php?id=${item[0]}">
                                Send message
                            </a>
                        </div>
                    `
                    }
                }

            }else if( apiData.status == -1){
                template = `
                    <h4 style="text-align:center;padding:10px;">
                        No data to display
                    </h4>`;
            }else{
                template = `
                <h4 style="text-align:center;padding:10px;color:red;">
                    Oops ! . Somthing went wrong
                </h4>`;
            }
            users.innerHTML = template;


        })
}
