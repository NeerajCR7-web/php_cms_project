<?php
// index.php (public-facing)
include('admin/includes/database.php');
include('admin/includes/config.php');
include('admin/includes/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>ACE • Portfolio</title>

  <!-- Google Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
    rel="stylesheet"
  >
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    rel="stylesheet"
  >

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="admin/css/style.css">
</head>
<body>

  <!-- Mobile menu toggle -->
  <button class="menu-toggle"><i class="fa fa-bars"></i></button>

  <!-- HERO / HOME -->
  <section id="home" class="hero">
    <div class="hero-content">
      <div class="hero-text">
        <h1>Hey there, This is Team ACE</h1>
        <p>Crafting sleek, user-friendly web experiences</p>
        <p class="team-desc">
          We’re a passionate Web Development team specializing in responsive design, interactive UIs, and rock-solid backends.
        </p>
        <a href="#projects" class="btn btn-primary">Explore Our Work</a>
      </div>
      <div class="hero-image">
        <img src="admin/images/team/team-banner.jpg" alt="Our Web Dev Team">
      </div>
    </div>
  </section>

  <div class="admin-container">
    <!-- SIDEBAR NAV -->
    <aside class="admin-sidebar">
      <div class="admin-brand">
        <i class="fa fa-briefcase"></i>
        <h1>Portfolio</h1>
      </div>
      <ul class="admin-menu">
        <li><a href="#home" class="active"><i class="fa fa-home"></i><span>Home</span></a></li>
        <li><a href="#projects"><i class="fa fa-folder-open"></i><span>Projects</span></a></li>
        <li><a href="#certificates"><i class="fa fa-certificate"></i><span>Certs</span></a></li>
        <li><a href="#skills"><i class="fa fa-code"></i><span>Skills</span></a></li>
        <li><a href="#contact"><i class="fa fa-envelope"></i><span>Contact</span></a></li>
      </ul>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="admin-main">
      <!-- PROJECTS -->
      <section id="projects" class="section-wrapper">
        <h2 class="section-title">Our Projects</h2>
        <div class="cards-grid">
          <?php
            $q   = 'SELECT * FROM projects ORDER BY date DESC';
            $res = mysqli_query($connect, $q);
            while($p = mysqli_fetch_assoc($res)):
              $excerpt = substr(strip_tags($p['content']),0,100).'…';
          ?>
          <div class="card">
            <div class="card-header">
              <div class="card-icon icon-project"><i class="fa fa-folder-open"></i></div>
              <div class="card-heading">
                <span class="title"><?= htmlentities($p['title']) ?></span>
                <span class="date"><?= date('M Y',strtotime($p['date'])) ?></span>
              </div>
            </div>
            <div class="card-body"><?= $excerpt ?></div>
            <div class="card-footer">
              <?php if($p['url']): ?>
                <a href="<?= htmlentities($p['url']) ?>" class="btn btn-primary">View Project</a>
              <?php endif; ?>
            </div>
          </div>
          <?php endwhile; ?>
        </div>
      </section>

      <!-- CERTIFICATES -->
      <section id="certificates" class="section-wrapper certificates-section">
        <h2 class="section-title">Certificates</h2>
        <div class="cards-grid">
          <?php
            $q   = 'SELECT * FROM certificates ORDER BY date DESC';
            $res = mysqli_query($connect, $q);
            while($c = mysqli_fetch_assoc($res)):
          ?>
          <div class="card">
            <div class="card-header">
              <div class="card-icon icon-certificate"><i class="fa fa-certificate"></i></div>
              <div class="card-heading">
                <span class="title"><?= htmlentities($c['title']) ?></span>
                <span class="date"><?= htmlentities($c['organization']) ?></span>
              </div>
            </div>
            <div class="card-body"><?= date('F Y',strtotime($c['date'])) ?></div>
            <div class="card-footer">
              <?php if($c['url']): ?>
                <a href="<?= htmlentities($c['url']) ?>" class="btn btn-primary">View Cert</a>
              <?php endif; ?>
            </div>
          </div>
          <?php endwhile; ?>
        </div>
      </section>

      <!-- SKILLS -->
      <section id="skills" class="section-wrapper skills-section">
        <h2 class="section-title">Skills &amp; Proficiency</h2>
        <div class="cards-grid">
          <?php
            $q   = 'SELECT * FROM skills ORDER BY name';
            $res = mysqli_query($connect, $q);
            while($s = mysqli_fetch_assoc($res)):
          ?>
          <div class="card">
            <div class="card-header">
              <div class="card-icon icon-skill"><i class="fa fa-code"></i></div>
              <div class="card-heading">
                <span class="title"><?= htmlentities($s['name']) ?></span>
                <span class="date"><?= $s['percent'] ?>%</span>
              </div>
            </div>
            <div class="card-body">
              <div class="skill-bar">
                <div class="skill-level" style="--target: <?= $s['percent'] ?>%;"></div>
              </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-primary"><?= $s['percent'] ?>%</button>
            </div>
          </div>
          <?php endwhile; ?>
        </div>
      </section>
    </main>
  </div>

  <!-- CONTACT -->
  <section id="contact" class="contact-section">
    <div class="section-wrapper">
      <h2 class="section-title">Let’s Connect</h2>
      <p>Looking for a web developer or just want to say hi? Drop us a line!</p>
      <a href="mailto:youremail@example.com" class="btn btn-primary">Email Us</a>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="site-footer">
    <p>© 2025 Team ACE</p>
    <div class="social-links">
      <a href="https://github.com/NeerajCR7-web/php_cms_project"><i class="fa fa-github"></i></a>
      <a href="https://www.linkedin.com/in/neeraj-k-89a460114/"><i class="fa fa-linkedin"></i></a>
    </div>
  </footer>

  <!-- JS: menu toggle & active-link highlighting -->
  <script>
    // Sidebar toggle on mobile
    document.querySelector('.menu-toggle')
      .addEventListener('click', () => {
        document.querySelector('.admin-sidebar').classList.toggle('open');
      });

    // Highlight active link on scroll
    const links = document.querySelectorAll('.admin-menu a');
    const sections = Array.from(links).map(l => document.querySelector(l.getAttribute('href')));
    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          links.forEach(l => l.classList.remove('active'));
          document.querySelector(`.admin-menu a[href="#${e.target.id}"]`).classList.add('active');
        }
      });
    }, { threshold: 0.5 });
    sections.forEach(sec => io.observe(sec));
  </script>
</body>
</html>
