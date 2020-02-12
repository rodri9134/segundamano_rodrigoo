<?php

namespace App\Controller;
use App\Entity\Foto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class FotoController extends AbstractController
{
    /**
     * @Route("/foto", name="foto")
     */
    public function index()
    {
        return $this->render('foto/index.html.twig', [
            'controller_name' => 'FotoController',
        ]);
    }
    /**
     * @Route("/subirFotos", name="subirFotos")
     */
    public function subirFotos(Request $request)
    {
      /*  $numFotos = $request->get('numFotos');
        $idAnuncio = $request->get('idAnuncio');*/
        $titulo="Subir fotos";
        $repository = $this->getDoctrine()->getRepository(Foto::class);
        $foto = new Foto();
    $form = $this->createFormBuilder($foto, ['attr' => ['id' => 'subirFotos']])
   
        ->add('Nombre', FileType::class, array('label' => 'Foto', 'multiple' => true, 'mapped' =>false))
        ->add('Guardar', SubmitType::class, array('label' => 'Guardar'))
        ->getForm();
    $form->handleRequest($request);



  //  dd($form);
    if ($form->isSubmitted() && $form->isValid()) {
        $files = $foto->getNombre();
        dd($files);
        foreach ($files as $file) {
           $foto = new Foto();
        
            $fileName = $fileUploader->upload($file);
            $foto->setFoto('img/' . $fileName);
            }
    }
/*
    return $this->render('foto/subirFotos.html.twig', array('titulo'=>$titulo,
        'foto' => $foto,
        'form' => $form->createView(),
    ));*/
    return $this->render("foto/subirFotos.html.twig", ['form' => $form->createView(), 'titulo' => $titulo]);
    }
}
