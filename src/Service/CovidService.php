<?php

namespace App\Service;



use Symfony\Contracts\HttpClient\HttpClientInterface;

class CovidService
{

    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getApi()
    {
        
        $response = $this->httpClient->request(
            'GET',
            'https://coronavirusapi-france.now.sh/AllLiveData'
        );
        
        if ($response == null) {
            throw new \Exception("Erreur api");
            
        }
        $response = $response->toArray();
        $response = $response['allLiveFranceData'];

        return $response;

    }

    public function global()
    {
        
        $response = $this->httpClient->request(
            'GET',
            'https://coronavirusapi-france.now.sh/FranceLiveGlobalData'
        );

       
        $response = $response->toArray();
        
        $response = $response['FranceGlobalLiveData'];
 
        return $response[0];

    }

    public function search(array $arrayData)
    {
        $data = [
            'valeurMini' => $arrayData[0]->getReanimation() + $arrayData[0]->getHospitalisation(),
            'departement' => ''
        ];
        
        
        foreach ($arrayData as $key) {

            $somme = $key->getReanimation() + $key->getHospitalisation();

            if ($somme < $data['valeurMini']) {
                $data['valeurMini'] = $somme;
                $data['departement'] = $key->getNom();
            }
        }

        return $data;
 
    }

    public function searchMax(array $arrayData)
    {
        $data = [
            'valeurMaxi' => $arrayData[0]->getReanimation() + $arrayData[0]->getHospitalisation(),
            'departement' => ''
        ];
        
        
        foreach ($arrayData as $key) {

            $somme = $key->getReanimation() + $key->getHospitalisation();
            if ($key->getNom() == 'France') {
                continue;
            }
            else if ($somme > $data['valeurMaxi']) {
                $data['valeurMaxi'] = $somme;
                $data['departement'] = $key->getNom();
            }
        }

        return $data;
    }
}