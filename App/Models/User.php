<?php

namespace App\Models;

use PDO;
use \App\Token;
use \App\Mail;
use \Core\View;


/**
 * Example user model
 *
 * PHP version 7.0
 */
class User extends \Core\Model
{

    protected $table = 'users';

    protected $allowed_columns = [
        'Username',
        'Password',
        'RoleId',
        'DisplayName',
        'UserStatus',
        'Remark',
        'RecordStatus',
        'CreatedDate',
        'CreatedBy',
        'ModifiedDate',
        'ModifiedBy'
    ];

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    // public static function getAll()
    // {
    //     $db = static::getDB();
    //     $stmt = $db->query('SELECT id, name FROM users');
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    /**
     * Find a user model by email address
     *
     * @param string $email email address to search for
     *
     * @return mixed User object if found, false otherwise
     */
    public static function findByUsername($username)
    {
        $sql = 'SELECT * FROM users WHERE username = :username';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();

       

    }

    public static function findByPassword($password)
    {
        $sql = 'SELECT * FROM users WHERE password = :password';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    /** Authenticate a user by username and password.
    * Authenticate a user by username and password. User account has to be active.
    *
    * @param string $username username address
    * @param string $password password
    *
    * @return mixed  The user object or false if authentication fails
    */
   public static function authenticate($username, $password)
   {
       $user = static::findByUsername($username);

       
       
       if ($user) {
           if (static::findByPassword($user->password)) {
                
                $user = json_encode($user);
               return $user;
           }
       }

       return false;
   
   }

  
}
