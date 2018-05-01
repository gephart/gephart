<?php

namespace Admin\Generator\Service;

use Admin\Generator\Type\BoolType;
use Admin\Generator\Type\DateType;
use Admin\Generator\Type\FileType;
use Admin\Generator\Type\ImageType;
use Admin\Generator\Type\TextareaType;
use Admin\Generator\Type\TextType;
use Admin\Generator\Type\TypeInterface;
use Gephart\Collections\Collection;
use Gephart\EventManager\Event;
use Gephart\EventManager\EventManager;

class Types
{
    const HOOK_EVENT = __CLASS__ . "::HOOK_EVENT";

    /**
     * @var Collection|TypeInterface[]
     */
    private $types;

    public function __construct(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;

        $this->types = new Collection(TypeInterface::class);

        $this->triggerHook([
            BoolType::class,
            DateType::class,
            FileType::class,
            ImageType::class,
            TextareaType::class,
            TextType::class
        ]);
    }

    public function getTypes(): Collection
    {
        return $this->types;
    }

    private function triggerHook(array $types = []): Collection
    {
        $event = new Event();
        $event->setName(self::HOOK_EVENT);
        $event->setParams([
            "types" => $types
        ]);

        $this->eventManager->trigger($event);

        $typeNames = $event->getParam("types");

        foreach ($typeNames as $typeName) {
            $this->types->add(new $typeName);
        }

        $this->types = $this->types->sort(function(TypeInterface $left, TypeInterface $right){
            return $left->getPriority() < $right->getPriority();
        });

        return $this->types;
    }

}