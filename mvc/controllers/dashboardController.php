<?php
declare(strict_types=1);

namespace Mvc\Controllers;

use Mvc\Core\Controller;
use GuzzleHttp\Client;

class DashboardController extends Controller{

  public function index()
  {
    
    $client = new Client([
      'base_uri' => 'http://localhost:3000'
    ]);
    $response = $client->request('GET', '/app/debt');
    $data['data'] = $response->getBody()->getContents();

    $this->render('index', '', (array) $data);
  }

  public function create()
  {
   try {
    $data = $_POST;
    $data['data_vencimento'] = str_replace("/","-", $data['data_vencimento']);
    $data['data_nascimento'] = str_replace("/","-", $data['data_nascimento']);
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

  public function edit() {

    try {
    $data = $_POST;
    $data['data_vencimento'] = str_replace("/","-", $data['data_vencimento']);
    $data['data_nascimento'] = str_replace("/","-", $data['data_nascimento']);
    $client = new Client([
      'base_uri' => 'http://localhost:3000'
    ]);
    $client->request('POST', '/app/put-debt', [
      'form_params' => [
        'id' => $data['debt_id'],
        'debtorId' => $data['debtor_id'],
        'debtDescription' => $data['descricao'],
        'value' => $data['valor'],
        'endDate' => $data['data_vencimento'],
        ]
    ]);

    $response = $client->request('POST', '/app/put-debtor', [
      'form_params' => [
        'id' => $data['debtor_id'],
        'name' => $data['nome'],
        'cpfCnpj' => preg_replace('/[^0-9]/', '', $data['cpfcnpj']),
        'birthdate' => $data['data_nascimento'],
        'address' => $data['endereco']
        ]
      ]);

      if($response->getStatusCode() <= 299) {
        header('Location:/');
      } else {
        print_r("Não foi possível atualizar o recebível");
        //TODO criar o retorno com flash message na view
      }
    } catch (\Exception $e) 
    {
      print_r($e->getMessage());
    }

  }
  public function delete($ids)
  {
    print_r($ids);
    $client = new Client([
      'base_uri' => 'http://localhost:3000'
    ]);
    $response = $client->request('GET', '/app/delete-receivable/'.$ids['debtorId'].'/'.$ids['debtId']);

    print_r($response->getBody()->getContents());
  }
}