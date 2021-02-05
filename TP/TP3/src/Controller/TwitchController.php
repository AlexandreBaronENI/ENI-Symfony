<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController ;
use Symfony\Component\Routing\Annotation\Route;

class TwitchController extends AbstractController
{
    /**
     * @Route("/twitchers", name="listTwitchers")
     */
    public function list()
    {
        return $this->render("twitchers/list.html.twig", ['twitchers' => $this->getTwitchers()]);
    }


    /**
     * @Route("/twitcher/{id}", name="detailTwitcher", requirements={"id"="\d+"})
     */
    public function detail($id)
    {
        $twitcher = null;
        foreach($this->getTwitchers() as $twitcherTemp) {
            if ($twitcherTemp->id == $id) {
                $twitcher = $twitcherTemp;
                break;
            }
        }

        if($twitcher == null){
            throw $this->createNotFoundException('The streamer does not exist');
        }

        return $this->render("twitchers/detail.html.twig", ['twitcher' =>  $twitcher]);
    }

    /**
     * Private methods
     */
    private function getTwitchers(){
        $twitchers = array();
        array_push($twitchers, new Twitcher(1, "Antoine Daniel Live", 15000, array("https://twitter.com/antoinedaniel", "https://youtube.com/whatthecut")));
        array_push($twitchers, new Twitcher(2, "Ponce", 10000, array("https://twitter.com/ponce", "https://youtube.com/ponce")));
        array_push($twitchers, new Twitcher(3, "Etoiles", 8000, array("https://twitter.com/etoiles", "https://youtube.com/etoiles")));

        return $twitchers;
    }
}
class Twitcher {
    public $name;
    public $followers;
    public $links;
    public $id;

    function __construct($id, $name, $followers, $links) {
        $this->followers = $followers;
        $this->links = $links;
        $this->name = $name;
        $this->id = $id;
    }
}