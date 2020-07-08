<?php

namespace App\Http\Helpers\Fakers;

use Faker\Provider\Lorem;

class FaqFaker extends Lorem
{
    // Override parent::word in order to use the custom word list in config('test')
    public static function word($override_word_list = false)
    {
        if($override_word_list)
        {
            return static::randomElement(config('test')['word_list']);
        }

        return parent::word();
    }

    // Override parent::words in order to be able to pass $override_word_list to self::word
    public static function words($nb_words = 3, $as_text = false, $override_word_list = false)
    {
        if($override_word_list)
        {
            $words = array();
            for ($i=0; $i < $nb_words; $i++) {
                $words []= static::word($override_word_list);
            }

            return $as_text ? implode(' ', $words) : $words;
        }

        return parent::words($nb_words, $as_text);
    }

    // Works just like parent::words except it captilizes the first letter and appends a question mark
    public function question($nb_words = 12, $variable_nb_words = true)
    {
        if($variable_nb_words)
        {
            $nb_words = parent::randomizeNbElements($nb_words);
        }

        return ucfirst(self::words($nb_words, true, true) . '?');
    }
}