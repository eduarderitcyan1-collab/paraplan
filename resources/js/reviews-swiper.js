import Swiper from "swiper/bundle";

var swiper = new Swiper(".reviewsSwiper", {
    direction: "horizontal",
    loop: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
    },
    spaceBetween: 25,
    slidesPerView: 3, // по умолчанию (>=1200)

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

    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
});
