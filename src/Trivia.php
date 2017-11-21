<?php

namespace PragmaRX\Trivia;

class Trivia
{
    /**
     * Return all the trivia lines.
     *
     * @return mixed
     */
    public function all()
    {
        return coollect($this->load());
    }

    /**
     * Load the trivia database to array.
     *
     * @return mixed
     */
    protected function load()
    {
        return json_decode(
            file_get_contents(__DIR__ . '/../database/trivia.json'),
            true
        );
    }
}
