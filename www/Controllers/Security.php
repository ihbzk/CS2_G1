<?php

namespace App\Controllers;

use App\Core\View;
use App\Forms\AddUser;
use App\Forms\LoginUser;
use App\Models\User;
use App\Core\Verificator;
use App\Core\Sql;
use App\Core\Path;
use PDO;
use App\Core\Mail;
use App\Forms\SendPassword;
use App\Forms\DefinePassword;
use App\Forms\VerifSeller;

class Security extends Sql
{
    /*
    Login(): Fonction qui permet de connecter un utilisateur au site
    */
    public function login(): void
    {
        $form = new LoginUser();
        $view = new View("Auth/login", "front");
        $view->assign('form', $form->getConfig());

        //Étape 1 : Remplir les inputs de connexion
        if ($form->isSubmit()) {
            $verificator = new Verificator();
            $errors = $verificator->verifLogin($form->getConfig(), $_POST);
            //echo $errors;
            if (empty($errors)) {
                //Étape 2 : Récupérer le contenu des inputs pour l'email et le password
                $email = $_POST['email'];
                $password = $_POST['pwd'];
                // if ($this->getIsVerifiedByEmail($email) != 1) {
                //     echo "Votre compte n'est pas vérifié.";
                //     exit;
                // }
                //Étape 3 : Vérifier que l'email existe bien en base de données
                // if (!$this->emailExists(strtolower(trim($email)))) {
                //     echo "L'email est incorrect.";
                //     exit;
                // }

                //Étape 5 : Comparer le hash du password en base de données et celui qui a été entré par l'utilisateur durant la connexion
                $dataUser = $this->getPasswordAndRoleByEmail($email);
                $hashedPassword = $dataUser['pwd'];
                if (!$hashedPassword || !password_verify($password, $hashedPassword)) {
                    echo "Le mot de passe est incorrect.";
                    exit;
                } else {
                    //Étape 7 : Connexion réussie, on génère un token qu'on stocke en base de données et on redirige vers la homepage
                    $role = $dataUser['id_role'];
                    $token = bin2hex(random_bytes(16));
                    $hash = password_hash($token, PASSWORD_DEFAULT);
                    $this->generateTokenByEmail($email, $hash);
                    $this->isLoggedIn($email);
                    $path = $role == 2 ? 'Location: /admin/dashboard' : ($role == 3 ? 'Location: /products/all' : 'Location: /products');
                    $_SESSION['role'] = $role;

                    header($path);
                    exit;
                }
            } else {
                $view->assign('errors', $errors);
            }
        }
    }

    /*
    Register(): Fonction qui permet d'ajouter un utilisateur à la base de données
    */
    public function register(): void
    {
        $form = new AddUser();
        $view = new View("Auth/register", "front");
        $view->assign('form', $form->getConfig());

        if ($form->isSubmit()) {
            $errors = Verificator::form($form->getConfig(), $_POST);
            if (empty($errors)) {
                //Si le formulaire a été rempli et soumis, alors on crée un utilisateur
                if (isset($_POST['submit'])) {
                    // $user = new User();
                    $user = User::getInstance();

                    //On vérifie l'unicité de l'email dans la BDD
                    if ($this->emailExists(strtolower(trim($_POST['email'])))) {
                        echo "Email déjà utilisé";
                        return; // Arrête l'exécution de la fonction si l'email est déjà utilisé
                    } else {
                        $user->setEmail($_POST['email']);
                    }

                    //S'il coche la case beatmaker on lui attribue le rôle, sinon on lui attribue le rôle user
                    if (isset($_POST['role']) && $_POST['role'] === "on") {
                        $_POST['role'] = 3;
                    } else {
                        $_POST['role'] = 1;
                    }

                    $user->setIdRole($_POST['role']);
                    $user->setFirstname($_POST['firstname']);
                    $user->setLastname($_POST['lastname']);
                    $user->setPseudo($_POST['pseudo']);
                    $user->setPhone($_POST['phone']);
                    $user->setBirthDate($_POST['birth_date']);
                    $user->setAddress($_POST['address']);
                    $user->setZipCode($_POST['zip_code']);
                    $user->setPassword($_POST['pwd']);
                    $user->setCountry($_POST['country']);

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
                            $uploadFileDir = 'public/img/user/';
                            $dest_path = $uploadFileDir . $newFileName;

                            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                                $user->setThumbnail($dest_path);
                            } else {
                                echo 'Il y a eu une erreur lors du téléchargement de l\'image.';
                            }
                        } else {
                            echo 'Seuls les extensions .jpg, .gif, .png, .jpeg sont autorisés.';
                        }
                    }


                    //On insère l'utilisateur en base de données
                    $user->save();
                    $userData = $this->getUserByEmail($_POST['email']);
                    $token = $this->generateToken($userData['id']);
                    $this->setUserTokenByEmail($_POST['email'], $token);
                    $this->sendEmailToRegistered($userData, $userData['id_role'], "verif"); //envoi du mail de confirm
                    header("Location: /login?verifMailSended");
                    exit;
                }
            } else {
                $view->assign('errors', $errors);
            }
        }
    }

    /*
    Logout(): Fonction qui permet de déconnecter un utilisateur en supprimant sa session
    */
    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        echo "déconnexion";
        header("Location: /login");
        exit;
    }

    /*
    IsLoggedIn(): Fonction qui s'éxécute à la connexion d'un utilisateur en lui créant une session
    */
    public function isLoggedIn(String $email): void
    {
        session_start();
        $data = $this->getPseudoByEmail($email);
        $_SESSION['id'] = $data['id'];
        $_SESSION['email'] = $email;
        $_SESSION['pseudo'] = $data['pseudo'];
        $_SESSION['cart'] = [];
        $_SESSION['role'] = $this->getPasswordAndRoleByEmail($email)['id_role'];
    }

    public function sendEmailToRegistered($user, $role, $action): bool
    {
        if ($action == "verif") {
            if ($role == 3) {
                $subject = 'Demande d\'ouverture d\'un compte professionnel';
                $token = $this->getUserById($user['id'])['token'];
                $code = substr($token, 0, 6);
                $token =  time() . "//" . $this->getUserById($user['id'])['token'] . "//" . $user['id_role'];
                $message = "Bonjour " . $user['firstname'] . ",<br><br>Merci d'avoir souscrit &agrave; nos services Hip Shop. <br><br>Voici un code de vérification permettant de vérifier votre compte sur le lien si dessous : <b>" . $code . "</b><br><br>Voici un lien qui vous permettra de v&eacute;rifier votre compte de beatmaker : <br><a href='http://localhost/verifUser?=" . $token . "'> lien</a>.<br><br>En vous remerciant,<br><br>L'équipe Hip Shop";
                $mail = new Mail($user['email'], $subject, $message);
                $email = $mail->sendEmail();
            } elseif ($role == 1) {
                $subject = 'Confirmation d\'inscription';
                $token = time() . "//" . $this->getUserById($user['id'])['token'] . "//" . $user['id_role'];
                $message = "
                    <a href='http://localhost/'>
                        <img src='https://image.noelshack.com/fichiers/2023/28/2/1689029663-logo-1.png' alt='Logo Hip-Shop' style='width: 150px'>
                    </a>
                    <br>
                    <p>Bonjour " . $user['firstname'] . ",</p>
                    <p>Merci pour votre inscription au compte client particulier.</p> 
                    <p>Pour compléter votre inscription, veuillez cliquer sur le bouton ci-dessous.</p>
                    <a href='http://localhost/verifUser?=" . $token . "'>
                        Confirmer inscription
                    </a>
                    <br>
                    <p>En cas d'inscription erronée ou si vous souhaitez retirer votre inscription, vous pouvez simplement ignorer cette lettre.</p>
                    <p>Si vous avez des questions ou si vous souhaitez obtenir de plus amples informations, n'hésitez pas à nous contacter.</p>
                    <p>En vous remerciant,</p>
                    <p>L'équipe HipShop.</p>
                ";
                $mail = new Mail($user['email'], $subject, $message);
                $email = $mail->sendEmail();
            }
        } elseif ($action == "forgotPassword") {
            $subject = 'Nouveau mot de passe';
            $token = $this->getUserById($user['id'])['token'];
            $message = "Bonjour " . $user['firstname'] . ",<br><br>Voici un lien qui vous permettra de regénérer un mot de passe pour vos services Hip Shop. <br><br>Veillez à bien noter en lieu sûr le nouveau mot de passe que vous définirez. <br><br>Cliquez sur ce : <br><a href='http://localhost/defineNewPassword?=" . $token . "'>lien</a>.<br><br>En vous remerciant,<br><br>L'équipe Hip Shop";
            $mail = new Mail($user['email'], $subject, $message);
            $email = $mail->sendEmail();
        }

        return $email;
    }

    public function generateToken($userId)
    {
        $encryptionKey = "test";
        // Chiffrement de l'ID
        $encryptedId = $this->encryptId($userId, $encryptionKey);
        return $encryptedId;
    }

    function encryptId($id, $key)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($id, 'aes-256-cbc', $key, 0, $iv);
        $encoded = base64_encode($encrypted . '::' . $iv);
        return $encoded;
    }

    function decryptId($encryptedId, $key)
    {
        $decoded = base64_decode($encryptedId);
        list($encryptedData, $iv) = explode('::', $decoded, 2);
        $decrypted = openssl_decrypt($encryptedData, 'aes-256-cbc', $key, 0, $iv);
        return $decrypted;
    }

    public function userVerification()
    {
        $token = $_SERVER['QUERY_STRING'];
        if (count(explode("//", $token)) == 3) {
            $role = substr($token, -1); // le role
            $uriExploded = explode("//", $token); // on récupere le moment du register, le token envoyé dans l'url, le role
            $lengthUri = count($uriExploded);
            $timeRegistered = ltrim($uriExploded[$lengthUri - 3], "="); // la date de register
            $diffInMinute = (time() - intval($timeRegistered)); //différence en minutes entre le register et l'accès à la page vérif
            $diffInMinute /= 60;
            $_SESSION['verif'] = $diffInMinute;
            $actualTime = time();
            $actualTime = strval($actualTime);
            $encryptionKey = "test";
            $userid = $this->decryptId($uriExploded[1], $encryptionKey);
            $user = $this->getUserById($userid);

            if ($role == 1) {
                if ($_SESSION['verif'] < 60) { //si la différence est de moins d'une heure
                    $view = new View("Users/confirm-user", "front");
                    $this->updateIsVerified($userid);
                    header('location:/login?accountVerified');
                } else {
?>
                    <div>
                        <p>
                            Votre lien a expiré : cliquer ici pour en regénérer un nouveau :
                        </p>
                        <form>
                            <input type="hidden" name="url" value="<?= $uriExploded[1] ?>">
                            <button type='submit' value="Envoyer">Envoyer</input>
                        </form>
                    </div>
                <?php
                }
            } elseif ($role == 3) {
                echo "3";
                if ($_SESSION['verif'] < 60) {
                    $form = new VerifSeller();
                    $view = new View("Seller/confirm-seller", "front");
                    $view->assign('form', $form->getConfig());
                    if ($form->isSubmit()) {
                        $userid = $this->decryptId($uriExploded[1], $encryptionKey);
                        $code = $_POST['code'];
                        if (Verificator::verifToken($code, $this->getUserById($userid)['token'])) {
                            $this->updateIsVerified($userid);
                            header('location:/login?accountVerified');
                        }
                    }
                } else {
                ?>
                    <div>
                        <p>
                            Votre lien a expiré : cliquer ici pour en regénérer un nouveau :
                        </p>
                        <form>
                            <button type='submit' name='<?= htmlspecialchars($uriExploded[1]) ?>'>Envoyer</input>
                        </form>
                    </div>
<?php
                }
            }
        } else {
            $encryptionKey = "test";
            $token = explode("=", $token);
            echo 'test';
            $userid = $this->decryptId(urldecode($token[1]), $encryptionKey);
            echo $userid;
            $user = $this->getUserById($userid);
            $role = $user['id_role'];
            $sendedEmail = $this->sendEmailToRegistered($user, $role, "verif");
            if ($sendedEmail == true) {
                header("location:/login?verifMailSended");
            } else {
                header("location:/login?verifMailSendedLost");
            }
        }
    }

    public function forgotPassword()
    {
        $form = new SendPassword();
        $view = new View("Auth/send-new-pwd", "front");
        $view->assign('form', $form->getConfig());
        if ($form->isSubmit()) {
            $verificator = new Verificator();
            $errors = $verificator->checkEmailForSendPassword($form->getConfig(), $_POST);
            if (empty($errors)) {
                //$sql = new Sql();
                $userdata = Sql::getUserByEmail($_POST['email']);
                $token = $this->generateToken($userdata['id']);
                $this->setUserTokenByEmail($_POST['email'], $token);
                $this->sendEmailToRegistered($userdata, $userdata['id_role'], "forgotPassword");
                header('Location:passwordForgot?mailSended');
            } else {
                $view->assign('errors', $errors);
            }
        } else {
        }
    }

    public function defineNewPassword()
    {
        $form = new DefinePassword();
        $view = new View("Auth/define-new-pwd", "front");
        $view->assign('form', $form->getConfig());
        $encryptionKey = "test";
        $token = $_SERVER['QUERY_STRING'];
        $token = explode("=", $token);
        // echo $token[1];
        $userid = $this->decryptId($token[1], $encryptionKey);
        if ($form->isSubmit()) {
            $verificator = new Verificator();
            $errors = "";
            if($_POST['pwd'] != "" && $_POST['confirmPwd'] != ""){
                $errors = $verificator->checkPassword($_POST['pwd'], $_POST['confirmPwd']);
            } else {
                $errors = "Veuillez rentrer un mot de passe valide et le confirmer.";
            }
            if (empty($errors)) {
                // $user = new User();
                $user = User::getInstance();
                $user->setId($userid);
                $user->setPassword($_POST['pwd']);
                $user->save();
                header('Location:/login?passwordUpdated');
            } else {
                $view->assign('errors', $errors);
            }
        }
    }

    public function generateSitemap()
    {
        $routes = yaml_parse_file(__DIR__ . '/../routes.yml');

        $filteredRoutes = array_filter($routes, function ($route) {
            return isset($route['sitemap']) && $route['sitemap'] === true;
        });

        $productData = $this->getAllProduct();
        $pageData = $this->getAllPage();

        header('Content-Type: application/xml');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($filteredRoutes as $url => $route) {
            echo '<url>';
            echo '<loc>' . 'http://localhost' . $url . '</loc>';
            echo '<lastmod>' . date('c') . '</lastmod>';
            echo '<priority>' . (isset($route['priority']) ? $route['priority'] : '0.50') . '</priority>';
            echo '</url>';
        }

        foreach ($productData as $product) {
            echo '<url>';
            echo '<loc>' . 'http://localhost/products/' . $product['slug'] . '</loc>';
            echo '<lastmod>' . date('c') . '</lastmod>';
            echo '<priority>0.50</priority>';
            echo '</url>';
        }

        foreach ($pageData as $page) {
            echo '<url>';
            echo '<loc>' . 'http://localhost/pages/' . $page['slug'] . '</loc>';
            echo '<lastmod>' . date('c') . '</lastmod>';
            echo '<priority>0.50</priority>';
            echo '</url>';
        }

        echo '</urlset>';
    }
}
