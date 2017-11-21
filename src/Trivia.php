<?php

namespace PragmaRX\Trivia;

class Trivia
{
    public function all()
    {
        return json_decode(__DIR__.'/database/trivia.json', true);
    }
}
