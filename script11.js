// Program to change navigation bar background on scroll
window.addEventListener('scroll', () => {
  document.querySelector('nav').classList.toggle('window-scroll', window.scrollY > 0);
});


// Program to change navigation bar background on scroll
let lastScrollTop = 0;

window.addEventListener('scroll', () => {
  const nav = document.querySelector('nav');
  const currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;

  if (currentScrollTop > lastScrollTop) {
    // Scrolling down, hide the navigation
    nav.classList.add('hidden');
    nav.classList.remove('visible');
  } else {
    // Scrolling up, show the navigation
    nav.classList.add('visible');
    nav.classList.remove('hidden');
  }

  lastScrollTop = currentScrollTop;
});

// Loading animation for the page
var loaderImg = document.querySelector(".img");
var loader = document.querySelector(".loader");

window.addEventListener('load', hides);

function hides() {
  loader.classList.add("hide");
  loaderImg.classList.add("ImgNone");
}

// Navigation menu Button toggle for small devices
const Menu = document.querySelector(".nav__navigation");
const menuBtn = document.querySelector(".menuBtn");

menuBtn.addEventListener('click', () => {
  menuBtn.classList.toggle("menu-active");
  Menu.classList.toggle("active");
});

// Close menu when clicked outside of it or when the page is scrolled
document.addEventListener('click', (event) => {
  const target = event.target;
  const isMenuBtn = target.closest('.menuBtn');
  const isMenu = target.closest('.nav__navigation');

  if (!isMenuBtn && !isMenu) {
    menuBtn.classList.remove("menu-active");
    Menu.classList.remove("active");
  }
});

document.addEventListener('scroll', () => {
  menuBtn.classList.remove("menu-active");
  Menu.classList.remove("active");
});

// Program to switch the content when button is clicked
document.addEventListener("DOMContentLoaded", function () {
  const menuButtons = document.querySelectorAll(".menu-button");
  const companies = document.querySelectorAll(".tab-content");

  menuButtons.forEach((button, index) => {
    button.addEventListener("click", function (event) {
      event.preventDefault();

      // Remove "active" class from all buttons
      menuButtons.forEach((btn) => {
        btn.classList.remove("spa--active");
      });

      // Add "active" class to the clicked button
      this.classList.add("spa--active");

      // Remove "active" class from all companies
      companies.forEach((company) => {
        company.classList.remove("spa--active");
      });

      // Add "active" class to the target company
      companies[index].classList.add("spa--active");
    });
  });
});

