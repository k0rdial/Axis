const proof = document.getElementById('proof');
const reference = document.getElementById('reference');
const checkout = document.getElementById('checkout-btn');

function isValidReference(referenceNumber) {
    const validPattern = /^\d{6}$/;

    return validPattern.test(referenceNumber);
}

function checkReference() {
    const referenceFilled = reference.value.trim() !== "" &&
                            proof.value.trim() !== "";
    const validReference = isValidReference(reference.value.trim());

    if (!validReference && !referenceFilled) {
        reference.classList.add("invalid");
        checkout.disabled = true;
    } else if (validReference && referenceFilled) {
        reference.classList.remove("invalid");
        checkout.disabled = false;
    }
}

proof.addEventListener("input",checkReference);
reference.addEventListener("input",checkReference);