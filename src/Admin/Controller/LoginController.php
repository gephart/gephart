<?php

namespace Admin\Controller;

use Admin\Response\AdminResponseFactory;
use Gephart\Routing\Router;
use Gephart\Security\Authenticator\Authenticator;
use Psr\Http\Message\ServerRequestInterface;

final class LoginController
{

    /**
     * @var Router
     */
    private $router;

    /**
     * @var Authenticator
     */
    private $authenticator;

    /**
     * @var AdminResponseFactory
     */
    private $responseFactory;

    public function __construct(
        AdminResponseFactory $responseFactory,
        ServerRequestInterface $request,
        Router $router,
        Authenticator $authenticator
    )
    {
        $this->request = $request;
        $this->router = $router;
        $this->authenticator = $authenticator;
        $this->responseFactory = $responseFactory;
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
        $postData = $this->request->getParsedBody();

        if (!empty($postData["email"]) && !empty($postData["password"])) {
            $email = $postData["email"];
            $password = $postData["password"];
            if ($this->authenticator->authorise($email, $password)) {
                $this->router->redirectTo("admin_homepage");
            }
        }

        return $this->responseFactory->createResponse("admin/login.html.twig");
    }
}