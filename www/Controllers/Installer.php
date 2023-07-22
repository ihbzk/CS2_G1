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


class Installer extends Sql {
    public function install(){
        echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/Installer/www/index.html");
    }
}
