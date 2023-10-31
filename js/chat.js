const form = document.querySelector('.form'),
submitbtn = form.querySelector('.submit'),
errortxt = form.querySelector('.error-text');

form.onsubmit = (e) =>{
    e.preventDefault();            //stops the default action
    // start ajax

    let xhr = new XMLHttpRequest(); // create xml object
    xhr.open("POST","./php/chat.php",true);
    xhr.onload = () =>{

        if(xhr.readyState === XMLHttpRequest.DONE){
            console.log(xhr);

            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "200"){
                window.location.reload();
                }
            }
        }

    }
    // send data through ajax to php
    let formData = new FormData(form); //creating new object from form data
    xhr.send(formData);  //sending data to php

}
