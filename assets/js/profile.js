const fname = document.getElementById("firstname");
const lname = document.getElementById("lastname");
const btn = document.getElementById("save");

var flag = "";

function checkInputs() {
    const inputsFilled = fname.value.trim() !== "" &&
                        fname.value.trim() !== "";

    if (flag !== "") {
        if (inputsFilled) {
            btn.disabled = false;
        } else {
            btn.disabled = true;
        }
    }    

}

function editName(input) {
    if (input === 'firstname') {
        flag = 1;
        fname.disabled = false;
        fname.classList.add('valid');
        checkInputs();
    } else {
        flag = 1;
        lname.disabled = false;
        lname.classList.add('valid');
        checkInputs();
    }
}

fname.addEventListener("input", checkInputs);
lname.addEventListener("input", checkInputs);

// ADDRESS SECTION

const province = document.getElementById('province');
const city = document.getElementById('city');
const barangay = document.getElementById('barangay');
const postal = document.getElementById('postal');
const street = document.getElementById('street');
const edit = document.getElementById('edit');
const save = document.getElementById('address-save');

function checkAddress() {
    const inputsFilled = province.value.trim() !== "" &&
                        city.value.trim() !== "" &&
                        barangay.value.trim() !== "" &&
                        postal.value.trim() !== "" &&
                        street.value.trim() !== "";

    if (inputsFilled) {
        save.disabled = false;
    } else {
        save.disabled = true;
    }
}

function editAddress() {
    province.disabled = false;
    city.disabled = false;
    barangay.disabled = false;
    postal.disabled = false;
    street.disabled = false;
}

document.addEventListener('DOMContentLoaded', () => {
    const message = document.querySelector('.status-message');
    const errorMessage = document.querySelector('.error-message');
    if (message) {
        setTimeout(() => {
            message.classList.add('hidden');
            setTimeout(() => message.remove(), 500);
        }, 3000);
    } else if (errorMessage) {
        setTimeout(() => {
            errorMessage.classList.add('hidden');
            setTimeout(() => errorMessage.remove(), 500);
        }, 3000);
    }
});

province.addEventListener("input", checkAddress);
city.addEventListener("input", checkAddress);
barangay.addEventListener("input", checkAddress);
postal.addEventListener("input", checkAddress);
street.addEventListener("input", checkAddress);

// ACCOUNT SECTION

const email = document.getElementById("email");
const emailBTN = document.getElementById("email-save");

function editEmail() {
    email.disabled = false;
}

function isValidEmail(emailValue) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(emailValue);
}

function checkEmail() {
    const emailFilled = email.value.trim() !== "";
    const validEmail = isValidEmail(email.value.trim());

    if (!validEmail && !emailFilled) {
        email.classList.add("invalid");
        emailBTN.disabled = true;
    } else if (validEmail && emailFilled) {
        email.classList.remove("invalid");
        emailBTN.disabled = false;
    }
}

email.addEventListener("input", checkEmail);

// CONTACT SECTION

const number = document.getElementById('contact');
const contactBTN = document.getElementById('contact-save');

function editContact() {
    number.disabled = false;
}

function isValidContact(contactValue) {
    const validPattern = /^09\d{9}$/;

    return validPattern.test(contactValue);
}

function checkContact() {
    const contactFilled = number.value.trim() !== "";
    const validContact = isValidContact(number.value.trim());
    
    if (!validContact && !contactFilled) {
        number.classList.add("invalid");
        contactBTN.disabled = true;
    } else if (validContact && contactFilled) {
        number.classList.remove("invalid");
        contactBTN.disabled = false;
    }
}

number.addEventListener("input", checkContact);

// PASSWORD SECTION

const oldpass = document.getElementById('old-password');
const newpass = document.getElementById('new-password');
const confpass = document.getElementById('confirm-password');
const passBTN = document.getElementById('password-save');

function checkPassword() {
    const passwordFilled = oldpass.value.trim() !== "" &&
                        newpass.value.trim() !== "" &&
                        confpass.value.trim() !== "";

    if (!passwordFilled) {
        passBTN.disabled = true;
    } else {
        passBTN.disabled = false;
    }
}

oldpass.addEventListener("input", checkPassword);
newpass.addEventListener("input", checkPassword);
confpass.addEventListener("input", checkPassword);