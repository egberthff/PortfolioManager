 // Handle active nav link switch on scroll
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('nav ul li a');

  window.addEventListener('scroll', () => {
    let scrollY = window.pageYOffset + 80;
    sections.forEach(section => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.offsetHeight;
      const sectionId = section.getAttribute('id');

      if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
        navLinks.forEach(link => {
          link.classList.remove('active');
          if (link.getAttribute('href') === '#' + sectionId) {
            link.classList.add('active');
          }
        });
      }
    });
  });

  // Contact form validation and submission (simulation)
  const form = document.getElementById('contactForm');
  const formMessage = document.getElementById('formMessage');

  form.addEventListener('submit', (e) => {
    e.preventDefault();

    clearErrors();
    formMessage.textContent = '';

    let valid = true;

    const name = form.name.value.trim();
    const email = form.email.value.trim();
    const message = form.message.value.trim();

    if (!name) {
      showError('nameError', 'Please enter your name.');
      valid = false;
    }
    if (!email) {
      showError('emailError', 'Please enter your email.');
      valid = false;
    } else if (!validateEmail(email)) {
      showError('emailError', 'Please enter a valid email address.');
      valid = false;
    }
    if (!message) {
      showError('messageError', 'Please enter your message.');
      valid = false;
    }

    if (valid) {
      // Simulate form submission success
      formMessage.style.color = 'green';
      formMessage.textContent = 'Thank you for your message! I will get back to you shortly.';
      form.reset();
    }
  });

  function showError(id, message) {
    const elem = document.getElementById(id);
    elem.textContent = message;
  }

  function clearErrors() {
    showError('nameError', '');
    showError('emailError', '');
    showError('messageError', '');
  }

  function validateEmail(email) {
    // Basic email validation regex
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email.toLowerCase());
  }

    function toggleMenu() {
    const navLinks = document.getElementById('nav-links');
    navLinks.classList.toggle('show');
    console.log('Menu toggled'); // Debug
  }
