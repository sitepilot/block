<?php

namespace Sitepilot\Block\Fields;

class Link extends Field
{
    public function builder_field()
    {
        return [
            'type' => 'link',
            'label' => $this->name,
            'show_target' => true
        ];
    }
}
