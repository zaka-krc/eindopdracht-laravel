<?php

namespace Database\Seeders;

use App\Models\GameInterest;
use Illuminate\Database\Seeder;

class GameInterestSeeder extends Seeder
{
    public function run(): void
    {
        $interests = [
            ['name' => 'First Person Shooter', 'slug' => 'fps', 'description' => 'FPS games zoals Call of Duty, Counter-Strike', 'color' => '#ef4444'],
            ['name' => 'Role Playing Games', 'slug' => 'rpg', 'description' => 'RPG games zoals The Witcher, Final Fantasy', 'color' => '#8b5cf6'],
            ['name' => 'Strategy Games', 'slug' => 'strategy', 'description' => 'Strategy games zoals Age of Empires, Civilization', 'color' => '#06b6d4'],
            ['name' => 'Sports Games', 'slug' => 'sports', 'description' => 'Sportgames zoals FIFA, NBA 2K', 'color' => '#22c55e'],
            ['name' => 'Racing Games', 'slug' => 'racing', 'description' => 'Race games zoals Forza, Gran Turismo', 'color' => '#f59e0b'],
            ['name' => 'Horror Games', 'slug' => 'horror', 'description' => 'Griezelige games zoals Resident Evil, Silent Hill', 'color' => '#1f2937'],
            ['name' => 'Indie Games', 'slug' => 'indie', 'description' => 'Onafhankelijke games van kleinere developers', 'color' => '#ec4899'],
            ['name' => 'MMO Games', 'slug' => 'mmo', 'description' => 'Multiplayer online games zoals World of Warcraft', 'color' => '#3b82f6'],
        ];

        foreach ($interests as $interest) {
            // Gebruik updateOrCreate om duplicaten te voorkomen
            GameInterest::updateOrCreate(
                ['slug' => $interest['slug']], // Zoek op slug
                $interest // Update of create met deze data
            );
        }
    }
}