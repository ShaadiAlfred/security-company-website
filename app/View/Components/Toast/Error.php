<?php

namespace App\View\Components\Toast;

use Illuminate\View\Component;

class Error extends Component
{
    /**
     * Error message
     */
    public string $message;

    /**
     * Show the toast automatically
     */
    public bool $automaticTrigger;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $message, bool $automaticTrigger = false)
    {
        $this->message          = trans($message);
        $this->automaticTrigger = $automaticTrigger;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.toast.error');
    }
}
