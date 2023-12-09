<?php
namespace App\Http\Responses;

use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;
 
class LoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        if (Filament::getCurrentPanel()->getId() === 'admin') {
            return redirect()->to('admin');
        }
 
        if (Filament::getCurrentPanel()->getId() === 'agent') {
            return redirect()->to('agent');
        }
 
        return parent::toResponse($request);
    }
}