<?php

namespace Sitepilot\Block\Fields;

class Image extends Field
{
    public function builder_field()
    {
        return [
            'type' => 'photo',
            'label' => $this->name,
            'show_remove' => !empty($this->default)
        ];
    }
}
