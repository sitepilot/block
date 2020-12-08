<?php

namespace Sitepilot\Block\Fields;

class Editor extends Field
{
    public function builder_field()
    {
        return [
            'type' => 'editor',
            'label' => $this->name,
            'default' => $this->default
        ];
    }
}
