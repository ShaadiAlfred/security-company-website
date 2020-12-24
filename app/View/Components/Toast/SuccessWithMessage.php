<?php

namespace App\View\Components\Toast;

use Illuminate\View\Component;

class SuccessWithMessage extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.toast.success_with_message');
    }
}
