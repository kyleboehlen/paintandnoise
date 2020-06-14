<?php
use App\Http\Helpers\Constants\Categories;

return [
    'colors' => [ // For ENUM values
        Categories::MUSIC => 'red',
        Categories::VISUAL_ART_2D => 'violet',
        Categories::VISUAL_ART_3D => 'indigo',
        Categories::DIGITAL_ART => 'blue',
        Categories::PERFORMANCE_ART => 'orange',
        Categories::WRITTEN_ART => 'green',
        Categories::BODY_ART => 'yellow',
    ],
    'slugs' => [
        // Parent Categories
        Categories::MUSIC => 'music',
        Categories::VISUAL_ART_2D => 'visual-art-2d',
        Categories::VISUAL_ART_3D => 'visual-art-3d',
        Categories::DIGITAL_ART => 'digital-art',
        Categories::PERFORMANCE_ART => 'performance-art',
        Categories::WRITTEN_ART => 'written-art',
        Categories::BODY_ART => 'body-art',
        
        // Music Sub Categories
        Categories::EDM => 'edm',
        Categories::RAP_HIP_HOP => 'rap-hip-hop',
        Categories::R_AND_B => 'r-and-b',
        Categories::POP => 'pop',
        Categories::INDIE => 'indie',
        Categories::REGGAE => 'reggae',
        Categories::ALTERNATIVE => 'alternative',
        Categories::ROCK => 'rock',
        Categories::METAL => 'metal',
        Categories::PUNK => 'punk',

        // Digital Art Sub Categories
        Categories::PHOTOGRAPHY => 'photography',
        Categories::GRAPHIC_DESIGN => 'graphic-design',
        Categories::VIDEOGRAPHY => 'vidography',
    ],
];