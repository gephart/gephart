<?php

namespace Admin\Controller;

use Admin\Facade\AdminResponse;
use Gephart\Framework\Facade\Request;
use Gephart\Framework\Facade\Router;
use Gephart\Security\Authenticator\Authenticator;

final class LoginController
{
    /**
     * @var Authenticator
     */
    private $authenticator;

    public function __construct(
        Authenticator $authenticator
    ) {
        $this->authenticator = $authenticator;
    }

    /**
     * @Route {
     *  "rule": "/login",
     *  "name": "admin_login"
     * }
     * @return \Gephart\Http\Response
     */
    public function index()
    {
        $postData = Request::getParsedBody();

        if (!empty($postData["email"]) && !empty($postData["password"])) {
            $email = $postData["email"];
            $password = $postData["password"];
            if ($this->authenticator->authorise($email, $password)) {
                Router::redirectTo("admin_homepage");
            }
        }

        return AdminResponse::createResponse("admin/login.html.twig");
    }
}
