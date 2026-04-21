import Swiper from "swiper/bundle";

var swiperProd = new Swiper(".gallerySwiper", {
    loop: true,
    // spaceBetween: 25,
    centeredSlides: true,
    navigation: {
        nextEl: ".gallery-next",
        prevEl: ".gallery-prev",
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
