<?php

namespace Sitepilot\Block;

use ReflectionClass;
use Sitepilot\Block\Fields\Link;
use Sitepilot\Block\Fields\Image;
use Sitepilot\Block\Fields\Video;

class Builder
{
    /**
     * The block instance.
     *
     * @var Block
     */
    private $block;

    /** 
     * The builder module file.
     * 
     * @var string
     */
    private $module_file;

    /**
     * The builder module class.
     *
     * @var BuilderModule
     */
    private $module_class;

    /**
     * Remove default module margin.
     *
     * @var boolean
     */
    public $no_margin = false;

    /**
     * Make module full width.
     *
     * @var boolean
     */
    public $full_width = false;

    /**
     * Create a new builder instance.
     *
     * @param Block $block
     */
    public function __construct(Block $block)
    {
        $this->block = $block;

        $reflect = new ReflectionClass($block);
        $this->module_class = "{$reflect->getShortName()}BuilderModule";
        $this->module_file = $this->block->dir . "/builder/sp-" . strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $reflect->getShortName())) . ".php";

        if (file_exists($this->module_file)) {
            add_action('init', function () {
                require_once $this->module_file;

                if (method_exists($this->module_class, 'init')) {
                    $this->module_class::init($this->block);
                }
            });
        }
    }

    /**
     * Get the builder module fields.
     *
     * @return array
     */
    public function fields(): array
    {
        $fields = [];
        $block_fields = $this->block->fields();

        foreach ($block_fields as $field) {
            $fields[$field->attribute] = $field->builder_field();
        }

        return $fields;
    }

    /**
     * Render the builder module.
     *
     * @param object $settings
     * @return string
     */
    public function render($id, $settings): string
    {
        $data = [];
        $fields = $this->block->fields();

        foreach ($fields as $field) {
            if (Image::class == get_class($field)) {
                if (!empty($settings->{$field->attribute . '_src'})) {
                    $data[$field->attribute] = $settings->{$field->attribute . '_src'};
                } else {
                    $data[$field->attribute] = $field->default;
                }
            } else if (Video::class == get_class($field)) {
                $video = wp_prepare_attachment_for_js($settings->{$field->attribute});
                if (isset($video['url'])) {
                    $data[$field->attribute] = $video['url'];
                } else {
                    $data[$field->attribute] = $field->default;
                }
            } else if (Link::class == get_class($field)) {
                $data[$field->attribute] = $settings->{$field->attribute};
                $data[$field->attribute . '_target'] = $settings->{$field->attribute . '_target'};
            } else {
                $data[$field->attribute] = $settings->{$field->attribute};
            }
        }

        if (isset($settings->slot) && !isset($data['slot'])) {
            $data['slot'] = $settings->slot;
        }

        $data = array_merge($this->block->view_data(), $data);

        return $this->block->render_view($data);
    }

    /**
     * Remove module margins.
     *
     * @param boolean $value
     * @return self
     */
    public function no_margin($no_margin = true): self
    {
        $this->no_margin = $no_margin;

        return $this;
    }

    /**
     * Make module full width.
     *
     * @param boolean $value
     * @return void
     */
    public function full_width($full_width = true): self
    {
        $this->full_width = $full_width;

        return $this;
    }
}
