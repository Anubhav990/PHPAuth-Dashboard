"use strict"

let menuicon = document.querySelector(".menuicn");
let nav = document.querySelector(".navcontainer");

menuicon.addEventListener('click', () => {
    nav.classList.toggle("navclose");
})


function confirmDelete(user_id) {

    const confirmation = confirm("Are you sure you want to Delete this account from the record?");
    if (confirmation) {
        window.location.href = `deleteuser.php?user_id=${user_id}`;
    } else {
        console.log("error deleting");
    }
    // /delete-user.pho?user_id=3
}

function deleteRow(index) {
    // Logic to delete the row, e.g., make an AJAX call to delete the record from the database
    alert("Record" + index + "Deleted");
    // Implement AJAX call to delete the record from the database here
}

setTimeout(function () {
    const successMessage = document.querySelectorAll('.success-message-check');
    const errorMessage = document.querySelectorAll('.error-message-check');

    successMessage.forEach((message) => {
        message.style.display = 'none';
    });

    errorMessage.forEach((message) => {
        message.style.display = 'none';
    });

}, 5000);