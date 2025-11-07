const email = document.getElementById("email");
const btn = document.getElementById("search");

function isValidEmail(emailValue) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(emailValue);
}

function checkInput() {
    const inputFilled = email.value.trim() !== "";
    
    const validEmail = isValidEmail(email.value.trim());

    if (!validEmail && email.value.trim() !== "") {
        email.classList.add("invalid");
    } else {
        email.classList.remove("invalid");
    }

    if (inputFilled && validEmail) {
        btn.disabled = false;
    } else {
        btn.disabled = true;
    }
}

email.addEventListener("input", checkInput);