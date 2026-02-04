import "swiper/css";
import "swiper/css/pagination";

import Swiper from "swiper/bundle";

var swiperProd = new Swiper(".tarifSwiper", {
    spaceBetween: 25,
    loop: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1.5,
            spaceBetween: 10,
        },
        450: {
            slidesPerView: 2,
        },
        1000: {
            slidesPerView: 3,
        },
        1200: {
            slidesPerView: 3,
        },
        1201: {
            slidesPerView: 4,
        },
    },
});

var swiperProd = new Swiper(".serviceSwiper", {
    loop: true,
    spaceBetween: 25,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

    breakpoints: {
        0: {
            slidesPerView: 1.5,
            spaceBetween: 10,
        },
        450: {
            slidesPerView: 2,
        },
        1000: {
            slidesPerView: 3,
        },
        1200: {
            slidesPerView: 3,
        },
        1201: {
            slidesPerView: 4,
        },
    },
});

var swiperProd = new Swiper(".teamSwiper", {
    loop: true,
    // spaceBetween: 25,
    centeredSlides: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

    breakpoints: {
        0: {
            slidesPerView: 1.5,
        },
        450: {
            slidesPerView: 1.5,
        },
        1200: {
            slidesPerView: 3,
        },
    },
});

var swiperProd = new Swiper(".sertificateSwiper", {
    loop: true,
    spaceBetween: 25,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        700: {
            slidesPerView: 2,
        },
        1200: {
            slidesPerView: 3,
        },
    },
});

var swiperProd = new Swiper(".gallerySwiper", {
    loop: true,
    // spaceBetween: 25,
    centeredSlides: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

    breakpoints: {
        0: {
            slidesPerView: 1.5,
        },
        450: {
            slidesPerView: 1.5,
        },
        1200: {
            slidesPerView: 3,
        },
    },
});

var swiper = new Swiper(".reviewsSwiper", {
    direction: "vertical",
    loop: true,
    spaceBetween: 25,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
});

let flyPointSwiper = null;

function toggleflyPointSwiper() {
    const wrapper = document.querySelector(".flyPointWrapper");

    if (window.innerWidth <= 700) {
        if (flyPointSwiper) return;

        wrapper.classList.add("swiper", "is-swiper");

        if (!wrapper.querySelector(".swiper-wrapper")) {
            const slides = Array.from(wrapper.children);
            const swiperWrapper = document.createElement("div");
            swiperWrapper.classList.add("swiper-wrapper");

            slides.forEach((slide) => {
                slide.classList.add("swiper-slide");
                swiperWrapper.appendChild(slide);
            });

            wrapper.appendChild(swiperWrapper);
        }

        flyPointSwiper = new Swiper(wrapper, {
            slidesPerView: 1.25,
            spaceBetween: 10,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    } else {
        if (!flyPointSwiper) return;

        flyPointSwiper.destroy(true, true);
        flyPointSwiper = null;

        wrapper.classList.remove("swiper", "is-swiper");

        const swiperWrapper = wrapper.querySelector(".swiper-wrapper");
        if (swiperWrapper) {
            const slides = Array.from(swiperWrapper.children);
            slides.forEach((slide) => {
                slide.classList.remove("swiper-slide");
                wrapper.appendChild(slide);
            });
            swiperWrapper.remove();
        }
    }
}

toggleflyPointSwiper();
window.addEventListener("resize", toggleflyPointSwiper);

let whyUsSwiper = null;

function toggleWhyUsSwiper() {
    const wrapper = document.querySelector(".whyUsWrapper");

    if (window.innerWidth <= 700) {
        if (whyUsSwiper) return;

        wrapper.classList.add("swiper", "is-swiper");

        if (!wrapper.querySelector(".swiper-wrapper")) {
            const slides = Array.from(wrapper.children);
            const swiperWrapper = document.createElement("div");
            swiperWrapper.classList.add("swiper-wrapper");

            slides.forEach((slide) => {
                slide.classList.add("swiper-slide");
                swiperWrapper.appendChild(slide);
            });

            wrapper.appendChild(swiperWrapper);
        }

        whyUsSwiper = new Swiper(wrapper, {
            slidesPerView: 1.75,
            spaceBetween: 16,
            loop: true,
            centeredSlides: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    } else {
        if (!whyUsSwiper) return;

        whyUsSwiper.destroy(true, true);
        whyUsSwiper = null;

        wrapper.classList.remove("swiper", "is-swiper");

        const swiperWrapper = wrapper.querySelector(".swiper-wrapper");
        if (swiperWrapper) {
            const slides = Array.from(swiperWrapper.children);
            slides.forEach((slide) => {
                slide.classList.remove("swiper-slide");
                wrapper.appendChild(slide);
            });
            swiperWrapper.remove();
        }
    }
}

toggleWhyUsSwiper();
window.addEventListener("resize", toggleWhyUsSwiper);
