<?php 

namespace App\Controller;

use App\Entity\Vart;
use App\Entity\Uzd;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class PanelController extends Controller {

/**
	* @Route("/back")
	*/

	public function errorPage() {

		return $this->render('error.html.twig');
	}

	/**
	* @Route("/login", name="login")
	* @Method({"GET", "POST"})
	*/

	public function login(Request $request, AuthenticationUtils $authenticationUtils) {

		$error = $authenticationUtils->getLastAuthenticationError();
		$lastUsername = $authenticationUtils->getLastUsername();

		return $this->render('login.html.twig', array(
			'last_username' => $lastUsername,
			'error'         => $error,
		));
	}
	/**
	* @Route("/logout", name="logout")
	*/
	public function logout() {

	}
	/**
	* @Route("/register/", name="register")
	* @Method({"GET", "POST"})
	*/
	public function register(Request $request, UserPasswordEncoderInterface $encoder, ValidatorInterface $validator) {

		$user = new Vart();
		$errors = $validator->validate($user);
		$form = $this->createFormBuilder($user)
		->add('username', TextType::class, array('label' => 'Vardas: ', 
												 'attr' => array('class' => 'input-group')))
		->add('email', EmailType::class, array('label' => 'El.paštas: ',
											   'attr' => array('class' => 'input-group')))
		->add('usertype', HiddenType::class, array('label' => 'Tipas: ',
												   'required' => false,
												   'empty_data' => 'ROLE_USER',
												   'attr' => array('class' => 'input-group')))
		->add('password', RepeatedType::class,
		 array('type' => PasswordType::class, 'invalid_message' => 'Slaptažodžiai nesutampa!',
		 	   'first_options' => array('label' => 'Slaptažodis: ',
		 								'attr' => array('class' => 'input-group')),
		 	   'second_options' => array('label' => 'Pakartokite slaptažodį: ',
		 	   							 'attr' => array('class' => 'input-group'))))
		->add('reg', SubmitType::class,array('label' => 'Registruotis',
											 'attr' => array('class' => 'btn')))

		->getForm();
		$form->handleRequest($request);
		$errors = $form->getErrors();

		if($form->isSubmitted() && $form->isValid()) {
			$user = $form->getData();
			$user->setPassword($encoder->encodePassword($user, $user->getPassword()));
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($user);
			$entityManager->flush();
			return $this->redirectToRoute('login');		
		}
		if ($form->isSubmitted() && count($errors) > 0) {
    		return $this->render('register.html.twig', array(
        	'errors' => $errors,'form' => $form->createView()));
		}

		return $this->render('register.html.twig', array('form' => $form->createView()));
	}

	/**
	* @Route("/createuser/", name="createuser")
	* @Method({"GET", "POST"})
	*/
	public function createUser(Request $request, UserPasswordEncoderInterface $encoder) {

		$user = new Vart();
		$form = $this->createFormBuilder($user)
		->add('username', TextType::class, array('label' => 'Vardas: ',
												 'attr' => array('class' => 'input-group')))
		->add('email', EmailType::class, array('label' => 'El.paštas: ',
											   'attr' => array('class' => 'input-group')))
		->add('usertype', ChoiceType::class, array('label' => 'Tipas: ',
												   'attr' => array('class' => 'input-group'),
												   'choices' => array('Admin' => 'ROLE_ADMIN',
																	  'User' => 'ROLE_USER')))
		->add('password', RepeatedType::class,
			array('type' => PasswordType::class, 'invalid_message' => 'Slaptažodžiai nesutampa!',
		 	   'first_options' => array('label' => 'Slaptažodis: ', 
		 	   							'attr' => array('class' => 'input-group')),
		 	   'second_options' => array('label' => 'Pakartokite slaptažodį: ',
		 	   							 'attr' => array('class' => 'input-group')))) 								  
		->add('reg', SubmitType::class,array('label' => 'Sukurti vartotoją',
											 'attr' => array('class' => 'btn')))

		->getForm();

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$user = $form->getData();
			$user->setPassword($encoder->encodePassword($user, $user->getPassword()));
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($user);
			$entityManager->flush();

			return $this->redirectToRoute('adminlog');
		}

		return $this->render('admin/create_user.html.twig', array('form' => $form->createView()));
	}

	/**
	* @Route("/createtask/", name="createtask")
	* @Method({"GET", "POST"})
	*/
	public function createTask(Request $request) {
		
		$users = $this->getDoctrine()->getRepository(Vart::class)->findAll();

		return $this->render('admin/create_task.html.twig', array('users' => $users));
	}

	/**
	* @Route("/createtask/add", name="addtask")
	* @Method({"GET", "POST"})
	*/
	public function createTaskSubmit(Request $request) {

		$task = $this->getDoctrine()->getRepository(Uzd::class)->findAll();
		$task = new Uzd();
		$task->setTaskname($request->get('_taskname'));
		$task->setStatus($request->get('_status'));
		$task->setLocation($request->get('_location'));
		$task->setUsername($request->get('_username'));

		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($task);
		$entityManager->flush($task);
		return $this->redirectToRoute('adminlog');
	}
	/**
	* @Route("/edittask/{id}", name="edittask")
	* @Method({"GET", "POST"})
	*/
	public function editTask(Request $request, $id) {

		$task = new Uzd();
		$task = $this->getDoctrine()->getRepository(Uzd::class)->find($id);
		$user = $this->getDoctrine()->getRepository(Vart::class)->findAll();

		$form = $this->createFormBuilder($task)
		->add('taskname', TextType::class, array('label' => 'Pavadinimas: ', 
												 'attr' => array('class' => 'input-group')))
		->add('location', TextType::class, array('label' => 'Vieta: ', 
												 'attr' => array('class' => 'input-group')))
		->add('username', EntityType::class, array('class' => Vart::class,
												   'choice_label' => 'username', 
												   'label' => 'Kam priskirti: ',
												   'attr' => array('class' => 'input-group')))
		->add('status', ChoiceType::class, array('label' => 'Statusas: ',
												 'choices' => array('Padaryta' => 'padaryta',
												 					'Nepadaryta' => 'nepadaryta'),
											   	 'attr' => array('class' => 'input-group')))
		->add('create', SubmitType::class,array('label' => 'Redaguoti užduotį', 
												'attr' => array('class' => 'btn')))
		->getForm();
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$task = $form->getData();
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($task);
			$entityManager->flush();

			return $this->redirectToRoute('adminlog');
		}
		return $this->render('admin/edit.html.twig', array('form' => $form->createView()));
	}
	/**
	* @Route("/", name="adminlog")
	* @Method({"GET", "POST"})
	*/
	public function adminLog() {

		$tasks = $this->getDoctrine()->getRepository(Uzd::class)->findAll();
		$users = $this->getDoctrine()->getRepository(Vart::class)->findAll();

		return $this->render('pagrindinis.html.twig', array('tasks' => $tasks, 'users' => $users));
	}
	/**
	* @Route("/userlog/", name="userlog")
	* @Method({"GET", "POST"})
	*/
	public function userLog() {

		$tasks = $this->getDoctrine()->getRepository(Uzd::class)->findAll();
		$users = $this->getDoctrine()->getRepository(Vart::class)->findAll();

		return $this->render('index.html.twig', array('tasks' => $tasks, 'users' => $users));
	}
	/**
	* @Route("/deleteuser/{id}")
	* @Method({"DELETE", "GET", "POST"})
	*/
	public function deleteUser(Request $request, $id) {

		$user = $this->getDoctrine()->getRepository(Vart::class)->find($id);
		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->remove($user);
		$entityManager->flush();

		$response = new Response();
		$response->send();
	}
	/**
	* @Route("/deletetask/{id}")
	* @Method({"DELETE"})
	*/
	public function deleteTask(Request $request, $id) {

		$task = $this->getDoctrine()->getRepository(Uzd::class)->find($id);
		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->remove($task);
		$entityManager->flush();

		$response = new Response();
		$response->send();
}
	/**
	* @Route("/padaryta/{id}")
	* @Method({"GET", "POST"})
	*/
	public function padaryta(Request $request, $id) {

		$entityManager = $this->getDoctrine()->getManager();
		$task = new Uzd();
		$task = $this->getDoctrine()->getRepository(Uzd::class)->find($id);
		$task->setStatus('padaryta');

		$entityManager->persist($task);
		$entityManager->flush();

		return $this->redirectToRoute('adminlog');
	}
	/**
	* @Route("/nepadaryta/{id}")
	* @Method({"GET", "POST"})
	*/
	public function nepadaryta(Request $request, $id) {

		$entityManager = $this->getDoctrine()->getManager();
		$task = new Uzd();
		$task = $this->getDoctrine()->getRepository(Uzd::class)->find($id);
		$task->setStatus('nepadaryta');

		$entityManager->persist($task);
		$entityManager->flush();

		return $this->redirectToRoute('adminlog');
	}
}