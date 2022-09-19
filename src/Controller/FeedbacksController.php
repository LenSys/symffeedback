<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Form\FeedbackFormType;
use App\Repository\FeedbackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FeedbacksController extends AbstractController
{
    #[Route('/', name: 'app_feedbacks.home')]
    public function home(Request $request, EntityManagerInterface $entityManager): Response
    {
        $feedback = new Feedback();
        $feedbackForm = $this->createForm(FeedbackFormType::class, $feedback);

        $feedbackForm->handleRequest($request);
        if ($feedbackForm->isSubmitted() && $feedbackForm->isValid()) {
            // $form->getData() holds the submitted values
            $feedback = $feedbackForm->getData();

            // save the feedback to the database
            $entityManager->persist($feedback);
            $entityManager->flush();

            return $this->redirectToRoute('app_feedbacks.feedback');
        }

        return $this->render('feedbacks/home.html.twig', [
            'feedback_form' => $feedbackForm->createView()
        ]);
    }


    #[Route('/feedback', name: 'app_feedbacks.feedback')]
    public function feedback(FeedbackRepository $feedbackRepository): Response
    {
        $feedbacks = $feedbackRepository->findAll();
        return $this->render('feedbacks/feedback.html.twig', [
            'feedbacks' => $feedbacks
        ]);
    }


    #[Route('/about', name: 'app_feedbacks.about')]
    public function about(): Response
    {
        return $this->render('feedbacks/about.html.twig', [
            
        ]);
    }
}
