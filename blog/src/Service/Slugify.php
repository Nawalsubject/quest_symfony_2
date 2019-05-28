<?php


namespace App\Service;


class Slugify
{
    public function generate(string $input) :string
    {
        setlocale(LC_ALL, 'fr_FR');
        $slug= mb_strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $input));
        $slug=  preg_replace( '/[^a-zA-Z0-9\-\s]/', '', $slug );
        $slug= str_replace(" ","-",trim($slug));
        $slug= preg_replace('/([-])\\1+/', '$1', $slug);

        return $slug;
    }
}