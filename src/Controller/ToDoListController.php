<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ToDoListController extends AbstractController
{
    /**
     * @Route("/", name="to_do_list")
     */
    public function index()
    {
        $tasks = $this->getDoctrine()->getRepository(Task::class)->findby([], ['id' => 'DESC']);
        return $this->render('index.html.twig', ['tasks' => $tasks]);
    }

    /**
     * @Route("/create", name="create_task", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function create(Request $request)
    {
        if (empty($title = trim($request->request->get('title'))))
            return $this->redirectToRoute('to_do_list');

        $request->request->get('title');

        $entityManager = $this->getDoctrine()->getManager();

        $task = new Task();
        $task->setTitle($title);

        $entityManager->persist($task);
        $entityManager->flush();

        return $this->redirectToRoute('to_do_list');
    }


    /**
     * @Route("/switch-status/{id}", name="switch_status")
     * @param $id
     */
    public function switchStatus($id)
    {
        exit('switch'.$id);
    }

    /**
     * @Route("/delete/{id}", name="delete_task")
     * @param $id
     */
    public function delete($id)
    {
        exit('delete'.$id);
    }
}
