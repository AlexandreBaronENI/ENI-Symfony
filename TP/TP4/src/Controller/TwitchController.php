<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController ;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Twitcher;

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
     */
    public function add()
    {
        return $this->render("twitchers/add.html.twig");
    }
}