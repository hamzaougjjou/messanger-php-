let mainUrl = "http://localhost/";


let btnLogOut = document.getElementById('btn-log-out');
let userItemContainer = document.getElementById('user-item-container');


btnLogOut.addEventListener("click", function () {
    localStorage.removeItem('id');
    window.location.href = 'logout.php';
})


fetch(`${mainUrl}/messanger/userInfo.php`, {
    method: 'POST',
    body: JSON.stringify(
        {
            "id": localStorage.getItem('id')
        }
    )
}).then(response => response.json())
    .then(apiData => {
        let template = ``;
        // console.log(apiData);
        if (apiData.status == 1) {

            if (apiData.data[3] == 0) {
                template = `
                    <div class="user-item">
                        <img src="./img/noProfile.png" alt="user profilr" srcset="">
                        <div class="desc-user">
                            <label for="">Full Name : </label>
                            <p class="name">
                                ${apiData.data[1]}
                            </p>
                            <label for="">Email : </label>
                            <p class="email">
                            ${apiData.data[2]}
                            </p>
                        </div>
                    </div>
            `;
            } else {
                template = `
                        <div class="user-item">
                            <img src="${apiData.data[3]}" alt="user profilr" srcset="">
                            <div class="desc-user">
                                <label for="">Full Name : </label>
                                <p class="name">
                                    ${apiData.data[1]}
                                </p>
                                <label for="">Email : </label>
                                <p class="email">
                                ${apiData.data[2]}
                                </p>
                            </div>
                        </div>
                `;
            }//else

            userItemContainer.innerHTML = template;
        }

    }); //fetch
