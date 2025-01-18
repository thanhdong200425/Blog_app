document.addEventListener("DOMContentLoaded", () => {
    handleConfirmPassword();
    hideIndicator();
    handlePasswordStrength();
});

const hideIndicator = () => {
    document.getElementById('password-strength').classList.add('hide')
}

const handleConfirmPassword = () => {
    document.getElementById("confirm-password").addEventListener("keyup", () => {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm-password").value;
        const passwordError = document.getElementById("password-error");
        const confirmPasswordField = document.getElementById("confirm-password-field");
        password !== confirmPassword && confirmPassword.length > 0 ? 
            (passwordError.classList.add("error"), confirmPasswordField.style.borderColor = "red") : 
            (passwordError.classList.remove("error"), confirmPasswordField.style.borderColor = "");
    });
};

const handlePasswordStrength = () => {
    document.getElementById("password").addEventListener("keyup", () => {
        const password = document.getElementById("password").value;
        const passwordLength = password.length;
        const passwordStrength = document.getElementById("password-strength");
        const bar = document.querySelector(".strength-bar .bar");
        let strength = "Weak";
        let width = "33.33%";

        passwordLength > 0 ? passwordStrength.classList.remove('hide') : passwordStrength.classList.add('hide')

        if (password.length >= 8) {
            strength = "Medium";
            width = "66.66%";
        }
        if (password.length >= 12) {
            strength = "Strong";
            width = "100%";
        }

        document.getElementById("password-strength-indicator").textContent = strength;
        document.getElementById("password-strength-indicator").className = strength.toLowerCase();
        bar.style.width = width;
        bar.className = `bar ${strength.toLowerCase()}`;
    });
};
