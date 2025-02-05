'use strict'

const popUp=document.querySelector('.popup-container');

function showPopUp(){
  popUp.style.display='flex';
}

function exitPopUp(){
  popUp.style.display='none';
}
const menu = document.getElementById('quickMenu');

function openQuickMenu() {
  menu.style.transform='translateX(0)';
 
}
function closeQuickMenu() {
  menu.style.transform='translateX(-300px)';
}

function toggleNavbar() {
  if (window.innerWidth > 992) {
    menu.style.display='none';
  }
}
toggleNavbar();
window.addEventListener('resize', toggleNavbar);



