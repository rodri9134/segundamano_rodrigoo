<?php

namespace App\Controller;

use App\Entity\Anuncio;
use App\Entity\Foto;
use App\Entity\Provincia;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class AnunciosController extends AbstractController {

    /**
     * @Route("/muestraProvincias", name="muestraProvincias")
     */
    public function muestraProvincias() {
        $repository = $this->getDoctrine()->getRepository(Provincia::class);
        $provincias = $repository->verProvincias();
        return $provincias;
    }

    /**
     * @Route("/", name="inicio")
     */
    public function inicio() {
        $titulo = "Anuncios";
        $repository = $this->getDoctrine()->getRepository(Anuncio::class);
        $repository2 = $this->getDoctrine()->getRepository(Provincia::class);
        $repository3 = $this->getDoctrine()->getRepository(Foto::class);
        $anuncios = $repository->findByPortada();

        foreach ($anuncios as $anuncio) {
            $fotos = $repository3->findByAnuncio($anuncio->getId());
        }
        $provincias = $repository2->verProvincias();
        return $this->render("inicio.html.twig", ['titulo' => $titulo, 'provincias' => $provincias, 'anuncios' => $anuncios, 'fotos' => $fotos]);
    }

    /**
     * @Route("/inicioUsuario", name="inicioUsuario")
     */
    public function inicioUsuario() {

        $titulo = "Anuncios usuario";
        $repository = $this->getDoctrine()->getRepository(Anuncio::class);
        $repository2 = $this->getDoctrine()->getRepository(Provincia::class);
        $repository3 = $this->getDoctrine()->getRepository(Foto::class);
        $anuncios = $repository->findByPortada();

        $provincias = $repository2->verProvincias();

        return $this->render("anuncios/inicioUsuario.html.twig", ['titulo' => $titulo, 'provincias' => $provincias, 'anuncios' => $anuncios]);
    }

    /**
     * @Route("/anuncios/invitado/ver/{id}", name="verAnuncioInv", requirements={"id"="\d+"})
     */
    public function ver($id) {
        $titulo = "Anuncio";
        $repository = $this->getDoctrine()->getRepository(Anuncio::class);
        $repository2 = $this->getDoctrine()->getRepository(Foto::class);
        $repository3 = $this->getDoctrine()->getRepository(User::class);
        $anuncio = $repository->find($id);
        $fotos = $repository2->find($anuncio->getId());

        //dd($fotos);
        if (!$anuncio) {
            throw $this->createNotFoundException(
                    'No existe el anuncio con el id indicado' . $id
            );
        }
        return $this->render("verAnuncioInv.html.twig", ['anuncio' => $anuncio, 'titulo' => $titulo, 'fotos' => $fotos, 'user' => $user]);
    }

    /**
     * @Route("/anuncios/verAnuncio/{id}", name="verAnuncio", requirements={"id"="\d+"})
     */
    public function verAnuncio($id) {
        $titulo = "Anuncio";
        $repository = $this->getDoctrine()->getRepository(Anuncio::class);
        $repository2 = $this->getDoctrine()->getRepository(Foto::class);
        $repository3 = $this->getDoctrine()->getRepository(User::class);
        $anuncio = $repository->find($id);
        $fotos = $repository2->find($anuncio->getId());

        $idUser = $anuncio->getUser();
        $user = $repository3->find($idUser);
        //   dd($user);
        //dd($fotos);
        if (!$anuncio) {
            throw $this->createNotFoundException(
                    'No existe el anuncio con el id indicado' . $id
            );
        }
        return $this->render("anuncios/verAnuncio.html.twig", ['anuncio' => $anuncio, 'titulo' => $titulo, 'fotos' => $fotos, 'user' => $user]);
    }

    /**
     * @Route("/busqueda", name="busqueda")
     */
    public function busqueda(Request $request) {
        $titulo = "Búsqueda de productos";
        $repository = $this->getDoctrine()->getRepository(Anuncio::class);
        $elemento = $request->get("busqueda");
        $anuncios = $repository->busqueda($elemento);
        // $fotos = $anuncios->getFotoPrincipal();
        // dd($fotos);
        $provincias = $this->muestraProvincias();
        //  dd($productos);
        return $this->render("inicio.html.twig", ['anuncios' => $anuncios, 'titulo' => $titulo, 'provincias' => $provincias]);
    }

    /**
     * @Route("/busquedaProvincia", name="busquedaProvincia")
     */
    public function busquedaPorProvincia(Request $request) {
        $titulo = "Búsqueda por provincia";
        $repository = $this->getDoctrine()->getRepository(Anuncio::class);
        $provincia = $request->get("provincias");
//dd($provincia);
        $anuncio = $repository->busquedaProvincia($provincia);
        $provincias = $this->muestraProvincias();

        return $this->render("inicio.html.twig", ['anuncios' => $anuncios, 'titulo' => $titulo, 'provincias' => $provincias, 'fotos' => $fotos]);
    }

    /**
     * @Route("/insertarAnuncio", name="insertarAnuncio")
     */
    public function insertarAnuncio(Request $request) {
        $titulo = "Insertar Anuncio";
        $idUsuario = $this->getUser()->getId();

        $anuncio = new Anuncio();

        $foto = new Foto();
        $form = $this->createFormBuilder($anuncio, ['attr' => ['id' => 'insertarAnuncio']])
                ->add('titulo', TextType::class, ['attr' => ['class' => 'form-control']])
                ->add('descripcion', TextareaType::class, array(
                    'required' => false), ['attr' => ['class' => 'form-control']])
                ->add('precio', MoneyType::class, ['attr' => ['class' => 'form-control']])
                ->add('fechacrea', DateType::class, ['attr' => ['class' => 'form-control']])
                //   ->add('fechamod', DateType::class, ['attr' => ['class' => 'form-control']])
                ->add('FotoPrincipal', FileType::class)
                //   ->add('Fotos', FileType::class, array('label' => 'Fotos', 'multiple' => true, 'mapped' =>true))
                ->add('Crear_Anuncio', SubmitType::class, ['attr' => ['class' => 'btn btn-danger']])
                ->getForm();

        $form->handleRequest($request);

        $foto = $form->get('FotoPrincipal')->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            //   dd($foto);
            if ($foto) {
                $extensión = pathinfo($foto->getClientOriginalName(), PATHINFO_EXTENSION);

                $nuevo_nombre_archivo = md5(time() + rand(0, 9999)) . "." . $extensión;
                $foto->move("img", "$nuevo_nombre_archivo");
                $anuncio->setFotoPrincipal($nuevo_nombre_archivo);
            }
            $usuario = new User();
            $idUsuario = $this->getUser()->getId();
            $usuario->setId($idUsuario);
            //dd($usuario);
            //  dd($usuario->getId());
            $anuncio->setUser($this->getUser());
            $anuncio = $form->getData();
            $foto = $form->getData('foto');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($foto);
            $entityManager->persist($anuncio);
            $entityManager->flush();
            return $this->redirectToRoute('inicioUsuario');
            // return $this->redirectToRoute('misAnuncios');
        }
        return $this->render("anuncios/crearAnuncio.html.twig", ['crear_anuncio' => $form->createView(), 'titulo' => $titulo]);
    }

    /**
     * @Route("/anunciosUsuario", name="anunciosUsuario")
     */
    public function listadoAnunciosUsuario() {

        $titulo = "Anuncios usuario";
        $repository = $this->getDoctrine()->getRepository(Anuncio::class);
        $repository2 = $this->getDoctrine()->getRepository(Provincia::class);
        $repository3 = $this->getDoctrine()->getRepository(Foto::class);
        $anuncios = $repository->findByPortada();
        // $anuncios=$repository->findByUsuario($id);

        foreach ($anuncios as $anuncio) {
            $fotos = $repository3->findByAnuncio($anuncio->getId());
        }

        $provincias = $repository2->verProvincias();

        return $this->render("anuncios/misAnuncios.html.twig", ['titulo' => $titulo, 'provincias' => $provincias, 'anuncios' => $anuncios, 'fotos' => $fotos]);
    }

    /**
     * @Route("/editarAnuncio/{id}", name="editarAnuncio")
     */
    public function editarAnuncio($id) {
        $titulo = "Anuncio";
        $repository = $this->getDoctrine()->getRepository(Anuncio::class);
        $repository2 = $this->getDoctrine()->getRepository(Foto::class);
        $anuncio = $repository->find($id);

        if (!$anuncio) {
            throw $this->createNotFoundException(
                    'No existe el anuncio con el id indicado' . $id
            );
        }
        return $this->render("anuncios/editarAnuncio.html.twig", ['anuncio' => $anuncio, 'titulo' => $titulo]);
    }

    /**
     * @Route("/modificarAnuncio", name="modificarAnuncio")
     */
    public function modificarAnuncio(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Anuncio::class);
        //  dd($request);
        $idAnuncio = $request->get('idAnuncio');
        //  dd($idAnuncio);
        $titulo = $request->get('titulo');
        //  dd($titulo);
        $descripcion = $request->get('descripcion');
        $precio = $request->get('precio');
        $fechamod = \DateTime::createFromFormat('Y-m-d', $request->get('fechamod'));
        $anuncio = $repository->find($idAnuncio);
        $anuncio->setTitulo($titulo);
        $anuncio->setDescripcion($descripcion);
        $anuncio->setFechaMod($fechamod);
        $anuncio->setPrecio($precio);
        //  dd($anuncio);
        $entityManager->flush();
        return $this->redirectToRoute('inicioUsuario');
    }

    /**
     * @Route("/anuncio/eliminarAnuncio/{id}", name="eliminarAnuncio")
     */
    public function eliminarAnuncio($id, Request $request) {
        $anuncio = new Anuncio();
        $repository = $this->getDoctrine()->getRepository(Anuncio::class);

        $anuncio = $repository->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($anuncio);
        $entityManager->flush();

        return $this->redirectToRoute('misAnuncios');
    }

    /**
     * @Route("/ordenar}", name="ordenar")
     */
    public function ordenPorTAF(Request $request) {

        $busqueda = $request->get('busqueda');
        $orden = $request->get('orden');
        $anuncio = new Anuncio();
        $repository = $this->getDoctrine()->getRepository(Anuncio::class);
        $repository2 = $this->getDoctrine()->getRepository(User::class);
        $anuncios = $repository->ordenarPor($busqueda, $orden);
        $provincias = $this->muestraProvincias();
        $titulo = "Ordenación de los anuncios por " . $busqueda . " " . $orden;
        return $this->render("inicio.html.twig", ['anuncios' => $anuncios, 'titulo' => $titulo, 'provincias' => $provincias]);
    }

}
