const form = document.querySelector('.form'),
submitbtn = form.querySelector('.submit');

form.onsubmit = (e) =>{
    e.preventDefault();            //stops the default action

}      
 

submitbtn.onclick = () =>{
    // start ajax

    let xhr = new XMLHttpRequest(); // create xml object
    xhr.open("POST","./php/editProfile.php",true);
    xhr.onload = () =>{

        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
                if(data=="200"){
                    alert("Edited Successfully")
                    window.location.reload()
                }
            }
        }

    }
    // send data through ajax to php
    let formData = new FormData(form); //creating new object from form data
    xhr.send(formData);  //sending data to php

}

