<?php

class configFilterIterator extends FilterIterator
{
    function accept()
    {
        $item = $this->getInnerIterator()->current();
        return $item->isFile() && $item->getExtension() === 'json';
    }
}

class iconTVGetListConfigsProcessor extends modProcessor
{
    public function process()
    {
        $files = new configFilterIterator(new FilesystemIterator(MODX_CORE_PATH . '/components/icontv/elements/config/'));
        $result = [];
        foreach ($files as $item) {
            $result[] = ['name'=>str_replace('.json', '', $item->getfileName())];
        }
        return json_encode(array(
            'success' => true,
            'total' => 3,
            'results' => $result
        ));
    }
}

return 'iconTVGetListConfigsProcessor';