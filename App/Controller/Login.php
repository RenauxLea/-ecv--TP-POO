<?php

declare(strict_types=1);

namespace App\Controller;

class Login implements Controller
{
    public function render(): void
    {
        $_SESSION['is_connected'] = true;
    }
}
