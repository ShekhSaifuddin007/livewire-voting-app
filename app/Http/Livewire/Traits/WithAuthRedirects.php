<?php

namespace App\Http\Livewire\Traits;

trait WithAuthRedirects
{
    public function redirectToIntended($route = 'login')
    {
        redirect()->setIntendedUrl(url()->previous());

        return redirect()->route($route);
    }
}
