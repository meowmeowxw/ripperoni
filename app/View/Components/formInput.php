<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formInput extends Component
{

    /**
     * The name of input.
     *
     * @var string
     */
    public $message;

    /**
     * The currentName.
     *
     * @var string
     */
    public $lblName;

    /**
     * The currentName.
     *
     * @var string
     */
    public $name;

    /**
     * The currentName.
     *
     * @var string
     */
    public $type;

    /**
     * Create the component instance.
     *
     * @param string $message
     * @param string $lblName
     * @param string $name
     * @param string $type
     */
    public function __construct(string $message, string $lblName, string $name, string $type)
    {
        $this->message = $message;
        $this->lblName = $lblName;
        $this->name = $name;
        $this->type = $type;
    }


    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.formInput');
    }
}
