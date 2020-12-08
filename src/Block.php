<?php

namespace Sitepilot\Block;

use ReflectionClass;
use Jenssegers\Blade\Blade;

abstract class Block
{
    /**
     * The caller directory.
     *
     * @var string
     */
    public $dir;

    /**
     * The caller class name.
     *
     * @var string
     */
    public $class;

    /**
     * The builder instance.
     *
     * @var Builder
     */
    public $builder;

    /**
     * The shortcode instance.
     *
     * @var Shortcode
     */
    public $shortcode;

    /**
     * Create a new block instance.
     *
     * @return static
     */
    public static function make(...$arguments)
    {
        return new static(...$arguments);
    }

    /**
     * Create a new block instance.
     *
     * @return void
     */
    public function __construct($shortcode = null)
    {
        $reflectionClass = new ReflectionClass($this);

        $this->dir = dirname($reflectionClass->getFileName());
        $this->url = trailingslashit(get_stylesheet_directory_uri()) . "classes/Blocks/" . $reflectionClass->getShortName();
        $this->class = get_called_class();
        $this->builder = new Builder($this);
        $this->shortcode = new Shortcode($this);

        if ($shortcode) {
            $this->shortcode->tag($shortcode);
        }
    }

    /**
     * Get the name of the block.
     *
     * @return string   
     */
    abstract public function name(): string;

    /**
     * Get the fields used by the block.
     *
     * @return array
     */
    abstract public function fields(): array;

    /**
     * Get the description of the block.
     *
     * @return string   
     */
    public function description(): string
    {
        return '';
    }

    /**
     * Render block blade template.
     *
     * @param array $data
     * @return string
     */
    public function render_view(array $data): string
    {
        $blade = new Blade($this->dir . '/views', apply_filters('sp_blocks_cache_dir', get_stylesheet_directory()) . '/cache');

        return $blade->make('frontend', $data)->render();
    }
}
