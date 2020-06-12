<?php
namespace phuongpt\yapi;

use yii\base\Event;
use craft\web\UrlManager;
use craft\services\Fields;
use craft\services\Elements;
use craft\services\Dashboard;
use Craft;

//register fields
use craft\web\twig\variables\Cp;
//register elements
use craft\elements\db\ElementQuery;
//register template function
use craft\events\PopulateElementEvent;
use craft\events\RegisterUrlRulesEvent;

class Plugin extends \craft\base\Plugin
{
    public static $plugin;

    public $hasCpSection = true;

    public $hasCpSettings = true;

    function getName()
    {
        return Craft::t('Youtube API');
    }

    function getVersion()
    {
        return '1.0';
    }

    function getDeveloper()
    {
        return 'Phuongpt';
    }

    function getDeveloperUrl()
    {
        return 'http://google.com';
    }

    public function init()
    {
        parent::init();
        self::$plugin = $this;


        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function(RegisterUrlRulesEvent $event) {
                $event->rules = array_merge(
                    $event->rules,
                    [
                        'api/yapi/getYoutube' => 'yapi/video',
                    ]
                );
            }
        );
    }

    public function createSettingsModel()
    {
        return new SettingsModel();
    }
}