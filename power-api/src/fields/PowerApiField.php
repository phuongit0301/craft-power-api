<?php

namespace phuongpt\powerapi\fields;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;

class PowerApiField extends Field
{
    public $dropdownOptions = '';
    public $columnType = 'text';

    public static function displayName(): string
    {
        return Craft::t('powerapi', 'Power Editor');
    }

    public function getSettingsHtml()
    {
        return Craft::$app->getView()->renderTemplate(
            'powerapi/_components/fields/Dropdown_settings',
            [
                'field' => $this,
            ]
        );
    }

    public function getContentColumnType(): string
    {
        return $this->columnType;
    }

    public function normalizeValue($value, ElementInterface $element = null): string
    {
        $view = Craft::$app->getView();
        $templateMode = $view->getTemplateMode();
        $view->setTemplateMode($view::TEMPLATE_MODE_SITE);

        $variables['element'] = $element;
        $variables['this'] = $this;

        $options = json_decode('[' . $view->renderString($this->dropdownOptions, $variables) . ']', true);

        $view->setTemplateMode($templateMode);

        if ($this->isFresh($element) && !empty($options) ) :
            foreach ($options as $key => $option) :
                if (!empty($option['default'])) :
                    $value = $option['value'];
                endif;
            endforeach;
        endif;

        return (is_null($value) ? '' : $value);
    }

    public function getInputHtml($value, ElementInterface $element = null): string
    {
        $view = Craft::$app->getView();
        $templateMode = $view->getTemplateMode();
        $view->setTemplateMode($view::TEMPLATE_MODE_SITE);

        $variables['element'] = $element;
        $variables['this'] = $this;

        $options = json_decode('[' . $view->renderString($this->dropdownOptions, $variables) . ']', true);

        $view->setTemplateMode($templateMode);

        return Craft::$app->getView()->renderTemplate('powerapi/_includes/forms/select', [
            'name' => $this->handle,
            'value' => $value,
            'options' => $options
        ]);
    }
}