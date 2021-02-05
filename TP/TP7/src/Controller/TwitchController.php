<?php
namespace App\Controller;

use App\Form\AddTwitcherType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController ;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Twitcher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class TwitchController extends AbstractController
{
    /**
     * @Route("/twitchers", name="listTwitchers")
     */
    public function list()
    {
        $twitchersRepo = $this->getDoctrine()->getRepository(Twitcher::class);
        $twitchers = $twitchersRepo->findBy([], ['dateInscription' => 'DESC']);

        return $this->render("twitchers/list.html.twig", ['twitchers' => $twitchers]);
    }

    /**
     * @Route("/twitcher/{id}", name="detailTwitcher", requirements={"id"="\d+"})
     */
    public function detail($id)
    {
        $twitchersRepo = $this->getDoctrine()->getRepository(Twitcher::class);
        $twitcher = $twitchersRepo->findOneBy([
            'id' => $id
        ]);

        return $this->render("twitchers/detail.html.twig", ['twitcher' =>  $twitcher]);
    }


    /**
     * @Route("/twitcher/ajouter", name="addTwitcher")
     *
     * @IsGranted("ROLE_USER")
     */
    public function add(EntityManagerInterface $em, Request $request)
    {
        $twitcher = new Twitcher();

        $twitcherForm = $this->createForm(AddTwitcherType::class, $twitcher);

        $twitcherForm->handleRequest($request);
        if($twitcherForm->isSubmitted() && $twitcherForm->isValid()){
            $em->persist($twitcher);
            $em->flush();

            $this->addFlash('success', 'Le streamer a bien été ajouté !');
            return $this->redirectToRoute('detailTwitcher', ['id' => $twitcher->getId()]);
        }

        return $this->render("twitchers/add.html.twig", [
            'twitcherForm' => $twitcherForm->createView()
        ]);
    }
}