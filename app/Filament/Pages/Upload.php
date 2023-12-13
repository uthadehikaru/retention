<?php

namespace App\Filament\Pages;

use App\Imports\AgentImport;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Upload extends Page
{
    use WithFileUploads;
 
    public $file;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-tray';

    protected static string $view = 'filament.pages.upload';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->is_admin;
    }

    public function submit()
    {
        if(!$this->file){
            Notification::make()
                ->title('No File found')
                ->danger()
                ->send();
            return;
        }

        $path = $this->file->store('uploads');
        Excel::import(new AgentImport, $path);
        Notification::make()
            ->title('Uploaded')
            ->success()
            ->send();
        $this->file = null;
    }
}
