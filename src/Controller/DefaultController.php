<?php

namespace App\Controller;

use App\Form\TaskType;
use App\Entity\Task;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
	public function __construct() {
		
		$this->task = new Task();
	}
	
    /**
     * @Route("/", name="default")
     */
    public function index(Request $request)
    {
		$form = $this->createForm(TaskType::class, $this->task);
		$form->handleRequest($request);
	
		 return $this->render('default/index.html.twig', [
				'controller_name' => 'DefaultController',
				'form' => $form->createView()
			
			]);
	}
	/**
     * @Route("/send")
     */
	public function send(Request $request, ValidatorInterface $validator)
	{
		$jsonData = [];
		$errorsmessage = '';
		$form = $this->createForm(TaskType::class, $this->task);
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$file = $this->task->getFile();
			$fileName = md5(uniqid()).'.'.$file->guessExtension();
			$file->move($this->getParameter('file_dir'), $fileName);
			$jsonData = [$fileName, $this->task->getName()." ".$this->task->getSurname()];
			$success = true;
			
		}
		else {
			foreach ($validator->validate($this->task) as $violation) {
				$errorsmessage[] = $violation->getMessage();
            }
			$success = false;	
		
		}

		return JsonResponse::create(
			 ['success' => $success,
			 'jsondata' => $jsonData,
			 'error' =>  $errorsmessage
			 ], 200);
	}
	
}
