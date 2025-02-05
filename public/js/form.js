document.addEventListener("DOMContentLoaded", () => {
    const forms = document.querySelectorAll("form");

    forms.forEach(form => {
        form.addEventListener("submit", (event) => {
            let isValid = true;
            const inputs = form.querySelectorAll("input, textarea, select");

            inputs.forEach(input => {
                if (!validateInput(input)) {
                    isValid = false;
                }
            });

            if (!isValid) {
                event.preventDefault(); 
            }
        });

        const inputs = form.querySelectorAll("input, textarea, select");
        inputs.forEach(input => {
            input.addEventListener("input", () => {
                if (input.classList.contains("error")) {
                    showError(input, "", true);
                }
            });
        });
    });

    function validateInput(input) {
        const value = input.value.trim();
        let isValid = true;
        let errorMessage = "";

        if (input.hasAttribute("required") && value === "") {
            errorMessage = "This field is required";
            isValid = false;
        }

        if (input.name === "fullname" && value.length < 2) {
            errorMessage = "Name must be at least 3 characters";
            isValid = false;
        }

        if (input.name === "email" && value !== "" && !validateEmail(value)) {
            errorMessage = "Invalid email format";
            isValid = false;
        }

        if (input.name === "password" && value.length < 6) {
            errorMessage = "Password must be at least 6 characters";
            isValid = false;
        }

        if (input.name === "confirm-password") {
            const password = document.querySelector("input[name='password']").value;
            if (value !== password) {
                errorMessage = "Passwords do not match";
                isValid = false;
            }
        }

        if (input.name === "contact" && !/^\+?\d{7,15}$/.test(value)) {
            errorMessage = "Invalid phone number (Use +CountryCode followed by digits)";
            isValid = false;
        }

        if (input.type === "file" && input.name === "resume") {
            if (input.files.length === 0) {
                errorMessage = "Please upload a resume";
                isValid = false;
            } else {
                const allowedTypes = ["application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"];
                const fileType = input.files[0].type;
                if (!allowedTypes.includes(fileType)) {
                    errorMessage = "Invalid file type (Allowed: PDF, DOC, DOCX)";
                    isValid = false;
                }
            }
        }

        if (input.tagName === "SELECT" && input.value === "") {
            errorMessage = "Please select an option";
            isValid = false;
        }

        showError(input, errorMessage, isValid);
        return isValid;
    }

    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function showError(input, message, isValid) {
        let errorElement = input.nextElementSibling;

        if (!errorElement || !errorElement.classList.contains("error-message")) {
            errorElement = document.createElement("span");
            errorElement.classList.add("error-message");
            input.parentNode.appendChild(errorElement);
        }

        if (!isValid) {
            errorElement.textContent = message;
            input.classList.add("error");
        } else {
            errorElement.textContent = "";
            input.classList.remove("error");
        }
    }
});