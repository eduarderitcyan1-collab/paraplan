import Swiper from "swiper/bundle";

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
