<?php

return [
    'icontv.path.svg' => [
        'namespace' => 'icontv',
        'key' => 'icontv.path.svg',
        'area' => 'icontv.path',
        'xtype' => 'textfield',
        'lexicon' => 'icontv:default',
        'value' => '[[++assets_url]]components/icontv/svg/',
    ],
    'icontv.path.config' => [
        'namespace' => 'icontv',
        'key' => 'icontv.path.config',
        'area' => 'icontv.path',
        'xtype' => 'textfield',
        'lexicon' => 'icontv:default',
        'value' => 'core/components/icontv/elements/config/',
    ],
//    'icontv.theme' => [
//        'namespace' => 'icontv',
//        'key' => 'icontv.theme',
//        'area' => 'icontv.main',
//        'xtype' => 'textfield',
//        'lexicon' => 'icontv:default',
//        'value' => 'fip-grey',
//    ],
    'icontv.auto.close' => [
        'namespace' => 'icontv',
        'key' => 'icontv.auto.close',
        'area' => 'icontv.main',
        'xtype' => 'combo-boolean',
        'lexicon' => 'icontv:default',
        'value' => 1,
    ],
    'icontv.iconsPerPage' => [
        'namespace' => 'icontv',
        'key' => 'icontv.icons.per.page',
        'area' => 'icontv.main',
        'xtype' => 'numberfield',
        'lexicon' => 'icontv:default',
        'value' => 20,
    ],
    'icontv.empty.icon' => [
        'namespace' => 'icontv',
        'key' => 'icontv.empty.icon',
        'area' => 'icontv.main',
        'xtype' => 'combo-boolean',
        'lexicon' => 'icontv:default',
        'value' => 1,
    ],
    'icontv.destroy.api' => [
        'namespace' => 'icontv',
        'key' => 'icontv.destroy.api',
        'area' => 'icontv.main',
        'xtype' => 'combo-boolean',
        'lexicon' => 'icontv:default',
        'value' => 1,
    ],
    'icontv.generate.template' => [
        'namespace' => 'icontv',
        'key' => 'icontv.generate.template',
        'area' => 'icontv.main',
        'xtype' => 'combo-boolean',
        'lexicon' => 'icontv:default',
        'value' => 1,
    ]
];