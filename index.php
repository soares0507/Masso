<?php
// Processamento de email removido
?>
<!DOCTYPE html>
<html lang="pt-BR" class="snap-container">
<head>
  <meta charset="UTF-8">
  <title>MASSO</title>
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
    .btn-large { padding: 18px 45px; font-size: 1.15em; }
    .btn-pulse { animation: pulseAnimation 2s infinite ease-in-out; }

    @keyframes pulseAnimation {
        0% { transform: scale(1); box-shadow: var(--sombra-padrao); }
        50% { transform: scale(1.05); box-shadow: var(--sombra-hover-forte); }
        100% { transform: scale(1); box-shadow: var(--sombra-padrao); }
    }
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
        .site-header {
            padding: 6px 0 !important; 
        }
        .site-header.scrolled {
            padding: 4px 0 !important; 
        }
        .logo {
            width: 270px !important;
        }
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
        .main-nav {
            top: 100%; 
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .auth-buttons-header {
            top: auto; 
            position: relative;
            background: transparent; 
            box-shadow: none;
            padding-top: 0;
        }
        .main-nav.active {
            display: flex !important;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: #1a237e;
            padding: 20px 0;
            z-index: 999;
        }
        
        .auth-buttons-header.active {
            display: flex !important;
            position: absolute;
            top: calc(100% + 220px);
            left: 0;
            width: 100%;
            background-color: #1a237e;
            padding-bottom: 20px;
            align-items: center;
            z-index: 998;
        }
        .main-nav a {
            color: #ffffff;
            padding: 15px 0;
            width: 100%;
            text-align: center;
            display: block;
            font-size: 1.1em;
        }
        
        .main-nav a:hover {
            background-color: rgba(255,255,255,0.05);
            color: var(--verde-destaque-hero);
        }

        .main-nav a::after {
            display: none; 
        }
        .auth-buttons-header .btn {
            width: 80%;
            margin: 10px 0;
            text-align: center;
            justify-content: center;
        }
    }
    @media (max-width: 992px) {
        .menu-toggle {
            display: block !important;
            position: absolute;
            right: 4px;
            top: 10px;
            z-index: 1002;
            background: transparent;
            border: none;
        }
        .menu-toggle span {
            display: block;
            width: 30px;
            height: 3px;
            margin: 6px 0;
            background-color: #ffffff !important;
            border-radius: 2px;
            transition: all 0.4s;
            margin-top: -100px;
        }
        .main-nav, 
        .auth-buttons-header {
            display: none !important;
        }
        .main-nav.active {
            display: flex !important;
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: #1a237e;
            padding: 20px 0;
            z-index: 999;
        }
        
        .auth-buttons-header.active {
            display: flex !important;
            flex-direction: column;
            position: absolute;
            top: calc(100% + 220px);
            left: 0;
            width: 100%;
            background-color: #1a237e;
            padding-bottom: 20px;
            align-items: center;
            z-index: 998;
        }
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
    }
    .hero-background-shapes { position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; z-index: 0;}
    .hero-background-shapes .shape {
        position: absolute; border-radius: 50%; opacity: 0.1;
        background: var(--verde);
        transition: transform 0.1s linear;
    }
    .shape-1 { width: 200px; height: 200px; top: 10%; left: 15%; }
    .shape-2 { width: 100px; height: 100px; bottom: 20%; right: 10%; background: var(--verde-destaque-hero); }
    .shape-3 { width: 150px; height: 150px; top: 50%; left: 5%; opacity: 0.05; }

    .hero-content { position: relative; z-index: 1; }
    .hero-tag {
        display: inline-block; padding: 6px 15px; background-color: rgba(26, 35, 126, 0.08);
        color: var(--verde-escuro); border-radius: var(--border-radius-sm);
        font-size: 0.85em; font-weight: 600; letter-spacing: 1px;
        margin-bottom: 25px; text-transform: uppercase;
    }
    .hero-title {
        font-size: clamp(1rem, 7vw, 4rem); 
        font-weight: 800;
        line-height: 1.15;
        margin-bottom: 25px;
        color: var(--cinza-escuro);
    }
    .hero-subline { display: inline; }
    @media (max-width: 768px) {
      .hero-title {
        font-size: clamp(2.3rem, 6.5vw, 2.6rem); 
        line-height: 1.18;
        margin-bottom: 18px;
        letter-spacing: -0.2px;
      }
      .hero-subline { display: inline; } 
      .hero-tag { margin-bottom: 18px; }
      .hero-subtitle { margin-bottom: 30px; }
    }

    
    @media (min-width: 769px) {
      .hero-subline { display: block; }
    }

    .highlight-green { color: var(--verde); }
    .hero-subtitle {
        font-size: clamp(1.1rem, 2.5vw, 1.5rem); font-weight: 400;
        max-width: 750px; margin: 0 auto 45px; color: var(--cinza-texto);
    }
    .btn-hero {
        padding: 20px 50px; font-size: 1.25em;
        background-color: var(--verde); color: var(--branco);
        box-shadow: 0 8px 25px rgba(26,35,126,0.3);
    }
    .btn-hero:hover {
        background-color: var(--verde-escuro); color: var(--branco);
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 12px 35px rgba(26,35,126,0.4);
    }
    .scroll-down-indicator {
        position: absolute; bottom: 40px; left: 50%; transform: translateX(-50%);
        color: var(--verde); opacity: 0.6;
        transition: opacity var(--transition-std), transform var(--transition-std);
        animation: bounceUpDown 2.5s infinite ease-in-out;
    }
    .scroll-down-indicator:hover { opacity: 1; transform: translateX(-50%) scale(1.15); }
    @keyframes bounceUpDown {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(-12px); }
    }

    .animate-fade-in-down { opacity: 0; transform: translateY(-30px); animation: fadeInDown 1s var(--transition-std) forwards; }
    @keyframes fadeInDown { to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in-up { opacity: 0; transform: translateY(30px); animation: fadeInUp 1s var(--transition-std) forwards; }
    @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }
    .delay-1 { animation-delay: 0.5s !important; }
    .delay-2 { animation-delay: 1s !important; }

    
    .features-section { background-color: var(--branco); }
    .section-title {
        font-size: clamp(2.2rem, 4.5vw, 3.2rem); color: var(--cinza-escuro);
        font-weight: 700; text-align: center; margin-bottom: 20px;
    }
    .section-subtitle {
        font-size: clamp(1rem, 2vw, 1.25rem); color: var(--cinza-texto);
        text-align: center; max-width: 750px; margin: 0 auto 70px;
    }
    .features-grid {
        display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 35px;
    }
    .feature-card {
        background-color: var(--branco); padding: 40px;
        border-radius: var(--border-radius-lg); box-shadow: var(--sombra-padrao);
        text-align: left;
        transition: transform var(--transition-std) cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow var(--transition-std) cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid var(--cinza-claro);
    }
    .feature-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 50px rgba(26,35,126,0.12);
        border-color: var(--verde-claro-fundo);
    }
    .feature-icon-wrapper {
        display: inline-flex; background-color: var(--verde-claro-fundo);
        padding: 18px; border-radius: 50%;
        margin-bottom: 25px; color: var(--verde);
    }
    .feature-icon { width: 36px; height: 36px; }
    .feature-card h3 {
        font-size: 1.6em; color: var(--cinza-escuro); font-weight: 600;
        margin-bottom: 12px;
    }
    .feature-card p { font-size: 0.95em; line-height: 1.8; }

    .content-section { background-color: var(--branco); }
    .content-text { font-size: 1.2em; line-height: 1.8; color: var(--cinza-texto); margin-bottom: 30px; text-align: justify; }
    .content-grid {
        display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center; margin: 60px 0;
    }
    .content-image img { width: 100%; border-radius: var(--border-radius-lg); box-shadow: var(--sombra-padrao); }

    @media (max-width: 768px) {
        .content-grid { grid-template-columns: 1fr; gap: 30px; }
    }

    .animate-on-scroll { opacity: 0; transform: translateY(50px); transition: opacity 0.8s ease-out, transform 0.8s ease-out; }
    .animate-on-scroll.in-view { opacity: 1; transform: translateY(0); }
    .animate-on-scroll.delay-0-2s { transition-delay: 0.2s; }
    .animate-on-scroll.delay-0-4s { transition-delay: 0.4s; }
    .animate-on-scroll.delay-0-6s { transition-delay: 0.6s; }
    .animate-on-scroll.delay-0-8s { transition-delay: 0.8s; }

    
    .parallax-section {
        background-image: url('https://images.unsplash.com/photo-1476231682828-37e571bc172f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1674&q=80');
        background-attachment: fixed; background-position: center; background-repeat: no-repeat; background-size: cover;
        text-align: center;
    }
    .parallax-content {
        background-color: rgba(10, 25, 41, 0.70);
        padding: 80px 40px; border-radius: var(--border-radius-lg);
        display: inline-block; max-width: 850px;
    }
    .light-text { color: var(--branco); text-shadow: 0 2px 8px rgba(0,0,0,0.6); }
    .highlight-parallax { color: var(--verde-destaque-parallax); }

    .vision-text-block {
        margin-top: 30px; text-align: justify;
        font-size: 1.05em; line-height: 1.8;
        opacity: 0.95;
    }
    .vision-text-block p {
        margin-bottom: 20px;
    }
    .vision-quote {
        font-size: 1.1em; font-style: italic;
        color: var(--cinza-claro); padding-top: 15px;
        border-top: 1px solid rgba(255,255,255,0.2);
        margin-top: 25px; text-align: center;
    }
    .vision-quote em::before { content: "“"; margin-right: 5px; font-size: 1.2em; }
    .vision-quote em::after { content: "”"; margin-left: 5px; font-size: 1.2em; }

    
    .cta-section { background-color: var(--cinza-claro); }
    .cta-container-grid {
        display: grid; grid-template-columns: 1fr 1fr;
        align-items: center; gap: 60px; text-align: left;
    }
    .cta-image-side img {
        max-width: 100%; height: auto; border-radius: var(--border-radius-lg);
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }
    .cta-text-content .section-title, .cta-text-content .section-subtitle { text-align: left; margin-left:0; margin-right:0; }
    .cta-action { margin-top: 30px; }
    .cta-login { margin-top: 25px; font-size: 0.95em; }
    .cta-login a { color: var(--verde); font-weight: 600; text-decoration: none; }
    .cta-login a:hover { text-decoration: underline; color: var(--verde-escuro); }
    #ctaCarousel {
      width: 100%;
      max-width: 900px; 
      margin: 0 auto;
      position: relative;
      overflow: hidden;
      min-height: 420px;
      box-sizing: border-box;
    }
    #ctaCarousel .cta-slide {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      box-sizing: border-box;
      opacity: 0;
      transform: translateY(10px) scale(0.995);
      transition: opacity 450ms cubic-bezier(.2,.9,.2,1), transform 450ms cubic-bezier(.2,.9,.2,1);
      pointer-events: none;
      z-index: 1;
    }
    #ctaCarousel .cta-slide.active {
      opacity: 1;
      transform: translateY(0) scale(1);
      pointer-events: auto;
      z-index: 2;
    }
    #ctaCarousel .cta-slide img {
      width: 100%;
      height: 440px;
      object-fit: cover;
      border-radius: 12px;
      display: block;
    }
    #ctaCarousel .cta-prev,
    #ctaCarousel .cta-next {
      z-index: 6 !important;
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      pointer-events: auto;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
    }
    #ctaCarousel .cta-prev { left: 8px; }
    #ctaCarousel .cta-next { right: 8px; }
    #ctaCarousel .cta-dots {
      position: relative;
      z-index: 6;
      pointer-events: auto;
      margin-top: 12px;
      text-align: center;
    }
    @media (max-width: 1024px) {
      #ctaCarousel { max-width: 760px; min-height: 380px; }
      #ctaCarousel .cta-slide img { height: 380px; }
    }
    @media (max-width: 768px) {
      .cta-container-grid { display: block; gap: 18px; }
      .cta-carousel-side { margin: 0 auto; width: 100%; }
      .cta-text-content { max-width: 100%; margin-top: 18px; }

      #ctaCarousel { max-width: 100%; min-height: 260px; }
      #ctaCarousel .cta-slide img { height: 220px; border-radius: 10px; }
      #ctaCarousel .cta-prev, #ctaCarousel .cta-next {
        width: 36px; height: 36px;
        display: none;
      }
      #ctaCarousel .cta-prev { left: 6px; }
      #ctaCarousel .cta-next { right: 6px; }
      #ctaCarousel .cta-dots { margin-top: 8px; }
    }
    @media (max-width: 480px) {
      #ctaCarousel { min-height: 200px; }
      #ctaCarousel .cta-slide img { height: 180px; border-radius: 8px; }
      #ctaCarousel .cta-prev, #ctaCarousel .cta-next { width: 32px; height: 32px; }
      #ctaCarousel .cta-prev { left: 4px; }
      #ctaCarousel .cta-next { right: 4px; }
      .cta-text-content .section-title { font-size: 1.95rem; }
      .cta-text-content .section-subtitle { font-size: 0.95rem; }
    }

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
    .footer-col a:hover { color: var(--verde); transform: translateX(3px); transition: transform var(--transition-fast); }
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
    .contact-options {
      display: flex;
      flex-direction: column;
      gap: 32px;
      align-items: center;
      justify-content: center;
      margin: 40px 0;
      width: 100%;
    }
    .contact-btn {
      width: 90%;
      max-width: 480px;
      padding: 38px 0;
      font-size: 1.45em;
      font-weight: 700;
      border-radius: var(--border-radius-lg);
      border: 2px solid var(--verde);
      background: var(--verde-claro-fundo);
      color: var(--verde);
      box-shadow: var(--sombra-padrao);
      cursor: pointer;
      transition: background var(--transition-fast), color var(--transition-fast), transform var(--transition-fast);
      margin: 0 auto;
      display: block;
    }
    .contact-btn:hover {
      background: var(--verde);
      color: var(--branco);
      transform: scale(1.03);
      box-shadow: var(--sombra-hover-forte);
    }
    
    #optWhats.contact-btn {
      background: #21C063 !important;
      color: #fff !important;
      border-color: #21C063 !important;
      box-shadow: var(--sombra-padrao);
      transition: transform var(--transition-fast);
    }
    #optWhats.contact-btn:hover {
      background: #21C063 !important;
      color: #fff !important;
      transform: scale(1.03);
      box-shadow: var(--sombra-padrao) !important;
    }
   
    #optEmail.contact-btn {
      width: 90%;
      max-width: 480px;
      padding: 38px 0;
      font-size: 1.45em;
      font-weight: 700;

      
      background: #ffffff !important;
      color: #1a237e !important;
      border-color: #1a237e !important;
      box-shadow: var(--sombra-padrao);
      transition: transform var(--transition-fast), background var(--transition-fast);
    }
    #optEmail.contact-btn:hover {
      background: #1a237e !important; 
      color: #ffffff !important;
      transform: scale(1.03);
      box-shadow: var(--sombra-hover-forte);
    }
    .hidden { display: none !important; }
    .email-form { display: flex; gap: 12px; flex-direction: column; align-items: stretch; margin-top: 30px; }
    .email-form textarea {
      min-height: 160px; padding: 14px; border-radius: var(--border-radius-md);
      border: 1px solid #e6e9ee; font-family: inherit; resize: vertical;
      font-size: 1rem; color: var(--cinza-escuro);
    }
    .email-form .email-actions { display:flex; gap:12px; justify-content:flex-end; align-items:center; }
    .email-form .note { flex:1; font-size:0.95rem; color:var(--cinza-texto); text-align:left; }
    @media (max-width: 768px) {
      .contact-btn { font-size: 1.1em; padding: 28px 0; }
      .contact-options { gap: 18px; }
      .email-form .email-actions { flex-direction: column-reverse; gap:10px; }
      .email-form .note { text-align:center; }
    }
    .carousel-section { background-color: var(--branco); }
    .carousel { position: relative; overflow: hidden; border-radius: var(--border-radius-lg); margin-top: 30px; }
    .carousel-track { display:flex; transition: transform 0.2s cubic-bezier(0.25, 0.46, 0.45, 0.94); will-change: transform; }
    .carousel-slide { min-width:100%; box-sizing:border-box; position:relative; }
    .carousel-slide img { width:100%; height:420px; object-fit:cover; display:block; border-radius:8px; }
    .carousel-caption { position:absolute; bottom:18px; left:18px; right:18px; background:rgba(0,0,0,0.45); color:#fff; padding:16px; border-radius:8px; }
    .carousel-caption h3 { margin:0 0 6px; font-size:1.25rem; }
    .carousel-caption p { margin:0; font-size:0.95rem; line-height:1.4; opacity:0.95; }
    .carousel-controls { position:absolute; top:50%; left:0; right:0; display:flex; justify-content:space-between; transform:translateY(-50%); pointer-events:none; }
    .carousel-button { pointer-events:auto; background:rgba(0,0,0,0.5); border:0; color:#fff; width:44px; height:44px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 12px; cursor:pointer; }
    .carousel-dots { text-align:center; padding:12px 0 0; }
    .carousel-dot { display:inline-block; width:10px; height:10px; border-radius:50%; background:#cfd8dc; margin:0 6px; cursor:pointer; border: none; }
    .carousel-dot.active { background:var(--verde); }
    
    @media (max-width:1024px) {
      .carousel-slide img { height:360px; }
      .carousel-caption { padding:14px; bottom:14px; left:14px; right:14px; }
      .carousel-caption h3 { font-size:1.15rem; margin-bottom:4px; }
      .carousel-caption p { font-size:0.9rem; line-height:1.3; }
    }
    
    @media (max-width:768px) {
      .carousel-slide img { height:280px; }
      .carousel-caption { padding:12px; bottom:10px; left:10px; right:10px; }
      .carousel-caption h3 { font-size:1.05rem; margin-bottom:3px; }
      .carousel-caption p { font-size:0.85rem; line-height:1.3; opacity:0.9; }
      .carousel-controls { display: none; visibility: hidden; pointer-events: none; }
    }
    
    @media (max-width:480px) {
      .carousel-slide img { height:220px; }
      .carousel-caption { padding:10px 8px; bottom:8px; left:8px; right:8px; }
      .carousel-caption h3 { font-size:0.95rem; margin-bottom:2px; font-weight:600; }
      .carousel-caption p { font-size:0.8rem; line-height:1.25; opacity:0.88; }
    }
    .cta-img-mobile { display: none; margin: 22px auto 0; max-width: 100%; border-radius: var(--border-radius-lg); box-shadow: 0 15px 40px rgba(0,0,0,0.1); }
    @media (max-width: 768px) {
      .cta-container-grid { display: block; }
      .cta-image-side { display: none; }
      .cta-img-mobile { display: block; }
    }
    @media (min-width: 769px) {
      .cta-img-mobile { display: none !important; }
      .cta-image-side { display: block; }
    }

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
    }
    .floating-icon {
      position: fixed;
      bottom: 30px;
      right: 30px;
      z-index: 900;
      width: 80px;
      height: 100px;
      border-radius: 50%;
      background-color: transparent;
      box-shadow: none;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform var(--transition-std);
      cursor: pointer;
    }
    .floating-icon:hover {
      transform: scale(1.1);
    }
    .floating-icon img {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      object-fit: contain;
      padding: 0;
    }
    @media (max-width: 768px) {
      .floating-icon {
        bottom: 20px;
        right: 20px;
        width: 85px;
        height: 85px;
      }
    }
    @media (max-width: 480px) {
      .floating-icon {
        bottom: 15px;
        right: 15px;
        width: 70px;
        height: 70px;
      }
    }

    .hidden-field {
      display: none;
    }
    @media (max-width: 768px) {
          #servicos .content-grid {
            display: block !important;
            gap: 18px !important;
            margin: 32px 0 !important;
          }
          #servicos .content-image {
            margin: 18px 0 0 0 !important;
            text-align: center !important;
          }
          #servicos .content-image img {
            max-width: 100% !important;
            height: auto !important;
            border-radius: 12px !important;
            box-shadow: 0 8px 25px rgba(26,35,126,0.07) !important;
          }
          #servicos h3 {
            font-size: 1.45em !important;
            margin-bottom: 10px !important;
          }
          #servicos .content-text {
            font-size: 1em !important;
            margin-bottom: 12px !important;
          }
        }
    .mini-carousel { position: relative; max-width: 480px; margin: 0 auto; }
    .mini-carousel-track { display: flex; transition: transform 0.4s cubic-bezier(.2,.9,.2,1); }
    .mini-carousel-slide { min-width: 100%; box-sizing: border-box; display: none; }
    .mini-carousel-slide.active { display: block; }
    .mini-carousel-prev, .mini-carousel-next {
      position: absolute; top: 50%; transform: translateY(-50%);
      background: rgba(0,0,0,0.45); color: #fff; border: none;
      width: 40px; height: 40px; border-radius: 50%; cursor: pointer; z-index: 2;
      font-size: 1.8em; display: flex; align-items: center; justify-content: center;
      transition: background 0.2s;
    }
    .mini-carousel-prev:hover, .mini-carousel-next:hover { background: rgba(0,0,0,0.65); }
    .mini-carousel-prev { left: 8px; }
    .mini-carousel-next { right: 8px; }
    .mini-carousel-dots { text-align: center; margin-top: 10px; }
    .mini-carousel-dot {
      display: inline-block; width: 10px; height: 10px; border-radius: 50%;
      background: #cfd8dc; margin: 0 6px; border: none; cursor: pointer;
      transition: background 0.2s;
    }
    .mini-carousel-dot.active { background: var(--verde); }
    @media (max-width: 768px) {
      .mini-carousel { max-width: 100%; }
      .mini-carousel-prev, .mini-carousel-next { display: none !important; }
    }
  </style>
</head>
<body>
  <header class="site-header">
    <div class="container header-container">
      <div class="logo-container">
        <a href="#hero"><img src="logos/logo1.png" alt="Logo Circuito Sustentável" class="logo"></a>
      </div>
      <nav class="main-nav">
        <a href="#sobre">Sobre a empresa</a>
        <a href="#servicos">Serviços</a>
        <a href="#cta">Áreas de atuação</a>
        <a href="#contato-email">Contato</a>
      </nav>
      <div class="auth-buttons-header">
      </div>
      <button class="menu-toggle" aria-label="Abrir menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>
  </header>
  <main>
    <section id="hero" class="hero-section scroll-snap-section">
      <div class="hero-background-shapes">
          <div class="shape shape-1"></div>
          <div class="shape shape-2"></div>
          <div class="shape shape-3"></div>
      </div>
      <div class="container hero-content">
        <h1 class="hero-title animate-fade-in-up">
          Transformando <span class="highlight-green">Desafios</span><span class="hero-subline"> em Soluções <span class="highlight-green">Sustentáveis</span>.</span>
        </h1>
        <p class="hero-subtitle animate-fade-in-up delay-1"></p>
        <a href="#sobre" class="btn btn-hero animate-fade-in-up delay-2">Descubra Como</a>
      </div>
      <a href="#sobre" class="scroll-down-indicator" aria-label="Rolar para baixo">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="48px" height="48px"><path d="M12 15.586l-4.293-4.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0l5-5a1 1 0 00-1.414-1.414L12 15.586zM12 2a1 1 0 00-1 1v10a1 1 0 002 0V3a1 1 0 00-1-1z"/></svg>
      </a>
    </section>
    <section id="sobre" class="features-section scroll-snap-section">
      <div class="container">
        <h2 class="section-title animate-on-scroll">Engenharia e Meio Ambiente em Sintonia</h2>
        <p class="section-subtitle animate-on-scroll delay-0-2s">A Masso Serviços Especializados foi fundada em abril de 2010. Possui ampla experiência em programas ambientais, estudos, engenharia de sustentabilidade e monitoramentos voltados à legalidade dos clientes e seus empreendimentos. A empresa atua com Disciplinas Core, cada uma conduzida por especialistas, garantidores da qualidade nas entregas.</p>
        <div class="features-grid">
          <div class="feature-card animate-on-scroll">
            <div class="feature-icon-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="feature-icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.447a1 1 0 00-.364 1.118l1.286 3.955c.3.921-.755 1.688-1.54 1.118L12 15.347l-3.497 2.673c-.785.57-1.84-.197-1.54-1.118l1.286-3.955a1 1 0 00-.364-1.118L4.516 9.382c-.783-.57-.381-1.81.588-1.81h4.162a1 1 0 00.95-.69L11.05 2.927z" />
</svg>
            </div>
            <h3>15 anos de empresa</h3>
            <p>A mais de quinze anos de experiência dedicada a soluções ambientais eficientes, com entregas confiáveis e foco no desenvolvimento legal e sustentável.</p>
          </div>
          <div class="feature-card animate-on-scroll delay-0-2s">
            <div class="feature-icon-wrapper">
             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="feature-icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 3l5 6H7l5-6z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 7l5 6H7l5-6z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 11l5 6H7l5-6z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 17v4" />
</svg>
            </div>
            <h3>Meio ambiente</h3>
            <p>Atuamos com responsabilidade ambiental, promovendo práticas que preservam recursos naturais e impulsionam um futuro sustentável.</p>
          </div>
          <div class="feature-card animate-on-scroll delay-0-4s">
            <div class="feature-icon-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="feature-icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 8.25A2.25 2.25 0 016 6h12a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18V8.25z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6V4.875A1.125 1.125 0 019.375 3.75h5.25A1.125 1.125 0 0115.75 4.875V6" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 11.25v3" />
</svg>
            </div>
            <h3>Profissionais</h3>
            <p>Atuamos por Disciplinas Core, nossos especialistas são experientes e garantidores de qualidade, precisão, tendo alto compromisso em cada projeto realizado.</p>
          </div>
        </div>
      </div>
    </section>
    <section id="servicos" class="content-section scroll-snap-section">
    <div class="container">
        <h2 class="section-title animate-on-scroll">Nossos Serviços</h2>
        <p class="section-subtitle animate-on-scroll">Conheça como ajudamos empresas e pessoas a adotarem práticas mais sustentáveis.</p>

        <div class="content-grid animate-on-scroll">
            <div>
                <h3 style="color: var(--cinza-escuro); font-size: 2.8em; margin-bottom: 15px;">Engenharia ambiental</h3>
                <p class="content-text">• Licenciamento, Estudos ambientais e Planos de Monitoramento;</p>
                <p class="content-text">• Monitoramento Diversos (NPS, PTS, PM10, MP2,5, Arqueológico, Hídricos, Efluentes, SWAB e potabilidade).</p>
            </div>
            <div class="content-image">
                <div class="mini-carousel" id="carousel-engenharia">
                  <?php
                    $produtosDir = __DIR__ . '/produtos';
                    $imgs = [];
                    if (is_dir($produtosDir)) {
                      $files = scandir($produtosDir);
                      foreach ($files as $f) {
                        $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
                        if (in_array($ext, ['jpg','jpeg','png','gif','webp'])) {
                          $imgs[] = 'produtos/' . $f;
                        }
                      }
                      natsort($imgs);
                      $imgs = array_values($imgs);
                    }
                    if (empty($imgs)) {
                      $imgs = ['carrosel/b.png','carrosel/c1.png'];
                    }
                  ?>
                  <div class="mini-carousel-track">
                    <?php foreach ($imgs as $i => $src): ?>
                      <div class="mini-carousel-slide <?php echo ($i === 0) ? 'active' : ''; ?>">
                        <img src="<?php echo htmlspecialchars($src, ENT_QUOTES); ?>" alt="Engenharia ambiental <?php echo $i+1; ?>" style="width:100%;border-radius:16px;box-shadow:0 8px 25px rgba(26,35,126,0.07);max-width:480px;">
                      </div>
                    <?php endforeach; ?>
                  </div>
                  <button type="button" class="mini-carousel-prev" aria-label="Anterior">‹</button>
                  <button type="button" class="mini-carousel-next" aria-label="Próximo">›</button>
                  <div class="mini-carousel-dots">
                    <?php foreach ($imgs as $i => $src): ?>
                      <button class="mini-carousel-dot <?php echo ($i === 0) ? 'active' : ''; ?>" data-index="<?php echo $i; ?>" aria-label="Slide <?php echo $i+1; ?>"></button>
                    <?php endforeach; ?>
                  </div>
                </div>
            </div>
        </div>

        <div class="content-grid animate-on-scroll" style="direction: rtl;">
            <div style="direction: ltr;">
                <h3 style="color: var(--cinza-escuro); font-size: 2.8em; margin-bottom: 15px;">Mão de Obra dedicada</h3>
                <p class="content-text">• Ofertamos mão de obra dedicada por projeto e necessidade.</p>
                <p class="content-text"></p>
            </div>
            <div class="content-image" style="direction: ltr;">
                <div class="mini-carousel" id="carousel-maoobra">
                  <div class="mini-carousel-track">
                    <div class="mini-carousel-slide active"><img src="carrosel/mb.png" alt="Mão de obra dedicada 1" style="width:100%;border-radius:16px;box-shadow:0 8px 25px rgba(26,35,126,0.07);max-width:480px;"></div>
                    <div class="mini-carousel-slide"><img src="carrosel/mb1.png" alt="Mão de obra dedicada 2" style="width:100%;border-radius:16px;box-shadow:0 8px 25px rgba(26,35,126,0.07);max-width:480px;"></div>
                  </div>
                  <button type="button" class="mini-carousel-prev" aria-label="Anterior">‹</button>
                  <button type="button" class="mini-carousel-next" aria-label="Próximo">›</button>
                  <div class="mini-carousel-dots">
                    <button class="mini-carousel-dot active" data-index="0" aria-label="Slide 1"></button>
                    <button class="mini-carousel-dot" data-index="1" aria-label="Slide 2"></button>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <section id="cta" class="cta-section scroll-snap-section">
      <div class="container">
        <h2 class="section-title">Setores de atuação</h2>
        <p class="section-subtitle"></p>
        <div class="cta-container-grid" style="align-items:center;gap:32px;">
          <div class="cta-carousel-side animate-on-scroll" style="display:flex;align-items:center;justify-content:center;">
            <div class="mini-carousel" id="carousel-cta">
              <div class="mini-carousel-track">
                <div class="mini-carousel-slide active">
                  <img src="carrosel/se1.jpg" alt="Carro 1" style="width:100%;border-radius:16px;box-shadow:0 8px 25px rgba(26,35,126,0.07);max-width:480px;">
                </div>
                <div class="mini-carousel-slide">
                  <img src="carrosel/si.jpg" alt="Carro 2" style="width:100%;border-radius:16px;box-shadow:0 8px 25px rgba(26,35,126,0.07);max-width:480px;">
                </div>
              </div>

              <button type="button" class="mini-carousel-prev" aria-label="Anterior" style="position:absolute;left:8px;top:50%;transform:translateY(-50%);background:rgba(0,0,0,0.45);color:#fff;border:0;width:40px;height:40px;border-radius:50%;cursor:pointer;">‹</button>
              <button type="button" class="mini-carousel-next" aria-label="Próximo" style="position:absolute;right:8px;top:50%;transform:translateY(-50%);background:rgba(0,0,0,0.45);color:#fff;border:0;width:40px;height:40px;border-radius:50%;cursor:pointer;">›</button>

              <div class="mini-carousel-dots" style="text-align:center;padding-top:12px;">
                <button class="mini-carousel-dot active" data-index="0" aria-label="Slide 1"></button>
                <button class="mini-carousel-dot" data-index="1" aria-label="Slide 2"></button>
              </div>
            </div>
          </div>

          <div class="cta-text-content" style="max-width:540px;">
            <h2 id="ctaTextTitle" class="section-title" style="text-align:left;margin-bottom:12px;">Soluções Sustentáveis para Transporte</h2>
            <p id="ctaTextSubtitle" class="section-subtitle" style="text-align:left;margin-bottom:18px;">Linhas de transmissão de energia elétrica, rodovias, adutoras, gasodutos, ferrovias, usinas termelétricas, parques eólicos, usinas fotovoltaicas, aterros sanitários e industriais.</p>  
          </div>
        </div>
      </div>
    </section>
     <section id="contato-email" class="email-contact-section scroll-snap-section">
      <div class="email-contact-container container">
        <h2 class="section-title">Fale Conosco</h2>
        <p class="instruction">Preencha o formulário abaixo e envie sua mensagem. Responderemos em breve!</p>
        <form id="emailForm" class="email-form" method="post" action="envio.php" aria-label="Formulário de contato por email">
          <input type="hidden" name="send_via_site" value="1">
          
          <div class="form-row">
            <div class="form-group">
              <label for="user_name">Nome *</label>
              <input type="text" id="user_name" name="name" placeholder="Seu nome completo" required>
            </div>
            <div class="form-group">
              <label for="user_phone">Telefone *</label>
              <input type="tel" id="user_phone" name="phone" placeholder="(85) 99999-9999" required>
            </div>
          </div>

          <div class="form-group">
            <label for="user_email">Email *</label>
            <input type="email" id="user_email" name="email" placeholder="seu@exemplo.com" required>
          </div>

          <div class="form-group">
            <label for="person_type">Tipo de Pessoa *</label>
            <select id="person_type" name="person_type" required>
              <option value="fisica">Pessoa Física</option>
              <option value="juridica">Pessoa Jurídica</option>
            </select>
          </div>

          <div class="form-group">
            <label for="cpf_cnpj" id="cpf_cnpj_label">CPF *</label>
            <input type="text" id="cpf_cnpj" name="cpf_cnpj" placeholder="000.000.000-00" required>
          </div>

          <div class="form-group">
            <label for="emailMessage">Mensagem *</label>
            <textarea id="emailMessage" name="message" placeholder="Escreva sua mensagem aqui..." required></textarea>
          </div>

          <div class="email-actions" style="align-items:center;justify-content:flex-end;">
            <button type="submit" class="btn btn-primary" id="submitBtn">Enviar</button>
          </div>
        </form>
        <div id="formMessage" style="display:none;margin-top:20px;padding:15px;border-radius:8px;text-align:center;font-weight:500;"></div>
      </div>
    </section>
  </main>

  <footer class="site-footer-bottom">
    <div class="container footer-content-grid">
      
      <div class="footer-col">
        <h4>Navegue</h4>
        <a href="#hero">Início</a>
        <a href="#sobre">Sobre a empresa</a>
        <a href="#nossa_visao">Serviços</a>
        <a href="loja.php">Políticas e termos</a>
      </div>
      <div class="footer-col">
        <h4>Contato</h4>
        <p> masso@massose.com</p>
        <p>(85) 981825753</p>
      </div>
      <div class="footer-col">
        <h4>Informações da empresa</h4>
        <p>CNPJ: 11.855.544/0001-51</p>
        <p> Rua Beatriz Braga, 119, Sala 104. Centro. São Gonçalo do Amarante, CE. 62.670-000</p>
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
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        const shapes = heroSection.querySelectorAll('.hero-background-shapes .shape');
        heroSection.addEventListener('mousemove', (e) => {
            const xAxis = (window.innerWidth / 2 - e.pageX) / 25;
            const yAxis = (window.innerHeight / 2 - e.pageY) / 25;
            shapes.forEach((shape, idx) => {
                const speed = (idx + 1) * 0.5;
                shape.style.transform = `translate(${xAxis * speed}px, ${yAxis * speed}px)`;
            });
        });
    }
  </script>
  <script>
    function initMiniCarousel(carouselId, onChange, options = {}) {
      const carousel = document.getElementById(carouselId);
      if (!carousel) return;
      const slides = Array.from(carousel.querySelectorAll('.mini-carousel-slide'));
      const prevBtn = carousel.querySelector('.mini-carousel-prev');
      const nextBtn = carousel.querySelector('.mini-carousel-next');
      const dots = Array.from(carousel.querySelectorAll('.mini-carousel-dot'));

      if (slides.length === 0) return;
      const opts = Object.assign({ autoPlay: true }, options);

      let current = 0;

      function setActive(index) {
        current = (index + slides.length) % slides.length;
        slides.forEach((slide, i) => {
          slide.classList.toggle('active', i === current);
        });
        dots.forEach((dot, i) => {
          dot.classList.toggle('active', i === current);
        });
        if (typeof onChange === 'function') {
          try { onChange(current); } catch (e) { console.error(e); }
        }
      }
      function next() {
        setActive(current + 1);
        restartAuto();
      }
      function prev() {
        setActive(current - 1);
        restartAuto();
      }
      if (prevBtn) prevBtn.addEventListener('click', prev);
      if (nextBtn) nextBtn.addEventListener('click', next);
      dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
          setActive(index);
          restartAuto();
        });
      });
      let autoInterval = null;

      function startAuto() {
        if (!opts.autoPlay) return;
        if (autoInterval) return;
        autoInterval = setInterval(next, 5000);
      }
      function pauseAuto() {
        if (autoInterval) {
          clearInterval(autoInterval);
          autoInterval = null;
        }
      }
      function restartAuto() {
        if (!opts.autoPlay) return;
        pauseAuto();
        startAuto();
      }
      if (opts.autoPlay) {
        carousel.addEventListener('mouseenter', pauseAuto);
        carousel.addEventListener('mouseleave', startAuto);
      }
      let touchStartX = 0;
      let touchCurrentX = 0;
      let isTouch = false;

      carousel.addEventListener('touchstart', (e) => {
        if (!e.touches || e.touches.length !== 1) return;
        touchStartX = e.touches[0].clientX;
        isTouch = true;
        pauseAuto();
      }, { passive: true });

      carousel.addEventListener('touchmove', (e) => {
        if (!isTouch || e.touches.length !== 1) return;
        touchCurrentX = e.touches[0].clientX;
      }, { passive: true });

      carousel.addEventListener('touchend', () => {
        if (!isTouch) return;
        const delta = touchCurrentX - touchStartX;
        if (Math.abs(delta) > 50) {
          delta < 0 ? next() : prev();
        }
        isTouch = false;
        restartAuto();
      }, { passive: true });
      setActive(0);
      startAuto();
      return { setActive, next, prev };
    }
    document.addEventListener('DOMContentLoaded', () => {
      initMiniCarousel('carousel-engenharia');
      initMiniCarousel('carousel-maoobra');

      const ctaTexts = [
        { title: 'Setor elétrico', subtitle: '• Usinas térmicas\n• Usinas solares\n• Parques aerogerador' },
        { title: 'Setor industrial', subtitle: '• Indústrias\n• Mineração e Siderurgia\n• Óleo e Gás\n• Complexos Portuára' }
      ];
      const titleEl = document.getElementById('ctaTextTitle');
      const subtitleEl = document.getElementById('ctaTextSubtitle');
      initMiniCarousel('carousel-cta', (currentIndex) => {
        const t = ctaTexts[currentIndex] || ctaTexts[0];
        if (titleEl) titleEl.textContent = t.title;
        if (subtitleEl) subtitleEl.innerHTML = t.subtitle.replace(/\n/g, '<br>');
      }, { autoPlay: false });
    });
  </script>
  <script>
    const emailForm = document.getElementById('emailForm');
    const formMessage = document.getElementById('formMessage');
    const submitBtn = document.getElementById('submitBtn');

    // Funções de formatação
    function formatPhone(value) {
      value = value.replace(/\D/g, '');
      if (value.length > 11) value = value.slice(0, 11);
      if (value.length <= 2) return value;
      if (value.length <= 7) return `(${value.slice(0, 2)}) ${value.slice(2)}`;
      return `(${value.slice(0, 2)}) ${value.slice(2, 7)}-${value.slice(7)}`;
    }

    function formatCPF(value) {
      value = value.replace(/\D/g, '');
      if (value.length > 11) value = value.slice(0, 11);
      if (value.length <= 3) return value;
      if (value.length <= 6) return `${value.slice(0, 3)}.${value.slice(3)}`;
      if (value.length <= 9) return `${value.slice(0, 3)}.${value.slice(3, 6)}.${value.slice(6)}`;
      return `${value.slice(0, 3)}.${value.slice(3, 6)}.${value.slice(6, 9)}-${value.slice(9)}`;
    }

    function formatCNPJ(value) {
      value = value.replace(/\D/g, '');
      if (value.length > 14) value = value.slice(0, 14);
      if (value.length <= 2) return value;
      if (value.length <= 5) return `${value.slice(0, 2)}.${value.slice(2)}`;
      if (value.length <= 8) return `${value.slice(0, 2)}.${value.slice(2, 5)}.${value.slice(5)}`;
      if (value.length <= 12) return `${value.slice(0, 2)}.${value.slice(2, 5)}.${value.slice(5, 8)}/${value.slice(8)}`;
      return `${value.slice(0, 2)}.${value.slice(2, 5)}.${value.slice(5, 8)}/${value.slice(8, 12)}-${value.slice(12)}`;
    }

    // Event listeners para formatação
    const phoneInput = document.getElementById('user_phone');
    const cpfCnpjInput = document.getElementById('cpf_cnpj');
    const personTypeSelect = document.getElementById('person_type');
    const cpfCnpjLabel = document.getElementById('cpf_cnpj_label');

    if (phoneInput) {
      phoneInput.addEventListener('input', (e) => {
        e.target.value = formatPhone(e.target.value);
      });
    }

    if (cpfCnpjInput) {
      cpfCnpjInput.addEventListener('input', (e) => {
        const personType = personTypeSelect.value;
        if (personType === 'juridica') {
          e.target.value = formatCNPJ(e.target.value);
        } else {
          e.target.value = formatCPF(e.target.value);
        }
      });
    }

    if (personTypeSelect) {
      personTypeSelect.addEventListener('change', () => {
        cpfCnpjInput.value = '';
        if (personTypeSelect.value === 'juridica') {
          cpfCnpjLabel.textContent = 'CNPJ *';
          cpfCnpjInput.placeholder = '00.000.000/0000-00';
        } else {
          cpfCnpjLabel.textContent = 'CPF *';
          cpfCnpjInput.placeholder = '000.000.000-00';
        }
      });
    }

    if (emailForm) {
      emailForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        formMessage.style.display = 'none';
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.6';

        // Coleta dados do formulário
        const formData = new FormData(emailForm);
        
        // Cria objeto para enviar como JSON
        const data = {
          name: formData.get('name'),
          email: formData.get('email'),
          phone: formData.get('phone'),
          person_type: formData.get('person_type'),
          cpf_cnpj: formData.get('cpf_cnpj'),
          subject: 'Novo contato do site - ' + formData.get('person_type'),
          message: `Telefone: ${formData.get('phone')}\nTipo: ${formData.get('person_type') === 'fisica' ? 'Pessoa Física' : 'Pessoa Jurídica'}\nCPF/CNPJ: ${formData.get('cpf_cnpj')}\n\nMensagem:\n${formData.get('message')}`
        };

        try {
          const response = await fetch('envio.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            },
            body: JSON.stringify(data)
          });

          const result = await response.json();

          formMessage.style.display = 'block';
          if (result.success) {
            formMessage.style.backgroundColor = '#d4edda';
            formMessage.style.color = '#155724';
            formMessage.style.borderLeft = '4px solid #28a745';
            formMessage.innerHTML = '✓ ' + result.message;
            emailForm.reset();
          } else {
            formMessage.style.backgroundColor = '#f8d7da';
            formMessage.style.color = '#721c24';
            formMessage.style.borderLeft = '4px solid #f5c6cb';
            formMessage.innerHTML = '✗ ' + (result.error || result.message || 'Erro ao enviar mensagem');
          }
        } catch (error) {
          formMessage.style.display = 'block';
          formMessage.style.backgroundColor = '#f8d7da';
          formMessage.style.color = '#721c24';
          formMessage.style.borderLeft = '4px solid #f5c6cb';
          formMessage.innerHTML = '✗ Erro na comunicação com o servidor';
          console.error('Erro:', error);
        } finally {
          submitBtn.disabled = false;
          submitBtn.style.opacity = '1';
        }
      });
    }
  </script>
</body>
</html>