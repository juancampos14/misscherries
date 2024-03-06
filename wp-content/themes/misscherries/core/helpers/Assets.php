<?php

namespace Brooktec\Helpers;

/**
 * Class Assets
 *
 * Helper functions for assets.
 *
 * @package Brooktec\Helpers
 * @since 1.0.0
 * @version 1.0.0
 */
class Assets
{
    /**
     * Get URI of asset
     *
     * It gets the URI of an asset file. For use on the src attribute of an image tag, for example.
     *
     * @param string $name Name of the file. For example: image.png
     * @param bool $parent If true, will look in parent theme directory instead of child theme directory
     * @return string
     */
    public static function getUri($name, $parent = false)
    {
        $base = $parent ? \get_template_directory_uri() : \get_stylesheet_directory_uri();
        return trailingslashit($base) . "dist/img/{$name}";
    }

    /**
     * Get Asset Path
     *
     * Gets the full path to the asset on the server
     *
     * @param string $name Name of the file. For example: image.png
     * @param bool $parent If true, will look in parent theme directory instead of child theme directory
     * @return string
     */
    public static function getAssetPath($name, $parent = false)
    {
        $base = $parent ? \get_template_directory() : \get_stylesheet_directory();
        return trailingslashit($base) . "dist/img/{$name}";
    }

    /**
     * Get Src
     *
     * Alias for getAssetPath
     *
     * @param string $name Name of the file. For example: image.png
     * @param bool $parent If true, will look in parent theme directory instead of child theme directory
     * @return string
     */
    public static function getSrc($name, $parent = false)
    {
        return self::getAssetPath($name, $parent);
    }

    /**
     * Get the contents of an SVG file
     *
     * @param string $name Name of the file. For example: image.png
     * @param bool $parent If true, will look in parent theme directory instead of child theme directory
     * @return string
     */
    public static function getSvgContents($name, $parent = false)
    {
        return @file_get_contents(self::getSrc($name, $parent));
    }
}
