<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Actions\EditAction;
use Filament\Pages\Page;
use Livewire\Attributes\Computed;
use Filament\Forms;
use Filament\Support\Enums\ActionSize;

class Profile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.profile';

    #[Computed()]
    
    public function authUser()
    {
        $user = User::findOrFail(auth()->user()->id);
        return $user;
    }

    public function editAction()
    {
        return EditAction::make()
        ->name('edit')   
        ->color('info')
        ->model(User::class)
        ->label('edit')
        ->size(ActionSize::Large)
        ->record(function (array $arguments) 
        {
            $user = \App\Models\User::find($arguments['userId']);
            return $user;
        })
        ->form([
            Forms\Components\TextInput::make('name'),
            Forms\Components\TextInput::make('email'),
            Forms\Components\FileUpload::make('profile_image'),
            Forms\Components\FileUpload::make('cover_image'),
        ])
        ->after(function ($record) {
        });
    }
}