<?php

namespace Sitepilot\Block\Fields;

class Text extends Field
{
    public function builder_field()
    {
        return [
            'type' => 'text',
            'label' => $this->name,
            'default' => $this->default
        ];
    }
}
