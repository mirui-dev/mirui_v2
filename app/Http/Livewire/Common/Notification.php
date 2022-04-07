<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class Notification extends Component
{
    public $notifications = [];
    public $count = 0;

    protected $listeners = [
        'common.notification.new' => 'newNotification',
        'common.notification.dismiss' => 'dismissNotification',
    ];
    
    public function render()
    {
        return view('livewire.common.notification');
    }

    public function newNotification($content, $color = false, $timeout = (5 * 1000)){
        $this->count++;
        $noti = [
            'count' => $this->count,
            'id' => 'global-noti-element-'.$this->count,
            'content' => $content,
            'color' => $color,
            'timeout' => $timeout, // * 1000,
        ];
        $this->notifications[$this->count] = $noti;
        // array_push($this->notifications, $noti);
        // dump($this->notifications);
        // dump($noti);
        // self::render();
        $this->dispatchBrowserEvent('common.notification.push', $noti);
    }

    public function dismissNotification($count = false){
        if($count){
            unset($this->notifications[$count]);
        }
    }

}
