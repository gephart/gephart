<?php

namespace Admin\Controller;

use Gephart\Framework\Facade\Router;
use Gephart\Security\Authenticator\Authenticator;

final class LogoutController
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
     *  "rule": "/logout",
     *  "name": "admin_logout"
     * }
     */
    public function index()
    {
        $this->authenticator->unauthorise();

        try {
            Router::redirectTo("homepage");
        } catch (\Exception $exception) {
            Router::redirectTo("app\controller\defaultcontroller_index");
        }
    }
}
