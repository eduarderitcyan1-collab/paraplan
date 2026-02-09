import Swiper from "swiper/bundle";

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
