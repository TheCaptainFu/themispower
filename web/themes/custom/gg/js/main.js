// Burger Button Toggle with Dropdown
const burgerBtn = document.getElementById("burger-btn");
const dropdownMenu = document.getElementById("dropdown-menu");

if (burgerBtn && dropdownMenu) {
  burgerBtn.addEventListener("click", function (e) {
    e.stopPropagation();

    // Toggle burger animation
    const spans = this.querySelectorAll("span");
    if (dropdownMenu.classList.contains("hidden")) {
      // Opening - animate to X
      spans[0].style.transform = "rotate(45deg) translateY(6px)";
      spans[1].style.opacity = "0";
      spans[2].style.transform = "rotate(-45deg) translateY(-6px)";
    } else {
      // Closing - animate back to hamburger
      spans[0].style.transform = "rotate(0deg) translateY(0px)";
      spans[1].style.opacity = "1";
      spans[2].style.transform = "rotate(0deg) translateY(0px)";
    }

    // Toggle dropdown menu
    dropdownMenu.classList.toggle("hidden");
  });

  // Close dropdown when clicking outside
  document.addEventListener("click", function (e) {
    if (!burgerBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
      dropdownMenu.classList.add("hidden");

      // Reset burger animation
      const spans = burgerBtn.querySelectorAll("span");
      spans[0].style.transform = "rotate(0deg) translateY(0px)";
      spans[1].style.opacity = "1";
      spans[2].style.transform = "rotate(0deg) translateY(0px)";
    }
  });

  // Close dropdown when pressing Escape key
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && !dropdownMenu.classList.contains("hidden")) {
      dropdownMenu.classList.add("hidden");

      // Reset burger animation
      const spans = burgerBtn.querySelectorAll("span");
      spans[0].style.transform = "rotate(0deg) translateY(0px)";
      spans[1].style.opacity = "1";
      spans[2].style.transform = "rotate(0deg) translateY(0px)";
    }
  });
}

