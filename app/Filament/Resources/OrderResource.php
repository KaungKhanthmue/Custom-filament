<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([   
                Fieldset::make()
                ->schema([
                    Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live()
                    ->afterStateUpdated(function (Set $set, $state, Get $get) { 
                        $set('orderName', $get('name'));
                    }),
                
                Forms\Components\Select::make('user_id')
                    ->options(fn() => User::whereNot('id',auth()->user()->id)->pluck('name','id') )
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (Set $set, $state, Get $get) { 
                        $user= User::find($get('user_id'));
                        $set('user', $user->name);
                        $set('email', $user->email);
                        $set('authUser',auth()->user()->name);
                    }),
                    Repeater::make('orderItems')
                    ->label("Products")
                    ->addActionLabel('Add Product')
                    ->relationship('orderItems')
                    ->live()
                    ->schema([
                        Select::make('product_id')
                            ->relationship('product', 'name')
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Set $set, $state, Get $get) {
                            }),
                    ])
                    ->afterStateHydrated(function (Set $set, $state, Get $get) {
                        // Debug the state after hydration
                        // dump('After Hydration', $state);
    
                        // Ensure the state is correctly populated
                        if (is_array($state)) {
                            foreach ($state as $key => $item) {
                                if (isset($item['product_id'])) {
                                    $product = Product::find($item['product_id']);
                                    if ($product) {
                                        $set('orderItems.' . $key . '.productName', $product->name);
                                    }
                                }
                            }
                        }
                    })
                    ->afterStateUpdated(function (Set $set, $state, Get $get) {
                        // Debug the state after update
                        $productX= [];
                        foreach ($state as $xx){
                            
                            $products = Product::find($xx['product_id']);
                            $productX[]=$products;
                        }
                        $set('productAll', $productX);
                    })
                        ->columnSpanFull()
                ])->columnSpan(2),
                Split::make([
                    ViewField::make('inventory')
                    ->columnSpanFull()
                    ->hiddenLabel()
                    ->view('filament.pages.inventory'),
                ])->columnSpan(2), 

            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
