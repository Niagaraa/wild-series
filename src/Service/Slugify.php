<?php


namespace App\Service;


class Slugify
{
    public function generate(string $input): string
    {
        $input = strtolower(str_replace(' ', '-', $input));
        $input = str_replace('--', '-', $input);

        return $input;
    }

}