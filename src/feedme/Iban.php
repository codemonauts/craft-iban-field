<?php

namespace codemonauts\iban\feedme;

use craft\feedme\base\Field;
use craft\feedme\base\FieldInterface;

class Iban extends Field implements FieldInterface
{
    public static $name = 'IBAN Field';
    public static $class = 'codemonauts\iban\fields\Iban';

    public function getMappingTemplate(): string
    {
        return 'iban/feedme';
    }

    public function parseField(): string
    {
        return (string)$this->fetchValue();
    }
}
