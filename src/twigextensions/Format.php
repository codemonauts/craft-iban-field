<?php

namespace codemonauts\iban\twigextensions;

use Iban\Validation\Iban;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class Format extends AbstractExtension
{
    public function getName()
    {
        return 'IBAN formating';
    }

    public function getFilters()
    {
        return [
            new TwigFilter('iban', [$this, 'iban']),
        ];
    }

    public function iban($value, $format = Iban::FORMAT_PRINT): string
    {
        $iban = new Iban($value);

        return $iban->format($format);
    }
}
