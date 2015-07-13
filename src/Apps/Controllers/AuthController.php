<?php
namespace Apps\Controllers;

use Cygnite\Common\Encrypt;
use Cygnite\Common\Input\Input;
use Cygnite\Common\SessionManager\Session;
use Cygnite\Foundation\Application as App;
use Application\Components\Authentication\Auth;
use Cygnite\Mvc\Controller\AbstractBaseController;

/**
 * This file is generated by Cygnite CLI
 * You may alter code to fit your needs
 */
class AuthController extends AbstractBaseController
{
    //protected $layout = 'layouts.base';

    protected $templateEngine = false;

    private $auth;

    /**
     * Your constructor.
     *
     * @access public
     *
     */
    public function __construct()
    {
        parent::__construct();
        /*
         | User Model to authenticate user using
         | credentials
         */
        $this->auth = Auth::model('\Apps\Models\User');
    }


    /**
     * Default Action
     */
    public function indexAction()
    {
    }

    /**
     * Authenticate user and login into the system
     *
     */
    public function checkAction()
    {
        $input = Input::make();
        $post = $input->json();

        $crypt = new Encrypt();
        $credentials = [
            'email' => $post->email,
            'password' => $crypt->encode($post->password)
        ];

        if ($this->auth->verify($credentials)) {
            $this->auth->login();
            $userInfo = $this->auth->userInfo();
            echo json_encode(
                ['success' => true, 'flash' => 'Logged In Successfully!!', 'name' => $userInfo['name']]
            );
        } else {
            echo json_encode(['success' => false, 'flash' => 'Invalid username or password', 'name' => '']);
        }
    }

    /**
     * Display specific information into the form to edit.
     *
     */
    public function logoutAction()
    {
        $this->auth->logout(false);

        echo json_encode(['success' => true, 'flash' => 'Successfully Logged Out!']);
    }
}//End of your LoginController
