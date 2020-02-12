<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Provincia;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\BasePasswordEncoder;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
class UsuariosController extends AbstractController
{
    /**
     * @Route("/usuarios", name="usuarios")
     */
    public function index()
    {
        return $this->render('usuarios/index.html.twig', [
            'controller_name' => 'UsuariosController',
        ]);
    }

    /**
     * @Route("/registrar", name="registrar")
     */
    public function registrar(UserPasswordEncoderInterface $encoder, Request $request)
    {
        $titulo = "Registro";
        $usuario = new User();
        $form = $this->createFormBuilder($usuario, ['attr' => ['id' => 'registro']])

            ->add('email', EmailType::class, ['attr' => ['class' => 'form-control']])
            ->add('password', PasswordType::class, ['attr' => ['class' => 'form-control']])
            ->add('nombre', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('apellidos', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('telefono', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('Provincia', EntityType::class, [
                'class' => Provincia::class,
                'choice_label' => function ($provincia) {
                    return $provincia->getNombre();
                },
            ])
            ->add('foto', FileType::class, ['attr' => ['class' => 'form-control']])
            ->add('Registrar', SubmitType::class, ['attr' => ['class' => 'btn btn-danger']])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
    
            $usuario = $form->getData();
            $usuario->setRoles('ROLE_USER');

            //Guarda el archivo de la foto
            $foto = $form->get('foto')->getData();
            $password = $form->get('password')->getData();
            //    dd($password);
            //      $encoded = $encoder->encodePassword($usuario, $password);
        //    dd($encoder->encodePassword($usuario, $usuario->getPassword()));
            $encoded = $encoder->encodePassword($usuario, $usuario->getPassword());
          //  dd($encoded);
            // $encoded = $encoder->encodePassword($usuario, $usuario->getPassword());

            $usuario->setPassword($encoded);
            if ($foto) {
                $extensión = pathinfo($foto->getClientOriginalName(), PATHINFO_EXTENSION);
                $nuevo_nombre_archivo = md5(time() + rand(0, 9999)) . "." . $extensión;
                $foto->move("imagenes", "$nuevo_nombre_archivo");
                $usuario->setFoto($nuevo_nombre_archivo);
            }

            if (!$this->getDoctrine()->getRepository(User::class)
                ->findOneBy(['email' => $usuario->getEmail()])) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($usuario);
                $entityManager->flush();
                $this->addFlash('mensaje', 'Usuario creado');
                return $this->redirectToRoute('inicio');
            } else {
                $this->addFlash('mensaje', 'El email ya existe');
            }
        }
        return $this->render("usuarios/registrar.html.twig", ['registro' => $form->createView(), 'titulo' => $titulo]);
    }
}
