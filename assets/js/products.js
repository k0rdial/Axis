document.addEventListener('DOMContentLoaded', () => {
    const upMess = document.querySelector('.update-message');
    const delMess = document.querySelector('.delete-message');
    const addMess = document.querySelector('.add-message');
    const errorMessage = document.querySelector('.error-message');
    if (upMess) {
        setTimeout(() => {
            upMess.classList.add('hidden');
            setTimeout(() => message.remove(), 500);
        }, 3000);
    } else if (delMess) {
        setTimeout(() => {
            delMess.classList.add('hidden');
            setTimeout(() => message.remove(), 500);
        }, 3000);
    } else if (addMess)  {
        setTimeout(() => {
            addMess.classList.add('hidden');
            setTimeout(() => message.remove(), 500);
        }, 3000);
    } else if (errorMessage) {
        setTimeout(() => {
            errorMessage.classList.add('hidden');
            setTimeout(() => errorMessage.remove(), 500);
        }, 3000);
    }
});

document.getElementById("image").addEventListener("change", function(e) {
    const file = e.target.files[0];
    const previewBox = document.getElementById("preview-box");

    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            previewBox.innerHTML = `<img src="${event.target.result}" alt="Preview">`;
        };
        reader.readAsDataURL(file);
    } else {
        previewBox.innerHTML = `<span>No Image</span>`;
    }
});