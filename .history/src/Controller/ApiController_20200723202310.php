<?php

namespace App\Controller;

use App\Entity\Region;
use App\Repository\RegionRepository;
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
        

        $regionObject = $serializer->deserialize($regionJson, 'App\Entity\Region[]','json');
        
        $entityManager = $this->getDoctrine()->getManager();
        foreach($regionObject as $region){
            $entityManager->persist($region);
         }
         $entityManager->flush();
                            
                            return new JsonResponse("succes",Response::HTTP_CREATED,[],true);
                    }
                    /**
 * @Route("/api/regions", name="api_all_region",methods={"GET"})
 */
 public function showRegion(SerializerInterface $serializer,RegionRepository $repo)
 {
        $regionsObject=$repo->findAll();
        $regionsJson =$serializer->serialize($regionsObject,"json");
        return new JsonResponse($regionsJson,Response::HTTP_OK,[],true);
 }
}