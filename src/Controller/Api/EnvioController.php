<?php

namespace App\Controller\Api;

use App\Entity\Envio;
use App\Repository\EnvioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

class EnvioController extends AbstractController
{
    /**
     * @Route("/api/envio/list", name="api_envio_list", methods="get")
     */
    public function list(EnvioRepository $envioRepository)
    {
        //obtener objeto usuario identificado
        $user = $this->getUser();

        $allEnvios = $envioRepository->findAll();

        if($allEnvios){
            $response = "success";
        }else{
            $response = "no hay datos para mostrar";
        }
        
        return $this->json([
            'action' => 'list',
            'user' => $user->getUserIdentifier(),
            'response' => $response,
            'data' => $allEnvios
        ]);
    }

    /**
     * @Route("/api/envio/create", name="api_envio_create", methods="post")
     */
    public function create(Request $request, EnvioRepository $envioRepository)
    {
        //obtener objeto usuario identificado
        $user = $this->getUser();

        //obtener datos envio
        $datos = $request->getContent();

        if($datos!=null){
            $datosLikeObj = json_decode($datos);

            //generar Uuid
            $uuid=Uuid::v4();
            //generar localizador
            $patron = '0123456789abcdefghijklmnopqrstuvwxyz'.date('dmis');
            $localizador = substr(str_shuffle($patron), 0, 10);

            //creo el objeto envio
            $envio = new Envio();
            $envio->setUuid($uuid);
            $envio->setRecogida([$datosLikeObj->recogida]);
            $envio->setDestino([$datosLikeObj->destino]);
            $envio->setLocalizador($localizador);
            $envio->setVehiculo($datosLikeObj->vehiculo);

            //guardo el objeto
            $envioRepository->add($envio,true);
            $response = "success";
        }else{
            $response = "envío no recibido";
            $envio = null;
        }

        return $this->json([
            'action' => 'create',
            'email' => $user->getUserIdentifier(),
            'response' => $response,            
            'data' => $envio
        ]);
    }
    
    /**
     * @Route("/api/envio/edit", name="api_envio_edit", methods="put")
     */
    public function edit(Request $request, EnvioRepository $envioRepository)
    {
        //obtener objeto usuario identificado
        $user = $this->getUser();        

        return $this->json([
            'action' => 'edit',
            'email' => $user->getUserIdentifier()
        ]);
    }    
}
