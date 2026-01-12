<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EEC Centre Médical - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
        }

        .navbar {
            background: var(--primary-color) !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 20px;
        }

        .hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 80px 20px;
            text-align: center;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .btn-custom {
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-custom-primary {
            background-color: white;
            color: var(--primary-color);
            border: none;
        }

        .btn-custom-primary:hover {
            background-color: #f0f0f0;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .service-card {
            background: white;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            margin-bottom: 20px;
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .service-card i {
            font-size: 48px;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }

        .service-card h4 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 15px;
        }

        .section {
            padding: 60px 0;
        }

        .section-title {
            font-size: 36px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 50px;
            text-align: center;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px 15px;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .footer {
            background: var(--primary-color);
            color: white;
            padding: 40px 0;
            margin-top: 60px;
        }

        .badge-custom {
            background-color: var(--secondary-color);
            padding: 8px 15px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 15px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-hospital"></i> EEC Centre Médical
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-light text-dark ms-2" href="#appointment">Rendez-vous</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <div class="hero">
        <div class="container">
            <h1>Centre Médical EEC</h1>
            <p>Vos soins de santé, notre priorité</p>
            <a href="#appointment" class="btn btn-custom btn-custom-primary">
                <i class="bi bi-calendar-check"></i> Prendre un rendez-vous
            </a>
        </div>
    </div>

    <!-- Services -->
    <section id="services" class="section">
        <div class="container">
            <h2 class="section-title">Nos Services</h2>
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <i class="bi bi-person-check"></i>
                        <h4>Consultation Générale</h4>
                        <p>Consultations médicales générales avec nos médecins expérimentés</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <i class="bi bi-house-door"></i>
                        <h4>Visite à Domicile</h4>
                        <p>Service de visite médicale directement chez vous</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <i class="bi bi-capsule"></i>
                        <h4>Vaccination</h4>
                        <p>Programme complet de vaccination pour toute la famille</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <i class="bi bi-tooth"></i>
                        <h4>Examen Dentaire</h4>
                        <p>Soins dentaires et examen complet</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <i class="bi bi-heart"></i>
                        <h4>Suivi Grossesse</h4>
                        <p>Suivi médical complet de la grossesse</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <i class="bi bi-bar-chart"></i>
                        <h4>Analyses Médicales</h4>
                        <p>Tous les types d'analyses et de tests médicaux</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Appointment Form -->
    <section id="appointment" class="section" style="background-color: #f0f0f0;">
        <div class="container">
            <h2 class="section-title">Prendre un Rendez-vous</h2>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div style="background: white; padding: 40px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <form method="POST" action="/api/appointments/create">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="patient_name" class="form-label">Nom complet</label>
                                    <input type="text" class="form-control" id="patient_name" name="patient_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="patient_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="patient_email" name="patient_email" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="patient_phone" class="form-label">Téléphone</label>
                                    <input type="tel" class="form-control" id="patient_phone" name="patient_phone" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="service_type" class="form-label">Service demandé</label>
                                    <select class="form-control" id="service_type" name="service_type" required>
                                        <option value="">Sélectionnez un service</option>
                                        <option value="Consultation Générale">Consultation Générale</option>
                                        <option value="Visite Domicile">Visite à Domicile</option>
                                        <option value="Vaccination">Vaccination</option>
                                        <option value="Examen Dentaire">Examen Dentaire</option>
                                        <option value="Suivi Grossesse">Suivi Grossesse</option>
                                        <option value="Analyses Médicales">Analyses Médicales</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="appointment_date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="appointment_time" class="form-label">Heure</label>
                                    <input type="time" class="form-control" id="appointment_time" name="appointment_time" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description/Remarques</label>
                                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                            </div>

                            <button type="submit" class="btn btn-custom btn-primary w-100" style="background-color: var(--secondary-color); border: none; padding: 12px; font-weight: 600;">
                                <i class="bi bi-calendar-check"></i> Réserver mon rendez-vous
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="section">
        <div class="container">
            <h2 class="section-title">Nous Contacter</h2>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div style="background: white; padding: 40px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <form method="POST" action="/api/contacts/create">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Sujet</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" style="background-color: var(--secondary-color); border: none; padding: 12px; font-weight: 600;">
                                Envoyer le message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>EEC Centre Médical</h5>
                    <p>Centre médical de qualité offrant une large gamme de services de santé</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Heures d'ouverture</h5>
                    <p>Lundi - Vendredi: 8h00 - 18h00<br>
                    Samedi: 9h00 - 14h00<br>
                    Dimanche: Fermé</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Contact</h5>
                    <p>Téléphone: +33 1 23 45 67 89<br>
                    Email: contact@eeccentremedical.com<br>
                    Adresse: 123 Rue de la Santé, 75000 Paris</p>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.2);">
            <div class="text-center" style="opacity: 0.8;">
                <p>&copy; 2026 EEC Centre Médical. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Script d'enregistrement des visiteurs -->
    <script>
        // Enregistrer le visiteur
        fetch('/api/track-visitor', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                page: window.location.pathname,
                referrer: document.referrer,
                userAgent: navigator.userAgent
            })
        }).catch(e => console.log('Visitor tracking initiated'));
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
