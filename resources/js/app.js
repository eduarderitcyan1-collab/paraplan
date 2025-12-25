document.addEventListener("DOMContentLoaded", function () {
    const phoneInput = document.getElementById("phone");
    const nameInput = document.getElementById("name");
    const form = document.querySelector(".contactForm");

    function formatPhone(value) {
        let digits = value.replace(/\D/g, "").slice(0, 11);
        if (!digits) return "";
        if (digits[0] === "8") digits = "7" + digits.slice(1);
        if (digits[0] !== "7") digits = "7" + digits.slice(0, 10);
        digits = digits.slice(0, 11);
        const a = digits.slice(1, 4);
        const b = digits.slice(4, 7);
        const c = digits.slice(7, 9);
        const d = digits.slice(9, 11);
        let out = "+7";
        if (a) out += " (" + a + (a.length === 3 ? ")" : "");
        if (b) out += (a.length === 3 ? " " : " ") + b;
        if (c) out += "-" + c;
        if (d) out += "-" + d;
        return out;
    }

    phoneInput.addEventListener("input", function (e) {
        const pos = this.selectionStart;
        this.value = formatPhone(this.value);
        this.setSelectionRange(this.value.length, this.value.length);
    });

    form.addEventListener("submit", function (e) {
        const name = nameInput.value.trim();
        const phone = phoneInput.value.trim();
        const phoneRegex = /^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/;
        if (name.length < 2) {
            e.preventDefault();
            alert("Пожалуйста, введите имя (минимум 2 символа).");
            nameInput.focus();
            return;
        }
        if (!phoneRegex.test(phone)) {
            e.preventDefault();
            alert(
                "Пожалуйста, введите корректный телефон в формате +7 (999) 999-99-99."
            );
            phoneInput.focus();
            return;
        }
    });
});
