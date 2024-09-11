"use strict"

const form = document.getElementById('form');
const email = document.getElementById('email');
const password = document.getElementById('password');

form.addEventListener('submit', e => {
    e.preventDefault();
    const isValid = validateInputs();
    if (isValid) {
        form.submit();
    }
})

const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error-message');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success');
}

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error-message');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
}

const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

const validateInputs = () => {

    let isValid = true;

    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();

    // Validate Email

    if (emailValue === '') {
        setError(email, 'Email cannot be empty');
        isValid = false;
    } else if (!isValidEmail(emailValue)) {
        setError(email, 'Provide a valid email address');
        isValid = false;
    } else {
        setSuccess(email)
    }

    //Validate the Password

    if (passwordValue === '') {
        setError(password, 'Password cannot be empty');
        isValid = false;
    } else if (passwordValue.length < 8) {
        setError(password, 'Password must be atleat 8 characters');
        isValid = false;
    } else {
        setSuccess(password);
    }

    return isValid;

};