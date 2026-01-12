<?php
namespace App\Controllers;


class ContactController extends BaseController
{
   public function __constroot(){
    helper('form');
   }
   public function index(){
    $data = [];
    $data['validation'] = null;
    $rules = [
        'name-surName' => 'required|min_length[3]|max_length[50]',
        'email' => 'required|valid_email',
        'telephone'  => 'required|numeric|min_length[10]|max_length[15]',
        'Objet'  => 'required',
        'msg'  => 'required',
        
    ];
   if( $this->request->getMethod() == 'post'){
    if($this->validate($rules)){
      $cdata = [
        'name-surName'=>$this->request->getVar('name-surName', FILTER_SANITIZE_STRING),
        'email'=>$this->request->getVar('email', FILTER_SANITIZE_STRING),
        'telephone'=>$this->request->getVar('telephone', FILTER_SANITIZE_STRING),
        'Objet'=>$this->request->getVar('Objet', FILTER_SANITIZE_STRING),
        'msg'=>$this->request->getVar('name-surName', FILTER_SANITIZE_STRING)

      ];
      

    }

   }else
   {
    $data['validation'] = $this->validator;
   }
    return view('Contact',$data );
   }
 }
