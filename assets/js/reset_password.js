const newpass = document.getElementById("new-password");
const confpass = document.getElementById("confirm-password");
const btn = document.getElementById("reset");

function checkInputs() {
    const inputsFilled = newpass.value.trim() !== "" &&
                        confpass.value.trim() !== "";

    if (inputsFilled) {
        btn.disabled = false;
    } else {
        btn.disabled = true;
    }
}

newpass.addEventListener("input", checkInputs);
confpass.addEventListener("input", checkInputs);