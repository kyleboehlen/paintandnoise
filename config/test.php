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
    ),
    'word_list' => array(
        'art'        , 'music'   , 'question', 'if'       , 'will'    , 'how'    , 'new'    ,
        'and'        , 'when'    , 'paint'   , 'noise'    , 'account' , 'set'    , 'spotify',
        'up'         , 'events'  , 'near'    , 'me'       , 'log'     , 'in'     , 'out'    ,
        'artist'     , 'sign'    , 'up'      , 'email'    , 'kyle'    , 'jody'   , 'unity'  ,
        'platform'   , 'discover', 'edm'     , 'community', 'inspired', 'respect', 'always' ,
        'do'         , 'we'      , 'support' , 'collab'   , 'good'    , 'share'  , 'post'   ,
        'browse'     , 'need'    , 'fresh'   , 'content'  , 'social'  , 'media'  , 'update' ,
        'underground', 'cost'    , 'free'    , 'team'     , 'love'    , 'peace'  , 'app'    ,
    ),
    'min_test_users' => env('MIN_TEST_USERS'),
    'max_test_users' => env('MAX_TEST_USERS'),
    'min_percent_users_post' => env('MIN_PERCENT_POSTERS') / 100,
    'max_percent_users_post' => env('MAX_PERCENT_POSTERS') / 100,
    'min_percent_posters_post' => env('MIN_PERCENT_POSTS') / 100,
    'max_percent_posters_post' => env('MAX_PERCENT_POSTS') / 100,
];