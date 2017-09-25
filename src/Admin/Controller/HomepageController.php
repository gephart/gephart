<?php

namespace Admin\Controller;

use Admin\Response\BackendTemplateResponse;
use Gephart\Routing\Router;
use Gephart\Sessions\Sessions;

/**
 * @Security ROLE_ADMIN
 */
class HomepageController
{

    /**
     * @var BackendTemplateResponse
     */
    private $template_response;

    /**
     * @var Router
     */
    private $router;

    public function __construct(BackendTemplateResponse $template_response, Router $router)
    {
        $this->template_response = $template_response;
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
        return $this->template_response->template("admin/homepage.html.twig");
    }

    /**
     * @Route /admin
     */
    public function redirect()
    {
        $this->router->redirectTo("admin_homepage");
    }

}