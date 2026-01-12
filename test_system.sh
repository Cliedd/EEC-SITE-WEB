#!/bin/bash
# Script de test complet du système

echo "========================================"
echo "TEST COMPLET DU SYSTÈME EEC"
echo "========================================"
echo ""

# Test 1: Connexion au site principal
echo "[TEST 1] Accès au site principal..."
curl -s http://127.0.0.1:9000/ -o /dev/null
if [ $? -eq 0 ]; then
    echo "✓ Site principal accessible"
else
    echo "✗ Erreur d'accès au site"
fi
echo ""

# Test 2: Page de login
echo "[TEST 2] Accès à la page de login..."
curl -s http://127.0.0.1:9000/auth/login -o /dev/null
if [ $? -eq 0 ]; then
    echo "✓ Page de login accessible"
else
    echo "✗ Erreur d'accès à la page de login"
fi
echo ""

# Test 3: Dashboard (non authentifié)
echo "[TEST 3] Accès à la dashboard (sans authentification)..."
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://127.0.0.1:9000/admin)
if [ $HTTP_CODE -eq 302 ] || [ $HTTP_CODE -eq 303 ]; then
    echo "✓ Dashboard redirection correcte (non authentifié)"
else
    echo "✗ Erreur d'accès à la dashboard"
fi
echo ""

# Test 4: Test de la page d'accueil
echo "[TEST 4] Accès à la page d'accueil test..."
curl -s http://127.0.0.1:9000/acceuil_test.php -o /dev/null
if [ $? -eq 0 ]; then
    echo "✓ Page d'accueil test accessible"
else
    echo "✗ Erreur d'accès à la page test"
fi
echo ""

echo "========================================"
echo "Tests complétés!"
echo "========================================"
echo ""
echo "Accédez à http://127.0.0.1:9000/tests.php pour les instructions compètes"
