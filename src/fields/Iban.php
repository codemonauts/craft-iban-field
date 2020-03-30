<?php

namespace codemonauts\iban\fields;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\base\PreviewableFieldInterface;
use yii\db\Schema;
use codemonauts\iban\validators\Iban as IbanValidator;
use Iban\Validation\Iban as IbanModel;

class Iban extends Field implements PreviewableFieldInterface
{
    /**
     * @var string The type of database column the field should have in the content table
     */
    public $columnType = Schema::TYPE_STRING;

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('iban', 'IBAN Field');
    }

    /**
     * @inheritdoc
     */
    public function getContentColumnType(): string
    {
        return $this->columnType;
    }

    /**
     * @inheritdoc
     */
    public function getInputHtml($value, ElementInterface $element = null): string
    {
        return Craft::$app->getView()->renderTemplate('_includes/forms/text',
            [
                'name' => $this->handle,
                'value' => $value,
                'field' => $this,
            ]);
    }

    /**
     * @inheritdoc
     */
    public function getSearchKeywords($value, ElementInterface $element): string
    {
        return (string)$value;
    }

    /**
     * @inheritdoc
     */
    public function getElementValidationRules(): array
    {
        return [
            ['trim'],
            [IbanValidator::class],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getTableAttributeHtml($value, ElementInterface $element): string
    {
        $iban = new IbanModel($value);

        return $iban->format(IbanModel::FORMAT_ANONYMIZED);
    }
}
