<?php

namespace App\Filament\Pages;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Actions;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Components\TextEntry;
use Filament\Pages\Page;
use Livewire\Attributes\Computed;
use Filament\Infolists\Components\ViewEntry;
use Livewire\WithPagination;


class Invoice extends Page
{
    use WithPagination;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static string $view = 'filament.pages.invoice';
    


 
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->model(Order::class)
                ->outlined()
                ->label('Invoice Add')
                ->form([
                    Grid::make()
                        ->live()
                        ->schema([
                            Grid::make()
                                ->live()
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->required()
                                        ->maxLength(255)
                                        ->live()
                                        ->afterStateUpdated(function (Set $set, $state, Get $get) { 
                                            $set('orderName', $get('name'));
                                        })->columnSpanFull(),
                            
                                    Forms\Components\Select::make('user_id')
                                        ->options(fn() => User::whereNot('id', auth()->user()->id)->pluck('name', 'id'))
                                        ->required()
                                        ->live()
                                        ->afterStateUpdated(function (Set $set, $state, Get $get) { 
                                            $user = User::find($get('user_id'));
                                            if ($user) {
                                                $set('user', $user->name);
                                                $set('email', $user->email);
                                                $set('authUser', auth()->user()->name);
                                            }
                                        })->createOptionForm([
                                            Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('email')
                                            ->email()
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('password')
                                            ->password()
                                            ->required()
                                            ->maxLength(255),
                                       Forms\Components\FileUpload::make('image_url')
                                       ->disk('public')
                                       ->directory('user-images')
                                       ->visibility('public')
                                        ])->columnSpanFull(),
                                    
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
                                        ])
                                        ->afterStateUpdated(function (Set $set, $state, Get $get) {
                                            $productX = [];
                                            foreach ($state as $xx) {
                                                $products = Product::find($xx['product_id']);
                                                if ($products) {
                                                    $productX[] = $products;
                                                }
                                            }

                                            $set('productAll', $productX);
                                        })
                                        ->columnSpanFull()
                                ])->columnSpan(2),
    
                            Split::make(function(Get $get){

                                return [
                                ViewField::make('inventory')
                                    ->columnSpanFull()
                                    ->hiddenLabel()
                                    ->afterStateUpdated(function(Set $set,$state,Get $get,)
                                    {
                                        dump($state);
                                    })
                                    ->view('filament.pages.invoiceCreate',[
                                        'name' => $get('name'),
                                        'customer'=>$get('user'),
                                        'email' => $get('email'),
                                        'authUser' => $get('authUser'),
                                        'productAll' => $get('productAll'),
                                    ])
                                    ];})->columnSpan(2), 
                        ])->columns(4)
                ])
                ->after(function ($record) {
                    $prcie= [];
                    foreach ($record->orderItems as $item){
                        $prcie[]=$item->product->price;
                    }
                    $total = array_sum($prcie);
                    $record->update([
                        'total_price' => $total,
                    ]);
                }),
        ];
    }
    
    public function editAction()
    {
        return EditAction::make()
        ->name('edit')
        ->outlined()   
        ->model(User::class)
        ->label('edit')
        ->model(Order::class)
        ->record(function (array $arguments) 
        {
            $order = \App\Models\Order::find($arguments['orderId']);
            return $order;
        })
        ->form([
            Grid::make()
            ->live()
            ->schema([

                Fieldset::make()
                    ->live()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live()
                            ->afterStateUpdated(function (Set $set, $state, Get $get) { 
                                $set('orderName', $get('name'));
                            })->columnSpanFull(),
                
                        Forms\Components\Select::make('user_id')
                            ->options(fn() => User::whereNot('id', auth()->user()->id)->pluck('name', 'id'))
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Set $set, $state, Get $get) { 
                               $set('userIdEdit', $get('user_id'));
                            })->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('email')
                                ->email()
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('password')
                                ->password()
                                ->required()
                                ->maxLength(255),
                           Forms\Components\FileUpload::make('image_url')
                           ->disk('public')
                           ->directory('user-images')
                           ->visibility('public')
                            ])->columnSpanFull(),
                        
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
                            ])
                            ->afterStateUpdated(function (Set $set, $state, Get $get) {
                                $productX = [];
                                foreach ($state as $xx) {
                                    $products = Product::find($xx['product_id']);
                                    if ($products) {
                                        $productX[] = $products;
                                    }
                                }

                                $set('productAll', $productX);
                            })
                            ->columnSpanFull()
                    ])->columnSpan(2),

                Split::make(function(Get $get){

                    return [
                    ViewField::make('inventory')
                        ->columnSpanFull()
                        ->hiddenLabel()
                        ->afterStateUpdated(function(Set $set,$state,Get $get,)
                        {
                            
                        })
                        ->view('filament.pages.invoiceEdit',[
                            'userId'    =>$get('user_id'),
                            'productId' =>$get('product_id'),
                            'name' => $get('name'),
                            'customer'=>$get('user'),
                            'email' => $get('email'),
                            'authUser' => $get('authUser'),
                            'productAll' => $get('productAll'),
                        ])
                        ];})->columnSpan(2), 
            ])->columns(4)
    ])
    ->after(function ($record) {
        $prcie= [];
        foreach ($record->orderItems as $item){
            $prcie[]=$item->product->price;
        }
        $total = array_sum($prcie);
        $record->update([
            'total_price' => $total,
        ]);
    });

    }

    public function deleteAction()
    {
        return DeleteAction::make()
        ->color('info')
        ->outlined()   
        ->model(Order::class)
        ->record(function (array $arguments) 
        {
            $order = \App\Models\Order::find($arguments['orderId']);
            return $order;
        });
    }
    public function viewAction()
    {
        return ViewAction::make()
        ->model(Order::class)
        ->record(function (array $arguments) 
        {
            $order = \App\Models\Order::find($arguments['orderId']);
            return $order;
        })->infolist(
            function(array $arguments){
            return [
            ViewEntry::make('status')
            ->view('filament.pages.invoiceView',[
            'orderId'=> $arguments,
            ])

        ];}
    );
    }
    



    #[Computed()]

    public function orderData()
    {

        $aa = Order::query()->with('user')->paginate(1);
        return $aa;
    }

}
