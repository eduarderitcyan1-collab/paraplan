import $ from "jquery";
window.$ = window.jQuery = $;

import "swiper/css";
import "swiper/css/pagination";

import Swiper from "swiper/bundle";

let tinyBootPromise;

window.initTiny = async function () {
    const editor = document.querySelector("#desc-editor");

    // TinyMCE работает только в standards mode, на остальных страницах просто пропускаем инициализацию.
    if (!editor || document.compatMode !== "CSS1Compat") {
        return;
    }

    if (!tinyBootPromise) {
        tinyBootPromise = (async () => {
            const [{ default: tinymce }] = await Promise.all([
                import("tinymce/tinymce"),
                import("tinymce/themes/silver"),
                import("tinymce/icons/default"),
                import("tinymce/models/dom"),
                import("tinymce/plugins/link"),
                import("tinymce/plugins/lists"),
                import("tinymce/plugins/code"),
                import("tinymce/plugins/image"),
                import("tinymce/plugins/table"),
                import("tinymce/plugins/media"),
            ]);

            return tinymce;
        })();
    }

    const tinymce = await tinyBootPromise;

    if (tinymce.get("desc-editor")) {
        tinymce.get("desc-editor").remove();
    }

    tinymce.init({
        selector: "#desc-editor",
        license_key: "gpl",
        height: 500,
        menubar: false,
        plugins: "link lists code image table media",
        toolbar:
            "undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image media table | code",
        block_formats:
            "Параграф=p; Заголовок H1=h1; Заголовок H2=h2; Заголовок H3=h3; Заголовок H4=h4; Заголовок H5=h5; Заголовок H6=h6",
        entity_encoding: "raw",
        convert_urls: false,
        relative_urls: false,
        remove_script_host: false,
        branding: false,
        image_title: true,
        automatic_uploads: true,
        images_file_types: "jpg,jpeg,png,gif,webp",
        images_upload_handler: (blobInfo) =>
            new Promise((resolve, reject) => {
                const formData = new FormData();
                formData.append("file", blobInfo.blob(), blobInfo.filename());

                fetch("/editor/upload", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN":
                            document
                                .querySelector('meta[name="csrf-token"]')
                                ?.getAttribute("content") || "",
                    },
                    body: formData,
                    credentials: "same-origin",
                })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error("Не удалось загрузить изображение");
                        }

                        return response.json();
                    })
                    .then((json) => {
                        if (!json || typeof json.location !== "string") {
                            throw new Error("Некорректный ответ сервера");
                        }

                        resolve(json.location);
                    })
                    .catch((error) => {
                        reject(error.message || "Ошибка загрузки");
                    });
            }),
    });
};

document.addEventListener("DOMContentLoaded", () => {
    window.initTiny();
});

document.addEventListener("DOMContentLoaded", () => {
    const lazyVideos = document.querySelectorAll("video[data-src]");
    const lazyImages = document.querySelectorAll("img[data-src]");

    const loadMedia = (element) => {
        if (!element) return;

        if (element.tagName === "VIDEO") {
            const source = element.querySelector("source");
            if (source) {
                source.src = element.dataset.src;
                element.load();
            }
            return;
        }

        if (element.tagName === "IMG") {
            element.src = element.dataset.src;
            element.removeAttribute("data-src");
            return;
        }
    };

    if ("IntersectionObserver" in window) {
        const observer = new IntersectionObserver(
            (entries, obs) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const media = entry.target;
                        loadMedia(media);
                        obs.unobserve(media);
                    }
                });
            },
            { threshold: 0.25 },
        );

        lazyVideos.forEach((video) => observer.observe(video));
        lazyImages.forEach((img) => observer.observe(img));
    } else {
        // fallback для старых браузеров
        lazyVideos.forEach((video) => loadMedia(video));
        lazyImages.forEach((img) => loadMedia(img));
    }
});

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

    $(".accordion-title").on("click", function () {
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

document.addEventListener("DOMContentLoaded", () => {
    const modalButtons = document.querySelectorAll(".modalButton");
    const modal = document.getElementById("modal");
    const overlay = document.getElementById("modalOverlay");
    const closeBtn = document.getElementById("modalClose");

    if (!modal || !overlay || !closeBtn) return;

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
});

import GLightbox from "glightbox";
import "glightbox/dist/css/glightbox.css";

document.addEventListener("DOMContentLoaded", () => {
    GLightbox({
        selector: ".glightbox",
        autoplayVideos: true,
        plyr: {
            css: "https://cdn.plyr.io/3.6.12/plyr.css",
            js: "https://cdn.plyr.io/3.6.12/plyr.js",
            config: {
                autoplay: false,
                muted: false,
            },
        },
    });
});

import Sortable from "sortablejs";

document.addEventListener("DOMContentLoaded", () => {
    const gallery = document.getElementById("gallery-container");

    if (gallery) {
        new Sortable(gallery, {
            animation: 150,
            ghostClass: "opacity-30",
            onEnd: function () {
                const items = gallery.querySelectorAll("[data-id]");

                items.forEach((el, index) => {
                    const input = el.querySelector(
                        'input[name="gallery_order[]"]',
                    );
                    if (input) {
                        input.value = el.dataset.id;
                    }
                });
            },
        });
    }

    const sortableLists = document.querySelectorAll("[data-sortable-list]");

    sortableLists.forEach((list) => {
        const sortUrl = list.getAttribute("data-sort-url");
        if (!sortUrl) return;

        new Sortable(list, {
            animation: 150,
            ghostClass: "opacity-30",
            onEnd: async () => {
                const ids = Array.from(list.querySelectorAll("[data-id]"))
                    .map((row) => Number(row.getAttribute("data-id")))
                    .filter((value) => Number.isInteger(value) && value > 0);

                try {
                    const response = await fetch(sortUrl, {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN":
                                document
                                    .querySelector('meta[name="csrf-token"]')
                                    ?.getAttribute("content") || "",
                            Accept: "application/json",
                        },
                        body: JSON.stringify({ ids }),
                        credentials: "same-origin",
                    });

                    if (!response.ok) {
                        throw new Error("Не удалось сохранить порядок");
                    }
                } catch (error) {
                    console.error(error);
                    window.location.reload();
                }
            },
        });
    });
});
