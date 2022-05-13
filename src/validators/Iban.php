<?php

namespace codemonauts\iban\validators;

use Craft;
use yii\validators\Validator;
use Iban\Validation\Iban as IbanModel;
use Iban\Validation\Validator as IbanValidator;

class Iban extends Validator
{
    /**
     * @inheritdoc
     */
    public function validateValue($value): ?array
    {
        $iban = new IbanModel($value);

        $validator = new IbanValidator([
            'violation.unsupported_country' => Craft::t('iban', 'The given country is not supported.'),
            'violation.invalid_length' => Craft::t('iban', 'The length of the given IBAN is not valid.'),
            'violation.invalid_format' => Craft::t('iban', 'The format of the given IBAN is not valid.'),
            'violation.invalid_checksum' => Craft::t('iban', 'The checksum of the given IBAN is not valid.'),
        ]);

        if (!$validator->validate($iban)) {
            $errors = $validator->getViolations();
            return [$errors[0], []];
        }

        return null;
    }
}
