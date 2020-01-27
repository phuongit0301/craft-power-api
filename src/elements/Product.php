<?php
namespace phuongpt\powerapi;

use craft\base\Element;
use craft\elements\db\ElementQueryInterface;
use phuongpt\powerapi\elements\db\ProductQuery;

class Product extends Element
{
    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return 'Product';
    }

    /**
     * @inheritdoc
     */
    public static function pluralDisplayName(): string
    {
        return 'Products';
    }

    /**
     * @var int Price
     */
    public $price = 0;

    /**
     * @var string Currency code
     */
    public $currency;

    public function afterSave(bool $isNew)
    {
        if ($isNew) {
            \Craft::$app->db->createCommand()
                ->insert('{{%products}}', [
                    'id' => $this->id,
                    'price' => $this->price,
                    'currency' => $this->currency,
                ])
                ->execute();
        } else {
            \Craft::$app->db->createCommand()
                ->update('{{%products}}', [
                    'price' => $this->price,
                    'currency' => $this->currency,
                ], ['id' => $this->id])
                ->execute();
        }

        parent::afterSave($isNew);
    }

    public static function find(): ElementQueryInterface
    {
        return new ProductQuery(static::class);
    }

    public static function hasContent(): bool
    {
        return true;
    }

    public static function hasTitle(): bool
    {
        return true;
    }

    public function getEditorHtml(): string
    {
        $html = \Craft::$app->getView()->renderTemplateMacro('_includes/forms', 'textField', [
            [
                'label' => \Craft::t('app', 'Title'),
                'siteId' => $this->siteId,
                'id' => 'title',
                'name' => 'title',
                'value' => $this->title,
                'errors' => $this->getErrors('title'),
                'first' => true,
                'autofocus' => true,
                'required' => true
            ]
        ]);
        $html .= parent::getEditorHtml();

        return $html;
    }
}
