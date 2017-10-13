<?php

namespace Admin\Response;

use Gephart\EventManager\Event;
use Gephart\EventManager\EventManager;
use Gephart\Framework\Response\TemplateResponseFactory;

class AdminResponseFactory
{
    const DATA_TRANSMIT_EVENT = __CLASS__ . "::DATA_TRANSMIT_EVENT";

    /**
     * @var EventManager
     */
    private $eventManager;

    /**
     * @var TemplateResponseFactory
     */
    private $response;

    public function __construct(TemplateResponseFactory $response, EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
        $this->response = $response;
    }

    public function createResponse(string $template, array $data = [], int $statusCode = 200, $headers = [])
    {
        $data = $this->triggerDataTransmit($data);
        return $this->response->createResponse($template, $data, $statusCode, $headers);
    }

    private function triggerDataTransmit(array $data = []): array
    {
        $event = new Event();
        $event->setName(self::DATA_TRANSMIT_EVENT);
        $event->setParams([
            "data" => $data
        ]);

        $this->eventManager->trigger($event);

        return $event->getParam("data");
    }
}
