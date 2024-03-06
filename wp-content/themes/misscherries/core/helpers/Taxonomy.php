<?php

namespace Brooktec\Helpers;

/**
 * Class Taxonomy
 *
 * Helper functions for taxonomies.
 *
 * @package Brooktec\Helpers
 * @since 1.0.0
 * @version 1.0.0
 */
class Taxonomy
{
    /**
     * @param int $post_id
     * @return \WP_Term
     */
    public static function getCategory($post_id = 0)
    {
        return self::getTerm('category', $post_id);
    }

    /**
     * @param int $post_id
     * @return \WP_Term
     */
    public static function getTag($post_id = 0)
    {
        return self::getTerm('post_tag', $post_id);
    }

    /**
     * @param $taxonomy
     * @param int $post_id
     * @return \WP_Term
     */
    public static function getTerm($taxonomy, $post_id = 0)
    {
        $terms = self::getTerms($taxonomy, $post_id);
        return ((is_countable($terms) && count($terms) > 0) ? current($terms) : false);
    }

    /**
     * @param $taxonomy
     * @param int $post_id
     * @return array Terms of taxonomy
     */
    public static function getTerms($taxonomy, $post_id = 0)
    {
        return get_the_terms(max(absint($post_id), 0) == 0 ? get_the_ID() : $post_id, $taxonomy);
    }
}
