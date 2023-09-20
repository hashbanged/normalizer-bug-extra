<?php

namespace App\Service;

class UserDataProvider
{
    public function getData(): array
    {
        return [
            'first_name' => 'Giovanni',
            'last_name' => 'Kapsberger',
            'profile' => [
                'publications' => [
                    "Libro terzo d'arie passeggiate",
                    "Libro quarto d'intavolatura di chitarrone",
                ],
            ],
        ];
    }
}
