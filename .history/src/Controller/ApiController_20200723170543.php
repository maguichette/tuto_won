<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/regions", name="api_add_region_api")
     */
    public function AddReggionByApi(SerializerInterface $serializer)
    {
    $regionJson=file_get_contents("https://geo.api.gouv.fr/regions");
    //decode json vers tableau
    $regionTab=$serializer->decode($regionJson,"json");
    //denormalise
    $regionObject=$serializer->denormalize($regionTab, 'App\Entity\Region[]');
    dd($regionTab);
    
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiController.php',
        ]);
    }
}
