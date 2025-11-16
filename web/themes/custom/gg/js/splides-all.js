(function () {
  "use strict";

  function initializeSplideCarousels() {
    if (typeof Splide !== "undefined") {
      document.querySelectorAll(".splide-item").forEach(function (mainEl) {
        try {
          // Find the thumbnail carousel (should be a sibling)
          const thumbnailEl =
            mainEl.parentElement.querySelector(".splide-thumbnails");

          // Initialize main carousel
          const main = new Splide(mainEl, {
            type: "carousel",
            perPage: 1,
            perMove: 1,
            pagination: false,
            arrows: false,
            autoplay: false,
            height: "auto",
            heightRatio: 0,
            fixedHeight: false,
          });

          // Initialize thumbnail carousel
          if (thumbnailEl) {
            const thumbnails = new Splide(thumbnailEl, {
              fixedWidth: 80,
              fixedHeight: 80,
              gap: 10,
              rewind: true,
              pagination: false,
              arrows: false,
              isNavigation: true,
              focus: "center",
              breakpoints: {
                600: {
                  fixedWidth: 60,
                  fixedHeight: 60,
                },
              },
            });

            // Sync the carousels
            main.sync(thumbnails);
            main.mount();
            thumbnails.mount();
          } else {
            main.mount();
          }
        } catch (e) {
          console.error("Error initializing Splide carousel:", e);
        }
      });
    } else {
      console.warn("Splide library not loaded, retrying in 500ms...");
      setTimeout(initializeSplideCarousels, 500);
    }
  }

  // Initialize when DOM is ready
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initializeSplideCarousels);
  } else {
    initializeSplideCarousels();
  }

  // Also try on window load as fallback
  window.addEventListener("load", function () {
    setTimeout(initializeSplideCarousels, 100);
  });
})();
