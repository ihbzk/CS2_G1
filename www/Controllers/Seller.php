<?php

namespace App\Controllers;

use App\Core\Sql;
use App\Core\View;
use App\Models\Comment;
use App\Models\Product;
use App\Core\Verificator;

use App\Forms\AddComment;
use App\Forms\AddProduct;
use App\Forms\EditProduct;

class Seller extends Sql
{

    /*
    Products(): Fonction qui permet d'afficher tous les produits d'un seller (à renommer et à déplacer)
    */
    public function showAllProductSeller()
    {
        if (isset($_SESSION['email'])) {
            $view = new View("Seller/products-seller", "front");

            $email = $_SESSION['email'];
            $userData = $this->getUserByEmail($email);
            $idUser = $this->getIdByEmail($email);
            $userDataAll = $this->getAllFromUser($email);
            $productData = $this->getAllProduct();
            $userData = $this->getAllUser();
            $categoryData = $this->getAllCategory();

            if (isset($_POST['deleteProduct'])) {
                $deleteProduct = $this->deleteProduct($_POST['id']);
            } else {
                $deleteProduct = null;
            }

            $view->assign('productData', $productData);
            $view->assign('userDataAll', $userDataAll);
            $view->assign('userData', $userData);
            $view->assign('idUser', $idUser);
            $view->assign('categoryData', $categoryData);
            $view->assign('deleteProduct', $deleteProduct);
        } else {
            echo "Non connecté.";
        }
    }

    public function showProductSellerPage(): void
    {
        $form = new EditProduct();

        $view = new View("Seller/product-page-seller", "front");
        $view->assign('form', $form->getConfig());
        // Récupérer l'ID du produit depuis l'URL
        $id = $_SERVER['QUERY_STRING'];
        if (preg_match('/\bid=(\d+)/', $id, $matches)) {
            $id = $matches[1];
            $_SESSION['productId'] = $id;
        } else {
            echo "Aucun ID trouvé dans l'URL.";
        }

        // Vérifier si l'ID existe dans la base de données
        // $productModel = new Product();
        $productModel = Product::getInstance();
        $productData = $productModel->getProductById($_SESSION['productId']);
        //var_dump($productData) ;
        $categoryData = $this->getAllCategory();

        if (empty($productData)) {
            http_response_code(404);
            //header('Location: ../Views/error404.php');
            exit;
        }

        $view->assign('productData', $productData);
        $view->assign('categoryData', $categoryData);
    }

    public function updateProductField($fieldName)
    {
        if (isset($_POST[$fieldName])) {
            $newFieldValue = $_POST[$fieldName];
            $id = $_SERVER['QUERY_STRING'];
            if (preg_match('/\bid=(\d+)/', $id, $matches)) {
                $id = $matches[1];
            } else {
                echo "Aucun ID trouvé dans l'URL.";
            }
            $currentProduct = $this->getProductById($id);
            $currentProduct[$fieldName] = $newFieldValue;
            $updateMethod = 'updateProduct' . ucfirst($fieldName);
            $this->$updateMethod($currentProduct);
            header("Location: /products/all");
            exit;
        }
    }

    public function updateProductNameAction()
    {
        if (isset($_POST) && isset($_SESSION['productId'])) {
            $productId = $_SESSION['productId'];
            $checkUpdate = new Verificator();
            $errors = $checkUpdate->checkUpdateProduct($_POST);
            if (is_array($errors)) {
                if (!empty($errors)) {
                    $_SESSION['update_errors'] = $errors;
                    header("Location: /products/all/edit?id=" . $_SESSION['productId']);
                    return $errors;
                }
            }
            $this->updateProductName($productId, $_POST);
            header("Location: /products/all");
            exit;
        }
    }

    /*
    AddProduct(): Fonction qui permet d'ajouter un produit (à renommer et à déplacer)
    */
    public function addProduct()
    {
        if (isset($_SESSION['email'])) {
            // Vérifier le rôle de l'utilisateur
            $email = $_SESSION['email'];
            $userData = $this->getUserByEmail($email);
            $role = $userData['id_role'];

            if ($role == 3) {
                $form = new AddProduct();
                $view = new View("Seller/add-product", "front");
                $view->assign('form', $form->getConfig());

                if ($form->isSubmit()) {
                    $errors = Verificator::form($form->getConfig(), $_POST);
                    if (empty($errors)) {
                        echo "Insertion en BDD";
                    } else {
                        $view->assign('errors', $errors);
                    }
                }

                //Si le formulaire a été rempli et soumis, alors on ajoute un produit
                if (isset($_POST['submit'])) {
                    // $product = new Product();
                    $product = Product::getInstance();
                    $product->setIdSeller($userData['id']);
                    $product->setIdCategory($this->getCategoryByName($_POST['id_category']));
                    $product->setName($_POST['name']);
                    $product->setDescription($_POST['description']);
                    $product->setPrice($_POST['price']);
                    $product->setStock($_POST['stock']);
                    $product->setMaxQuantity($_POST['max_quantity']);
                    $product->setSlug($_POST['slug']);
                    $product->setMetaTitle($_POST['meta_title']);
                    $product->setMetaDescription($_POST['meta_description']);
                    $product->setMetaKeywords($_POST['meta_keywords']);

                    if (isset($_FILES['thumbnail'])) {
                        $fileTmpPath = $_FILES['thumbnail']['tmp_name'];
                        $fileName = $_FILES['thumbnail']['name'];
                        $fileSize = $_FILES['thumbnail']['size'];
                        $fileType = $_FILES['thumbnail']['type'];
                        $fileNameCmps = explode(".", $fileName);
                        $fileExtension = strtolower(end($fileNameCmps));

                        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
                        if (in_array($fileExtension, $allowedfileExtensions)) {
                            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                            $uploadFileDir = 'public/img/product/';
                            $dest_path = $uploadFileDir . $newFileName;

                            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                                $product->setThumbnail($dest_path);
                            } else {
                                echo 'Il y a eu une erreur lors du téléchargement de l\'image.';
                            }
                        } else {
                            echo 'Seuls les extensions .jpg, .gif, .png, .jpeg sont autorisés.';
                        }
                    }
                    $product->save();

                    header('Location: /products/all');
                    exit;
                }
            } else {
                echo "Non connecté en tant que vendeur.";
            }
        }
    }
}
