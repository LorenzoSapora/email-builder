<?php

namespace LorenzoSapora\EmailBuilder\Layouts;

use LorenzoSapora\EmailBuilder\Flexible;

abstract class Preset
{
    /**
     * Execute the preset configuration
     *
     * @return void
     */
    abstract public function handle(Flexible $field);

}
