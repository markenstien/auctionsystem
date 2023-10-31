let menu = document.querySelector('#menu-bar');
let navbar = document.querySelector('.navbar');

menu.onclick = () =>{

  menu.classList.toggle('fa-times');
  navbar.classList.toggle('active');

}

window.onscroll = () =>{

  menu.classList.remove('fa-times');
  navbar.classList.remove('active');

  if(window.scrollY > 60){
    document.querySelector('#scroll-top').classList.add('active');
  }else{
    document.querySelector('#scroll-top').classList.remove('active');
  }

}

function loader(){
  document.querySelector('.loader-container').classList.add('fade-out');
}

function fadeOut(){
  setInterval(loader, 3000);
}

window.onload = fadeOut();

function myFunction1() {
  document.getElementById("f1").style.fontFamily = "Garamond";
  document.getElementById("f2").style.fontFamily = "Garamond";
}

function myFunction2() {
  document.getElementById("f1").style.fontFamily = "Georgia";
  document.getElementById("f2").style.fontFamily = "Georgia";
}

function myFunction3() {
  document.getElementById("f1").style.fontFamily = "Arial";
  document.getElementById("f2").style.fontFamily = "Arial";
}

function myFunction4() {
  document.getElementById("f1").style.fontSize = "Small";
  document.getElementById("f2").style.fontSize = "Small";
}

function myFunction5() {
  document.getElementById("f1").style.fontSize = "14px";
  document.getElementById("f2").style.fontSize = "14px";
}

function myFunction6() {
  document.getElementById("f1").style.fontSize = "Medium";
  document.getElementById("f2").style.fontSize = "Medium";
}