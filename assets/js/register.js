const user = document.getElementById("username");
const pass = document.getElementById("password");
const confpass = document.getElementById("confirm-password");
const fname = document.getElementById("firstname");
const lname = document.getElementById("lastname");
const email = document.getElementById("email");
const btn = document.getElementById("register");

function isValidEmail(emailValue) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(emailValue);
}

function checkInput() {
    const inputsFilled = fname.value.trim() !== "" &&
                        lname.value.trim() !== "" &&
                        email.value.trim() !== "" &&
                        user.value.trim() !== "" &&
                        pass.value.trim() !== "" &&
                        confpass.value.trim() !== "";

    const validEmail = isValidEmail(email.value.trim());

    if (!validEmail && email.value.trim() !== "") {
        email.classList.add("invalid");
    } else {
        email.classList.remove("invalid");
    }

    if (inputsFilled && validEmail) {
        btn.disabled = false;
    } else {
        btn.disabled = true;
    }
}

fname.addEventListener("input", checkInput);
lname.addEventListener("input", checkInput);
email.addEventListener("input", checkInput);
user.addEventListener("input", checkInput);
pass.addEventListener("input", checkInput);
confpass.addEventListener("input", checkInput);