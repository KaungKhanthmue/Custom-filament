<?php

namespace App\Filament\Resources\LikeProductResource\Pages;

use App\Filament\Resources\LikeProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLikeProduct extends EditRecord
{
    protected static string $resource = LikeProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
