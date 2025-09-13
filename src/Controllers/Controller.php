<?php

namespace Src\Controllers;

use Slim\Flash\Messages;
use Slim\Views\PhpRenderer;

class Controller
{
    public function __construct(
        protected PhpRenderer $renderer,
        protected Messages $flash,
    )
    {
    }
}