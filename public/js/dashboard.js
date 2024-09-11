"use strict"

let menuicon = document.querySelector(".menuicn");
let nav = document.querySelector(".navcontainer");

menuicon.addEventListener('click', () => {
    nav.classList.toggle("navclose");
})