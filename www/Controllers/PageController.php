<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Sql;
use App\Core\Verificator;
use App\Models\Page;
use App\Models\Element;
use App\Models\PageElement;
use App\Forms\AddPage;

class PageController extends Sql
{

    /*
    Pages(): Fonction qui permet d'afficher toutes les pages (à renommer et à déplacer)
    */
    public function pages()
    {
        $view = new View("Page/pages", "front");

        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            $userData = $this->getUserByEmail($email);
            $idUser = $this->getIdByEmail($email);
            $userDataAll = $this->getAllFromUser($email);

            $view->assign('userDataAll', $userDataAll);
            $view->assign('idUser', $idUser);
        } else {
            echo "Non connecté.";
        }
        $pageData = $this->getAllPage();
        $userData = $this->getAllUser();

        $view->assign('pageData', $pageData);
        $view->assign('userData', $userData);
    }

    public function showPage(): void
    {
        $view = new View("Page/show-page", "front");

        //Récupère l'id de la page depuis l'URL
        $id = $_SERVER['QUERY_STRING'];
        if (preg_match('/\bid=(\d+)/', $id, $matches)) {
            $id = $matches[1];
            $_SESSION['pageId'] = $id;
        } else {
            echo "Aucun ID trouvé dans l'URL.";
        }

        //Vérifie si l'id existe en bdd
        // $pageModel = new Page();
        $pageModel = Page::getInstance();
        $pageData = $pageModel->getPageById($_SESSION['pageId']);

        $userData = $this->getUserById($pageData['id_user']);

        if (empty($pageData)) {
            http_response_code(404);
            //header('Location: ../Views/error404.php');
            exit;
        }

        //Récupère les éléments de la page
        $pageElements = $this->getAllElementsPage($_SESSION['pageId']);

        //Compare les éléments avec les éléments en bdd
        $matchedElements = [];

        foreach ($pageElements as $element) {
            $elementName = $element['name'];
            $dbElement = $this->getElementByName($elementName);

            if ($dbElement) {
                //Les éléments qui correspondent sont ajoutés au tableau $matchedElements
                $matchedElements[] = $dbElement;
            }
        }

        //Récupère les éléments correspondant de la page
        $matchedElements = $this->getAllElementsPage($_SESSION['pageId']);

        $view->assign('pageData', $pageData);
        $view->assign('userData', $userData);
        $view->assign('matchedElements', $matchedElements);
    }
}
