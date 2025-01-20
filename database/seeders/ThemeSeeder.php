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
                'title' => 'Default',
                'btn_color' => '#161818',
                'text_color' => '#ffffff',
                'bg_color1' => '#000000',
                'bg_color2' => '#00008b',
                'angle' => '90',
            ],
            [
                'title' => 'Dark',
                'btn_color' => '#161818',
                'text_color' => '#ffffff',
                'bg_color1' => '#222222',
                'bg_color2' => '#222222',
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
