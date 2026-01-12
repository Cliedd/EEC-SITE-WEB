# 🧪 Guide de test du système Email

## Configuration préalable

1. Ensure `app/Config/Email.php` est configuré
2. Ensure `writable/logs/` existe et est accessible
3. Accès à l'adresse email: `boumbisaij@gmail.com`
4. Navigateur web avec accès à votre site local

---

## 📧 Scénarios de test

### Test 1: Inscription et vérification email

**Objectif:** Vérifier que l'email de vérification est envoyé

1. Accéder à la page d'inscription
   ```
   http://localhost/creer-un-compte
   ```

2. Remplir le formulaire:
   ```
   Nom: Test User
   Email: test@gmail.com (vérifier ce compte)
   Mot de passe: SecurePass123!
   Confirmez: SecurePass123!
   ```

3. Cliquer sur "Créer un compte"

4. ✅ **Attendre** l'email dans `boumbisaij@gmail.com` (ou forwarded)
   - Sujet: "Vérifiez votre adresse email - EEC Centre Médical"
   - Contient: Bouton "Vérifier mon email"
   - Contient: Lien direct avec token

5. Cliquer sur le lien ou bouton pour vérifier

6. ✅ **Vérifier** le message de succès

**Résultats attendus:**
```
✓ Email reçu en moins de 5 secondes
✓ Template HTML correctement formaté
✓ Lien fonctionne
✓ Message de confirmation
```

---

### Test 2: Prise de rendez-vous

**Objectif:** Vérifier les emails patient et admin

1. Accéder au formulaire de rendez-vous
   ```
   http://localhost/prendre-rendez-vous
   ```

2. Remplir le formulaire:
   ```
   Nom: Jean Dupont
   Email: john@example.com
   Téléphone: +33612345678
   Date: [Demain]
   Service: Consultation générale
   Raison: Contrôle médical
   ```

3. Cliquer sur "Prendre un rendez-vous"

4. ✅ **Vérifier 2 emails reçus:**

   **Email 1 - Patient**
   ```
   À: john@example.com
   Sujet: Confirmation de votre rendez-vous - EEC Centre Médical
   Contient:
   - Badge "Confirmation"
   - Détails du rendez-vous
   - Numéro de dossier
   - Instructions importantes
   ```

   **Email 2 - Admin**
   ```
   À: boumbisaij@gmail.com
   Sujet: 🔔 Nouveau rendez-vous - [ID]
   Contient:
   - Badge "Alerte"
   - Données patient compètes
   - Détails appointment
   ```

**Résultats attendus:**
```
✓ 2 emails reçus
✓ Emails correctement routés
✓ Dossier créé avec ID
✓ Templates différents pour patient/admin
```

---

### Test 3: Mise à jour du statut RDV

**Objectif:** Vérifier les notifications de changement de statut

1. Se connecter au Dashboard admin
   ```
   http://localhost/admin
   Email: admin@eecsite.com
   Mot de passe: [admin password]
   ```

2. Trouver le rendez-vous créé en Test 2

3. Cliquer sur le rendez-vous → "Confirmer"

4. ✅ **Vérifier** l'email au patient:
   ```
   Sujet: Mise à jour de votre rendez-vous
   Contient: Badge "CONFIRMÉ" en vert
   Contient: Détails du RDV
   ```

5. **Répéter** en sélectionnant "Annuler"

6. ✅ **Vérifier** l'email au patient:
   ```
   Sujet: Mise à jour de votre rendez-vous
   Contient: Badge "ANNULÉ" en rouge
   ```

**Résultats attendus:**
```
✓ Email envoyé à chaque changement
✓ Badge de couleur correct (vert/rouge)
✓ Notifications personnalisées
```

---

### Test 4: Rappel manuel

**Objectif:** Vérifier l'envoi manuel de rappel

1. Dashboard → Rendez-vous

2. Sélectionner un RDV

3. Cliquer sur "Envoyer un rappel"

4. ✅ **Vérifier** l'email patient:
   ```
   Sujet: 🔔 Rappel de rendez-vous
   Contient: Alerte jaune "N'oubliez pas"
   Contient: Instructions (10 min avant, ID, documents)
   Contient: Coordonnées du centre
   ```

**Résultats attendus:**
```
✓ Email envoyé immédiatement
✓ Template avec alerte visuelle
✓ Instructions et contact fournis
```

---

### Test 5: Réinitialisation mot de passe

**Objectif:** Vérifier le flux complet de reset password

1. Accéder à la page de connexion admin
   ```
   http://localhost/auth/login
   ```

2. Cliquer sur "Mot de passe oublié"

3. Entrer un email admin:
   ```
   Email: admin@eecsite.com
   ```

4. ✅ **Vérifier** l'email reçu:
   ```
   Sujet: Réinitialisez votre mot de passe - EEC Centre Médical
   Contient: Bouton "Réinitialiser mon mot de passe"
   Contient: Lien direct avec token
   Contient: Avertissement "Ne pas partager"
   Contient: Expire dans 24h
   ```

5. Cliquer sur le bouton ou lien

6. Remplir le formulaire:
   ```
   Nouveau mot de passe: NewSecurePass123!
   Confirmation: NewSecurePass123!
   ```

7. Cliquer "Enregistrer"

8. ✅ **Vérifier** le message de succès

9. Se connecter avec le nouveau mot de passe

**Résultats attendus:**
```
✓ Email envoyé avec lien
✓ Lien valide 24h
✓ Formulaire reset fonctionne
✓ Nouvelle connexion réussie
✓ Ancien mot de passe ne fonctionne plus
```

---

## 🔍 Vérification des logs

### Localisation
```
c:\wamp\www\EEC_SITE_INTERNET\writable\logs\
```

### Contenu attendu
```
[2024-01-20 10:30:15] --> ERROR: Email send failed for: test@example.com
[2024-01-20 10:30:16] --> INFO: Email sent successfully to: john@example.com
[2024-01-20 10:30:17] --> ERROR: Email exception: Exception message...
```

### Vérification
1. Ouvrir le fichier log le plus récent
2. Chercher "Email sent successfully"
3. Vérifier les adresses email
4. Vérifier les timestamps

---

## 🐛 Dépannage des tests

### Email non reçu après 5 minutes

**Checklist:**
```
☐ Vérifier spam/promotions
☐ Vérifier adresse email correcte
☐ Vérifier logs: writable/logs/
☐ Vérifier SMTP connection
☐ Vérifier credentials Gmail (app password)
```

### Email avec template cassé

**Checklist:**
```
☐ Vérifier le fichier template HTML
☐ Vérifier syntaxe PHP dans template
☐ Vérifier les variables passées
☐ Vérifier CSS inline valide
```

### Erreur "Token invalide ou expiré"

**Checklist:**
```
☐ Vérifier que le lien complet est copié
☐ Vérifier que moins de 24h ont passé
☐ Vérifier la base de données email_verifications
☐ Vérifier que le token n'a pas été déjà utilisé
```

---

## 📊 Tableau de test

| Scénario | Statut | Notes | Date |
|----------|--------|-------|------|
| Inscription email | ☐ | | |
| Vérification email | ☐ | | |
| Confirmation RDV patient | ☐ | | |
| Alerte RDV admin | ☐ | | |
| Status update confirm | ☐ | | |
| Status update cancel | ☐ | | |
| Rappel manual | ☐ | | |
| Reset password link | ☐ | | |
| Reset password form | ☐ | | |
| Nouvelle connexion | ☐ | | |

---

## 🎯 Critères de succès

Pour considérer le système comme **✅ Opérationnel:**

```
1. Tous les 10 tests passent
2. Aucune erreur dans les logs
3. Tous les emails reçus en < 5 sec
4. Templates HTML correctement formatés
5. Tous les liens fonctionnent
6. Tous les redirects corrects
7. Messages de succès affichés
8. Base de données cohérente
9. Sessions correctes
10. Audit logs générés
```

---

## 🚀 Performance

### Temps d'envoi attendu
- Configuration: < 1 sec
- SMTP connection: < 2 sec
- Template rendering: < 500 ms
- Email sending: < 3 sec
- **Total: < 5 secondes**

### Monitoring
```php
// Dans votre contrôleur de test:
$start = microtime(true);
$emailService->sendVerificationEmail(...);
$duration = microtime(true) - $start;
echo "Email sent in: " . ($duration * 1000) . "ms";
```

---

## ✅ Test de production

Avant la mise en production:

1. **Configuration:**
   ```
   ☐ SMTPVerifySSL = true
   ☐ Credentials correct
   ☐ Logs activés
   ☐ Error handling robuste
   ```

2. **Sécurité:**
   ```
   ☐ Credentials en .env
   ☐ Tokens sécurisés
   ☐ Email validation
   ☐ Rate limiting
   ```

3. **Monitoring:**
   ```
   ☐ Logs configurés
   ☐ Alertes configurées
   ☐ Cleanup automatique
   ☐ Backup base de données
   ```

---

## 📞 Support

Pour toute question:
1. Vérifier les logs: `writable/logs/`
2. Lire: `EMAIL_INTEGRATION_GUIDE.md`
3. Vérifier: `EMAIL_IMPLEMENTATION_SUMMARY.md`
4. Consulter: Code source des contrôleurs

**Bon testing! 🚀**
