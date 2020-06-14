<?php
use App\Http\Helpers\Constants\Posts\Types;
use App\Http\Helpers\Constants\Socials;

return [
    'social_handles' => array(
        Socials::FACEBOOK => [
            'username' => 'itsadiidas',
        ],
        Socials::TWITTER => [
            'username' => 'Electric_Hawk',
        ],
        Socials::INSTAGRAM => [
            'username' => 'telenaut',
        ],
        Socials::YOUTUBE => [
            'username' => 'StephenRidleyTV',
        ],
        Socials::SOUNDCLOUD => [
            'username' => 'soundslikesprout',
        ],
        Socials::SPOTIFY => [
            'type' => 'artist',
            'uid' => '5LXoYRwmW0t66mFpPWJiha?si=ZMTNhCGWQOS0XbaDFePDbA',
        ],
    ),
    'assets' => array(
        Types::IMAGE => [
            'filename' => 'flowers.jpeg',
        ],
        Types::AUDIO => [
            'filename' => 'dubstep.mp3',
        ],
        Types::VIDEO => [
            'video_id' => '8e93be5dae47ac48c3c4993fd2a07e3f',
        ],
        Types::TEXT => [
            'value' => 'And then the day came,
            when the risk
            to remain tight
            in a bud
            was more painful
            than the risk
            it took
            to blossom.',
        ],
        Types::EMBEDDED_SOUNDCLOUD => [
            'song_slug' => 'good-feelin-feat-alan-watts',
        ],
    )
];