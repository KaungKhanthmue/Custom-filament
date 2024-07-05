<?php

namespace App\Filament\Pages;

use App\Models\Product as ModelsProduct;
use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Pages\Page;
use Livewire\Attributes\Computed;

class Product extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.product';

    #[Computed]
    public function ProductList()
    {
        $products = ModelsProduct::query()->paginate(10);
        return $products;
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->model(\App\Models\Product::class)
            ->label('Create Product')
            ->form([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                        ->required(),
                    Forms\Components\TextInput::make('description'),
                    Forms\Components\Select::make('category_id')
                        ->relationship('category','name'),
                    Forms\Components\Select::make('brand_id')
                        ->relationship('brand','name'),
                    Forms\Components\TextInput::make('price')
                        ->required()
                        ->numeric()
                    ])->columns(2)
            ])
        ];
    }
}