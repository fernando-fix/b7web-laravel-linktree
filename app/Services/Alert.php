<?php

namespace App\Services;

class Alert
{
    public function success($message)
    {
        session()->flash('alert.success', $message);
        return $this;
    }

    public function error($message)
    {
        session()->flash('alert.error', $message);
        return $this;
    }

    public function warning($message)
    {
        session()->flash('alert.warning', $message);
        return $this;
    }

    public function info($message)
    {
        session()->flash('alert.info', $message);
        return $this;
    }
}
