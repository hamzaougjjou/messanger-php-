var msgsContainer = document.getElementById("msgs-container");
let ii = 1;
let scrollDown = true;
function showUser(id) {
    xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            let template = ""
            ////////////////////////////////////////////////////////////////////////
            data.forEach(msg => {
                if (msg.reciverId == id) {

                    template += `<div class="full-msg">
                                    <div class="msg-container msg-send-container">
                                        <p class="mgs-content">    
                                            ${msg.content}
                                        </p>
                                        <div class="mgs-info">
                                            <p class="msg-read">read</p>
                                            <p class="msg-date">21/4/22 11:35</p>
                                        </div>
                                    </div>
                                </div>
                                `;
                } else {
                    template += `<div class="full-msg">
                                    <div class="msg-container msg-recived-container">
                                        <p class="mgs-content">    
                                            ${msg.content}
                                        </p>
                                        <div class="mgs-info">
                                            <p class="msg-read">read</p>
                                            <p class="msg-date">21/4/22 11:35</p>
                                        </div>
                                    </div>
                                </div>
                                `;
                }
            });

            msgsContainer.innerHTML = template;
            // if (scrollDown==true) {
                msgsContainer.scrollTop = msgsContainer.scrollHeight;
            // } 
            ////////////////////////////////////////////////////////////////////////
        }
    };
    xmlhttp.open("GET", "getMessages.php?id=" + id, true);
    xmlhttp.send();
}
msgsContainer.onscroll = function () {
    if (this.scrollTop < this.scrollHeight - 400) {
        scrollDown = false;
    } else {
        scrollDown = true;
    }
}

showUser(reciverId);
// msgsContainer.scrollTop = msgsContainer.scrollHeight;
setInterval(() => {
    showUser(reciverId);

}, 3000);




