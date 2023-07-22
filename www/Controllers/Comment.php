<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Sql;

class Comment extends Sql
{

    /*
    reportComment(): Fonction qui permet de signaler un commentaire
    */
    public function reportComment()
    {
        if (isset($_GET['id'])) {
            $commentId = $_GET['id'];

            $this->updateCommentReportedStatus($commentId, true);

            $userId = $this->getIdByEmail($_SESSION['email'])['id'];
            $this->updateCommentReporterId($commentId, $userId);
        }

        header("Location: /products");
        exit;
    }
}