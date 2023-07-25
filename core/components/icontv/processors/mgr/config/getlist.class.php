<?php

require_once dirname(__FILE__, 4). '/Services/ConfigFilterIterator.php';
require_once dirname(__FILE__, 4). '/Services/Sprite.php';

//$s = new Sprite();
//$s->addAllStates('add.svg', 0);
//$s->addAllStates('comment.svg', 1);
//$s->addAllStates('trash.svg', 2);
//$s->addAllStates('share.svg', 3);
//$s->addAllStates('tick.svg', 4);
//$s->addAllStates('edit.svg', 5);
//$s->addAllStates('x.svg', 6);
//$s->output();


class iconTVGetListConfigsProcessor extends modProcessor
{
    public function process()
    {
        $path = $this->modx->getOption(
            'icontv.path.config',
            '',
            MODX_CORE_PATH . '/components/icontv/elements/config/'
        );
        if (!is_dir($path)) {
            $path = MODX_CORE_PATH . '/components/icontv/elements/config/';
        }
        $files = new configFilterIterator(new FilesystemIterator($path));
        $result = [];
        foreach ($files as $item) {
            $result[] = ['name' => str_replace('.json', '', $item->getfileName())];
        }
        return json_encode(
            array(
                'success' => true,
                'total' => 3,
                'results' => $result
            )
        );
    }
}

return 'iconTVGetListConfigsProcessor';
