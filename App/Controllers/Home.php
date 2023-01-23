<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Models\User;
/**
 * Home controller
 *
 * PHP version 7.0
 */

 date_default_timezone_set('Asia/Yangon');
class Home extends \Core\Controller
{

    

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('Home/index.html',[
            'user' => Auth::getUser()
        ]);
    }

    public function homeAction()
    {
        
        View::renderTemplate('Home/index.html',[
            'user' => Auth::getUser()
        ]);
    }
}
