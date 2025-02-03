<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DeleteButton extends Component
{
    public $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function render()
    {
        return view('components.delete-button');
    }
}