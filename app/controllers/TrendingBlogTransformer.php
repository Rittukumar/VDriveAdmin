<?php

use League\Fractal;

/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 24/01/16
 * Time: 10:24 PM
 */
class TrendingBlogTransformer extends Fractal\TransformerAbstract
{
    public function transform(EvezplaceTrendingBlog $evezplaceTrendingBlog)
    {
        return [
            'id'    => (int) $evezplaceTrendingBlog->id,
            'blog_id' => $evezplaceTrendingBlog->blog_id,
            'is_show_evezplace' => $evezplaceTrendingBlog->is_show_evezplace,
            'blog' => $evezplaceTrendingBlog->blog,
            'priority' => (int) $evezplaceTrendingBlog->priority,
            'evezown_section' => $evezplaceTrendingBlog->evezown_section,
        ];
    }
}