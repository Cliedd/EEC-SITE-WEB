# 📊 ANALYSE COMPLÈTE DE VOTRE SITE - CMP BAFOUSSAM

## 🏗️ ARCHITECTURE GLOBALE

Votre site utilise **CodeIgniter 4** (MVC Framework) avec cette structure:

```
EEC_SITE_INTERNET/
├── app/
│   ├── Controllers/        ← Gère la logique métier
│   ├── Models/             ← Gère les données
│   ├── Views/              ← Interface utilisateur (HTML)
│   ├── Config/             ← Configuration
│   └── Database/
│       └── Migrations/     ← Création des tables
├── public/                 ← Point d'entrée (index.php)
└── writable/               ← Logs, cache, uploads
```

---

## 🔄 FLUX D'UNE REQUÊTE (Comment ça marche)

### **Exemple: Accéder à http://localhost:9000/acceuil**

1. **Routeur** (Config/Routes.php) reçoit la requête
   ```
   $routes->get('acceuil', 'Home::acceuil');
   ```
   
2. **Contrôleur** (Controllers/Home.php) exécute la méthode
   ```php
   public function acceuil(){
       return view("acceuil");
   }
   ```

3. **Vue** (Views/acceuil.php) affiche le HTML au navigateur

---

## 🎯 VOS CONTRÔLEURS (CE QU'ILS FONT)

### **1. Home Controller** - La page d'accueil et les pages statiques
```
┌─ index()              → affiche acceuil.php
├─ acceuil()            → affiche la page d'accueil
├─ a_propos()           → affiche "À Propos"
├─ service_medicaux()   → affiche les services
├─ espace_peteint()     → affiche l'espace patient
├─ actualiter()         → affiche les actualités
├─ Contact()            → affiche formulaire contact
├─ PrendreRendez_vous() → affiche formulaire rendez-vous
├─ sinscrire()          → affiche formulaire connexion
└─ creer_un_compte()    → affiche formulaire inscription
```

**Logique**: Tous les contrôleurs simples = affichage d'une vue HTML
Pas de traitement de données compliqué

---

### **2. Creer_compte Controller** - Gestion de l'inscription
```
┌─ index()          → Affiche formulaire d'inscription
│
├─ store()          → Reçoit les données du formulaire
│                   → Valide les données
│                   → Hash le mot de passe
│                   → Sauvegarde dans BD (table 'login')
│                   → Redirige avec message de succès
│
└─ verifyLogin()    → Reçoit email + mot de passe
                    → Cherche l'utilisateur en BD
                    → Crée une SESSION si trouvé
                    → Redirige vers acceuil
```

**ROUTES** (Config/Routes.php):
```php
$routes->get('Creer_compte', 'Creer_compte::index');
$routes->post('Creer_compte/store', 'Creer_compte::store');
$routes->post('Creer_compte/verifyLogin', 'Creer_compte::verifyLogin');
```

---

### **3. ContactController** - Gestion des messages
```
┌─ index()     → Affiche formulaire contact
└─ Contact()   → Reçoit le message
                → Sauvegarde en BD (table 'contact')
                → (À implémenter complètement)
```

---

### **4. Dashboard Controller** - Espace admin
```
┌─ index()   → Page d'accueil admin
└─ acceuil() → Page accueil admin
```

---

## 🗄️ VOS MODÈLES (GESTION DE LA BASE DE DONNÉES)

### **Creer_compteModel**
```php
protected $table = 'login';  // Nom de la table en BD
protected $primaryKey = 'idlogin';  // Clé primaire

// Champs acceptés (sécurité)
protected $allowedFields = [
    'name_surName',
    'email',
    'telephone',
    'mot_de_passe'
];

// Champs de DATE (auto-gérés)
$createdField  = 'Date-creation'    // Rempli automatiquement
$updatedField  = 'Date-modification' // Mis à jour auto
$deletedField  = 'Date-logout'      // Suppression logique
```

**Exemple d'utilisation en contrôleur:**
```php
$model = new Creer_compteModel();
$model->save($data);  // Crée un nouvel utilisateur
$user = $model->where('name_surName', $name)->first();  // Cherche un user
```

---

## 📊 BASE DE DONNÉES

### **Table: login** (Créée par migration)
```
┌─────────────────────────────────────────┐
│ TABLE: login                            │
├─────────────────────────────────────────┤
│ idlogin (INT) - Clé primaire ⭐        │
│ name_surName (VARCHAR 100)              │
│ email (VARCHAR 100) - Unique            │
│ telephone (VARCHAR 20)                  │
│ mot_de_passe (VARCHAR 255)              │
│ Date-creation (DATETIME)                │
│ Date-modification (DATETIME)            │
│ Date-logout (DATETIME)                  │
└─────────────────────────────────────────┘
```

**Exemple d'enregistrement:**
```
idlogin: 1
name_surName: "Jean Dupont"
email: "jean@example.com"
telephone: "+237657281610"
mot_de_passe: "$2y$10$ab...xyz" (Hashé)
Date-creation: 2026-01-02 16:30:00
Date-logout: NULL (Pas déconnecté)
```

---

## 🖼️ VOS VUES (LES PAGES HTML)

| Vue | Contrôleur | Fonction |
|-----|-----------|----------|
| **acceuil.php** | Home | Page d'accueil (logo, menu, images) |
| **a_propos.php** | Home | Page À Propos |
| **service_medicaux.php** | Home | Liste des services |
| **espace_peteint.php** | Home | Espace patient |
| **creer_un_compte.php** | Creer_compte::index | Formulaire inscription |
| **sinscrire.php** | Home | Formulaire connexion |
| **Contact.php** | Home | Formulaire contact |
| **PrendreRendez_vous.php** | Home | Formulaire rendez-vous |

---

## 🔐 FLUX SÉCURITÉ (Inscription + Connexion)

### **INSCRIPTION (Creer_un_compte)**

```
1. Utilisateur remplit formulaire
   ↓
2. POST vers '/Creer_compte/store'
   ↓
3. Contrôleur valide les données
   - Email valide?
   - Mot de passe >= 8 caractères?
   - Téléphone = 10-15 chiffres?
   ↓
4. Si valide:
   - Hash le mot de passe avec password_hash()
   - Sauvegarde dans table 'login'
   - Redirige avec message "succès"
   ↓
5. Si invalide:
   - Affiche formulaire avec erreurs
```

### **CONNEXION (Login)**

```
1. Utilisateur entre email + mot de passe
   ↓
2. POST vers '/Creer_compte/verifyLogin'
   ↓
3. Cherche utilisateur en BD
   ↓
4. Si trouvé:
   - Vérifie password_verify()
   - Crée SESSION:
     * idlogin
     * name-surName
     * logged_in = true
   - Redirige vers acceuil
   ↓
5. Si pas trouvé:
   - Redirige vers formulaire
```

---

## ⚠️ PROBLÈMES & SOLUTIONS IDENTIFIÉS

### **PROBLÈME 1: URL avec majuscules/underscores**
- **Cause**: `$translateUriToCamelCase = true` dans Routing.php
- **Solution**: Désactivé ✅

### **PROBLÈME 2: `.index.html` dans l'URL**
- **Cause**: Formulaire HTML ou JavaScript rajoute `index.html`
- **Solution**: À vérifier dans les vues

### **PROBLÈME 3: Pas de table en BD**
- **Cause**: Migrations vides
- **Solution**: Créé migration pour table `login` ✅

### **PROBLÈME 4: BaseURL incorrecte**
- **Cause**: Configurée pour Apache, pas pour dev server
- **Solution**: Changée à `http://localhost:9000/` ✅

### **PROBLÈME 5: CSS ne charge pas**
- **Cause**: BaseURL incorrecte
- **Solution**: Corrigée avec BaseURL ✅

---

## 🔄 ROUTES RÉSUMÉE

| URL | Méthode | Contrôleur | Action |
|-----|---------|-----------|--------|
| `/` | GET | Home | Affiche acceuil |
| `/acceuil` | GET | Home | Affiche acceuil |
| `/a_propos` | GET | Home | Affiche à propos |
| `/service_medicaux` | GET | Home | Affiche services |
| `/creer_un_compte` | GET | Home | Formulaire inscription |
| `/Creer_compte` | GET | Creer_compte | Formulaire inscription |
| `/Creer_compte/store` | POST | Creer_compte | Crée utilisateur |
| `/Creer_compte/verifyLogin` | POST | Creer_compte | Connexion utilisateur |
| `/sinscrire` | GET | Home | Formulaire login |
| `/Contact` | GET | Home | Formulaire contact |

---

## 💡 RECOMMANDATIONS

1. **Unifier les routes**: `creer_un_compte` vs `Creer_compte` confus
2. **Compléter ContactModel**: saveData() est vide
3. **Ajouter des validations**: Email déjà existant?
4. **Implémenter logout**: Session sans déconnexion
5. **Sécuriser**: Ajouter CSRF tokens aux formulaires

---

## 📝 RÉSUMÉ

Votre site est un **système de gestion de médecine** avec:
- ✅ Pages statiques (accueil, services, à propos)
- ✅ Système d'inscription/connexion
- ⚠️ Formulaire contact (incomplet)
- ⚠️ Espace patient (placeholder)
- ⚠️ Dashboard admin (vide)

Le fonctionnement principal = **Utilisateur → Route → Contrôleur → Vue** ou **Utilisateur → Formulaire → Contrôleur → Base de données → Redirection**

pour la Dashboard:
mail:
adminstrateurcmp@dashboard.com
mot de passe: cmpBafoussam237@