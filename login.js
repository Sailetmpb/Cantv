//Inicio de sesion 

document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("loginForm");
    
    const errorAlert = document.getElementById("error-alert");
    if (errorAlert) {
        const inputs = form.querySelectorAll("input");
        inputs.forEach(input => {
            input.addEventListener("input", () => {
                errorAlert.style.display = "none";
            });
        });
    }

    // Validación básica del usuario antes de enviar
    form.addEventListener("submit", function(event) {
        const correo = document.getElementById("correo").value.trim();
        const password = document.getElementById("password").value.trim();

        if (correo === "" || password === "") {
            event.preventDefault();
            alert("Por favor, rellene todos los campos obligatorios.");
        }
    });
});