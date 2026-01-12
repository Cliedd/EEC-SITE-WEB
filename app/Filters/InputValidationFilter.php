<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class InputValidationFilter implements FilterInterface
{
    /**
     * Filtre pour valider et nettoyer les inputs utilisateur
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Valider les inputs POST
        if ($request->getMethod() === 'post' || $request->getMethod() === 'put' || $request->getMethod() === 'patch') {
            $inputs = $request->getPost();

            foreach ($inputs as $key => $value) {
                // Rejeter les arrays à moins que ce soit explicitement permis
                if (is_array($value)) {
                    // Permettre seulement certains champs
                    $allowedArrayFields = ['services', 'permissions', 'ids'];
                    if (!in_array($key, $allowedArrayFields)) {
                        return service('response')
                            ->setStatusCode(400)
                            ->setJSON(['error' => 'Données invalides']);
                    }
                }

                // Rejeter les données potentiellement dangereuses
                if ($this->containsDangerousPatterns($value)) {
                    return service('response')
                        ->setStatusCode(400)
                        ->setJSON(['error' => 'Données invalides détectées']);
                }

                // Rejeter les valeurs NULL inattendues
                if ($value === null && $key !== 'optional_field') {
                    // On peut ajouter plus de logique ici
                }
            }
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Ajouter les headers de sécurité
        $response->setHeader('X-Content-Type-Options', 'nosniff');
        $response->setHeader('X-Frame-Options', 'DENY');
        $response->setHeader('X-XSS-Protection', '1; mode=block');
        $response->setHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->setHeader('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'");
        $response->setHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->setHeader('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');

        return $response;
    }

    /**
     * Détecte les patterns dangereuses dans les inputs
     */
    private function containsDangerousPatterns($value)
    {
        if (!is_string($value)) {
            return false;
        }

        // Patterns dangereux
        $patterns = [
            '/(<script|<iframe|<object|<embed|on\w+\s*=)/i', // XSS
            '/(\\\x00|%00)/', // Null bytes
            '/(\$\{|@\{)/', // Template injection
            '/(eval\(|exec\(|system\(|passthru\()/', // Command injection
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $value)) {
                return true;
            }
        }

        return false;
    }
}
