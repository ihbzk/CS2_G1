<?php

namespace App\Core;

use PDO;
use App\Models\User;
use App\Controller\Security;

abstract class Sql
{

    private $pdo;
    private $table;

    public function getPDO()
    {
        return $this->pdo;
    }

    public function __construct()
    {
        $env = __DIR__ . '/../.env';
        $envVar = parse_ini_file($env);

        $host = $envVar['DB_HOST'];
        $port = $envVar['DB_PORT'];
        $dbname = $envVar['DB_NAME'];
        $username = $envVar['DB_USERNAME'];
        $password = $envVar['DB_PASSWORD'];

        try {
            $dbVar = "pgsql:host=$host;port=$port;dbname=$dbname";
            $this->pdo = new PDO($dbVar, $username, $password);
        } catch (\Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
        $classExploded = explode("\\", get_called_class());
        $this->table = end($classExploded);
        $this->table = $this->table;
    }

    public function save(): void
    {
        $columns = get_object_vars($this);
        $columnsToDeleted = get_class_vars(get_class());
        $columns = array_diff_key($columns, $columnsToDeleted);
        unset($columns["id"]);

        if (is_numeric($this->getId()) && $this->getId() > 0) {
            $columnsUpdate = [];
            foreach ($columns as $key => $value) {
                $columnsUpdate[] = $key . "=:" . $key;
            }
            $queryPrepared = $this->pdo->prepare("UPDATE \"" . $this->table . "\" SET " . implode(",", $columnsUpdate) . " WHERE id=" . $this->getId());
        } else {
            $queryPrepared = $this->pdo->prepare("INSERT INTO \"" . $this->table . "\" (" . implode(",", array_keys($columns)) . ") 
                        VALUES (:" . implode(",:", array_keys($columns)) . ") RETURNING id"); // Utilisation de RETURNING pour récupérer l'ID
        }

        $queryPrepared->execute($columns);

        if (!is_numeric($this->getId()) || $this->getId() <= 0) {
            $this->setId($queryPrepared->fetchColumn()); // Récupération de l'ID inséré dans la propriété de l'objet
        }
    }

    public function checkIfExist(string $value, string $table, string $column): bool
    {
        $sql = "SELECT {$column} FROM {$table} WHERE {$column} = :value";

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->bindValue(':value', $value, PDO::PARAM_STR);

        $queryPrepared->execute();

        if ($queryPrepared->rowCount() > 0) {
            echo "La valeur est déjà présente dans la base de données";
            return true;
        } else {
            return false;
        }
    }

    public function emailExists($email)
    {
        $query = $this->pdo->prepare("SELECT COUNT(*) FROM \"User\" WHERE email = :email");
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();

        if ($query->fetchColumn() > 0) {
            return true;
        }
        return  false;
    }

    public function getPasswordAndRoleByEmail($email): array
    {
        $query = $this->pdo->prepare("SELECT pwd, id_role FROM \"User\" WHERE email = :email");
        $query->bindValue(':email', $email);
        $query->execute();

        $userData = $query->fetch(PDO::FETCH_ASSOC);

        //vérifier si password/email existent bien
        return $userData;
    }

    public function generateTokenByEmail(string $email, string $token): void
    {
        $sql = "UPDATE \"User\" SET token = :token WHERE email = :email";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':token', $token, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
    }

    public function getPseudoByEmail($email): array
    {
        $query = $this->pdo->prepare("SELECT id, pseudo FROM \"User\" WHERE email = :email");
        $query->bindValue(':email', $email);
        $query->execute();

        $userData = $query->fetch(PDO::FETCH_ASSOC);
        var_dump($userData);
        //vérifier si password/email existent bien
        return $userData;
    }

    public function getRoleByEmail($email)
    {
        $query = $this->pdo->prepare("SELECT id_role FROM \"User\" WHERE email = :email");
        $query->bindValue(':email', $email);
        $query->execute();

        $userData = $query->fetch(PDO::FETCH_ASSOC);
        // var_dump($userData);
        //vérifier si password/email existent bien
        return $userData;
    }

    public function getIsVerifiedByEmail($email): String
    {
        $query = $this->pdo->prepare("SELECT is_verified FROM \"User\" WHERE email = :email");
        $query->bindValue(':email', $email);
        $query->execute();

        $userData = $query->fetch(PDO::FETCH_ASSOC);
        //vérifier si password/email existent bien
        return $userData['is_verified'];
    }

    public function getAllUser()
    {
        $query = $this->pdo->prepare("SELECT * FROM \"User\"");
        $query->execute();

        $userData = $query->fetchAll(PDO::FETCH_ASSOC);

        return $userData;
    }

    public function getAllRole()
    {
        $query = $this->pdo->prepare("SELECT * FROM \"Role\"");
        $query->execute();

        $roleData = $query->fetchAll(PDO::FETCH_ASSOC);

        return $roleData;
    }

    public function deleteUsers($id)
    {
        // Supprime tous les commentaires reportés par l'utilisateur séléctionné
        $query = $this->pdo->prepare("DELETE FROM \"Comment\" WHERE id_reporter = :id_reporter");
        $query->bindValue(':id_reporter', $id, PDO::PARAM_INT);
        $query->execute();

        // Supprime tous les commentaires publiés par l'utilisateur séléctionné
        $query = $this->pdo->prepare("DELETE FROM \"Comment\" WHERE id_user = :id_user");
        $query->bindValue(':id_user', $id, PDO::PARAM_INT);
        $query->execute();

        // Supprime tous les commentaires des produits associés à l'utilisateur séléctionné
        $query = $this->pdo->prepare("DELETE FROM \"Comment\" WHERE id_product IN (SELECT id FROM \"Product\" WHERE id_seller = :id_seller)");
        $query->bindValue(':id_seller', $id, PDO::PARAM_INT);
        $query->execute();

        // Supprime tous les produits associés à l'utilisateur séléctionné
        $query = $this->pdo->prepare("DELETE FROM \"Product\" WHERE id_seller = :id_seller");
        $query->bindValue(':id_seller', $id, PDO::PARAM_INT);
        $query->execute();

        // Supprime l'utilisateur séléctionné
        $query = $this->pdo->prepare("DELETE FROM \"User\" WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        header("Location: users");
        exit;
    }

    public function getAllComment()
    {
        $query = $this->pdo->prepare("SELECT * FROM \"Comment\"");
        $query->execute();

        $commentData = $query->fetchAll(PDO::FETCH_ASSOC);

        return $commentData;
    }

    public function getUserByEmail($email)
    {
        $query = $this->pdo->prepare("SELECT * FROM \"User\" WHERE email = :email");
        $query->bindValue(':email', $email);
        $query->execute();

        $userData = $query->fetch(PDO::FETCH_ASSOC);

        return $userData;
    }

    public function getUserById($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM \"User\" WHERE id = :id");
        $query->bindValue(':id', $id);
        $query->execute();

        $userData = $query->fetch(PDO::FETCH_ASSOC);

        return $userData;
    }

    public function updateUserData($userData, $column)
    {
        $query = $this->pdo->prepare("UPDATE \"User\" SET {$column} = :value WHERE id = :id");
        $query->bindValue(':value', $userData[$column], PDO::PARAM_STR);
        $query->bindValue(':id', $userData['id'], PDO::PARAM_INT);
        $query->execute();
    }

    public function updateUserFirstname($userData)
    {
        $this->updateUserData($userData, 'firstname');
    }

    public function updateUserLastname($userData)
    {
        $this->updateUserData($userData, 'lastname');
    }

    public function updateUserPseudo($userData)
    {
        $this->updateUserData($userData, 'pseudo');
    }

    public function updateUserPhone($userData)
    {
        $this->updateUserData($userData, 'phone');
    }

    public function updateUserAddress($userData)
    {
        $this->updateUserData($userData, 'address');
    }

    public function updateUserThumbnail($userData)
    {
        $this->updateUserData($userData, 'thumbnail');
    }

    public function deleteUser($id)
    {
        // Supprime tous les commentaires reportés par l'utilisateur séléctionné
        $query = $this->pdo->prepare("DELETE FROM \"Comment\" WHERE id_reporter = :id_reporter");
        $query->bindValue(':id_reporter', $id, PDO::PARAM_INT);
        $query->execute();

        // Supprime tous les commentaires publiés par l'utilisateur séléctionné
        $query = $this->pdo->prepare("DELETE FROM \"Comment\" WHERE id_user = :id_user");
        $query->bindValue(':id_user', $id, PDO::PARAM_INT);
        $query->execute();

        // Supprime tous les commentaires des produits associés à l'utilisateur séléctionné
        $query = $this->pdo->prepare("DELETE FROM \"Comment\" WHERE id_product IN (SELECT id FROM \"Product\" WHERE id_seller = :id_seller)");
        $query->bindValue(':id_seller', $id, PDO::PARAM_INT);
        $query->execute();

        // Supprime tous les produits associés à l'utilisateur séléctionné
        $query = $this->pdo->prepare("DELETE FROM \"Product\" WHERE id_seller = :id_seller");
        $query->bindValue(':id_seller', $id, PDO::PARAM_INT);
        $query->execute();

        // Supprime l'utilisateur séléctionné
        $query = $this->pdo->prepare("DELETE FROM \"User\" WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        header("Location: /logout");
        exit;
    }

    public function getAllProduct()
    {
        $query = $this->pdo->prepare("SELECT * FROM \"Product\"");
        $query->execute();

        $productData = $query->fetchAll(PDO::FETCH_ASSOC);

        return $productData;
    }

    public function getAllCategory()
    {
        $query = $this->pdo->prepare("SELECT * FROM \"Category\"");
        $query->execute();

        $categoryData = $query->fetchAll(PDO::FETCH_ASSOC);

        return $categoryData;
    }

    public function getCategoryByName($name_category)
    {
        $query = $this->pdo->prepare("SELECT * FROM \"Category\" WHERE name = :name");
        $query->bindValue(':name', $name_category);
        $query->execute();

        $userData = $query->fetch(PDO::FETCH_ASSOC);

        return $userData['id'];
    }

    public function getIdByEmail($email)
    {
        $query = $this->pdo->prepare("SELECT id FROM \"User\" WHERE email = :email");
        $query->bindValue(':email', $email);
        $query->execute();

        $userData = $query->fetch(PDO::FETCH_ASSOC);

        return $userData;
    }

    public function getAllProductByUser($id_seller)
    {
        $query = $this->pdo->prepare("SELECT * FROM \"Product\" WHERE id_seller = :id_seller");
        $query->bindValue(':id_seller', $id_seller);
        $query->execute();

        $productData = $query->fetchAll(PDO::FETCH_ASSOC);
        return $productData;
    }

    public function getAllFromUser($email)
    {
        $query = $this->pdo->prepare("SELECT * FROM \"User\" WHERE email = :email");
        $query->bindValue(':email', $email);
        $query->execute();

        $userData = $query->fetch(PDO::FETCH_ASSOC);

        return $userData;
    }

    public function getProductById($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM \"Product\" WHERE id = :id");
        $query->bindValue(':id', $id);
        $query->execute();

        $productData = $query->fetch(PDO::FETCH_ASSOC);

        return $productData;
    }

    public function getProductsByIds($ids)
    {
        $query = $this->pdo->prepare("SELECT * FROM \"Product\" WHERE id IN (" . implode(",", $ids) . ")");
        $query->execute();

        $productData = $query->fetchAll(PDO::FETCH_ASSOC);

        return $productData;
    }

    public function getCommentsByProductId($id_product)
    {
        $query = $this->pdo->prepare("SELECT * FROM \"Comment\" WHERE id_product = :id_product");
        $query->bindValue(':id_product', $id_product);
        $query->execute();

        $commentData = $query->fetchAll(PDO::FETCH_ASSOC);

        return $commentData;
    }

    public function deleteProduct($id)
    {
        // Supprime tous les commentaires associés au produit sélectionné
        $query = $this->pdo->prepare("DELETE FROM \"Comment\" WHERE id_product = :id_product");
        $query->bindValue(':id_product', $id, PDO::PARAM_INT);
        $query->execute();

        // Supprime le produit sélectionné
        $query = $this->pdo->prepare("DELETE FROM \"Product\" WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        header("Location: /products/all");
        exit;
    }

    public function deleteProducts($id)
    {
        // Supprime tous les commentaires associés au produit sélectionné
        $query = $this->pdo->prepare("DELETE FROM \"Comment\" WHERE id_product = :id_product");
        $query->bindValue(':id_product', $id, PDO::PARAM_INT);
        $query->execute();

        // Supprime le produit sélectionné
        $query = $this->pdo->prepare("DELETE FROM \"Product\" WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        header("Location: products");
        exit;
    }

    public function updateProductData($productData, $column)
    {
        $query = $this->pdo->prepare("UPDATE \"Product\" SET {$column} = :value WHERE id = :id");
        $query->bindValue(':value', $productData[$column], PDO::PARAM_STR);
        $query->bindValue(':id', $productData['id'], PDO::PARAM_INT);
        $query->execute();
    }

    public function updateProductName($id, $POST)
    {
        $query = $this->pdo->prepare("UPDATE \"Product\" SET (name, price, description, stock, max_quantity, id_category, thumbnail)  = (:name, :price, :description, :stock, :max_quantity, :id_category, :thumbnail) WHERE id = :id");
        $oldCategoryId = "";
        $oldStock = "";
        // Si on ne change pas la catégorie, on lui attribue son ancienne valeur
        if (!isset($POST['category']) || empty($POST['category'])) {
            $oldCategoryId = $this->getProductById($_SESSION['productId'])['id_category'];
            $query->bindValue(':id_category', $oldCategoryId, PDO::PARAM_INT);
        } else {
            $query->bindValue(':id_category', $this->getCategoryByName($POST['category']), PDO::PARAM_INT);
        }
        if (!isset($POST['stock'])) {
            $oldStock = $this->getProductById($_SESSION['productId'])['stock'];
            $query->bindValue(':stock', $oldStock, PDO::PARAM_STR);
        } else {
            $query->bindValue(':stock', $POST['stock'], PDO::PARAM_STR);
        }
        $query->bindValue(':name', $POST['name'], PDO::PARAM_STR);
        $query->bindValue(':price', $POST['price'], PDO::PARAM_STR);
        $query->bindValue(':description', $POST['description'], PDO::PARAM_STR);
        $query->bindValue(':thumbnail', $POST['thumbnail'], PDO::PARAM_STR);
        $query->bindValue(':max_quantity', $POST['max_quantity'], PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }

    public function getAllCommentReported()
    {
        $query = $this->pdo->prepare("SELECT * FROM \"Comment\" WHERE is_reported = 't'");
        $query->execute();

        $commentReportedData = $query->fetchAll(PDO::FETCH_ASSOC);

        return $commentReportedData;
    }

    public function deleteComments($id)
    {
        $query = $this->pdo->prepare("DELETE FROM \"Comment\" WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        header("Location: comments");
        exit;
    }

    public function updateCommentReportedStatus($commentId, $status)
    {
        $query = $this->pdo->prepare("UPDATE \"Comment\" SET is_reported = :status WHERE id = :id");
        $query->bindValue(':status', $status, PDO::PARAM_BOOL);
        $query->bindValue(':id', $commentId, PDO::PARAM_INT);
        $query->execute();
    }

    public function updateCommentReporterId($commentId, $reporterId)
    {
        $query = $this->pdo->prepare("UPDATE \"Comment\" SET id_reporter = :reporterId WHERE id = :id");
        $query->bindValue(':reporterId', $reporterId, PDO::PARAM_INT);
        $query->bindValue(':id', $commentId, PDO::PARAM_INT);
        $query->execute();
    }

    public function checkExistingProduct($productName)
    {
        //On regarde lors de l'update s'il n'y a pas un produit qui possède le même nom chez le beatmaker courant
        $query = $this->pdo->prepare("SELECT * FROM \"Product\" WHERE name = :name AND id != :productId AND id_seller = :id_seller");
        $query->bindValue(':name', $productName);
        $query->bindValue(':productId', $_SESSION['productId']);
        $query->bindValue(':id_seller', $_SESSION['id']);
        $query->execute();

        $userData = $query->fetch(PDO::FETCH_ASSOC);
        return $userData;
    }

    public function updateIsVerified($id): void
    {
        $query = $this->pdo->prepare("UPDATE \"User\" SET is_verified = :is_verified WHERE id = :id");
        $query->bindValue(':is_verified', true, PDO::PARAM_BOOL);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }

    public function setUserTokenByEmail(string $email, string $token): void
    {
        $query = $this->pdo->prepare("UPDATE \"User\" SET token = :token WHERE email = :email");
        $query->bindValue(':token', $token, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
    }

    public function getAllElements()
    {
        $query = $this->pdo->prepare("SELECT * FROM \"Element\"");
        $query->execute();

        $elementData = $query->fetchAll(PDO::FETCH_ASSOC);

        return $elementData;
    }

    public function getAllPage()
    {
        $query = $this->pdo->prepare("SELECT * FROM \"Page\"");
        $query->execute();

        $pageData = $query->fetchAll(PDO::FETCH_ASSOC);

        return $pageData;
    }

    public function deletePages($id)
    {
        // Supprime tous les éléments associés à la page sélectionné
        $query = $this->pdo->prepare("DELETE FROM \"PageElement\" WHERE id_page = :id_page");
        $query->bindValue(':id_page', $id, PDO::PARAM_INT);
        $query->execute();

        // Supprime la page sélectionné
        $query = $this->pdo->prepare("DELETE FROM \"Page\" WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        header("Location: pages");
        exit;
    }

    public function getPageById($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM \"Page\" WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $pageData = $query->fetch(PDO::FETCH_ASSOC);

        return $pageData;
    }

    public function updatePageData($pageData, $column)
    {
        $query = $this->pdo->prepare("UPDATE \"Page\" SET {$column} = :value WHERE id = :id");
        $query->bindValue(':value', $pageData[$column], PDO::PARAM_STR);
        $query->bindValue(':id', $pageData['id'], PDO::PARAM_INT);
        $query->execute();
    }

    public function updatePageName($id, $POST)
    {
        $query = $this->pdo->prepare("UPDATE \"Page\" SET (cover_image, cover_title, slug, meta_title, meta_description, meta_keywords)  = (:cover_image, :cover_title, :slug, :meta_title, :meta_description, :meta_keywords) WHERE id = :id");
        $query->bindValue(':cover_image', $POST['cover_image'], PDO::PARAM_STR);
        $query->bindValue(':cover_title', $POST['cover_title'], PDO::PARAM_STR);
        $query->bindValue(':slug', $POST['slug'], PDO::PARAM_STR);
        $query->bindValue(':meta_title', $POST['meta_title'], PDO::PARAM_STR);
        $query->bindValue(':meta_description', $POST['meta_description'], PDO::PARAM_STR);
        $query->bindValue(':meta_keywords', $POST['meta_keywords'], PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }

    public function checkExistingPage($pageName)
    {
        //On regarde lors de l'update s'il n'y a pas une page qui possède le même nom
        $query = $this->pdo->prepare("SELECT * FROM \"Page\" WHERE slug = :slug AND id != :pageId");
        $query->bindValue(':slug', $pageName);
        $query->bindValue(':pageId', $_SESSION['pageId']);
        $query->execute();

        $userData = $query->fetch(PDO::FETCH_ASSOC);
        return $userData;
    }

    public function getAllElementsPage($id)
    {
        $query = $this->pdo->prepare("SELECT pageElement.*, element.name FROM \"PageElement\" AS pageElement JOIN \"Element\" AS element ON pageElement.id_element = element.id WHERE pageElement.id_page = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $pageData = $query->fetchAll(PDO::FETCH_ASSOC);

        return $pageData;
    }

    public function getElementByName($name)
    {
        $query = $this->pdo->prepare("SELECT * FROM \"Element\" WHERE name = :name");
        $query->bindValue(':name', $name);
        $query->execute();

        $elementData = $query->fetch(PDO::FETCH_ASSOC);

        return $elementData;
    }

    public function getPageBySlug($slug)
    {
        $query = $this->pdo->prepare("SELECT * FROM \"Page\" WHERE slug = :slug");
        $query->bindValue(':slug', $slug, PDO::PARAM_INT);
        $query->execute();

        $pageData = $query->fetch(PDO::FETCH_ASSOC);

        return $pageData;
    }

    public function getProductsBySellerId($id_seller)
    {
        $query = $this->pdo->prepare("SELECT * FROM \"Product\" WHERE id_seller = :id_seller");
        $query->bindValue(':id_seller', $id_seller);
        $query->execute();

        $productData = $query->fetchAll(PDO::FETCH_ASSOC);

        return $productData;
    }

    public function searchProductsInDatabase($result)
    {
        $query = $this->pdo->prepare("SELECT * FROM \"Product\" WHERE name ILIKE :result");
        $query->bindValue(':result', '%' . $result . '%', PDO::PARAM_STR);
        $query->execute();
    
        $productData = $query->fetchAll(PDO::FETCH_ASSOC);
    
        return $productData;
    }

    public function getPageHistoryByPageId($id_page)
    {
        $query = $this->pdo->prepare("SELECT * FROM \"PageHistory\" WHERE id_page = :id_page");
        $query->bindValue(':id_page', $id_page);
        $query->execute();

        $pageHistoryData = $query->fetchAll(PDO::FETCH_ASSOC);

        return $pageHistoryData;
    }

    public function getPageVersionById($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM \"PageHistory\" WHERE id = :id");
        $query->bindValue(':id', $id);
        $query->execute();

        $versionPageData = $query->fetch(PDO::FETCH_ASSOC);

        return $versionPageData;
    }
}
