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
            [
                'filename' => 'test/birb.jpg',
            ],
            [
                'filename' => 'test/plane.jpg',
            ],
            [
                'filename' => 'test/portrait1.jpg',
            ],
            [
                'filename' => 'test/portrait2.jpg',
            ],
            [
                'filename' => 'test/shadow.jpg',
            ],
            [
                'filename' => 'test/train.jpg',
            ],
        ],
        Types::AUDIO => [
            [
                'filename' => 'dubstep.mp3',
            ],
        ],
        Types::VIDEO => [
            [
                'video_id' => '8e93be5dae47ac48c3c4993fd2a07e3f',
            ],
        ],
        Types::TEXT => [
            [
                'value' =>
                    'And then the day came,
                    when the risk
                    to remain tight
                    in a bud
                    was more painful
                    than the risk
                    it took
                    to blossom.',
            ],
            [
                'value' =>
                    'Be patient with life, despite its cruelty.
                    Often it seems careless of our pain,
                    But just as often brings us hope again.
                    
                    Remember, I wanted happiness for you.
                    Under every foolish word this still was true.
                    Be happy, then, without, as you would with me.
                    In your life many sweet events remain.
                    Not in anguish, but in joy remember me.',
            ],
            [
                'value' =>
                    'Why am I the mirror of your heart,
                    Reflecting without depth your deepest pain,
                    Revisiting your hell again, again,
                    As though you were a well-wrought work of art?
                    Why do I vicariously take part
                    In suffering you barely can sustain,
                    Witnessing your agony in vain,
                    Tracing chaos too profound to chart?
                    Each night obsessively I come to you,
                    Eager to devour your bitter fruit,
                    Uneasy through the doldrums of my day.
                    Watching is, alas, what I can do,
                    As though my gaze were contribution mute,
                    Sharing your unease in some small way.',
            ],
            [
                'value' =>
                    'For us there is no death.
                    Rest here merely bones.
                    Around you love\'s in flower,
                    Zero though our breath,
                    Etched into these stones.
                    Read and feel its power.',
            ],
            [
                'value' =>
                    'Sinners all, we ask for Your forgiveness
                    As we await the hour of Your return.
                    If only grace were something one could earn!
                    Nor can we hope to imitate Your goodness.
                    The saints know well the hopelessness of being
                    Put upon the pedestal of faith
                    As though we had already gained Your grace.
                    The heart is naked to Your restless seeking.
                    Regard us all, then, equally with love:
                    In saints and vicious pederasts find lovers,
                    Cherishing not one above the others,
                    Knowing none has anything to prove.',
            ],
            [
                'value' =>
                    'All I wanted was to find the truth,
                    Subtle and elusive though it be,
                    However insusceptible to proof,
                    Ever stranger than the world we see,
                    Revealed to us as probability.
                    
                    And so I found in humor a fit foil,
                    Rendering the world a tad askew.
                    I would with relish expectations roil,
                    And with a wry pun pertly turn the soil,
                    Not distant from a different kind of true.',
            ],
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