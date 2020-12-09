<?php

namespace Sitepilot\Block\Fields;

use FLBuilder;

class HasMany extends Field
{
    /**
     * The child block.
     *
     * @var Block
     */
    private $block;

    /**
     * The preview attribute name.
     *
     * @var string
     */
    private $preview_attribute;

    /**
     * Create a new field.
     *
     * @param string $name
     * @param string $attribute
     * @return void
     */
    public function __construct($name, $attribute, $class)
    {
        parent::__construct($name, $attribute);

        $this->block = new $class();
    }

    /**
     * Get builder field configuration.
     *
     * @return array
     */
    public function builder_field(): array
    {
        $form = get_class($this->block) . 'Form';

        FLBuilder::register_settings_form($form, array(
            'title' => __('Shortcode', 'sitepilot-theme'),
            'tabs'  => array(
                'general' => array(
                    'title' => __('General', 'fl-builder'),
                    'sections' => array(
                        'general' => array(
                            'title' => '',
                            'fields' => $this->block->builder->fields()
                        )
                    )
                )
            )
        ));

        return [
            'type' => 'form',
            'label' => $this->name,
            'form' => $form,
            'preview_text' => $this->preview_attribute,
            'multiple' => true
        ];
    }

    /**
     * Set the preview attribute.
     *
     * @param string $attribute
     * @return self
     */
    public function preview_attribute($attribute): self
    {
        $this->preview_attribute = $attribute;

        return $this;
    }
}
