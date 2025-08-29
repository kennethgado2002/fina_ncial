const header = document.querySelector("header");

window.addEventListener("scroll", function(){
    header.classList.toggle("sticky", window.scrollY > 0 );
});
let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('open');
};
window.onscroll = () => {
    menu.classList.remove('bx-x');
    navbar.classList.remove('open');
};

const sr = ScrollReveal ({
     distance:'60px',
     duration:2500,
     delay:400,
     reset:true
})
sr.reveal('.home-text', {delay:200, origin:'top'});
sr.reveal('.home-img', {delay:300, origin:'top'});
sr.reveal('.feature,.product,.cta-content, .contact', {delay:200, origin:'top'});

document.addEventListener("DOMContentLoaded", function() {
    const dropdown = document.querySelector(".dropdown > a");
    const dropdownMenu = document.querySelector(".dropdown-menu");

    dropdown.addEventListener("click", function(e) {
        e.preventDefault(); // Para hindi mag-refresh
        dropdownMenu.classList.toggle("show");
    });

    // Close kapag nag-click sa labas
    document.addEventListener("click", function(e) {
        if (!dropdown.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.remove("show");
        }
    });
});
let slides = document.querySelectorAll(".hero-slides .slide");
let currentSlide = 0;
let slideInterval = setInterval(nextSlide, 3000);

function showSlide(index) {
  slides[currentSlide].classList.remove("active");
  currentSlide = (index + slides.length) % slides.length;
  slides[currentSlide].classList.add("active");
}

function nextSlide() {
  showSlide(currentSlide + 1);
}

function prevSlide() {
  showSlide(currentSlide - 1);
}

// Event listeners for arrows
document.getElementById("nextSlide").addEventListener("click", () => {
  nextSlide();
  resetInterval();
});

document.getElementById("prevSlide").addEventListener("click", () => {
  prevSlide();
  resetInterval();
});

// Reset interval after manual click
function resetInterval() {
  clearInterval(slideInterval);
  slideInterval = setInterval(nextSlide, 3000);
}


// Elements
const userIcon = document.querySelector('.ri-user-line').parentElement;
const loginModal = document.getElementById('loginModal');
const closeLogin = document.getElementById('closeLogin');

// Open login modal
userIcon.addEventListener('click', (e) => {
    e.preventDefault();
    loginModal.style.display = 'flex';
    setTimeout(() => {
        loginModal.classList.add('show');
    }, 10);
});

// Close modal
closeLogin.addEventListener('click', () => {
    loginModal.classList.remove('show');
    setTimeout(() => {
        loginModal.style.display = 'none';
    }, 400);
});

// Close if click outside
loginModal.addEventListener('click', (e) => {
    if (e.target === loginModal) {
        loginModal.classList.remove('show');
        setTimeout(() => {
            loginModal.style.display = 'none';
        }, 400);
    }
});

// Password toggle
const togglePassword = document.getElementById('togglePassword');
const passwordInput = document.getElementById('password');

togglePassword.addEventListener('click', () => {
    const isPassword = passwordInput.type === 'password';
    passwordInput.type = isPassword ? 'text' : 'password';
    togglePassword.className = isPassword ? 'ri-eye-off-line' : 'ri-eye-line';
});

// Elements for signup modal
const signupModal = document.getElementById('signupModal');
const closeSignup = document.getElementById('closeSignup');
const openSignup = document.getElementById('openSignup');
const openLoginFromSignup = document.getElementById('openLoginFromSignup');

// Open signup modal from login
openSignup.addEventListener('click', (e) => {
    e.preventDefault();
    loginModal.classList.remove('show');
    setTimeout(() => {
        loginModal.style.display = 'none';
        signupModal.style.display = 'flex';
        setTimeout(() => signupModal.classList.add('show'), 10);
    }, 400);
});

// Close signup modal
closeSignup.addEventListener('click', () => {
    signupModal.classList.remove('show');
    setTimeout(() => signupModal.style.display = 'none', 400);
});

// Back to login from signup
openLoginFromSignup.addEventListener('click', (e) => {
    e.preventDefault();
    signupModal.classList.remove('show');
    setTimeout(() => {
        signupModal.style.display = 'none';
        loginModal.style.display = 'flex';
        setTimeout(() => loginModal.classList.add('show'), 10);
    }, 400);
});

// Close signup if click outside
signupModal.addEventListener('click', (e) => {
    if (e.target === signupModal) {
        signupModal.classList.remove('show');
        setTimeout(() => signupModal.style.display = 'none', 400);
    }
});

// Toggle signup password
document.querySelector('.toggleSignupPassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('newPassword');
    const isPassword = passwordInput.type === 'password';
    passwordInput.type = isPassword ? 'text' : 'password';
    this.className = isPassword ? 'ri-eye-off-line toggleSignupPassword' : 'ri-eye-line toggleSignupPassword';
});

const searchToggle = document.getElementById('search-toggle');
const searchBar = document.getElementById('search-bar');

searchToggle.addEventListener('click', (e) => {
  e.preventDefault();
  searchBar.classList.toggle('show');
});
