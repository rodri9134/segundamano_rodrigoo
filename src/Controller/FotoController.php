<?php

namespace App\Controller;

use App\Entity\Foto;
use App\Entity\Anuncio;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FotoController extends AbstractController {

    /**
     * @Route("/foto", name="foto")
     */
    public function index() {
        return $this->render('foto/index.html.twig', [
                    'controller_name' => 'FotoController',
        ]);
    }

    /**
     * @Route("/fotos/subirFoto/{id}", name="subirFoto", requirements={"id"="\d+"})
     */
    public function subirFoto($id, Request $request) {
        /*  $numFotos = $request->get('numFotos');
          $idAnuncio = $request->get('idAnuncio'); */
        $titulo = "Subir fotos";
        $anuncio = new Anuncio();
        $anuncio->setId($id);
        $repository = $this->getDoctrine()->getRepository(Foto::class);
        $foto = new Foto();
        $form = $this->createFormBuilder($foto, ['attr' => ['id' => 'subirFotos']])
                ->add('Nombre', FileType::class, array('label' => 'Foto'))
                ->add('Guardar', SubmitType::class, array('label' => 'Añadir foto'))
                ->getForm();
        $form->handleRequest($request);

        $foto = $form->get('Nombre')->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            if ($foto) {
                $extensión = pathinfo($foto->getClientOriginalName(), PATHINFO_EXTENSION);

                $nuevo_nombre_archivo = md5(time() + rand(0, 9999)) . "." . $extensión;
                $foto->move("img", "$nuevo_nombre_archivo");

                //dd($nuevo_nombre_archivo);
                $foto->setNombre($nuevo_nombre_archivo);
            }
         //   dd($anuncio);
            $foto->setAnuncio($anuncio);
           $foto = $form->getData('Nombre');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($foto);
            $entityManager->flush();

            return $this->render("foto/subirFotos.html.twig", ['form' => $form->createView(), 'titulo' => $titulo]);
        }
        return $this->render("foto/subirFotos.html.twig", ['form' => $form->createView(), 'titulo' => $titulo]);
    }

}
