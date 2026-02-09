import Swiper from "swiper/bundle";

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
