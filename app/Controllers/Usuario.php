<?php

namespace App\Controllers;
use App\Models\usuarioModel;

class Usuario extends BaseController
{

    protected $datos=null;
    protected $session;

    public function __construct(){
        $this->datos = new usuarioModel();
    }


    public function logout()
    {
        $session=session();
        $session->destroy(); 
        return view('layouts/header').view('login').view('layouts/footer');   

    }
    public function inicio()
    {
        $session=session();
        $session->destroy(); 
        return view('layouts/header').view('login').view('layouts/footer');   

    }

    public function login()
    {

       

        $username=$_POST['username'];
        $password=$_POST['password'];
       $resp=$this->datos->login($username,$password);
            
        
       //print_r($resp);
//logica es buscar toas las rutas del  rol actual (creo que tova traajar con el rol usuario , y decir que ese usuario esta permito tomar ese rol)
       if ($resp) {

              
                    $rol=$resp[0]->ROL_ID;

                    $rutas=$this->datos->menuModel($rol);
                    $session=session();

                    $session->set('rolId',$resp);
                    $session->set('rutas',$rutas);



                    return $this->index();
        # code...
       } else {
        # code...
     return redirect()->back()->with('error','el usuario no es coreto');
       }
       


    }


    public function index()
    {

        $session=session();

        $rol=($session->get('rolId'));
       

        if ($rol!=""||$rol!=0) {

  
            $rol=$rol[0]->ROL_ID;

            $rutas=$this->datos->menuModel($rol);
   
             
   
                   $roles=$this->datos->selectRoles();
   
                   $usu=$this->datos->selectUsuarios();
    
           
                   $dato['usu']=$usu;
                   // print_r($dato);
                   $dato['rol']=$roles;
   
   
           $menu['rutas']=$rutas;

           return view('layouts/header').view('layouts/aside',$menu).view('pagina_web/usuarios',$dato).view('layouts/footer');   
   


        } else {
            $session=session();
            $session->destroy();
            return view('layouts/header').view('login').view('layouts/footer');   


        }
      
    }



    public function ventasUsuarioCategoria($ruID)
    {

      $idRut=esc($ruID);

       $rolesAutorizados=$this->datos->rolesAutorizadosModel($idRut);
       
       $session=session();
        
       $rol=($session->get('rolId'));
       


       $autorizado=false;

       foreach($rolesAutorizados as $rolAu){

                 if($rolAu->ROL_ID==$rol[0]->ROL_ID){
                    $autorizado=true;                    break;

                 }else{

                    $autorizado=false;

                 }


       }

       if ($autorizado) {


        $session=session();///
               $vuc=$this->datos->ventasUsuarioCategoriaModel();

       
               $dato['vuc']=$vuc;//var_dump($dato);

                $menu['rutas']=($session->get('rutas'));
       return view('layouts/header').view('layouts/aside',$menu).view('reportes/ventasUsuarioCategoria',$dato).view('layouts/footer');   




        } else {

         $session=session();
         $session->destroy();
         return view('layouts/header').view('login').view('layouts/footer');         }
       



    }




    public function ventasDiariasCategoria($ruID)
    {

      $idRut=esc($ruID);

       $rolesAutorizados=$this->datos->rolesAutorizadosModel($idRut);
       
       $session=session();
        
       $rol=($session->get('rolId'));
       


       $autorizado=false;

       foreach($rolesAutorizados as $rolAu){

                 if($rolAu->ROL_ID==$rol[0]->ROL_ID){
                    $autorizado=true;                    break;

                 }else{

                    $autorizado=false;

                 }


       }

       if ($autorizado) {


        $session=session();///
               $vuc=$this->datos->ventasDiariasCategoriaModel();

       
               $dato['vdc']=$vuc;//var_dump($dato);

                $menu['rutas']=($session->get('rutas'));
       return view('layouts/header').view('layouts/aside',$menu).view('reportes/ventasDiariasCategoria',$dato).view('layouts/footer');   




        } else {

         $session=session();
         $session->destroy();
         return view('layouts/header').view('login').view('layouts/footer');  
             }
       



    }




    public function rankingVentasTotalesUsuario($ruID)
    {

      $idRut=esc($ruID);

       $rolesAutorizados=$this->datos->rolesAutorizadosModel($idRut);
       
       $session=session();
        
       $rol=($session->get('rolId'));
       


       $autorizado=false;

       foreach($rolesAutorizados as $rolAu){

                 if($rolAu->ROL_ID==$rol[0]->ROL_ID){
                    $autorizado=true;                    break;

                 }else{

                    $autorizado=false;

                 }


       }

       if ($autorizado) {


        $session=session();///
               $vuc=$this->datos->rankingVentasTotalesUsuarioModel();

       
               $dato['rkvu']=$vuc;//var_dump($dato);

                $menu['rutas']=($session->get('rutas'));
       return view('layouts/header').view('layouts/aside',$menu).view('reportes/rankingVentasTotalesUsuario',$dato).view('layouts/footer');   




        } else {

         $session=session();
         $session->destroy();
         return view('layouts/header').view('login').view('layouts/footer');         }
       



    }

    public function mejoresProductosVendidos($ruID)
    {

      $idRut=esc($ruID);

       $rolesAutorizados=$this->datos->rolesAutorizadosModel($idRut);
       
       $session=session();
        
       $rol=($session->get('rolId'));
       


       $autorizado=false;

       foreach($rolesAutorizados as $rolAu){

                 if($rolAu->ROL_ID==$rol[0]->ROL_ID){
                    $autorizado=true;                    break;

                 }else{

                    $autorizado=false;

                 }


       }

       if ($autorizado) {


        $session=session();///
               $vuc=$this->datos->mejoresProductosVendidosModel();

       
               $dato['mjP']=$vuc;//var_dump($dato);

                $menu['rutas']=($session->get('rutas'));
       return view('layouts/header').view('layouts/aside',$menu).view('estadisticas/mejoresProductosVendidos',$dato).view('layouts/footer');   




        } else {

         $session=session();
         $session->destroy();
         return view('layouts/header').view('login').view('layouts/footer');         }
       



    }



    public function menoresProductosVendidos($ruID)
    {

      $idRut=esc($ruID);

       $rolesAutorizados=$this->datos->rolesAutorizadosModel($idRut);
       
       $session=session();
        
       $rol=($session->get('rolId'));
       


       $autorizado=false;

       foreach($rolesAutorizados as $rolAu){

                 if($rolAu->ROL_ID==$rol[0]->ROL_ID){
                    $autorizado=true;
                    break;
                 }else{

                    $autorizado=false;

                 }


       }

       if ($autorizado) {


        $session=session();///
               $vuc=$this->datos->menoresProductosVendidosModel();

       
               $dato['meNP']=$vuc;//var_dump($dato);

                $menu['rutas']=($session->get('rutas'));
       return view('layouts/header').view('layouts/aside',$menu).view('estadisticas/menoresProductosVendidos',$dato).view('layouts/footer');   




        } else {

         $session=session();
         $session->destroy();
         return view('layouts/header').view('login').view('layouts/footer');  
             }
       



    }
    public function registroU(){

        $data=['nombre'=> $_POST['nombre'],
               'apellido'=> $_POST['apellido'],
               'cedula'=> $_POST['cedula'],
               'correo'=> $_POST['correo'],
               ];
               //
               $nombrex=$_POST['nombre'];
               $rol=$_POST['rol'];

               //
            //   print_r($data);
        $this->datos->insertUsuarios($data);

        //
        $idUsu=$this->datos->seleid($nombrex);
        $ide=$idUsu[0]->USU_ID;

        $this->datos->insertarRol($ide,$rol);

        return $this->index();




    }


    public function updateU()
    {
        $usuId = $this->request->getPost('idU'); 
        $resp = $this->datos->getUsuarioModel($usuId);
    
        return $this->response->setJSON($resp); 
    }

    public function actualizarU()
    {
          $nombre=$_POST['n'];
          $apellido=$_POST['a'];
          $cedula=$_POST['c'];
          $correo=$_POST['e'];

        $resp = $this->datos->actualizarUModel($nombre, $apellido, $correo, $cedula);
        //return $nombre." ".$apellido." ".$cedula." ".$correo;
        return $resp;
    }



    public function eliminarU()
    {
          $id=$_POST['idU'];
               $resp = $this->datos->eliminarUModel($id);
        //return $nombre." ".$apellido." ".$cedula." ".$correo;
        return $resp;
    }



}
