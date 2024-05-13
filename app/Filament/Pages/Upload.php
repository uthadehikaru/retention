<?php

namespace App\Filament\Pages;

use App\Imports\AgentImport;
use App\Imports\CustomerImport;
use App\Imports\InvoiceImport;
use App\Imports\PaymentImport;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Upload extends Page
{
    use WithFileUploads;
 
    public $file;
    public $data = 'agent';

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-tray';

    protected static ?string $navigationGroup = 'Admin';

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
        if($this->data==='agent')
            Excel::import(new AgentImport, $path);
        elseif($this->data==='customer')
            Excel::import(new CustomerImport, $path);
        elseif($this->data==='invoice')
            Excel::import(new InvoiceImport, $path);
        elseif($this->data==='payment')
            Excel::import(new PaymentImport, $path);
        else{
            Notification::make()
                ->title('Data '.$this->data.' not supported')
                ->danger()
                ->send();
            return;
        }

        Notification::make()
            ->title('Uploaded')
            ->success()
            ->send();
        $this->file = null;
    }
}
