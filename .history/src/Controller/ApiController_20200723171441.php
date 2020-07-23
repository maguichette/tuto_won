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
    //denormalisation tableau vert objet
    $regionObject=$serializer->denormalize($regionTab, 'App\Entity\Region[]');
    dd($regionObject);
    //Déserialise : conversion Json to Object
    $regionObject = $serializer->deserialize($regionJson,'App\Entity\Region[]','json');
    dd($regionObject);
     //Methode 2:deserial
    // $entityManager = $this->getDoctrine()->getManager();

 $regionObject = $serializer->deserialize($regionJson, 'App\Entity\Region[]','json');

 /*foreach($regionObject as $region){
 $entityManager->persist($region);

    
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiController.php',
        ]);
    }
}regionTab
