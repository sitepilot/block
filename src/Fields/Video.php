<?php

namespace Sitepilot\Block\Fields;

class Video extends Field
{
    public function builder_field()
    {
        return [
            'type' => 'video',
            'label' => $this->name,
            'show_remove' => !empty($this->default)
        ];
    }
}
