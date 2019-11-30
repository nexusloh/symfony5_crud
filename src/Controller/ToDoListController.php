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
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function switchStatus($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $task = $entityManager->getRepository(Task::class)->find($id);

        $task->setStatus( ! $task->getStatus() );
        $entityManager->flush();

        return $this->redirectToRoute('to_do_list');
    }

    /**
     * @Route("/delete/{id}", name="delete_task")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete($id)
    {
        $tasks = $this->getDoctrine()->getRepository(Task::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($tasks);
        $entityManager->flush();

        return $this->redirectToRoute('to_do_list');
    }
}
