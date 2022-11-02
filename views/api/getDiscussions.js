

let mainUrl = "http://localhost";

// ================check if admin already loged in================
let id = localStorage.getItem("id");


// ===============loin in manualy==============
// let loginError = document.getElementById('login-error');
let discussionsItems = document.getElementById('discussions-items');

let inputSearch = document.getElementById('input-search');
inputSearch.addEventListener("keyup", () => {
    console.log(inputSearch.value.trim());
    // if (inputSearch.value.trim().length > 0) {
    getSearchDiscussion(inputSearch.value.trim());
    // }

})

async function getSearchDiscussion(text) {
    await fetch(`${mainUrl}/messanger/discussionSearch.php`, {
        method: 'POST',
        body: JSON.stringify(
            {
                "id": id,
                "text": text
            }
        )
    }).then(response => response.json())
        .then(apiData => {
            let template = ``;
            // console.log(apiData);
            if (apiData.status == 1) {
                for (let i = 0; i < apiData.data.length; i++) {
                    const element = apiData.data[i];
                    // publicApiData = apiData.data;

                    if (element[2] != 0) { // check user profile image exist
                        template += `
                            <div class="discussion-item">
                                <div class="photo" style="background-image: url('${element[2]}');">
                                    <div class="online"></div>
                                </div>
                                <div class="desc-contact">
                                    <p class="name">
                                    ${element[1]}
                                    </p>
                                    <!-- <p class="message">9 pm at the bar if possible 😳</p> -->
                                </div>
                                <!--<div class="timer">12 sec</div>-->
                            </div>
                        `;
                    } else {
                        template += `
                            <div class="discussion-item">
                                <div class="photo" style="background-image: url('./img/noProfile.png');">
                                    <div class="online"></div>
                                </div>
                                <div class="desc-contact">
                                    <p class="name">
                                    ${element[1]}
                                    </p>
                                    <!-- <p class="message">9 pm at the bar if possible 😳</p> -->
                                </div>
                                <!--<div class="timer">12 sec</div>-->
                            </div>
                        `;
                    }


                }

                discussionsItems.innerHTML = template;

                let discussion = document.getElementsByClassName("discussion-item");
                for (let i = 0; i < discussion.length; i++) {

                    const item = discussion[i];
                    item.addEventListener('click', function () {
                        // window.location.href = `messanger.php?id=${apiData.data[i][0]}`;  // this reloads

                        // change url without raloading page
                        window.history.pushState("", "", `messanger.php?id=${apiData.data[i][0]}`);
                        // for (let j = 0; j < discussion.length; j++) {
                        //     // discussion[j].classList.remove('message-active');

                        // }
                        // item.classList.add('message-active');
                        getMessages();

                    })
                }
            } else if (apiData.status == -1) { //no discussion
                discussionsItems.innerHTML = `
                    <h4 style="text-align:center;padding:10px;color:red;">
                        discussion not exist
                    </h4>`;
            }
            else if (apiData.status == 0) {
                discussionsItems.innerHTML = `
                    <h4 style="text-align:center;padding:10px;color:red;">
                        Somthin went wrong
                    </h4>`;
            }

        });

} // getSearchDiscussion ''

// var publicApiData = null;

getSearchDiscussion('');
getMessages();

async function getMessages() {
    let chat = document.querySelector('.chat');

    let messagesChat = document.querySelector('.messages-chat');
    const headerChat = document.querySelector('.header-chat');
    const footerChat = document.querySelector('.footer-chat');
    const noUserSelect = document.querySelector('.no-user-select');
    const userHeaderName = document.querySelector('#user-header-name');
    const headerIserImg = document.querySelector('#header-user-img');
    // You can get url_string from window.location.href if you want to work with
    // the URL of the current page
    var url_string = window.location.href;
    var url = new URL(url_string);
    var reciveUserId = url.searchParams.get("id");

    function errorMsg(myMsg) {
        headerChat.style.display = "none";
        messagesChat.style.display = "none";
        footerChat.style.display = "none";
        noUserSelect.style.display = "block";
        document.querySelector('#err-msg').textContent = myMsg;
    }
    if (reciveUserId == null) {
        errorMsg('select some one to send message');
    } else {
        headerChat.style.display = "grid";
        messagesChat.style.display = "block";
        footerChat.style.display = "block";
        noUserSelect.style.display = "none";

        await fetch(`${mainUrl}/messanger/getUserMessages.php`, {
            method: 'POST',
            body: JSON.stringify(
                {
                    "id": localStorage.getItem('id'),
                    "reciverId": reciveUserId
                }
            )
        }).then(response => response.json())
            .then(apiData => {
                let mgsTemplate = '';


                if (apiData.status == -2) {
                    errorMsg('invalid user id');
                }
                if (apiData.status == 1) {

                    //user name and photo
                    userHeaderName.textContent = apiData.data.user[1];
                    if (apiData.data.user[2] != 0) {
                        headerIserImg.src = apiData.data.user[2];
                    } else {
                        headerIserImg.src = './img/noProfile.png';
                    }
                    // console.log("=================");
                    // console.log(apiData.data.user);

                    for (let i = 0; i < apiData.data.messages.length; i++) {
                        const msg = apiData.data.messages[i];
                        
                        if (msg[2] == id) {
                            mgsTemplate += `
                                <div class="message message-send">
                                    <section>
                                        <div class="photo" style="background-image: url('./img/img1.jpg')">
                                            <!--<div class="online"></div>-->
                                        </div>
                                        <p class="text"> 
                                         ${msg[1]}
                                        </p>
                                    </section>
                                    <p class="time">
                                        ${msg[5].substr(0, 5)}
                                        ${msg[4].substr(0, 10)}
                                    </p>
                                </div>
                        `;
                        } else {
                            if (apiData.data.user[2] == 0)
                                userImg = './img/noProfile.png';
                            else
                                userImg = apiData.data.user[2];

                            mgsTemplate += `
                            <div class="message message-recived clearfix">
                                <section>
                                    <div class="photo" style="background-image: url('${userImg}')">
                                    </div>
                                    <p class="text"> 
                                    ${msg[1]}
                                    </p>
                                </section>
                                <p class="time">
                                    ${msg[5].substr(0, 5)}
                                    ${msg[4].substr(0, 10)}
                                </p>
                            </div>
                    `;
                        }


                    }
                    messagesChat.innerHTML = mgsTemplate;
                    messagesChat.scrollTop = messagesChat.scrollHeight;
                } else if (apiData.status == 0) {
                    alert("error");
                }

            });

    }
}

// send message
function sendMessage() {
    let btnSend = document.getElementById('btn-send');

    btnSend.addEventListener('click', async function () {
        let messageInput = document.getElementById('message-input');

        if (messageInput.value.trim().length != 0) {
            // You can get url_string from window.location.href if you want to work with
            // the URL of the current page
            var url_string = window.location.href;
            var url = new URL(url_string);
            var userId = url.searchParams.get("id");

            await fetch(`${mainUrl}/messanger/sendMessage.php`, {
                method: 'POST',
                body: JSON.stringify(
                    {
                        "message": messageInput.value.trim(),
                        "senderId": localStorage.getItem('id'),
                        "reciverId": userId
                    }
                )
            }).then(response => response.json())
                .then(apiData => {


                    if (apiData.status == 1) {
                        messageInput.value = "";
                        getMessages();
                        getSearchDiscussion('');
                    } else if (apiData.status == 0) {
                        alert("error");
                    }

                });
        } else {
        }



    })


}
sendMessage();

// reload messges
function reloadMessages() {
    // the URL of the current page
    var url_string = window.location.href;
    var url = new URL(url_string);
    var userId = url.searchParams.get("id");
    if (userId != null) {
        getMessages();
    }

    if (inputSearch.value.trim().length == 0) {
        getSearchDiscussion('');
    }
}
setInterval(() => {
    reloadMessages();
}, 5000);