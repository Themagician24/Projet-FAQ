<?php

namespace App\Controller;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    public function __construct(
        private QuestionRepository $questionRepository
    ) {
    }

    /**
     * Accueil - Affichage de toutes les questions utilisateurs
     */
    #[Route('/', name: 'app_question')]
    public function index(): Response
    {
        // Sélectionne toutes les questions ordré par date (plus récent au plus vieux)
        $questions = $this->questionRepository->findBy([], ['dateCreation' => 'DESC']);

        return $this->render('question/index.html.twig', [
            'questions' => $questions
        ]);
    }

    /**
     * Affiche la question ainsi que toutes ses réponses
     */
    #[Route('/question/{id}', name: 'app_question_reponses', requirements: ['id' => '\d+'])]
    public function responses(Question $question): Response
    {
        return $this->render('question/reponses.html.twig', [
            'question' => $question
        ]);
    }
}
