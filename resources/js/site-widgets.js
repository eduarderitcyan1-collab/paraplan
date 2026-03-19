const arrowButton = document.getElementById("arrowUp");

if (arrowButton) {
    window.addEventListener(
        "scroll",
        () => {
            if (window.scrollY > 200) {
                arrowButton.classList.add("show");
            } else {
                arrowButton.classList.remove("show");
            }
        },
        { passive: true },
    );

    arrowButton.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });
}

document.addEventListener("DOMContentLoaded", () => {
    const cookiePopup = document.getElementById("cookiePopup");
    const cookieIcon = document.getElementById("cookieIcon");
    const saveBtn = document.getElementById("saveCookieSettings");
    const headers = document.querySelectorAll(".cookie-header");

    if (!cookiePopup || !cookieIcon) {
        return;
    }

    const LOCAL_KEY = "cookieSettings";

    function applySaved() {
        try {
            const saved = JSON.parse(localStorage.getItem(LOCAL_KEY));
            if (!saved) {
                cookiePopup.setAttribute("aria-hidden", "true");
                cookiePopup.style.display = "none";
                cookieIcon.style.display = "block";
                return;
            }

            cookiePopup.setAttribute("aria-hidden", "true");
            cookiePopup.style.display = "none";
            cookieIcon.style.display = "none";

            const technical = document.getElementById("technical-cookie");
            const analytics = document.getElementById("analytics-cookie");
            const functional = document.getElementById("functional-cookie");

            if (technical) technical.checked = !!saved.technical;
            if (analytics) analytics.checked = !!saved.analytics;
            if (functional) functional.checked = !!saved.functional;
        } catch (error) {
            cookiePopup.setAttribute("aria-hidden", "true");
            cookiePopup.style.display = "none";
            cookieIcon.style.display = "block";
            console.warn("cookieSettings parse error", error);
        }
    }

    function openPopup() {
        cookiePopup.style.display = "block";
        requestAnimationFrame(() => {
            cookiePopup.setAttribute("aria-hidden", "false");
            cookieIcon.style.display = "none";
            cookieIcon.setAttribute("aria-hidden", "true");
        });
    }

    function closePopup() {
        cookiePopup.setAttribute("aria-hidden", "true");
        setTimeout(() => {
            if (cookiePopup.getAttribute("aria-hidden") === "true") {
                cookiePopup.style.display = "none";
                cookieIcon.style.display = "block";
                cookieIcon.setAttribute("aria-hidden", "false");
            }
        }, 280);
    }

    function toggleContent(target) {
        const content = document.getElementById(`${target}-content`);
        if (!content) return;

        const isActive = content.classList.contains("active");
        document
            .querySelectorAll(".cookie-content")
            .forEach((item) => item.classList.remove("active"));

        if (!isActive) {
            content.classList.add("active");
        }
    }

    function saveCookieSettings() {
        const technical = document.getElementById("technical-cookie")?.checked;
        const analytics = document.getElementById("analytics-cookie")?.checked;
        const functional = document.getElementById("functional-cookie")?.checked;

        const cookieSettings = {
            technical: !!technical,
            analytics: !!analytics,
            functional: !!functional,
            timestamp: Date.now(),
        };

        localStorage.setItem(LOCAL_KEY, JSON.stringify(cookieSettings));
        cookiePopup.setAttribute("aria-hidden", "true");
        cookiePopup.style.display = "none";
        cookieIcon.style.display = "none";
    }

    cookieIcon.addEventListener("click", openPopup);
    cookieIcon.addEventListener("keydown", (event) => {
        if (event.key === "Enter" || event.key === " ") {
            openPopup();
        }
    });

    if (saveBtn) {
        saveBtn.addEventListener("click", saveCookieSettings);
    }

    headers.forEach((header) => {
        header.addEventListener("click", () => {
            const target = header.dataset.target;
            if (target) {
                toggleContent(target);
            }
        });
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            closePopup();
        }
    });

    document.addEventListener("click", (event) => {
        if (cookiePopup.contains(event.target) || cookieIcon.contains(event.target)) {
            return;
        }

        if (cookiePopup.getAttribute("aria-hidden") === "false") {
            closePopup();
        }
    });

    applySaved();

    window.addEventListener("resize", () => {
        if (window.innerWidth <= 700) {
            document
                .querySelectorAll(".cookie-content")
                .forEach((item) => item.classList.remove("active"));
        }
    });
});
