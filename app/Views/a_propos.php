<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>À Propos - EEC Centre Médical</title>
    <meta name="description" content="En savoir plus sur le Centre Médical Protestant de Bafoussam">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    
    <!-- Système Responsive Professionnel -->
    <link rel="stylesheet" href="<?=base_url('ASSETS/responsive-system.css');?>">
    <link rel="stylesheet" href="https://font.googleapis.com/css2?family=material+symbols+rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    
    <style>
        .timeline-list {
            list-style: none;
            padding: 0;
        }
        
        .timeline-list li {
            padding: var(--spacing-sm) 0;
            border-left: 3px solid var(--primary);
            padding-left: var(--spacing-md);
            margin-bottom: var(--spacing-sm);
        }
        
        .timeline-list strong {
            color: var(--primary);
        }
    </style>
</head>
<body>
    <!-- Header Responsive -->
    <header class="top-header">
        <div class="header-content">
            <div class="logo-area">
                <img src="<?=base_url('ASSETS/LOGO/LOGO_SITE.png')?>" alt="Logo CMP Bafoussam">
                <div class="title">
                    <span class="line1">Centre médical protestant</span>
                    <span class="line2">de Bafoussam</span>
                </div>
            </div>

            <div class="contact-area">
                <div class="contact-item">
                    <span class="icon">📧</span>
                    <a href="mailto:cmpbafoussam2020@gmail.com">cmpbafoussam2020@gmail.com</a>
                </div>
                <div class="contact-item">
                    <span class="icon">📞</span>
                    <a href="tel:+237657281610">+237 657 28 16 10 / 654 23 26 92</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="main-menu">
        <ul>
            <li><a href="<?=site_url('acceuil');?>">Accueil</a></li>
            <li><a href="<?=site_url('a_propos');?>">À Propos</a></li>
            <li><a href="<?=site_url('service_medicaux');?>">Services Médicaux</a></li>
            <li><a href="<?=site_url('espace_peteint');?>">Espace Patient</a></li>
            <li><a href="<?=site_url('actualiter');?>">Actualités</a></li>
            <li><a href="<?=site_url('Contact');?>">Contact</a></li>
        </ul>
    </nav>

    <!-- Boutons -->
    <div class="header-btns">
        <a class="btn btn-green" href="<?=site_url('creer_un_compte');?>">Créer un compte</a>
        <a class="btn btn-red" href="<?=site_url('sinscrire');?>">S'inscrire</a>
        <a class="btn btn-light" href="<?=site_url('PrendreRendez_vous');?>">Prendre rendez-vous</a>
    </div>

    <!-- Contenu principal -->
    <main class="container">
        <section class="content">
            <h1 class="section-title">À Propos du CMPB</h1>
            
            <div class="grid grid-2">
                <div>
                    <p>Le Centre Médical Protestant de Bafoussam est une œuvre de témoignage de l'Église Évangélique du Cameroun (EEC), c'est un centre de formation sanitaire créé en 1978 par arrêté d'ouverture N°135/A/MSP du 05/05/1978 situé en plein cœur de la ville de Bafoussam.</p>
                       
                    <p>À son ouverture le CMPB était appelé «Centre de Santé Médical de Bafoussam» et était un centre de santé intégré à «l'Hôpital Protestant de Mbouo-Bandjoun».</p>
                    
                    <p>Dès sa création jusqu'en l'an 2000, ce centre était dirigé par des infirmiers. À partir de 2000, date de sa médicalisation, il s'est vu porté à la tête des médecins.</p>
                </div>

                <div>
                    <h3 class="section-title">Historique des Responsables</h3>
                    <ul class="timeline-list">
                        <li><strong>1978-1994:</strong> M Njeunguo Paul</li>
                        <li><strong>1994-1997:</strong> M. Njeutang Benjamin</li>
                        <li><strong>1997-2000:</strong> M. Kamdem Samuel</li>
                        <li><strong>2000-2010:</strong> Dr Nana Martial</li>
                        <li><strong>2010-2013:</strong> Dr Ndensi Jean Paul</li>
                        <li><strong>2013-2014:</strong> Dr Tchamou Michel</li>
                        <li><strong>2014-2020:</strong> Dr Chemgne Nadine</li>
                        <li><strong>2020-Auj.:</strong> Dr Bonny Dalle Cyrile</li>
                    </ul>
                </div>
            </div>
        </section>
    </main>

    <!-- Missions -->
    <section class="content" style="background: #f8f9fa;">
        <div class="container">
            <h2 class="section-title">Missions et Valeurs</h2>
            
            <div class="grid grid-4">
                <div class="card">
                    <h3>🛡️ Intégrité</h3>
                    <p>Exercer notre profession avec honnêteté et éthique chrétienne.</p>
                </div>
                <div class="card">
                    <h3>💚 Compassion</h3>
                    <p>Agir avec empathie et bienveillance envers chaque patient.</p>
                </div>
                <div class="card">
                    <h3>🤝 Service</h3>
                    <p>Être au service des plus vulnérables avec humilité.</p>
                </div>
                <div class="card">
                    <h3>⭐ Espérance</h3>
                    <p>Offrir un soutien spirituel et un message d'espoir.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-inner">
                <div class="grid grid-4">
                    <div class="footer-col">
                        <div class="logo-wrap mb-3">
                            <img src="<?=base_url('ASSETS/LOGO/LOGO_SITE.png');?>" alt="Logo" class="footer-logo">
                        </div>
                        <div class="stay-connected">
                            <p class="small-title mb-2">Restez connectés</p>
                            <div class="socials">
                                <a href="#" aria-label="Facebook" class="social">📘</a>
                                <a href="#" aria-label="YouTube" class="social">📺</a>
                                <a href="#" aria-label="LinkedIn" class="social">💼</a>
                            </div>
                        </div>
                    </div>

                    <div class="footer-col">
                        <h3 class="col-title mb-3">SERVICES</h3>
                        <ul class="services-list">
                            <li>Pédiatrie/Néonatologie</li>
                            <li>Obstétrique/Gynécologie</li>
                            <li>Chirurgie générale</li>
                            <li>Réanimation</li>
                            <li>Laboratoire</li>
                        </ul>
                    </div>

                    <div class="footer-col">
                        <h3 class="col-title mb-3">CONTACT</h3>
                        <p class="mb-2">📞 +237 654 28 16 10</p>
                        <p class="mb-2">📧 cmpbafoussam2020@gmail.com</p>
                        <p>🕐 24H/24, 7J/7</p>
                    </div>

                    <div class="footer-col">
                        <h3 class="col-title mb-3">ACTIONS</h3>
                        <div class="footer-btns">
                            <a href="<?=site_url('PrendreRendez_vous');?>" class="btn btn-green">Rendez-vous</a>
                            <a href="<?=site_url('sinscrire');?>" class="btn btn-light">S'inscrire</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <footer class="site-footer2">
        <div class="container">
            <div class="copyright text-center">
                ©2025 CENTRE MÉDICAL PROTESTANT DE BAFOUSSAM. TOUS DROITS RÉSERVÉS.
            </div>
        </div>
    </footer>
</body>
</html>
