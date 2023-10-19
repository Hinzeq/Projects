const inputPesel = document.getElementById('pesel');

inputPesel.addEventListener("keyup", () => {
    document.getElementById('submitButton').disabled = 
        inputPesel.value.length == 11
            ? false
            : true;
});
