<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Sql;
use App\Models\Comment;
use App\Models\Product;
use App\Core\Verificator;

use App\Forms\AddComment;
use App\Forms\AddProduct;

class ProductController extends Sql
{

    /*
    Products(): Fonction qui permet d'afficher tous les produits (à renommer et à déplacer)
    */
    public function products()
    {
        $view = new View("Products/products", "front");

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            $userData = $this->getUserByEmail($email);
            $idUser = $this->getIdByEmail($email);
            $userDataAll = $this->getAllFromUser($email);

            if (isset($_POST['id'])) {
                array_push($_SESSION['cart'], $_POST['id']);
                // Redirection pour ajouter l'ajout à l'infini
                header('Location: /products');
                exit;
            }

            $view->assign('userDataAll', $userDataAll);
            $view->assign('idUser', $idUser);
        } else {
            echo "Non connecté.";
        }
        $productData = $this->getAllProduct();
        $userData = $this->getAllUser();
        $categoryData = $this->getAllCategory();

        $view->assign('productData', $productData);
        // $view->assign('userDataAll', $userDataAll);
        $view->assign('userData', $userData);
        // $view->assign('idUser', $idUser);
        $view->assign('categoryData', $categoryData);
    }

    public function showProductPage(): void
    {
        $form = new AddComment();
        $view = new View("Products/show-product-page", "front");
        $view->assign('form', $form->getConfig());

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Récupérer l'ID du produit depuis l'URL
        $id = $_SERVER['QUERY_STRING'];
        if (preg_match('/\bid=(\d+)/', $id, $matches)) {
            $id = $matches[1];
        } else {
            echo "Aucun ID trouvé dans l'URL.";
        }

        if (isset($_POST['id'])) {
            array_push($_SESSION['cart'], $_POST['id']);
            header("Location: /products/page?id=$id");
            exit;
        }

        // Vérifier si l'ID existe dans la base de données
        // $productModel = new Product();
        $productModel = Product::getInstance();
        $productData = $productModel->getProductById($id);
        // $commentModel = new Comment();
        $commentModel = Comment::getInstance();
        $comments = $commentModel->getCommentsByProductId($id);

        if (empty($productData)) {
            http_response_code(404);
            header('Location: ../Views/error404.php');
            exit;
        }


        $view->assign('productData', $productData);
        $view->assign('comments', $comments);

        if ($form->isSubmit()) {
            // Traitement du formulaire pour ajouter un commentaire
            // $commentaire = new Comment();
            $commentaire = Comment::getInstance();
            $commentaire->setId(0);
            $commentaire->setIdProduct($id);
            $commentaire->setContent($_POST['comment']);
            $commentaire->setDate(date('Y-m-d'));
            $commentaire->setIdUser($this->getIdByEmail($_SESSION['email'])['id']);

            $commentaire->save();
            header("Location: /products/page?id=$id");
            exit;
        }
    }

    /*
    ProductCart(): Fonction qui permet d'afficher le panier de l'utilisateur connecté (à renommer et à déplacer)
    */
    public function productCart()
    {
        if (isset($_SESSION['cart'])) {
            $view = new View("Products/cart", "front");

            if (isset($_SESSION['cart'])) {
                $productIds = $_SESSION['cart'];

                if (!empty($productIds)) {
                    $productData = $this->getProductsByIds($productIds);

                    $view->assign('productData', $productData);
                }
            } else {
                $view->assign('productData', []);
            }
        }
    }

    public function removeFromCart()
    {
        if (isset($_POST['id'])) {
            $productId = $_POST['id'];
            $index = array_search($productId, $_SESSION['cart']);

            if ($index !== false) {
                unset($_SESSION['cart'][$index]);
            }

            header("Location: /cart");
            exit;
        }
    }

    public function searchProducts()
    {
        if (isset($_GET['result'])) {
            $result = $_GET['result'];
    
            // $productModel = new Product();
            $productModel = Product::getInstance();
            $productData = $productModel->searchProductsInDatabase($result);
    
            $view = new View("Products/search-results", "front");
            $view->assign('productData', $productData);
        }
    }     
}
