<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
{
    return [
        'all' => Tab::make('All'),
        'Paid' => Tab::make('Paid')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'paid')),
        'Unpaid' => Tab::make('Unpaid')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'upaid')),
    ];
}
}