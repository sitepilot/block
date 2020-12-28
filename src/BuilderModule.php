<?php

namespace Sitepilot\Block;

use stdClass;
use FLBuilder;
use FLBuilderModel;
use FLBuilderModule;

class BuilderModule extends FLBuilderModule
{
    /**
     * The block instance.
     *
     * @var Block
     */
    public $block;

    /**
     * The static block instance.
     *
     * @var array
     */
    private static array $_blocks;

    /**
     * Create a new builder module instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->block = self::$_blocks[static::class];

        parent::__construct(array(
            'name' => $this->block->name(),
            'description' => $this->block->description(),
            'category' => $this->block->category(),
            'group' => $this->block->group(),
            'partial_refresh' => !$this->block->builder->full_width,
            'editor_export' => true,
            'enabled' => true
        ));
    }

    /**
     * Initialize the builder module.
     *
     * @param Block $block
     * @return Block
     */
    public static function init(Block $block)
    {
        self::$_blocks[static::class] = $block;

        FLBuilder::register_module(static::class, array(
            'general' => array(
                'title' => __('Shortcode', 'sitepilot-block'),
                'sections' => array(
                    'general' => array(
                        'title' => __('Settings', 'sitepilot-block'),
                        'fields' => $block->builder->fields()
                    )
                )
            )
        ));

        return $block;
    }

    /**
     * Update module and row settings.
     *
     * @param object $settings
     * @return object
     */
    public function update($settings)
    {
        if ($this->block->builder->no_margin) {
            if (!$settings->margin_top) $settings->margin_top = 0;
            if (!$settings->margin_bottom) $settings->margin_bottom = 0;
            if (!$settings->margin_left) $settings->margin_left = 0;
            if (!$settings->margin_right) $settings->margin_right = 0;
        }

        if ($this->block->builder->full_width) {
            $row = FLBuilderModel::get_node_parent_by_type($this->node, 'row');

            if ($row->content_width != "full") {
                $update_row = new stdClass;
                $update_row->width = "full";
                $update_row->content_width = "full";

                $update_row->padding_top = 0;
                $update_row->padding_bottom = 0;
                $update_row->padding_left = 0;
                $update_row->padding_right = 0;

                FLBuilderModel::save_settings($row->node, $update_row);
            }
        }

        return $settings;
    }
}
