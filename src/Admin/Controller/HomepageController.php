<?php

namespace Admin\Controller;

use Admin\Response\AdminResponseFactory;
use Gephart\Routing\Router;

/**
 * @Security ROLE_ADMIN
 */
class HomepageController
{

    /**
     * @var AdminResponseFactory
     */
    private $responseFactory;

    /**
     * @var Router
     */
    private $router;

    public function __construct(AdminResponseFactory $responseFactory, Router $router)
    {
        $this->responseFactory = $responseFactory;
        $this->router = $router;
    }

    /**
     * @Route {
     *  "rule": "/admin/homepage",
     *  "name": "admin_homepage"
     * }
     */
    public function index()
    {
        return $this->responseFactory->createResponse("admin/homepage.html.twig");
    }

    /**
     * @Route /admin
     */
    public function redirect()
    {
        $this->router->redirectTo("admin_homepage");
    }
}
