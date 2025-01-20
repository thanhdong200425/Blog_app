document.addEventListener("DOMContentLoaded", () => {
    handleConfirmPassword();
    hideIndicator();
    handlePasswordStrength();
    setEventForSubmitting();
});

const hideIndicator = () => {
    document.getElementById("password-strength").classList.add("hide");
};

// Set event when submitting form
export const setEventForSubmitting = () => {
    document.querySelector("#form").addEventListener("submit", (event) => {
        event.preventDefault();
        const submitButton = document.querySelector(".action-button");
        submitButton.textContent = "";
        submitButton.innerHTML = '<img src="../icons/spinner.svg" alt="Loading..." />';
        setTimeout(() => {
            event.target.submit();
        }, 1000);
    });
};

const handleConfirmPassword = () => {
    document.getElementById("confirm-password").addEventListener("keyup", () => {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm-password").value;
        const passwordError = document.getElementById("password-error");
        const confirmPasswordField = document.getElementById("confirm-password-field");
        const buttonSubmit = document.querySelector(".action-button");
        // Check whether the confirm password matches the original password or not
        if (password !== confirmPassword && confirmPassword.length > 0) {
            passwordError.classList.add("error");
            confirmPasswordField.style.borderColor = "red";
            buttonSubmit.classList.add("disabled-button");
            buttonSubmit.setAttribute("disabled", true);
        } else {
            passwordError.classList.remove("error");
            confirmPasswordField.style.borderColor = "";
            buttonSubmit.classList.remove("disabled-button");
            buttonSubmit.removeAttribute("disabled");
        }
    });
};

const handlePasswordStrength = () => {
    document.getElementById("password").addEventListener("keyup", () => {
        const password = document.getElementById("password").value;
        const passwordStrength = document.getElementById("password-strength");
        const bar = document.querySelector(".strength-bar .bar");
        const length = password.length;
        // Show or hide indicator based on length of password
        passwordStrength.classList.toggle("hide", length === 0);
        // RegExpresion to test strength of a password
        const hasSpecialChar = /[!@#$%^&*]/.test(password);
        const hasUpperCase = /[A-Z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        // Set strengtColor and width
        let strength = length >= 12 ? "Strong" : length >= 8 ? "Medium" : "Weak";
        let width = length >= 12 ? "100%" : length >= 8 ? "66.66%" : "33.33%";
        if (!hasSpecialChar || !hasUpperCase || !hasNumber) (strength = "Weak"), (width = "33.33%");
        bar.style.width = width;
        bar.className = `bar ${strength.toLowerCase()}`;
    });
};
