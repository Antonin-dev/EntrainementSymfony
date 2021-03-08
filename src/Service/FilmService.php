<?php

namespace App\Service;

use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;

class FilmService
{
    private $entityManager;
    

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        

    }

    public function affichageFilm(string $filmName) : Film
    {
    
            $film = $this->entityManager->getRepository(Film::class)->findOneBy([
            'titre' => $filmName
            ]);
                
            if ($film == null) {
                throw new \Exception('film non valide');
            }
            
            $film->setCoutFilmActeurs();
            
            return $film;

        
    }
}