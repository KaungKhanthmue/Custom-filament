<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function afterCreate(): void
    {

        $prcie= [];
        foreach ($this->record->orderItems as $item){
            $prcie[]=$item->product->price;
        }
        $total = array_sum($prcie);
        $this->record->update([
            'total_price' => $total,
        ]);
        
    }
}
