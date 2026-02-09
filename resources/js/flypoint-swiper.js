import Swiper from "swiper/bundle";

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
