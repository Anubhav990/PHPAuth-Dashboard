"use strict"

let menuicon = document.querySelector(".menuicn");
let nav = document.querySelector(".navcontainer");

menuicon.addEventListener('click', () => {
    nav.classList.toggle("navclose");
})

const form = document.getElementById('form');
const email = document.getElementById('email');


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

const validatePhoneNumber = (Pnumber) => {
    // Stricter regex to ensure realistic phone numbers
    const phoneRegex = /^(\+?\d{1,3}[-.\s]?)?(\(?\d{1,4}\)?[-.\s]?)?\d{3,4}[-.\s]?\d{4}$/;
    return phoneRegex.test(Pnumber);
}

const validateInputs = () => {

    let isValid = true;

    const fnameValue = fname.value.trim();
    const lnameValue = lname.value.trim();
    const PnumberValue = Pnumber.value.trim();
    const companyNameValue = Company_Name.value.trim();
    const bestTimeValue = best_time_to_contact.value;
    const emailValue = email.value.trim();

    // Validate first name
    if (fnameValue === '') {
        setError(fname, 'First name cannot be empty');
        isValid = false;
    } else {
        isValid = true;
        setSuccess(fname);
    }

    // Validate last name
    if (lnameValue === '') {
        setError(lname, 'Last name cannot be empty');
        isValid = false;
    } else {
        setSuccess(lname);
    }

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

    // Validate phone number
    if (PnumberValue === '') {
        setError(Pnumber, 'Phone number cannot be empty');
        isValid = false;
    } else if (!validatePhoneNumber(PnumberValue)) {
        setError(Pnumber, 'Please enter a valid phone number');
        isValid = false;
    } else {
        setSuccess(Pnumber);
    }

    // Validate company name
    if (companyNameValue === '') {
        setError(Company_Name, 'Company name cannot be empty');
        isValid = false;
    } else {
        setSuccess(Company_Name);
    }

    // Validate best time to contact
    if (bestTimeValue === 'Best Time To Contact') {
        setError(best_time_to_contact, 'Please select a time slot to contact');
        isValid = false;
    } else {
        setSuccess(best_time_to_contact);
    }

    return isValid;

};