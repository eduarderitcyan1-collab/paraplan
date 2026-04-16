document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.getElementById('storiesWrapper');
    const lightbox = document.getElementById('storiesLightbox');

    if (!wrapper || !lightbox) {
        return;
    }

    const stories = wrapper.querySelectorAll('.story');
    if (!stories.length) {
        return;
    }

    const lightboxContent = lightbox.querySelector('.lightbox-content');
    const mediaContainer = lightbox.querySelector('.lightbox-media-container');
    const progressContainer = lightbox.querySelector('.progress-container');
    const closeBtn = lightbox.querySelector('.lightbox-close');
    const navPrev = document.getElementById('storiesNavPrev');
    const navNext = document.getElementById('storiesNavNext');

    if (!lightboxContent || !mediaContainer || !progressContainer) {
        return;
    }

    let currentStoryIndex = 0;
    let currentMediaIndex = 0;
    let mediaItems = [];
    let progressBars = [];
    let autoAdvanceInterval = null;
    let mediaDuration = 0;
    const PHOTO_DURATION = 15;
    const DEFAULT_MEDIA_WIDTH = 9;
    const DEFAULT_MEDIA_HEIGHT = 16;
    const LIGHTBOX_MAX_WIDTH = 640;
    let currentMediaSize = {
        width: DEFAULT_MEDIA_WIDTH,
        height: DEFAULT_MEDIA_HEIGHT,
    };

    const viewedMedia = new Map();

    const fitLightboxToMedia = (width, height) => {
        const hasValidSize = Number.isFinite(width) && Number.isFinite(height) && width > 0 && height > 0;
        const mediaWidth = hasValidSize ? width : DEFAULT_MEDIA_WIDTH;
        const mediaHeight = hasValidSize ? height : DEFAULT_MEDIA_HEIGHT;

        currentMediaSize = {
            width: mediaWidth,
            height: mediaHeight,
        };

        const maxWidth = Math.min(window.innerWidth * 0.9, LIGHTBOX_MAX_WIDTH);
        const maxHeight = window.innerHeight * 0.9;
        const ratio = mediaWidth / mediaHeight;

        let targetWidth = maxWidth;
        let targetHeight = targetWidth / ratio;

        if (targetHeight > maxHeight) {
            targetHeight = maxHeight;
            targetWidth = targetHeight * ratio;
        }

        lightboxContent.style.width = `${Math.round(targetWidth)}px`;
        lightboxContent.style.height = `${Math.round(targetHeight)}px`;
    };

    const getMediaType = (item) => {
        if (item.dataset.type === 'photo' || item.dataset.type === 'video') {
            return item.dataset.type;
        }

        const src = item.dataset.src || '';
        const ext = src.split('.').pop().toLowerCase();
        return ['mp4', 'webm', 'ogg', 'mov', 'avi'].includes(ext) ? 'video' : 'photo';
    };

    const markMediaAsViewed = (storyIdx, mediaIdx) => {
        if (!viewedMedia.has(storyIdx)) {
            viewedMedia.set(storyIdx, new Set());
        }

        viewedMedia.get(storyIdx).add(mediaIdx);
        updateStoryBorders();
    };

    const isStoryFullyViewed = (storyIdx) => {
        const els = stories[storyIdx].querySelectorAll('.story-media');
        const viewed = viewedMedia.get(storyIdx) || new Set();

        return els.length > 0 && viewed.size === els.length;
    };

    const updateStoryBorders = () => {
        stories.forEach((story, index) => {
            story.classList.toggle('viewed', isStoryFullyViewed(index));
        });
    };

    const createProgressBars = () => {
        progressContainer.innerHTML = '';
        progressBars = [];

        mediaItems.forEach(() => {
            const bar = document.createElement('div');
            bar.className = 'progress-bar';

            const fill = document.createElement('div');
            fill.className = 'progress-fill';
            bar.appendChild(fill);

            progressContainer.appendChild(bar);
            progressBars.push(fill);
        });
    };

    const resetProgress = () => {
        progressBars.forEach((fill, index) => {
            fill.style.width = index < currentMediaIndex ? '100%' : '0%';
        });
    };

    const startAutoAdvance = () => {
        clearInterval(autoAdvanceInterval);

        const startTime = Date.now();
        autoAdvanceInterval = setInterval(() => {
            const elapsed = (Date.now() - startTime) / 1000;
            const percent = (elapsed / mediaDuration) * 100;

            if (progressBars[currentMediaIndex]) {
                progressBars[currentMediaIndex].style.width = `${Math.min(percent, 100)}%`;
            }

            if (elapsed >= mediaDuration) {
                goToNextMedia();
            }
        }, 50);
    };

    const loadCurrentMedia = () => {
        const item = mediaItems[currentMediaIndex];

        mediaContainer.innerHTML = '';
        fitLightboxToMedia(DEFAULT_MEDIA_WIDTH, DEFAULT_MEDIA_HEIGHT);

        if (item.type === 'video') {
            const video = document.createElement('video');
            video.className = 'lightbox-video';
            video.src = item.src;
            video.muted = true;
            video.playsInline = true;
            mediaContainer.appendChild(video);

            video.onloadedmetadata = () => {
                fitLightboxToMedia(video.videoWidth, video.videoHeight);
            };

            video.oncanplay = () => {
                mediaDuration = video.duration || 5;
                video.play().catch(() => {
                    mediaDuration = 5;
                });

                createProgressBars();
                resetProgress();
                startAutoAdvance();
            };

            video.onerror = () => {
                mediaDuration = 5;
                createProgressBars();
                resetProgress();
                startAutoAdvance();
            };

            return;
        }

        const img = new Image();
        img.className = 'lightbox-image';
        img.src = item.src;
        img.alt = 'Story photo';

        img.onload = () => {
            fitLightboxToMedia(img.naturalWidth, img.naturalHeight);
            mediaContainer.appendChild(img);
            mediaDuration = PHOTO_DURATION;
            createProgressBars();
            resetProgress();
            startAutoAdvance();
        };

        img.onerror = () => {
            mediaDuration = PHOTO_DURATION;
            createProgressBars();
            resetProgress();
            startAutoAdvance();
        };
    };

    const closeLightbox = () => {
        lightbox.classList.remove('active');
        clearInterval(autoAdvanceInterval);
        mediaContainer.innerHTML = '';
        fitLightboxToMedia(DEFAULT_MEDIA_WIDTH, DEFAULT_MEDIA_HEIGHT);
    };

    const goToPrevMedia = () => {
        if (currentMediaIndex > 0) {
            currentMediaIndex -= 1;
            loadCurrentMedia();
            return;
        }

        closeLightbox();
    };

    const goToNextMedia = () => {
        markMediaAsViewed(currentStoryIndex, currentMediaIndex);

        if (currentMediaIndex < mediaItems.length - 1) {
            currentMediaIndex += 1;
            loadCurrentMedia();
            return;
        }

        closeLightbox();
    };

    const scrollToStory = (index) => {
        const story = stories[index];
        const offset = story.offsetLeft - (wrapper.parentElement.clientWidth / 2) + (story.offsetWidth / 2);

        wrapper.scrollTo({
            left: offset,
            behavior: 'smooth',
        });
    };

    const openLightbox = (index) => {
        currentStoryIndex = index;

        const story = stories[index];
        mediaItems = Array.from(story.querySelectorAll('.story-media')).map((el) => ({
            src: el.dataset.src,
            type: getMediaType(el),
        }));

        if (!mediaItems.length) {
            return;
        }

        currentMediaIndex = 0;
        lightbox.classList.add('active');
        loadCurrentMedia();
        updateStoryBorders();
        scrollToStory(index);
    };

    const updateNavButtons = () => {
        const max = wrapper.scrollWidth - wrapper.clientWidth;
        const atStart = wrapper.scrollLeft <= 10;
        const atEnd = wrapper.scrollLeft >= max - 10;

        if (navPrev) {
            navPrev.style.opacity = atStart ? '0' : '1';
            navPrev.style.pointerEvents = atStart ? 'none' : 'auto';
        }

        if (navNext) {
            navNext.style.opacity = atEnd ? '0' : '1';
            navNext.style.pointerEvents = atEnd ? 'none' : 'auto';
        }
    };

    const updateLayout = () => {
        const containerWidth = wrapper.parentElement.clientWidth;
        const totalWidth = wrapper.scrollWidth;
        const needsScroll = totalWidth > containerWidth + 1;

        wrapper.style.justifyContent = needsScroll ? 'flex-start' : 'center';
        wrapper.style.scrollSnapType = needsScroll ? 'x mandatory' : 'none';

        if (navPrev) {
            navPrev.style.display = needsScroll ? 'flex' : 'none';
        }

        if (navNext) {
            navNext.style.display = needsScroll ? 'flex' : 'none';
        }

        updateNavButtons();
    };

    stories.forEach((story, index) => {
        story.addEventListener('click', () => openLightbox(index));
    });

    mediaContainer.addEventListener('click', (event) => {
        const rect = mediaContainer.getBoundingClientRect();
        const clickX = event.clientX - rect.left;
        const isLeft = clickX < rect.width / 2;

        if (isLeft) {
            goToPrevMedia();
        } else {
            goToNextMedia();
        }
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', closeLightbox);
    }

    lightbox.addEventListener('click', (event) => {
        if (event.target === lightbox) {
            closeLightbox();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && lightbox.classList.contains('active')) {
            closeLightbox();
        }
    });

    if (navPrev) {
        navPrev.addEventListener('click', () => {
            wrapper.scrollBy({
                left: -wrapper.clientWidth,
                behavior: 'smooth',
            });
        });
    }

    if (navNext) {
        navNext.addEventListener('click', () => {
            wrapper.scrollBy({
                left: wrapper.clientWidth,
                behavior: 'smooth',
            });
        });
    }

    wrapper.addEventListener('scroll', updateNavButtons);
    window.addEventListener('resize', () => {
        updateLayout();

        if (lightbox.classList.contains('active')) {
            fitLightboxToMedia(currentMediaSize.width, currentMediaSize.height);
        }
    });

    updateStoryBorders();
    updateLayout();
    fitLightboxToMedia(DEFAULT_MEDIA_WIDTH, DEFAULT_MEDIA_HEIGHT);
    setTimeout(updateLayout, 100);
});
