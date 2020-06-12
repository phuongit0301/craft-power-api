<?php

namespace phuongpt\powerapi\assets;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class Bootstrap extends AssetBundle
{
    public function init()
    {
        // define the path that your publishable resources live
        $this->sourcePath = '@phuongpt/powerapi/assets/dist';

        // define the dependencies
        $this->depends = [
            CpAsset::class,
        ];

        // define the relative path to CSS/JS files that should be registered with the page
        // when this asset bundle is registered
        $this->js = [
            'bundle.js',
        ];

        $this->css = [
            'https://unpkg.com/graphiql/graphiql.min.css',
        ];

        parent::init();
    }
}