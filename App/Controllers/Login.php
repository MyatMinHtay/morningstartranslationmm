<?php  

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Auth;
use \App\Flash;


class Login extends \Core\Controller
{

        public $user;

        protected function before()
        {
            

            $this->user = Auth::getUser();

        
        }



    /**
     * Show the login page
     *
     * @return void
     */
    public function indexAction()
    {

        if($this->user == false){
            Auth::redirect('/');
        }else{
            View::renderTemplate('Login/userlogin.html');
        }
        
    }


    /**
     * Log in a user
     *
     * @return void
     */
  

    public function createAction()
    {
        $errors = [];
        $user = [];
        $json = json_decode(file_get_contents('php://input'));
        $User = new User();

        $username = $json->username;
        $password = $json->password;

        $row = $User->where(['Username' => $username],'RoleId','DESC');


        if($row){

            if(password_verify($password, $row[0]['Password'])){

                

                // redirect('home');
                $user['status'] = 2;
                $id = $row[0]['RoleId'];
                $query = "SELECT users.Username,users.DisplayName,systemrole.RoleName FROM `users`JOIN systemrole ON users.RoleId = systemrole.RoleId WHERE users.RoleId = $id";
                $data = $User->search($query);
                $user['user'] = $data;
                Auth::login($data[0]['Username'],$data[0]['RoleName']);
                echo json_encode($user);
                die();
            }else{
                $errors['status'] = 1;
                $errors['errormessage'] = "wrong password";
                echo json_encode($errors);
                die();
            }
        }else{
            $errors['status'] = 0;
            $errors['errormessage'] = "wrong username";
            echo json_encode($errors);
            die();
        }
    }

  

    /**
     * Log out a user
     *
     * @return void
     */
    public function destoryAction()
    {
        Auth::logout();

        $this->redirect('/login');
    }

    
}