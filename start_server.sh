#!/bin/bash

# Script de lancement du serveur EEC Centre Médical
# Commande: php spark serve --host 127.0.0.1 --port 9000

echo "🚀 LANCEMENT DU SERVEUR EEC CENTRE MÉDICAL"
echo "=========================================="
echo ""

# Vérifier si PHP est installé
if ! command -v php &> /dev/null; then
    echo "❌ PHP n'est pas installé. Veuillez installer PHP 8.1+ d'abord."
    echo "   sudo apt update && sudo apt install php8.2 php8.2-mysql php8.2-cli php8.2-curl php8.2-gd php8.2-mbstring php8.2-xml php8.2-zip"
    exit 1
fi

# Vérifier si nous sommes dans le bon répertoire
if [ ! -f "spark" ]; then
    echo "❌ Fichier 'spark' non trouvé. Assurez-vous d'être dans le répertoire racine du projet."
    exit 1
fi

echo "✅ PHP détecté: $(php --version | head -n 1)"
echo "✅ Répertoire: $(pwd)"
echo ""

# Vérifier la connectivité MariaDB
echo "🔍 Vérification de la base de données..."
if php -r "
try {
    \$pdo = new PDO('mysql:host=localhost;dbname=eecbafoussam', 'root', '');
    echo '✅ Connexion MariaDB réussie';
} catch(Exception \$e) {
    echo '❌ Erreur MariaDB: ' . \$e->getMessage();
    exit(1);
}
"; then
    echo ""
else
    echo "❌ Problème de connexion à la base de données"
    exit 1
fi

echo ""
echo "🌐 Lancement du serveur sur http://127.0.0.1:9000"
echo "   Commande: php spark serve --host 127.0.0.1 --port 9000"
echo ""
echo "📋 Informations importantes:"
echo "   - URL d'accès: http://127.0.0.1:9000"
echo "   - Dashboard admin: http://127.0.0.1:9000/auth/login"
echo "   - Email admin: administrationeecc@dashboard.com"
echo "   - Mot de passe: bafoussameec2026@web"
echo ""
echo "🛑 Pour arrêter: Ctrl+C"
echo ""
echo "=========================================="
echo ""

# Lancer le serveur
php spark serve --host 127.0.0.1 --port 9000