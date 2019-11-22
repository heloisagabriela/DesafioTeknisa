<?php

namespace App\Http\Controllers;

use App\Email;
use App\ListaEmail;
use Illuminate\Request;

class APIController extends Controller{

    public function __construct(){
        //
    }

    public function index(){

        //Recuperar o array que esta em resources na pasta data.json 
           $jsonString = file_get_contents(base_path('resources/data.json'));

        //   //Decodifivar o json
           $arr = json_decode($jsonString);
  
        //   //Filtrar o json e salvar na lista $array[]
           foreach ($arr as $key){
               $array[] = $key->email;
           }
        //Indentificar o email para melhor vizualizacao 
           $str=implode(",", $array);
            
          $this->ValidarEmail($str);
    }

    public function ValidarEmail($str){

        $file = fopen('../emails.txt','w');
        fwrite($file, print_r($str, TRUE));
    
        $file = fopen('../emails_'.time().'.txt','w');
        fwrite($file, print_r($str, TRUE));

    }

    public function ListaUsuario(){

        $file_lines = file('../data.txt');
        foreach ($file_lines as $line) {
            echo $line;

        }

        //$file = file_get_contents('../data.txt');
        //echo $file;

        //Recuperar o array que esta em resources na pasta data.json 
        $jsonString = file_get_contents(base_path('resources/data.json'));

        //Decodifivar o array
        $arr = json_decode($jsonString);

        //Filtrar o json e salvar na lista $array[]
        foreach ($arr as $key){
            $array[] = $key->email;
        }

        //Indentificar o email para melhor vizualizacao 
        $str=implode(", ", $array);

        //Criar o arquivo na raiz das pastas no modo de escrita 
        $file = fopen('../data.txt','w');

        //Gravar no arquivo Json identado
        fwrite($file, print_r($str, TRUE));

        //Retornar o implode
        // return response($str,201)
        // ->header('Content-Type', 'application/json');
    }

    public function EnviarEmails(Request $request){
        // $data = $request->json()->all();
        return response($request,201)
        ->header('Content-Type', 'application/json');
    }
}