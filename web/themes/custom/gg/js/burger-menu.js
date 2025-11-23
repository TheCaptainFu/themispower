/**
 * Burger Menu Toggle Animation
 * Transforms between hamburger icon and X icon
 */
(function () {
  'use strict';

  // Wait for DOM to be ready
  document.addEventListener('DOMContentLoaded', function () {
    const menuBtn = document.getElementById('menu-btn');
    const hiddenMenu = document.querySelector('.hidden-menu-wrapper');
    
    if (!menuBtn || !hiddenMenu) {
      console.warn('Menu button or hidden menu not found');
      return;
    }

    // Toggle burger menu animation and dropdown
    menuBtn.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      
      // Toggle active class for burger animation
      this.classList.toggle('active');
      
      // Toggle hidden menu visibility
      hiddenMenu.classList.toggle('open');
    });

    // Close menu when clicking outside
    document.addEventListener('click', function (e) {
      if (!menuBtn.contains(e.target) && !hiddenMenu.contains(e.target)) {
        menuBtn.classList.remove('active');
        hiddenMenu.classList.remove('open');
      }
    });

    // Close menu when pressing Escape key
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && menuBtn.classList.contains('active')) {
        menuBtn.classList.remove('active');
        hiddenMenu.classList.remove('open');
      }
    });
  });

})();

