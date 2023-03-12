<?php

namespace App\View\Components\Css;

use Illuminate\View\Component;

class alerta extends Component{

    /**
     * 
     * public $backColor;           -> Alert background color
     * public $borderColor;         -> Alert border color
     * public $borderStyle;         -> Alert border style: solid, dotted
     * public $textColor;           -> Alert text color
     * public $iconName;            -> Alert icon name googleIconFont library
     * public $timeVisible;         -> Alert time to hide
     * public $timeInTransition;    -> Alert in transition time
     * public $timeOutTransition;   -> Alert out transition time
     *
     */
    public $backColor;
    public $backColorStrong;
    public $borderColor;
    public $borderStyle;
    public $textColor;
    public $iconName;
    public $timeVisible;
    public $timeInTransition;
    public $timeOutTransition;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( 
                                $backColor          = "orange",
                                $backColorStrong    = "300",
                                $borderColor        = "",
                                $borderStyle        = "solid",
                                $textColor          = "grey",
                                $iconName           = "info",
                                $timeVisible        = 4500,
                                $timeInTransition   = 1000,
                                $timeOutTransition  = 1000
                            ){

        $this->backColor            = $backColor;
        $this->backColorStrong      = $backColorStrong;
        $this->borderColor          = $borderColor;
        $this->borderStyle          = $borderStyle;
        $this->textColor            = $textColor;
        $this->iconName             = $iconName;
        $this->timeVisible          = $timeVisible;
        $this->timeInTransition     = $timeInTransition;
        $this->timeOutTransition    = $timeOutTransition;
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(){
        
        return view('components.css.alerta');
    }
}
