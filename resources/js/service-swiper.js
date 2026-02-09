import Swiper from "swiper/bundle";

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
