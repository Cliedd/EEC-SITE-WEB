<?php

namespace App\Controllers;


class Home extends BaseController
{
    public function index(): string
    {  
      
        return view('acceuil');
    }

   public function acceuil(){
        return view("acceuil");
    }

    public function a_propos(){
        return view("a_propos");
    }

    public function service_medicaux()
    {
        return view("service_medicaux");
    }

    public function espace_peteint()
    {
        return view("espace_peteint");
    }

    public function actualiter()
    {
        return view("actualiter");
    }

    public function Contact()
    {
        return view("Contact");
    }

    public function systerm_EEC()
    {
        return view("systerm_EEC");
    }

    public function PrendreRendez_vous()
    {
        return view("PrendreRendez_vous");
    }
    
    public function sinscrire()
    {
        return view("sinscrire"); 
    }

    public function creer_un_compte()
    {
        return view("creer_un_compte");
    }


}
