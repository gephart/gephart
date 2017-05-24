<?php

namespace Admin\Controller;

use Gephart\Routing\Router;
use Gephart\Security\Authenticator\Authenticator;

final class LogoutController
{

    /**
     * @var Router
     */
    private $router;

    /**
     * @var Authenticator
     */
    private $authenticator;

    public function __construct(
        Router $router,
        Authenticator $authenticator
    )
    {
        $this->router = $router;
        $this->authenticator = $authenticator;
    }

    /**
     * @Route {
     *  "rule": "/logout",
     *  "name": "admin_logout"
     * }
     */
    public function index()
    {
        $this->authenticator->unauthorise();
        $url = $this->router->generateUrl("homepage");
        header("location: $url");
        exit;
    }
}