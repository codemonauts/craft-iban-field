<?php

namespace codemonauts\iban;

use codemonauts\iban\twigextensions\Format;
use Craft;
use craft\base\Plugin;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;
use yii\base\Event;
use codemonauts\iban\fields\Iban as IbanField;
use codemonauts\iban\feedme\Iban as IbanFeedme;
use craft\feedme\events\RegisterFeedMeFieldsEvent;
use craft\feedme\services\Fields as FeedMeFields;

class Iban extends Plugin
{
    /**
     * @var \codemonauts\iban\Iban
     */
    public static Iban $plugin;

    public function init()
    {
        parent::init();

        self::$plugin = $this;

        if (Craft::$app->request->getIsSiteRequest()) {
            Craft::$app->view->registerTwigExtension(new Format());
        }

        Event::on(Fields::class, Fields::EVENT_REGISTER_FIELD_TYPES, function (RegisterComponentTypesEvent $event) {
            $event->types[] = IbanField::class;
        });

        // Register field for feed-me plugin if installed
        if (Craft::$app->plugins->isPluginEnabled('feed-me')) {
            Event::on(FeedMeFields::class, FeedMeFields::EVENT_REGISTER_FEED_ME_FIELDS, function (RegisterFeedMeFieldsEvent $e) {
                $e->fields[] = IbanFeedme::class;
            });
        }
    }
}
