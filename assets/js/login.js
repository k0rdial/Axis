const user = document.getElementById("username");
const pass = document.getElementById("password");
const btn = document.getElementById("login");

function checkInput() {
    if (user.value.trim() !== "" && 
        pass.value.trim() !== "") {
            btn.disabled = false;
    } else {
        btn.disabled = true;
    }
}

user.addEventListener("input", checkInput);
pass.addEventListener("input", checkInput);