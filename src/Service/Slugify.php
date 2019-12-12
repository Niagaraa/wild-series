<?php


namespace App\Service;


class Slugify
{
    public function generate(string $input): string
    {
        $input = mb_strtolower(str_replace(' ', '-', $input));
        return $input;
    }
}