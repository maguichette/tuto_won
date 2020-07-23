<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/regions", name="api_add_region_api", methods={"GET"})
     */
    public function AddReggionByApi(SerializerInterface $serializer)
    {
        $regionJson=file_get_contents("https://geo.api.gouv.fr/regions");
        // //decode json vers tableau
        // $regionTab=$serializer->decode($regionJson,"json");
        // //denormalisation tableau vert objet
        // $regionObject=$serializer->denormalize($regionTab, 'App\Entity\Region[]');
        // dd($regionObject);
        // //Déserialise : conversion Json to Object
        // $regionObject = $serializer->deserialize($regionJson,'App\Entity\Region[]','json');
        // dd($regionObject);
        //Methode 2:deserialisation json vers objet
        

        $regionObject = $serializer->deserialize($regionJson, 'App\Entity\Region[]','json',true);
        dd($regionJson);
        $entityManager = $this->getDoctrine()->getManager();
        foreach($regionObject as $region){
            $entityManager->persist($region);
         }
         $entityManager->flush();
                            
                            return new JsonResponse("succes",Response::HTTP_CREATED,[],true);
                    }
                    }