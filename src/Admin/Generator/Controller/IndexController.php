<?php

namespace Admin\Generator\Controller;

use Admin\Generator\Repository\ModuleRepository;
use Admin\Response\BackendTemplateResponse;

/**
 * @Security ROLE_ADMIN
 * @RoutePrefix /admin/generator
 */
class IndexController
{

    /**
     * @var BackendTemplateResponse
     */
    private $template_response;

    /**
     * @var ModuleRepository
     */
    private $module_repository;

    public function __construct(
        BackendTemplateResponse $template_response,
        ModuleRepository $module_repository
    )
    {
        $this->template_response = $template_response;
        $this->module_repository = $module_repository;
    }

    /**
     * @Route {
     *  "rule": "/",
     *  "name": "admin_generator"
     * }
     */
    public function index()
    {
        $modules = $this->module_repository->findBy();

        return $this->template_response->template("admin/generator/index.html.twig", [
            "modules" => $modules
        ]);
    }

}