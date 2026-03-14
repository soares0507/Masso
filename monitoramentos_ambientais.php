
<!DOCTYPE html>
<html lang="pt-BR" class="snap-container">
<head>
  <meta charset="UTF-8">
  <title>Monitoramentos Ambientais - MASSO</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="icon" href="logo.ico" type="image/x-icon">
  <style>
    :root {
        --verde: #1a237e; 
        --verde-escuro: #0f153b; 
        --verde-claro-fundo: #f0f4ff; 
        --verde-destaque-hero: #4a63ff;
        --verde-destaque-parallax: #7f97ff;
        --cinza-claro: #f4f6f8;
        --cinza-texto: #5a6470;
        --cinza-escuro: #2c3e50;
        --branco: #ffffff;
        --sombra-padrao: 0 8px 25px rgba(26, 35, 126, 0.07);
        --sombra-hover-forte: 0 12px 35px rgba(26, 35, 126, 0.18);
        --border-radius-sm: 4px;
        --border-radius-md: 8px;
        --border-radius-lg: 16px;
        --transition-fast: 0.2s;
        --transition-std: 0.4s;
        --transition-long: 0.6s;
        --font-principal: 'Poppins', sans-serif;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    html.snap-container {
        scroll-behavior: smooth;
        scroll-snap-type: none; 
    }

    body {
        font-family: var(--font-principal);
        line-height: 1.7;
        color: var(--cinza-texto);
        background-color: var(--branco);
        overflow-x: hidden;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .scroll-snap-section {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 100px 0;
        position: relative;
        overflow: hidden; 
    }
    .hero-section {
        padding-top: 0;
    }
    .site-footer-bottom {
        padding: 70px 0 40px; 
    }

    .container { width: 90%; max-width: 1140px; margin: 0 auto; padding: 0 20px; }
    .btn {
        display: inline-block; padding: 14px 32px; font-weight: 600;
        text-decoration: none; border-radius: var(--border-radius-md);
        transition: all var(--transition-std) cubic-bezier(0.25, 0.8, 0.25, 1);
        cursor: pointer; border: 2px solid transparent; font-size: 1em;
        box-shadow: var(--sombra-padrao); letter-spacing: 0.5px;
    }
    .btn-primary { background-color: var(--verde); color: var(--branco); }
    .btn-primary:hover {
        background-color: var(--verde-escuro);
        transform: translateY(-4px) scale(1.03);
        box-shadow: var(--sombra-hover-forte);
    }
    .btn-outline { background-color: transparent; color: var(--verde); border-color: var(--verde); }
    .btn-outline:hover {
        background-color: var(--verde); color: var(--branco);
        transform: translateY(-4px) scale(1.03);
        box-shadow: var(--sombra-hover-forte);
    }

    /* Header */
    .site-header {
        position: fixed; top: 0; left: 0; width: 100%; z-index: 1000;
        padding: 8px 0; 
        background-color: #1a237e;
        backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
        transition: background-color var(--transition-std), box-shadow var(--transition-std), padding var(--transition-std);
    }
    .site-header.scrolled {
        background-color: var(--verde); 
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        padding: 6px 0; 
    }
    .site-header .main-nav a { color: #ffffff; }
    .site-header .main-nav a::after { background-color: rgba(255,255,255,0.12); }
    .site-header .main-nav a:hover { color: #f0f4ff; }
    .site-header .auth-buttons-header .btn { color: #ffffff; }
    .site-header .auth-buttons-header .btn.btn-outline {
        background-color: transparent;
        color: #ffffff;
        border-color: rgba(255,255,255,0.75);
    }
    .site-header .auth-buttons-header .btn.btn-outline:hover {
        background-color: #ffffff;
        color: var(--verde);
    }
    .site-header .menu-toggle span { background-color: #ffffff; }

    @media (max-width: 992px) {
        .site-header { padding: 6px 0 !important; }
        .site-header.scrolled { padding: 4px 0 !important; }
        .logo { width: 270px !important; }
        .menu-toggle {
            display: block !important;
            position: absolute;
            right: 12px; 
            top: 8px;    
            z-index: 1002;
            background: transparent;
            border: none;
        }
        .menu-toggle span {
            width: 28px;
            height: 3px;
            background-color: #ffffff !important;
        }
        .main-nav, 
        .auth-buttons-header {
            display: none !important;
            position: absolute;
            left: 0;
            width: 100%;
            background-color: #1a237e;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            padding: 20px 0;
            z-index: 999;
        }
        .main-nav.active, .auth-buttons-header.active {
            display: flex !important;
        }
        .main-nav a {
            color: #ffffff;
            padding: 15px 0;
            width: 100%;
            text-align: center;
            display: block;
            font-size: 1.1em;
        }
        .main-nav a:hover { background-color: rgba(255,255,255,0.05); color: var(--verde-destaque-hero); }
        .main-nav a::after { display: none; }
    }

    .header-container { display: flex; align-items: center; justify-content: space-between; }
    .logo { width: 190px; transition: transform var(--transition-std); }
    .logo:hover { transform: scale(1.03) rotate(-2deg); }
    .main-nav { display: flex; gap: 30px; }
    .main-nav a {
        color: var(--cinza-escuro); font-weight: 500; text-decoration: none;
        position: relative; padding-bottom: 8px; font-size: 0.95em;
    }
    .main-nav a::after {
        content: ''; position: absolute; bottom: 0; left: 0; width: 0%; height: 2.5px;
        background-color: var(--verde);
        transition: width var(--transition-long) cubic-bezier(0.19, 1, 0.22, 1);
    }
    .main-nav a:hover::after, .main-nav a.active::after { width: 100%; }
    .main-nav a:hover { color: var(--verde); }
    .auth-buttons-header { display: flex; gap: 12px; }
    .menu-toggle { display: none; background: none; border: none; cursor: pointer; padding: 15px; z-index: 1001; }
    .menu-toggle span { display: block; width: 28px; height: 3px; background-color: var(--cinza-escuro); margin: 6px 0; transition: all var(--transition-std); }
    .menu-toggle.active span:nth-child(1) { transform: translateY(9px) rotate(45deg); }
    .menu-toggle.active span:nth-child(2) { opacity: 0; transform: translateX(-10px); }
    .menu-toggle.active span:nth-child(3) { transform: translateY(-9px) rotate(-45deg); }

    .hero-section {
        background: linear-gradient(135deg, var(--verde-claro-fundo) 0%, var(--cinza-claro) 100%);
        color: var(--cinza-escuro); text-align: center;
        min-height: 60vh;
        padding: 120px 0 80px;
    }
    .hero-content { position: relative; z-index: 1; }
    .hero-tag {
        display: inline-block; padding: 6px 15px; background-color: rgba(26, 35, 126, 0.08);
        color: var(--verde-escuro); border-radius: var(--border-radius-sm);
        font-size: 0.85em; font-weight: 600; letter-spacing: 1px;
        margin-bottom: 25px; text-transform: uppercase;
    }
    .hero-title {
        font-size: clamp(2rem, 5vw, 3.5rem); 
        font-weight: 800;
        line-height: 1.15;
        margin-bottom: 20px;
        color: var(--cinza-escuro);
    }
    .hero-subtitle {
        font-size: clamp(1rem, 2.5vw, 1.3rem); font-weight: 400;
        max-width: 750px; margin: 0 auto 30px; color: var(--cinza-texto);
    }
    .highlight-green { color: var(--verde); }

    .section-title {
        font-size: clamp(2.2rem, 4.5vw, 3.2rem); color: var(--cinza-escuro);
        font-weight: 700; text-align: center; margin-bottom: 20px;
    }
    .section-subtitle {
        font-size: clamp(1rem, 2vw, 1.25rem); color: var(--cinza-texto);
        text-align: center; max-width: 750px; margin: 0 auto 50px;
    }

    .content-section { background-color: var(--branco); }
    .content-text { font-size: 1.2em; line-height: 1.8; color: var(--cinza-texto); margin-bottom: 30px; text-align: justify; }
    .content-grid {
        display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center; margin: 60px 0;
    }
    .content-image img { width: 100%; border-radius: var(--border-radius-lg); box-shadow: var(--sombra-padrao); }

    @media (max-width: 768px) {
        .content-grid { grid-template-columns: 1fr; gap: 30px; }
        .hero-section { min-height: 50vh; padding: 100px 0 60px; }
    }

    .animate-on-scroll { opacity: 0; transform: translateY(50px); transition: opacity 0.8s ease-out, transform 0.8s ease-out; }
    .animate-on-scroll.in-view { opacity: 1; transform: translateY(0); }

    .site-footer-bottom {
        background-color: var(--cinza-escuro); color: #b0bec5;
        padding: 70px 0 40px; font-size: 0.95em;
    }
    .footer-content-grid {
        display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 45px; margin-bottom: 50px;
    }
    .footer-col h4 { font-size: 1.25em; color: var(--branco); font-weight: 600; margin-bottom: 20px; }
    .footer-col p, .footer-col a { color: #b0bec5; text-decoration: none; margin-bottom: 10px; display: block; }
    .footer-col a:hover { color: var(--verde); }
    .footer-copyright { text-align: center; padding-top: 40px; border-top: 1px solid #4a5c6a; color: #78909c; }

    .email-contact-section {
      background-color: var(--branco);
      color: var(--cinza-escuro);
      padding: 60px 0;
      text-align: center;
    }
    .email-contact-container { width: 90%; max-width: 900px; margin: 0 auto; }
    .email-contact-section p.instruction {
      font-size: 1.05rem; margin-bottom: 18px; color: var(--cinza-texto);
    }
    .email-form { display: flex; gap: 12px; flex-direction: column; align-items: stretch; margin-top: 30px; }
    .email-form textarea {
      min-height: 160px; padding: 14px; border-radius: var(--border-radius-md);
      border: 1px solid #e6e9ee; font-family: inherit; resize: vertical;
      font-size: 1rem; color: var(--cinza-escuro);
    }
    .email-form .email-actions { display:flex; gap:12px; justify-content:flex-end; align-items:center; }

    .form-group {
      display: flex;
      flex-direction: column;
      margin-bottom: 12px;
      text-align: left;
    }
    .form-group label {
      margin-bottom: 6px;
      font-weight: 500;
      color: var(--cinza-escuro);
      font-size: 0.95em;
    }
    .form-group input,
    .form-group select,
    .form-group textarea {
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #e6e9ee;
      font-family: inherit;
      font-size: 1rem;
      color: var(--cinza-escuro);
    }
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: var(--verde);
      box-shadow: 0 0 0 3px rgba(26, 35, 126, 0.1);
    }
    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }
    @media (max-width: 768px) {
      .form-row {
        grid-template-columns: 1fr;
      }
      .email-form .email-actions { flex-direction: column-reverse; }
    }

    .floating-icon {
      position: fixed;
      bottom: 30px;
      right: 30px;
      z-index: 900;
      width: 80px;
      height: 100px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform var(--transition-std);
      cursor: pointer;
    }
    .floating-icon:hover { transform: scale(1.1); }
    .floating-icon img { width: 100%; height: 100%; border-radius: 50%; object-fit: contain; }

    @media (max-width: 768px) {
      .floating-icon { bottom: 20px; right: 20px; width: 85px; height: 85px; }
    }
    @media (max-width: 480px) {
      .floating-icon { bottom: 15px; right: 15px; width: 70px; height: 70px; }
    }
  </style>
</head>
<body>

  <header class="site-header">
    <div class="container header-container">
      <div class="logo-container">
        <a href="index.php"><img src="logos/logo1.png" alt="Logo Circuito Sustentável" class="logo"></a>
      </div>
      <nav class="main-nav">
        <a href="index.php#features">Sobre a empresa</a>
        <a href="index.php#nossa-visao">Serviços</a>
        <a href="index.php#cta">Áreas de atuação</a>
        <a href="#contato-email">Contato</a>
      </nav>
      <div class="auth-buttons-header">
        <div class="lang-switch" style="display:flex;align-items:center;gap:8px;">
          <label for="langSelect" class="visually-hidden" style="position:absolute;left:-9999px;">Idioma</label>
          <select id="langSelect" aria-label="Selecionar idioma" class="btn btn-outline" style="padding:8px 12px;min-width:88px;">
            <option value="pt-BR">PT-BR</option>
            <option value="en-US">EN</option>
          </select>
        </div>
      </div>
      <button class="menu-toggle" aria-label="Abrir menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>
  </header>

  <main>

    <section id="hero" class="hero-section">
      <div class="container hero-content">
        <span class="hero-tag">TEXTO</span>
        <h1 class="hero-title">TE<span class="highlight-green">X</span>TO</h1>
        <p class="hero-subtitle">TEXTO.</p>
      </div>
    </section>

    <section class="content-section scroll-snap-section">
      <div class="container">
        <h2 class="section-title animate-on-scroll">TEXTO</h2>
        <p class="section-subtitle animate-on-scroll">TEXTO</p>

        <div class="content-grid animate-on-scroll">
          <div>
            <h3 style="color: var(--cinza-escuro); font-size: 2.8em; margin-bottom: 15px;">Engenharia ambiental</h3>
            <p class="content-text">•Licenciamento, Estudos ambientais e Planos de Monitoramento;</p>
            <p class="content-text">•Monitoramento Diversos (NPS, PTS, PM10, MP2,5, Arqueológico, Hídricos, Efluentes, SWAB e potabilidade).</p>
          </div>
          <div class="content-image">
            <img src="carrosel/b.png" alt="Descrição da imagem">
          </div>
        </div>

        <div class="content-grid animate-on-scroll" style="direction: rtl;">
          <div style="direction: ltr;">
            <h3 style="color: var(--cinza-escuro); font-size: 2.8em; margin-bottom: 15px;">Mão de Obra dedicada</h3>
            <p class="content-text">•Ofertamos mão de obra dedicada por projeto e necessidade.</p>
            <p class="content-text"></p>
          </div>
          <div class="content-image">
            <img src="carrosel/a.png" alt="Descrição da imagem 2">
          </div>
        </div>
      </div>
    </section>

  </main>

  <footer class="site-footer-bottom">
    <div class="container footer-content-grid">
      <div class="footer-col">
        <h4>Navegue</h4>
        <a href="index.php">Início</a>
        <a href="index.php#features">Sobre a empresa</a>
        <a href="index.php#nossa_visao">Serviços</a>
        <a href="index.php#cta">Áreas de atuação</a>
      </div>
      <div class="footer-col">
        <h4>Contato</h4>
        <p>masso@massose.com</p>
        <p>(85) 981825753</p>
      </div>
      <div class="footer-col">
        <h4>Informações da empresa</h4>
        <p>CNPJ: 11.855.544/0001-51</p>
        <p>Rua Beatriz Braga, 119, Sala 104. Centro. São Gonçalo do Amarante, CE. 62.670-000</p>
      </div>
    </div>
    <div class="footer-copyright">
      &copy; <?php echo date("Y"); ?> MASSO SERVIÇOS ESPECIALIZADOS LTDA. Todos os direitos reservados.
    </div>
  </footer>

  <a href="https://wa.me/5585981825753" target="_blank" rel="noopener" class="floating-icon" title="Abrir WhatsApp" aria-label="Ícone do WhatsApp">
    <img src="logos/w.png" alt="Ícone do WhatsApp">
  </a>

  <script>
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    const authButtonsHeader = document.querySelector('.auth-buttons-header');

    if (menuToggle && mainNav && authButtonsHeader) {
        menuToggle.addEventListener('click', () => {
            const isActive = mainNav.classList.toggle('active');
            authButtonsHeader.classList.toggle('active');
            menuToggle.classList.toggle('active');
            menuToggle.setAttribute('aria-expanded', isActive);
        });
        const navLinks = mainNav.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (mainNav.classList.contains('active')) {
                    mainNav.classList.remove('active');
                    authButtonsHeader.classList.remove('active');
                    menuToggle.classList.remove('active');
                    menuToggle.setAttribute('aria-expanded', 'false');
                }
            });
        });
    }

    const header = document.querySelector('.site-header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
            }
        });
    }, { threshold: 0.1 });
    animatedElements.forEach(el => observer.observe(el));

    (function(){
      const userPhone = document.getElementById('user_phone');
      const personTypeSelect = document.getElementById('person_type');
      const cpfCnpjInput = document.getElementById('cpf_cnpj');
      const cpfCnpjLabel = document.getElementById('cpf_cnpj_label');
      
      function formatPhone(value) {
        const numbers = value.replace(/\D/g, '').slice(0, 11);
        if (numbers.length <= 2) return numbers;
        if (numbers.length <= 7) return numbers.replace(/(\d{2})(\d)/, '($1) $2');
        return numbers.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
      }
      function formatCPF(value) {
        const numbers = value.replace(/\D/g, '').slice(0, 11);
        if (numbers.length <= 3) return numbers;
        if (numbers.length <= 6) return numbers.replace(/(\d{3})(\d)/, '$1.$2');
        if (numbers.length <= 9) return numbers.replace(/(\d{3})(\d{3})(\d)/, '$1.$2.$3');
        return numbers.replace(/(\d{3})(\d{3})(\d{3})(\d{1,2})/, '$1.$2.$3-$4');
      }
      function formatCNPJ(value) {
        const numbers = value.replace(/\D/g, '').slice(0, 14);
        if (numbers.length <= 2) return numbers;
        if (numbers.length <= 5) return numbers.replace(/(\d{2})(\d)/, '$1.$2');
        if (numbers.length <= 8) return numbers.replace(/(\d{2})(\d{3})(\d)/, '$1.$2.$3');
        if (numbers.length <= 12) return numbers.replace(/(\d{2})(\d{3})(\d{3})(\d)/, '$1.$2.$3/$4');
        return numbers.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{1,2})/, '$1.$2.$3/$4-$5');
      }
      if (userPhone) {
        userPhone.addEventListener('input', (e) => {
          e.target.value = formatPhone(e.target.value);
        });
        userPhone.maxLength = 14; 
      }
      function updatePersonTypeFields() {
        const isFisica = personTypeSelect.value === 'fisica';
        cpfCnpjLabel.textContent = isFisica ? 'CPF *' : 'CNPJ *';
        cpfCnpjInput.placeholder = isFisica ? '000.000.000-00' : '00.000.000/0000-00';
        cpfCnpjInput.value = '';
        cpfCnpjInput.maxLength = isFisica ? 14 : 18;
      }
      if (cpfCnpjInput) {
        cpfCnpjInput.addEventListener('input', (e) => {
          const isFisica = personTypeSelect.value === 'fisica';
          e.target.value = isFisica ? formatCPF(e.target.value) : formatCNPJ(e.target.value);
        });
      }
      if (personTypeSelect) {
        personTypeSelect.addEventListener('change', updatePersonTypeFields);
      }
    })();

    (function(){
      const LANG_PARAM = 'lang';
      const DEFAULT_LANG = 'pt-BR';
      const select = document.getElementById('langSelect');

      function getLangFromQuery() {
        try {
          const params = new URLSearchParams(window.location.search);
          return params.get(LANG_PARAM);
        } catch(e) { return null; }
      }

      function applyLang(lang) {
        if (!lang) lang = DEFAULT_LANG;
        document.documentElement.lang = lang;
        try { localStorage.setItem('siteLang', lang); } catch(e){}
      }
      const qLang = getLangFromQuery();
      const stored = (() => { try { return localStorage.getItem('siteLang'); } catch(e){ return null; } })();
      const initial = qLang || stored || DEFAULT_LANG;
      applyLang(initial);
      if (select) select.value = initial;
      if (select) {
        select.addEventListener('change', (e) => {
          const v = e.target.value;
          applyLang(v);
        });
      }
    })();
  </script>
</body>
</html>
