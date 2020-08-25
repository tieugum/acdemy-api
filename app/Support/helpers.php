<?php
if (!function_exists('slugify')) {
    function slugify($value)
    {
        $slug = preg_replace('/[\s<>[\]{}|\\^%&\$,\/:;=?@#\'\"]/', '-', mb_strtolower($value));

        $slug = preg_replace('/-+/', '-', $slug);

        return trim($slug, '!"#$%&\'()*+,-./:;<=>?@[]^_`{|}~');
    }
}
