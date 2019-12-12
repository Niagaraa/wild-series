<?php


namespace App\Service;


class Slugify
{
    public function generate(string $input): string
    {
        $input = str_replace(' ', '-', $input);
        return $input;
    }
}