<?php

declare(strict_types=1);

namespace App\Controller;

class Welcome implements Controller
{
    public function render(): void
    {
        echo 'Welcome';
    }
}
