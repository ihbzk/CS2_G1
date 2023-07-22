<?php

namespace App\Controllers;

use App\Core\Sql;
use App\Core\View;
use App\Models\Page;
use App\Forms\AddPage;
use App\Forms\EditPage;
use App\Models\Element;
use App\Core\Verificator;
use App\Models\PageElement;
use App\Models\PageHistory;

class Admin extends Sql
{

    /*
    Users(): Fonction qui permet d'afficher tous les utilisateurs (à renommer et à déplacer)
    */
    public function users()
    {
        $view = new View("Admin/users", "back");
        $userData = $this->getAllUser();
        $roleData = $this->getAllRole();

        if (isset($_POST['deleteUsers'])) {
            $deleteUsers = $this->deleteUsers($_POST['id']);
        } else {
            $deleteUsers = null;
        }

        $view->assign('userData', $userData);
        $view->assign('roleData', $roleData);
        $view->assign('deleteUsers', $deleteUsers);
    }

    /*
    dashboard(): Fonction qui permet d'afficher tous les utilisateurs, rôles et commentaires
    */
    public function dashboard()
    {
        $view = new View("Admin/dashboard", "back");
        $userData = $this->getAllUser();
        $roleData = $this->getAllRole();
        $commentData = $this->getAllComment();
        $productData = $this->getAllProduct();
        $pageData = $this->getAllPage();

        $view->assign('userData', $userData);
        $view->assign('roleData', $roleData);
        $view->assign('commentData', $commentData);
        $view->assign('productData', $productData);
        $view->assign('pageData', $pageData);
    }

    public function showUser()
    {
        $view = new View("Admin/show-user", "back");
        $id = $_SERVER['QUERY_STRING'];
        if (preg_match('/\bid=(\d+)/', $id, $matches)) {
            $id = $matches[1];
        } else {
            echo "Aucun ID trouvé dans l'URL.";
        }
        $userData = $this->getUserById($id);
        // foreach ($userData as $key => $value) {
        //     echo $value . '<br>';
        // }
        $view->assign('userData', $userData);
    }

    /*
    userProducts(): Fonction qui permet d'afficher tous les produits de l'utilisateur sélectionné
    */
    public function userProducts()
    {
        $view = new View("Admin/products", "back");

        if (isset($_GET['id'])) {
            $id_seller = $_GET['id'];
            $productData = $this->getProductsBySellerId($id_seller);
            $view->assign('productData', $productData);
        } else {
            var_dump("pas de produit");
        }
    }

    /*
    products(): Fonction qui permet d'afficher tous les produits
    */
    public function products()
    {
        if (isset($_POST['id_seller'])) {
            $this->userProducts();
            return;
        }

        $view = new View("Admin/products", "back");
        $productData = $this->getAllProduct();

        if (isset($_POST['deleteProducts'])) {
            $deleteProducts = $this->deleteProducts($_POST['id']);
        } else {
            $deleteProducts = null;
        }

        $view->assign('productData', $productData);
        $view->assign('deleteProducts', $deleteProducts);
    }


    /*
    comments(): Fonction qui permet d'afficher tous les commentaires
    */
    public function comments()
    {
        $view = new View("Admin/comments", "back");
        $userData = $this->getAllUser();
        $roleData = $this->getAllRole();
        $commentData = $this->getAllComment();
        $commentReportedData = $this->getAllCommentReported();

        if (isset($_POST['deleteComments'])) {
            $deleteComments = $this->deleteComments($_POST['id']);
        } else {
            $deleteComments = null;
        }

        $view->assign('userData', $userData);
        $view->assign('roleData', $roleData);
        $view->assign('commentData', $commentData);
        $view->assign('commentReportedData', $commentReportedData);
        $view->assign('deleteComments', $deleteComments);
    }

    /*
    unreportComment(): Fonction qui permet d'enlever le signalement d'un commentaire
    */
    public function unreportComment()
    {
        if (isset($_GET['id'])) {
            $commentId = $_GET['id'];

            $this->updateCommentReportedStatus($commentId, false);

            $userId = $this->getIdByEmail($_SESSION['email'])['id'];
            $this->updateCommentReporterId($commentId, $userId);
        }

        header("Location: /admin/comments");
        exit;
    }

    /*
    pages(): Fonction qui permet d'afficher toutes les pages
    */
    public function pages()
    {
        $view = new View("Admin/pages", "back");
        $pageData = $this->getAllPage();

        if (isset($_POST['deletePages'])) {
            $deletePages = $this->deletePages($_POST['id']);
        } else {
            $deletePages = null;
        }

        $view->assign('pageData', $pageData);
        $view->assign('deletePages', $deletePages);
    }

    public function showSinglePage(): void
    {
        $form = new EditPage();

        $view = new View("Admin/page-single", "back");
        $view->assign('form', $form->getConfig());

        //Récupère l'id de la page depuis l'URL
        $id = $_SERVER['QUERY_STRING'];
        if (preg_match('/\bid=(\d+)/', $id, $matches)) {
            $id = $matches[1];
            $_SESSION['pageId'] = $id;
        } else {
            echo "Aucun ID trouvé dans l'URL.";
        }

        //Vérifie si l'id existe en bdd
        $pageModel = new Page();
        $pageData = $pageModel->getPageById($_SESSION['pageId']);

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

        // Récupérer l'historique des versions de la page
        $pageHistoryModel = new PageHistory();
        $pageHistoryData = $pageHistoryModel->getPageHistoryByPageId($_SESSION['pageId']);

        $view->assign('pageData', $pageData);
        $view->assign('matchedElements', $matchedElements);
        $view->assign('pageHistoryData', $pageHistoryData);
    }

    /*
    AddPage(): Fonction qui permet d'afficher tous les utilisateurs (à renommer et à déplacer)
    */
    public function addPage()
    {
        if (isset($_SESSION['email'])) {
            // Vérifier le rôle de l'utilisateur
            $email = $_SESSION['email'];
            $userData = $this->getUserByEmail($email);
            $role = $userData['id_role'];

            if ($role == 1 || $role == 2 || $role == 3) {
                $form = new AddPage();
                $view = new View("Page/add-page", "back");
                $view->assign('form', $form->getConfig());

                if ($form->isSubmit()) {
                    $errors = Verificator::form($form->getConfig(), $_POST);
                    if (empty($errors)) {
                        echo "Insertion en BDD";
                    } else {
                        $view->assign('errors', $errors);
                    }
                }

                // Si le formulaire a été rempli et soumis, alors on ajoute une page
                if (isset($_POST['submit'])) {
                    // $page = new Page();
                    $page = Page::getInstance();
                    $page->setCoverTitle($_POST['cover_title']);
                    $page->setSlug($_POST['slug']);
                    $page->setMetaTitle($_POST['meta_title']);
                    $page->setMetaDescription($_POST['meta_description']);
                    $page->setMetaKeywords($_POST['meta_keywords']);
                    $page->setIdUser($this->getIdByEmail($_SESSION['email'])['id']);

                    if (isset($_FILES['cover_image'])) {
                        $fileTmpPath = $_FILES['cover_image']['tmp_name'];
                        $fileName = $_FILES['cover_image']['name'];
                        $fileSize = $_FILES['cover_image']['size'];
                        $fileType = $_FILES['cover_image']['type'];
                        $fileNameCmps = explode(".", $fileName);
                        $fileExtension = strtolower(end($fileNameCmps));

                        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
                        if (in_array($fileExtension, $allowedfileExtensions)) {
                            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                            $uploadFileDir = 'public/img/page/';
                            $dest_path = $uploadFileDir . $newFileName;

                            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                                $page->setCoverImage($dest_path);
                            } else {
                                echo 'Il y a eu une erreur lors du téléchargement de l\'image.';
                            }
                        } else {
                            echo 'Seuls les extensions .jpg, .gif, .png, .jpeg sont autorisés.';
                        }
                    }

                    // On insère la page en base de données
                    $page->save();

                    $idPage = $page->getId(); // Récupère l'ID inséré

                    
                    header('Location: /admin/pages/add/step-2?id=' . $idPage);
                    $this->savePageHistory($page->getData()); // Enregistre la page actuelle dans la table "PageHistory"
                    exit;
                }
            } else {
                // echo "Non connecté.";
            }
        }
    }

    public function addPageElement()
    {
        if (isset($_SESSION['email'])) {
            // Vérifier le rôle de l'utilisateur
            $email = $_SESSION['email'];
            $userData = $this->getUserByEmail($email);
            $role = $userData['id_role'];

            if ($role == 2) {
                $view = new View("Page/add-page-element", "back");

                $idPage = $_GET['id'];
                $elements = $this->getAllElements();
                $page = new Page();
                $pageData = $page->getPageById($idPage);

                $view->assign('elements', $elements);
                $view->assign('pageData', $pageData);

                //Si le formulaire a été rempli et soumis, alors on ajoute un produit
                if (isset($_POST['submit'])) {
                    foreach ($_POST['elements'] as $position => $elementId) {
                        $pageElement = new PageElement();
                        $pageElement->setIdPage($idPage);
                        $pageElement->setIdElement($elementId);
                        $pageElement->setContent($_POST['contents'][$elementId]);
                
                        $pageElement->save();
                    }
                
                    header('Location: /admin/pages');
                    exit;
                }
            } else {
                // echo "Non connecté.";
            }
        }
    }

    /** 
     * Better version of page builder but not working
     */
    // public function addPageElement()
    // {
    //     if (isset($_SESSION['email'])) {
    //         // Vérifier le rôle de l'utilisateur
    //         $email = $_SESSION['email'];
    //         $userData = $this->getUserByEmail($email);
    //         $role = $userData['id_role'];

    //         if ($role == 2) {
    //             $view = new View("Page/add-page-element", "back");

    //             $idPage = $_GET['id'];
    //             $elements = $this->getAllElements();
    //             // $page = new Page();
    //             $page = Page::getInstance();
    //             $pageData = $page->getPageById($idPage);

    //             $view->assign('elements', $elements);
    //             $view->assign('pageData', $pageData);

    //             if (isset($_POST['submit'])) {
    //                 // $pageElement = new PageElement();
    //                 $pageElement = PageElement::getInstance();
    //                 // Parcourir les éléments soumis
    //                 foreach ($_POST['elements'] as $position => $elementId) {
    //                     $pageElement->setIdPage($idPage);
    //                     $pageElement->setIdElement($elementId);
    //                     $pageElement->setContent($_POST['addElementContent'][$elementId]);
    //                     $pageElement->setLink($_POST['addElementLink'][$elementId] ?? '');
    //                     $pageElement->setAlt($_POST['addElementAlt'][$elementId] ?? '');
    //                     $pageElement->setPosition($_POST['addElementPosition'][$elementId] ?? 0);

    //                     $pageElement->save(); // Enregistrer l'élément en base de données
    //                 }

    //                 header('Location: /admin/pages');
    //                 exit;
    //             }
    //         } else {
    //             echo "Non connecté.";
    //         }
    //     }
    // }

    public function updatePageField($fieldName)
    {
        if (isset($_POST[$fieldName])) {
            $newFieldValue = $_POST[$fieldName];
            $id = $_SERVER['QUERY_STRING'];
            if (preg_match('/\bid=(\d+)/', $id, $matches)) {
                $id = $matches[1];
            } else {
                echo "Aucun ID trouvé dans l'URL.";
                return;
            }

            $currentPage = $this->getPageById($id);
            $currentPage[$fieldName] = $newFieldValue;

            $this->savePageHistory($currentPage); // Enregistre la page actuelle dans la table "PageHistory"

            $updateMethod = 'updatePage' . ucfirst($fieldName);
            $this->$updateMethod($currentPage);

            header("Location: /admin/pages");
            exit;
        }
    }

    public function updatePageNameAction()
    {
        if (isset($_POST) && isset($_SESSION['pageId'])) {
            $pageId = $_SESSION['pageId'];
            $checkUpdate = new Verificator();
            $errors = $checkUpdate->checkUpdatePage($_POST);
            if (is_array($errors)) {
                if (!empty($errors)) {
                    $_SESSION['update_errors'] = $errors;
                    header("Location: /admin/pages/edit?id=" . $_SESSION['pageId']);
                    return $errors;
                }
            }

            //Récupère la page actuelle
            $currentPage = $this->getPageById($pageId);

            //Enregistre la page actuelle dans la table PageHistory pour le memento
            $this->savePageHistory($currentPage);

            // Met à jour la page dans la table Page
            $this->updatePageName($pageId, $_POST);

            header("Location: /admin/pages/edit?id=" . $_SESSION['pageId']);
            exit;
        }
    }

    public function savePageHistory($pageData)
    {
        $pageHistory = new PageHistory();
        $pageHistory->setIdPage($pageData['id']);
        $pageHistory->setIdUser($pageData['id_user']);
        $pageHistory->setCoverImage($pageData['cover_image']);
        $pageHistory->setCoverTitle($pageData['cover_title']);
        $pageHistory->setSlug($pageData['slug']);
        $pageHistory->setMetaTitle($pageData['meta_title']);
        $pageHistory->setMetaDescription($pageData['meta_description']);
        $pageHistory->setMetaKeywords($pageData['meta_keywords']);
        $pageHistory->setCreatedAt(date('Y-m-d H:i:s'));

        $pageHistory->save();
    }

    public function restoreVersionAction()
    {
        if (isset($_POST['pageId']) && isset($_POST['versionId'])) {
            $pageId = $_POST['pageId'];
            $versionId = $_POST['versionId'];

            $pageModel = new Page();
            $pageHistoryModel = new PageHistory();

            // Récupérer la version sélectionnée depuis la table PageHistory
            $versionPageData = $pageHistoryModel->getPageVersionById($versionId);

            // Mettre à jour les valeurs de la page dans la table Page
            $pageModel->updatePageName($pageId, [
                'cover_image' => $versionPageData['cover_image'],
                'cover_title' => $versionPageData['cover_title'],
                'slug' => $versionPageData['slug'],
                'meta_title' => $versionPageData['meta_title'],
                'meta_description' => $versionPageData['meta_description'],
                'meta_keywords' => $versionPageData['meta_keywords']
            ]);

            header("Location: /admin/pages/edit?id=" . $pageId);
            exit;
        }
    }
}