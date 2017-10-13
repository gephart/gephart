<?php

namespace App\Controller;

use Gephart\Framework\Response\TemplateResponseFactory;

final class DefaultController
{

    /**
     * @var TemplateResponseFactory
     */
    private $response;

    public function __construct(TemplateResponseFactory $template_response)
    {
        $this->response = $template_response;
    }

    /**
     * @Route /
     */
    public function index()
    {
        return $this->response->createResponse("_framework/default.html.twig");
    }
}
