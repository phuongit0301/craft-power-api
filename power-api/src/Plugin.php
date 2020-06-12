<?php
namespace phuongpt\powerapi;

use yii\base\Event;
use craft\web\UrlManager;
use craft\services\Fields;
use craft\services\Elements;
use craft\services\Dashboard;
use phuongpt\powerapi\Widget;
use Craft;

//register fields
use craft\web\twig\variables\Cp;
//register elements
use craft\elements\db\ElementQuery;
//register template function
use craft\events\PopulateElementEvent;
use craft\events\RegisterUrlRulesEvent;

use phuongpt\powerapi\elements\Product;
use craft\events\RegisterCpNavItemsEvent;
use craft\web\twig\variables\CraftVariable;
use phuongpt\powerapi\fields\PowerApiField;
use craft\events\RegisterComponentTypesEvent;
use phuongpt\powerapi\behaviors\ProductBehavior;
use phuongpt\powerapi\models\SettingsModel;

class Plugin extends \craft\base\Plugin
{
    public static $plugin;

    public $hasCpSection = true;

    public $hasCpSettings = true;

    function getName()
    {
        return Craft::t('Power API');
    }

    function getVersion()
    {
        return '1.0';
    }

    function getDeveloper()
    {
        return 'phuongpt';
    }

    function getDeveloperUrl()
    {
        return 'http://google.com';
    }

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(Dashboard::class, Dashboard::EVENT_REGISTER_WIDGET_TYPES, function(RegisterComponentTypesEvent $event) {
            $event->types[] = Widget::class;
        });

        // Register our fields
        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = PowerApiField::class;
            }
        );

        Event::on(
            Elements::class,
            Elements::EVENT_REGISTER_ELEMENT_TYPES,
            function  (RegisterComponentTypesEvent $event) {
                $event->types[] = Product::class;
            }
        );

//        Event::on(
//            ElementQuery::class,
//            ElementQuery::EVENT_AFTER_POPULATE_ELEMENT,
//            function(PopulateElementEvent $event) {
//                $element = $event->element;
//
//                // only do this for product entry types
//                print_r($element->ty);exit;
//                if(get_class($element) === 'craft\elements\Entry' && $element->getType() == 'product') {
//                    $element->attachBehavior('powerProductBehavior', ProductBehavior::class());
//                }
//            }
//        );
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function(Event $event) {
                $variable = $event->sender;

                // Attach a behavior:
                $variable->attachBehaviors([
                    ProductBehavior::class,
                ]);
            }
        );

//        Event::on(UrlManager::class, UrlManager::EVENT_REGISTER_CP_URL_RULES, function(RegisterUrlRulesEvent $event) {
//            $event->rules = array_merge(
//                $event->rules,
//                [
//                    'powerapi/graphqlstandard' => 'powerapi/index/main',
//                ]
//            );
//        });

         Event::on(
             UrlManager::class,
             UrlManager::EVENT_REGISTER_SITE_URL_RULES,
             function(RegisterUrlRulesEvent $event) {
                 $event->rules = array_merge(
                     $event->rules,
                     [
                         'powerapi/graphql' => 'powerapi/index/index',
                     ]
                 );
             }
         );
    }

    public function createSettingsModel()
    {
        return new SettingsModel();
    }

    public function settingsHtml()
    {
        return Craft::$app->getView()->renderTemplate('powerapi/_setting', [
            'settings' => $this->getSettings()
        ]);
    }
}