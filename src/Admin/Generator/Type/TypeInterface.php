<?php

namespace Admin\Generator\Type;

interface TypeInterface
{
    public function getEntityProperty(): string;
    public function getEntityMethods(): string;
    public function getSet(): string;
    public function getForm(): string;
    public function getShow(): string;
    public function getPriority(): int;
}