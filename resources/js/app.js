import $ from "jquery";
window.$ = window.jQuery = $;

import "swiper/css";
import "swiper/css/pagination";

import Swiper from "swiper/bundle";

document.addEventListener("DOMContentLoaded", function () {
    function formatPhone(value) {
        let digits = value.replace(/\D/g, "").slice(0, 11);

        if (!digits) return "";

        if (digits[0] === "8") digits = "7" + digits.slice(1);
        if (digits[0] !== "7") digits = "7" + digits.slice(0, 10);

        const a = digits.slice(1, 4);
        const b = digits.slice(4, 7);
        const c = digits.slice(7, 9);
        const d = digits.slice(9, 11);

        let out = "+7";
        if (a) out += " (" + a + (a.length === 3 ? ")" : "");
        if (b) out += " " + b;
        if (c) out += "-" + c;
        if (d) out += "-" + d;

        return out;
    }

    // НАХОДИМ ВСЕ ФОРМЫ С КЛАССОМ contactForm (и на странице, и в модалке)
    document.querySelectorAll(".contactForm").forEach(function (form) {
        const phoneInput = form.querySelector('input[name="phone"]');
        const nameInput = form.querySelector('input[name="name"]');

        if (!phoneInput || !nameInput) return;

        phoneInput.addEventListener("input", function () {
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
                    "Пожалуйста, введите корректный телефон в формате +7 (999) 999-99-99.",
                );
                phoneInput.focus();
                return;
            }
        });
    });
});

jQuery(document).ready(function ($) {
    $(".accordion-item").each(function () {
        if (!$(this).hasClass("active")) {
            $(this).find(".accordion-content").hide();
        }
    });

    $(".accordion-item").on("click", function () {
        const $item = $(this).closest(".accordion-item");
        const isActive = $item.hasClass("active");

        $(".accordion-item")
            .not($item)
            .removeClass("active")
            .find(".accordion-content")
            .hide();

        if (isActive) {
            $item.removeClass("active");
            $item.find(".accordion-content").hide();
        } else {
            $item.addClass("active");
            $item.find(".accordion-content").show();
        }
    });
});

jQuery(document).ready(function ($) {
    $("a").click(function (e) {
        let href = $(this).attr("href");
        if (href === "#") {
            e.preventDefault();
        }
    });
});

function setRealVh() {
    document.documentElement.style.setProperty(
        "--vh",
        `${window.innerHeight * 0.01}px`,
    );
}
setRealVh();

const modalButtons = document.querySelectorAll(".modalButton");
const modal = document.getElementById("modal");
const overlay = document.getElementById("modalOverlay");
const closeBtn = document.getElementById("modalClose");

function openModal() {
    modal.classList.add("show");
    overlay.classList.add("show");
    document.body.classList.add("modalOpen");
}

function closeModal() {
    modal.classList.remove("show");
    overlay.classList.remove("show");
    document.body.classList.remove("modalOpen");
}

modalButtons.forEach((button) => {
    button.addEventListener("click", function (e) {
        e.stopPropagation();
        openModal();
    });
});

closeBtn.addEventListener("click", closeModal);

overlay.addEventListener("click", function (e) {
    if (e.target === overlay) {
        closeModal();
    }
});

document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
        closeModal();
    }
});

import GLightbox from "glightbox";
import "glightbox/dist/css/glightbox.css";

document.addEventListener("DOMContentLoaded", () => {
    GLightbox({
        selector: ".glightbox",
    });
});
