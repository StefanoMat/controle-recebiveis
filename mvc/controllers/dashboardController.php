<?php
declare(strict_types=1);

namespace Mvc\Controllers;

use Mvc\Core\Controller;
use GuzzleHttp\Client;

class DashboardController extends Controller{

  public function index()
  {
    $this->render('index');
  }

  public function create()
  {
   try {
    $data = $_POST;

    $client = new Client([
      'base_uri' => 'http://localhost:3000'
    ]);
    $response = $client->request('POST', '/app/debtor', [
    'form_params' => [
      'name' => $data['nome'],
      'cpfCnpj' => preg_replace('/[^0-9]/', '', $data['cpfcnpj']),
      'birthdate' => $data['data_nascimento'],
      'address' => $data['endereco']
      ]
    ]);
    $debtorId = $response->getBody()->getContents();
    $response = $client->request('POST', '/app/debt', [
      'form_params' => [
        'debtorId' => json_decode($debtorId),
        'debtDescription' => $data['descricao'],
        'value' => $data['valor'],
        'endDate' => $data['data_vencimento'],
        ]
      ]);

      if($response->getStatusCode() <= 299) {
        header('Location:/');
      } else {
        print_r("Não foi possível criar o recebível");
        //TODO criar o retorno com flash message na view
      }
   } catch (\Exception $e) {
     print_r($e->getMessage());
   }  
  }
}