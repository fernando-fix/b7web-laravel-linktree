<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = [
            [
                'title' => 'Dark',
                'text_color' => '#ffffff',
                'bg_color1' => '#000000',
                'bg_color2' => '#000000',
                'angle' => '90',
            ],
            [
                'title' => 'Light',
                'text_color' => '#000000',
                'bg_color1' => '#ffffff',
                'bg_color2' => '#ffffff',
                'angle' => '90',
            ]
        ];

        foreach ($themes as $theme) {
            $foundTheme = Theme::where('title', $theme['title'])->first();
            if (!$foundTheme) {
                Theme::create($theme);
            }
        }
    }
}
