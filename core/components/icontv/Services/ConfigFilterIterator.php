<?php

class ConfigFilterIterator extends FilterIterator
{
    public function accept(): bool
    {
        $item = $this->getInnerIterator()->current();

        return $item->isFile() && $item->getExtension() === 'json';
    }
}
