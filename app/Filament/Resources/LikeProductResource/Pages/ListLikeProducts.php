<?php

namespace App\Filament\Resources\LikeProductResource\Pages;

use App\Filament\Resources\LikeProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLikeProducts extends ListRecords
{
    protected static string $resource = LikeProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
