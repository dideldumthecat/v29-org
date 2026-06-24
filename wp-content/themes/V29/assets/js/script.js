// ------------------------------
// Basis-Elemente
// ------------------------------
const timelineSection = document.querySelector(".timeline-section");
const timelineContainer = document.querySelector(".timeline-container");
const todayLine = document.querySelector(".today-line");

const startButton = document.getElementById("timeline-start");
const todayButton = document.getElementById("timeline-today");
const endButton = document.getElementById("timeline-end");
const zoomButton = document.getElementById("timeline-zoom");

const zoomLevels = [150, 100, 60, 200];
let zoomIndex = 0;

// Lightbox
const lightbox = document.getElementById("lightbox");
const track = document.getElementById("lightbox-track");

let mediaList = [];
let activeIndex = 0;

// Monatsdefinition pro Jahr (aus PHP, siehe window.V29Timeline)
const monthsPerYear = (window.V29Timeline && window.V29Timeline.monthsPerYear) || {};

// ------------------------------
// Lightbox-Funktionen
// ------------------------------
function updateActiveMedia() {
    const items = document.querySelectorAll(".lightbox-item");

    items.forEach((item, i) => {
        const video = item.querySelector("video");

        if (video) {
            if (i === activeIndex) {
                video.play().catch(() => {});
            } else {
                video.pause();
                video.currentTime = 0;
            }
        }
    });
}

function renderCarousel() {
    track.innerHTML = "";
    track.classList.toggle("is-single", mediaList.length === 1);

    mediaList.forEach((media, i) => {
        const item = document.createElement("div");
        item.className = "lightbox-item";

        // 👉 NEU: Wrapper für Hintergrund
        const mediaWrapper = document.createElement("div");
        mediaWrapper.className = "lightbox-media";

        let el;

        if (media.type === "video") {
            el = document.createElement("video");
            el.src = media.src;
            el.loop = true;
            el.muted = true;
            el.playsInline = true;

            if (i === activeIndex) {
                el.autoplay = true;
            }
        } else {
            el = document.createElement("img");
            el.src = media.src;
        }

        // 👉 optional: white-image Klasse aus data übernehmen
        if (media.white === true) {
            el.classList.add("white-image");
        }

        const caption = document.createElement("div");
        caption.className = "lightbox-caption";
        caption.textContent = media.caption || "";

        // 👉 wichtig: Bild INS WRAPPER
        mediaWrapper.appendChild(el);

        item.appendChild(mediaWrapper);
        item.appendChild(caption);

        item.addEventListener("click", (e) => {
            e.stopPropagation();

            if (i === activeIndex) {
                closeLightbox();
            } else {
                activeIndex = i;
                centerActive();
                updateActiveMedia();
            }
        });

        track.appendChild(item);
    });

    requestAnimationFrame(() => {
        centerActive();
        updateActiveMedia();
    });
}

function centerActive() {
    const items = document.querySelectorAll(".lightbox-item");
    const activeItem = items[activeIndex];

    requestAnimationFrame(() => {
        activeItem.scrollIntoView({
            behavior: "smooth",
            inline: "center"
        });
    });
}

function openLightbox(mediaData) {
    mediaList = mediaData;
    activeIndex = 0;

    renderCarousel();

    lightbox.style.display = "flex";
}

function closeLightbox() {
    lightbox.style.display = "none";
}

document.querySelectorAll(".thumbnail").forEach((el) => {
    el.addEventListener("click", (e) => {
        e.stopPropagation();

        const media = JSON.parse(el.dataset.media);
        openLightbox(media);
    });
});

lightbox.addEventListener("click", closeLightbox);

// ------------------------------
// Hilfsfunktionen
// ------------------------------
function getMonthWidth() {
    return parseFloat(getComputedStyle(document.documentElement).getPropertyValue("--month-width"));
}

function getLabelWidth() {
    const labelEl = document.querySelector(".row-title");
    return labelEl ? labelEl.offsetWidth : 150;
}

function getTodayPosition() {
    const today = new Date();
    const startYear = (window.V29Timeline && window.V29Timeline.startYear) || today.getFullYear();

    let monthsSinceStart = 0;

    for (let year = startYear; year < today.getFullYear(); year++) {
        monthsSinceStart += monthsPerYear[year] || 12;
    }

    monthsSinceStart += today.getMonth();

    return getLabelWidth() + monthsSinceStart * getMonthWidth() + getMonthWidth() / 2;
}

function scrollTimelineTo(positionX, positionY = timelineSection.offsetTop) {
    timelineContainer.scrollTo({ left: positionX, behavior: "smooth" });
    window.scrollTo({ top: positionY, behavior: "smooth" });
    updateTodayLine();
}

// ------------------------------
// Timeline horizontal über vertikales Scrollen steuern
// ------------------------------
timelineContainer.addEventListener(
    "wheel",
    (e) => {
        const sectionTop = timelineSection.offsetTop;
        const sectionHeight = timelineSection.offsetHeight;
        const scrollY = window.scrollY;
        const maxScrollLeft = timelineContainer.scrollWidth - timelineContainer.clientWidth;

        if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
            timelineContainer.scrollLeft += e.deltaY;

            if (
                (e.deltaY > 0 && timelineContainer.scrollLeft < maxScrollLeft) ||
                (e.deltaY < 0 && timelineContainer.scrollLeft > 0)
            ) {
                e.preventDefault();
            }
        }
    },
    { passive: false }
);

// ------------------------------
// Mobile Touch Handling
// ------------------------------
let startX = 0;
let startY = 0;
let scrollLeftStart = 0;

timelineContainer.addEventListener("touchstart", (e) => {
    startX = e.touches[0].pageX;
    startY = e.touches[0].pageY;
    scrollLeftStart = timelineContainer.scrollLeft;
});

timelineContainer.addEventListener("touchmove", (e) => {
    const x = e.touches[0].pageX;
    const y = e.touches[0].pageY;

    const diffX = x - startX;
    const diffY = y - startY;

    const maxScrollLeft = timelineContainer.scrollWidth - timelineContainer.clientWidth;

    // Nur bei KLAR horizontaler Bewegung
    if (Math.abs(diffX) > Math.abs(diffY) * 1.5) {
        let newScroll = scrollLeftStart - diffX;

        if (newScroll < 0) newScroll = 0;
        if (newScroll > maxScrollLeft) newScroll = maxScrollLeft;

        timelineContainer.scrollLeft = newScroll;

        e.preventDefault(); // nur hier!
    }
});

// ------------------------------
// Today-Line aktualisieren
// ------------------------------
function updateTodayLine() {
    const position = getTodayPosition();
    todayLine.style.left = position - timelineContainer.scrollLeft + "px";
}

timelineContainer.addEventListener("scroll", updateTodayLine);

// ------------------------------
// Zoom-Button
// ------------------------------
zoomButton.addEventListener("click", () => {
    const todayBefore = getTodayPosition();
    const offset = todayBefore - timelineContainer.scrollLeft;

    zoomIndex = (zoomIndex + 1) % zoomLevels.length;
    document.documentElement.style.setProperty("--month-width", zoomLevels[zoomIndex] + "px");

    const todayAfter = getTodayPosition();
    timelineContainer.scrollLeft = todayAfter - offset;

    updateTodayLine();
});

// ------------------------------
// Buttons: Start, Heute, Info
// ------------------------------
startButton.addEventListener("click", () => scrollTimelineTo(0));

todayButton.addEventListener("click", () => scrollTimelineTo(getTodayPosition() - timelineContainer.clientWidth / 2));

endButton.addEventListener("click", () => {
    let position = getLabelWidth();
    for (const year in monthsPerYear) {
        position += monthsPerYear[year] * getMonthWidth();
    }
    scrollTimelineTo(position);
});

// ------------------------------
// Standardbreite beim Laden
// ------------------------------
document.addEventListener("DOMContentLoaded", () => {
    document.documentElement.style.setProperty("--month-width", "150px");
    updateTodayLine();
});

// ------------------------------
// Beim Laden automatisch zu Today-Line
// ------------------------------
window.addEventListener("load", () => {
    requestAnimationFrame(() => {
        requestAnimationFrame(() => {

            window.scrollTo({ top: 0, behavior: "auto" });

            const todayPosition = getTodayPosition();

            timelineContainer.scrollLeft =
                todayPosition - timelineContainer.clientWidth / 2;

            updateTodayLine();

        });
    });
});

// ------------------------------
// Row highlight
// ------------------------------
document.querySelectorAll(".row-title").forEach((title) => {
    title.addEventListener("click", () => {
        const cells = [];
        let next = title.nextElementSibling;

        while (next && !next.classList.contains("row-title")) {
            cells.push(next);
            next = next.nextElementSibling;
        }

        cells.forEach((cell) => cell.classList.toggle("row-highlight"));
        title.classList.toggle("row-highlight");
    });
});

// ------------------------------
// Impressum
// ------------------------------
const impressumOverlay = document.getElementById("impressum-overlay");
const impressumClose = document.getElementById("impressum-close");
const impressumLink = document.getElementById("impressum-link");

impressumLink.addEventListener("click", (e) => {
    e.preventDefault();
    impressumOverlay.style.display = "flex";
});

impressumClose.addEventListener("click", () => {
    impressumOverlay.style.display = "none";
});


// ------------------------------
// Background
// ------------------------------

const bgImages = [
    { x: 0, src: "wp-content/themes/V29/assets/images/bg_a.webp" },
    { x: 2000, src: "wp-content/themes/V29/assets/images/bg_b.webp" },
    { x: 4000, src: "wp-content/themes/V29/assets/images/bg_c.webp" }
];

const bgA = document.getElementById("bg-a");
const bgB = document.getElementById("bg-b");

function updateBackground() {
    const scrollX = timelineContainer.scrollLeft;

    // Index berechnen
    let index = 0;
    for (let i = 0; i < bgImages.length - 1; i++) {
        if (scrollX >= bgImages[i].x && scrollX <= bgImages[i + 1].x) {
            index = i;
            break;
        }
    }

    const current = bgImages[index];
    const next = bgImages[index + 1] || bgImages[0]; // Tile: nächstes ist erstes, falls am Ende

    const range = next.x - current.x || 1;
    let t = (scrollX - current.x) / range;
    t = Math.max(0, Math.min(1, t));

    const eased = t * t * (3 - 2 * t);

    // Direkt setzen, keine dataset-Prüfung
    bgA.src = current.src;
    bgB.src = next.src;

    // Tile Crossfade
    bgA.style.opacity = 1 - eased;
    bgB.style.opacity = eased;
}

// Scroll-Listener
timelineContainer.addEventListener("scroll", updateBackground);



// ------------------------------
// Video Sequenz (optimiert)
// ------------------------------

const totalFrames = 201;
const frameSuffix = ".webp";

let currentPrefix = "";
let webpFrames = [];

const titleImg = document.getElementById("title-webp-sequence");

let frameIndex = 0;
const fps = 15;
const frameInterval = 1000 / fps;
let lastTime = 0;

let animationActive = false;
let requestAnimationFrameId = null;

const imageCache = new Map();

const PRELOAD_AHEAD = 6;
const PRELOAD_BEHIND = 2;

// ------------------------------
// Prefix bestimmen
// ------------------------------
function getFramePrefix() {
    const width = window.innerWidth;

    if (width <= 500) {
        return "/wp-content/themes/V29/assets/images/sequence/mobile/logoanimation_";
    } else if (width <= 800) {
        return "/wp-content/themes/V29/assets/images/sequence/middle/logoanimation_";
    } else {
        return "/wp-content/themes/V29/assets/images/sequence/desktop/logoanimation_";
    }
}

// ------------------------------
// Frames bauen
// ------------------------------
function buildFrames(prefix) {
    const frames = [];

    for (let i = 1; i <= totalFrames; i++) {
        const frameNumber = String(i).padStart(5, "0");
        frames.push(`${prefix}${frameNumber}${frameSuffix}`);
    }

    return frames;
}

// ------------------------------
// Einzelnes Frame preloaden (idle)
// ------------------------------
function preloadFrame(index) {
    if (index < 0 || index >= webpFrames.length) return;
    if (imageCache.has(index)) return;

    const load = () => {
        const img = new Image();
        img.src = webpFrames[index];
        imageCache.set(index, img);
    };

    if ("requestIdleCallback" in window) {
        requestIdleCallback(load);
    } else {
        setTimeout(load, 0);
    }
}

// ------------------------------
function evictCache(index) {
    for (const key of imageCache.keys()) {
        if (key < index - PRELOAD_BEHIND - 1 || key > index + PRELOAD_AHEAD + 1) {
            imageCache.delete(key);
        }
    }
}

function preloadAround(index) {
    evictCache(index);
    for (let i = -PRELOAD_BEHIND; i <= PRELOAD_AHEAD; i++) {
        preloadFrame(index + i);
    }
}

// ------------------------------
// Animation
// ------------------------------
function animateWebPSequence(timestamp) {
    if (!lastTime) lastTime = timestamp;

    const elapsed = timestamp - lastTime;

    if (elapsed >= frameInterval) {
        // 👉 aus Cache nehmen wenn möglich
        const cached = imageCache.get(frameIndex);

        if (cached) {
            titleImg.src = cached.src;
        } else {
            titleImg.src = webpFrames[frameIndex];
        }

        preloadAround(frameIndex);

        frameIndex = (frameIndex + 1) % webpFrames.length;
        lastTime = timestamp;
    }

    if (animationActive) {
        requestAnimationFrameId = requestAnimationFrame(animateWebPSequence);
    }
}

// ------------------------------
// Animation steuern
// ------------------------------
function startAnimation() {
    if (animationActive) return;
    lastTime = 0;
    animationActive = true;
    requestAnimationFrameId = requestAnimationFrame(animateWebPSequence);
}

function stopAnimation() {
    animationActive = false;
    if (requestAnimationFrameId) {
        cancelAnimationFrame(requestAnimationFrameId);
        requestAnimationFrameId = null;
    }
}

// ------------------------------
// Init
// ------------------------------
function initSequence() {
    const newPrefix = getFramePrefix();

    if (newPrefix !== currentPrefix) {
        currentPrefix = newPrefix;

        webpFrames = buildFrames(currentPrefix);
        frameIndex = 0;
        lastTime = 0;

        imageCache.clear();

        for (let i = 0; i < 12; i++) {
            preloadFrame(i);
        }

        const first = new Image();
        first.src = webpFrames[0];
        first.onload = () => {
            titleImg.src = first.src;
            imageCache.set(0, first);
        };
    }
}

// ------------------------------
// START
// ------------------------------
window.addEventListener("load", () => {
    initSequence();
    startAnimation();
});

// ------------------------------
// RESIZE
// ------------------------------
let resizeTimeout;

window.addEventListener("resize", () => {
    clearTimeout(resizeTimeout);

    resizeTimeout = setTimeout(() => {
        initSequence();
    }, 150);
});

// ------------------------------
// Animation pausieren wenn außerhalb des Sichtbereichs
// ------------------------------
const sequenceObserver = new IntersectionObserver((entries) => {
    entries[0].isIntersecting ? startAnimation() : stopAnimation();
}, { threshold: 0 });

if (titleImg) sequenceObserver.observe(titleImg);

document.addEventListener("visibilitychange", () => {
    document.hidden ? stopAnimation() : startAnimation();
});

// ------------------------------
// Lazy Loading (ohne BG!)
// ------------------------------
document.querySelectorAll("img:not(.no-lazy)").forEach(img => {
    img.loading = "lazy";
});