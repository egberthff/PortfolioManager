<header>
  <nav class="container" aria-label="Primary Navigation">
    <!-- Logo -->
    <a href="#hero" class="logo">
      <img src="images/logo.png" alt="Sherwin George Bush Logo" class="logo-image" />
    </a>

    <!-- Hamburger Toggle -->
    <div class="menu-toggle" onclick="toggleMenu()" aria-label="Toggle menu">
      <span></span>
      <span></span>
      <span></span>
    </div>

    <!-- Navigation Menu -->
    <ul id="nav-links" role="menu">
      <li role="menuitem"><a href="#about" class="active">About</a></li>
      <li role="menuitem"><a href="#skills">Skills</a></li>
      <li role="menuitem"><a href="#experience">Experience</a></li>
      <li role="menuitem"><a href="#projects">Projects</a></li>
      <li role="menuitem"><a href="#education">Education</a></li>
      <li role="menuitem"><a href="#contact">Contact</a></li>
    </ul>
  </nav>
</header>

<script>
  function toggleMenu() {
    document.getElementById('nav-links').classList.toggle('show');
  }
</script>
