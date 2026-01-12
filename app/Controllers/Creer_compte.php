<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Creer_compteModel;
use App\Models\VisitorModel;
use App\Models\EmailVerificationModel;
use App\Services\EmailService;

class Creer_compte extends BaseController
{
    private function formView($validation = null){
        return view('creer_un_compte',['validation' => $validation ?? \Config\Services::validation()] );
    }
    
    // afficher les utilisateur
    public function index()
    {  
        return $this->formView();
    }
    
    // enregistrer les donnee depuis la method post
    public function store()
    {
        $rules = [
            'name_surName' => 'required|min_length[3]|max_length[50]',
            'email' => 'required|valid_email',
            'telephone'  => 'required|numeric|min_length[10]|max_length[15]',
            'mot_de_passe' => 'required|min_length[8]'      
        ];
        if(! $this->validate($rules)){
            return $this->formView( $this->validator );
        }

        $Creer_compteModel = new Creer_compteModel();
        $email = $this->request->getPost('email');
        // Check if email already exists
        $existing = $Creer_compteModel->where('email', $email)->first();
        if ($existing) {
            return redirect()->to('/creer_un_compte')->with('error', "Cet email est déjà utilisé. Veuillez en choisir un autre.");
        }

        $data = [
            'name_surName' =>  $this->request->getPost('name_surName'),
            'email' =>  $email,
            'telephone' =>  $this->request->getPost('telephone'),
            'mot_de_passe' =>   password_hash($this->request->getPost('mot_de_passe'),PASSWORD_DEFAULT),
        ];
        $idlogin = $Creer_compteModel->save($data) ? $Creer_compteModel->getInsertID() : null;

        // Enregistrer automatiquement comme nouveau visiteur
        if($idlogin){
            $VisitorModel = new VisitorModel();
            $visitorData = [
                'idlogin' => $idlogin,
                'name_surName' => $this->request->getPost('name_surName'),
                'email' => $email,
                'telephone' => $this->request->getPost('telephone'),
                'visitor_type' => 'new_account',
                'date_visit' => date('Y-m-d H:i:s')
            ];
            $VisitorModel->save($visitorData);

            // Générer token de vérification email
            $emailVerification = new EmailVerificationModel();
            $token = $emailVerification->createVerificationToken(
                $email,
                'login',
                $idlogin,
                24
            );

            // Envoyer email de vérification
            $emailService = new EmailService();
            $verificationLink = base_url() . 'auth/verifyEmail/' . $token;
            
            if ($emailService->sendVerificationEmail(
                $email,
                $this->request->getPost('name_surName'),
                $verificationLink
            )) {
                return redirect()->to('/creer_un_compte')->with('success','Compte créé! Vérifiez votre email pour confirmer votre inscription.');
            } else {
                return redirect()->to('/creer_un_compte')->with('warning','Compte créé mais erreur lors de l\'envoi de l\'email. Vérifiez votre boîte spam.');
            }
        }
        return redirect()->to('/creer_un_compte')->with('error','Erreur lors de la création du compte');
    }
}