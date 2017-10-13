<?php

namespace Admin\Generator\Controller;

use Gephart\Framework\Response\TemplateResponseFactory;

/**
 * @Security ROLE_ADMIN
 * @RoutePrefix /admin/generator
 */
class JavaScriptController
{

    /**
     * @var TemplateResponseFactory
     */
    private $template_response;

    public function __construct(TemplateResponseFactory $template_response)
    {
        $this->template_response = $template_response;
    }

    /**
     * @Route {
     *  "rule": "/generator.js",
     *  "name": "admin_generator_javascript"
     * }
     */
    public function index()
    {
        return $this->template_response->createResponse("admin/generator/js/index.js.twig");
    }
}
