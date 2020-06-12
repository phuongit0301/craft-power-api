<?php
namespace phuongpt\powerapi;

use Craft;

class Widget extends \craft\base\Widget
{

    public static function displayName(): string
    {
        return 'Power API Widget';
    }

    public function getBodyHtml()
    {
        return "<div>Hello Power API Widget body</div>";
    }

    public function getSettingsHtml()
    {
        Craft::$app->getView()->setNamespace('powerapi');
        // Come up with an ID value for 'foo'
        $id = Craft::$app->getView()->formatInputId('widgetMarkdownText');
        // Figure out what that ID is going to be namespaced into
        $namespacedId = Craft::$app->view->namespaceInputId($id);
        // Render and return the input template
        return Craft::$app->getView()->renderTemplate('powerapi/_widgets/_setting', [
            'id'           => $id,
            'namespacedId' => $namespacedId,
            'widget'       => $this
        ]);
    }
}