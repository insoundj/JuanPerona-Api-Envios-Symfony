<?php

namespace App\Controller\Api;

use App\Entity\Envio;
use App\Repository\UserRepository;
use App\Repository\EnvioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class EnvioController extends AbstractController
{  
    /**
     * @Route("/api/envio/list", name="api_envio_list", methods="get")
     */
    public function list(EnvioRepository $envioRepository, UserRepository $userRepository)
    {
        //obtener usuario identificado
        $userEmail = $this->getUser()->getUserIdentifier();
        //obtener id usuario identificado
        $user = $userRepository->findOneBy(['email' => $userEmail]);

        //consultar envios del usuario identificado
        $allEnvios = $envioRepository->findBy(['user' => $user->getId()]);

        if($allEnvios){
            $response = "success";
        }else{
            $response = "no hay datos para mostrar";
        }
        
        return $this->json([
            'action' => 'list',
            'emailUser' => $userEmail,
            'response' => $response,
            'data' => $allEnvios
        ]);
    }

    /**
     * @Route("/api/envio/create", name="api_envio_create", methods="post")
     */
    public function create(Request $request, EnvioRepository $envioRepository, UserRepository $userRepository, ValidatorInterface $validatorInterface)
    {
        //obtener usuario identificado
        $userEmail = $this->getUser()->getUserIdentifier();
        //obtener id usuario identificado
        $user = $userRepository->findOneBy(['email' => $userEmail]);

        //obtener datos envio
        $datos = $request->getContent();

        if($datos!=null){
            $datosLikeObj = json_decode($datos);

            //comprobamos si recogida y destino tienen datos
            if(
                (!empty($datosLikeObj->recogida->nombre) && !empty($datosLikeObj->recogida->latitud) && !empty($datosLikeObj->recogida->longitud)) 
            &&
                (!empty($datosLikeObj->destino->nombre) && !empty($datosLikeObj->destino->latitud) && !empty($datosLikeObj->destino->longitud))
            ){

                //generar Uuid
                $uuid=Uuid::v4();
                //generar localizador
                $patron = '0123456789abcdefghijklmnopqrstuvwxyz'.date('dmis');
                $localizador = substr(str_shuffle($patron), 0, 10);

                //creo el objeto envio y seteo los datos
                $envio = new Envio();
                $envio->setUuid($uuid);
                $envio->setRecogida([$datosLikeObj->recogida]);
                $envio->setDestino([$datosLikeObj->destino]);
                $envio->setLocalizador($localizador);
                $envio->setVehiculo($datosLikeObj->vehiculo);
                $envio->setUser($user);

                //validacion de datos
                $errors = $validatorInterface->validate($envio);
                    
                if(count($errors) > 0){
                    //devuelvo los errores
                    $response = "errores encontrados";
                    $data = (string) $errors;                
                }else{
                    //guardo en bbdd
                    $envioRepository->add($envio,true);
                    $response = "success";
                    $data = $envio;
                }
            }else{
                $response = "errores encontrados en recogida o destino";
                $data = $datosLikeObj;                
            }    
        }else{
            $response = "envío no recibido";
            $data = null;
        }

        return $this->json([
            'action' => 'create',
            'emailUser' => $userEmail,
            'response' => $response,            
            'data' => $data
        ]);
    }
    
    /**
     * @Route("/api/envio/edit", name="api_envio_edit", methods="put")
     */
    public function edit(Request $request, EnvioRepository $envioRepository, UserRepository $userRepository, ValidatorInterface $validatorInterface)
    {
        //obtener usuario identificado
        $userEmail = $this->getUser()->getUserIdentifier();
        //obtener id usuario identificado
        $user = $userRepository->findOneBy(['email' => $userEmail]);

        //obtener datos envio
        $datos = $request->getContent();

        if($datos!=null){
            $datosLikeObj = json_decode($datos);

            //comprobamos si existe uuid
            if(!empty($datosLikeObj->uuid)){

                //obtener registro a modificar
                $envio = $envioRepository->findOneBy(["uuid" => $datosLikeObj->uuid]);

                //seteo los datos si existen
                isset($datosLikeObj->recogida)?$envio->setRecogida([$datosLikeObj->recogida]):"";
                isset($datosLikeObj->destino)?$envio->setDestino([$datosLikeObj->destino]):"";
                isset($datosLikeObj->vehiculo)?$envio->setVehiculo($datosLikeObj->vehiculo):"";

                //validacion de datos
                $errors = $validatorInterface->validate($envio);
                    
                if(count($errors) > 0){
                    //devuelvo los errores                    
                    $response = "errores encontrados";
                    $data = (string) $errors;
                }else{
                    //actualizo en bbdd
                    $envioRepository->add($envio,true);
                    $response = "success";
                    $data = $envio;
                }
            }else{                
                $response = "errores encontrados en uuid";
                $data = $datosLikeObj;
            }    
        }else{
            $response = "envío no recibido";
            $data = null;
        }

        return $this->json([
            'action' => 'update',
            'emailUser' => $userEmail,
            'response' => $response,            
            'data' => $data
        ]);
    }    
}
