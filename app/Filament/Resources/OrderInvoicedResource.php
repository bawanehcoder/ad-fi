<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderInvoicedResource\Pages;
use App\Filament\Resources\OrderAcceptResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\OrderDetailsRelationManager;
use App\Models\Branche;
use App\Models\Order;
use App\Models\OrderAccept;
use App\Models\OrderInvoiced;
use App\Models\User;
use App\Models\Zones;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Str;

class OrderInvoicedResource extends Resource
{
    protected static ?string $model = OrderInvoiced::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Orders';
    protected static ?string $navigationLabel = 'Invoiced';

    protected static ?int $navigationSort = 18;

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->branch_id) {

            return static::getModel()::query()->where('status', 4)->where('BranchID', auth()->user()->branch_id);
        }
        return static::getModel()::query()->where('status', 4);
    }

    public static function getNavigationBadge(): ?string
    {
        if (auth()->user()->branch_id) {

            return count(Order::where('status', 4)->where('BranchID', auth()->user()->branch_id)->get());
        }
        return count(Order::where('status', 4)->get());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('Phone')->label('Phone Number')
                    ->live(debounce: 400)
                    ->autocomplete('off')
                    ->datalist(options: function (?string $state, Forms\Components\TextInput $component, ?Order $record, $modelsearch = '\App\Models\User', $fieldsearch = 'phone') {
                        //get options from database using where and (ilike I'm a postgresql fan)
                        $options = [];
                        if ($state != null and Str::length($state) >= 3) {
                            $options = $modelsearch::where($fieldsearch, 'like', '%' . $state . '%')
                                ->limit(20)
                                ->pluck('phone')
                                ->toarray();
                            //send options to datalist
            
                        }
                        return $options;
                    })
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state) {
                        $user = User::where('phone', $state)->first();
                        // dd($state);
                        if ($user) {

                            $set('Name', $user?->name); // ضبط الاسم بناءً على الهاتف المختار
                        }
                        if ($state == '') {
                            $set('Name', '');
                        }
                    }),

                Forms\Components\TextInput::make('Name')
                    ->required(),


                Hidden::make('UserID')->default(151),
                Hidden::make('callc')->default(0),
                Forms\Components\Select::make('delivery_type')
                    ->options([
                        'personal_pickup' => 'Personal Pickup',
                        'delivery_address' => 'Delivery Address',
                    ])
                    ->required()
                    ->reactive(), // لتفعيل التفاعل الديناميكي

                Select::make('ZoneID')
                    ->searchable()
                    ->getOptionLabelUsing(fn($value): ?string => Zones::find($value)?->AddresAr)
                    ->getSearchResultsUsing(function (string $search) {
                        return Zones::where('AddresEn', 'LIKE', '%' . $search . '%')

                            ->orWhere('AddresAr', 'LIKE', '%' . $search . '%')
                            ->get()
                            ->mapWithKeys(function ($item) {
                                return [
                                    $item->id => "<div style='display: flex; align-items: center;'>
                                        <span>{$item->AddresAr}</span>
                                        -
                                        <span>{$item->delivery}</span>
                                      </div>",
                                ];
                            })->toArray();
                    })->allowHtml()
                    ->reactive()
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $zoneID = $get('ZoneID');

                        $z = Zones::find($zoneID);

                        // تحديث حقل السعر بالسعر الإجمالي
                        $set('zone.delivery', $z->delivery);

                    })
                    ->visible(fn(callable $get) => $get('delivery_type') === 'delivery_address'), // يظهر إذا كان نوع الطلب delivery_address

                Forms\Components\Select::make('BranchID')
                    ->label('Branch')
                    ->relationship('branch', 'AddresEn')
                    ->required()
                    ->searchable()
                    ->visible(fn(callable $get) => $get('delivery_type') === 'personal_pickup'), // يظهر إذا كان نوع الطلب personal_pickup
                Forms\Components\DatePicker::make('OrderDate')
                    ->native(false)
                    ->required(),

                Forms\Components\TimePicker::make('DeliveryTime')
                    ->native(false)
                    ->displayFormat('H:i')
                    ->required(),


                Forms\Components\Select::make('action_type')
                    ->label('Action Type') // تسمية الخانة
                    ->options([
                        'cash' => 'cash',
                        'deposit' => 'Deposit', // خيار الإيداع
                        'full' => 'full', // خيار آخر كمثال
                    ])
                    ->default('cash')
                    ->required()
                    ->reactive(), // لتفعيل التفاعل الديناميكي

                Forms\Components\TextInput::make('deposit_amount')
                    ->label('Deposit Amount') // تسمية الحقل
                    ->numeric() // تأكد من أن الإدخال رقم
                    ->required(fn(callable $get) => $get('action_type') === 'deposit') // اجعل الحقل مطلوبًا إذا كان الخيار "ديبوست"
                    ->visible(fn(callable $get) => $get('action_type') === 'deposit') // يظهر فقط إذا كان الخيار "ديبوست"
                    ->placeholder('Enter the deposit amount'), // نص إرشادي

                Forms\Components\Textarea::make('Note'),
                Forms\Components\TextInput::make('Total')
                    ->label('Total Amount')
                    ->readOnly(),
                Forms\Components\TextInput::make('zone.delivery')
                    ->label('delivery')
                    ->readOnly(),
                Forms\Components\TextInput::make('add_value'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->searchable(),

                Tables\Columns\TextColumn::make('OrderDate')->label('Order Date'),
                Tables\Columns\TextColumn::make('DeliveryTime')->label('Delivery Time'),
                Tables\Columns\TextColumn::make('Name')->label('Customer Name'),
                Tables\Columns\TextColumn::make('Phone')->label('Phone'),
                Tables\Columns\TextColumn::make('invoice_number')->label('Invoice'),
                Tables\Columns\TextColumn::make('Total')->label('Total Amount'),
                Tables\Columns\TextColumn::make('Source')->label('Source'),
                Tables\Columns\TextColumn::make('branch.AddresAr')->label('Branch'),
                Tables\Columns\TextColumn::make('user.name')->label('By'),

                Tables\Columns\TextColumn::make('updated_at')->label('Last Update'),

                Tables\Columns\TextColumn::make('Status')->label('Status'),
                Tables\Columns\TextColumn::make('PaymentMethod')->label('Payment Method'),
            ])
            ->filters([


                Filter::make('created_at')
                    ->form([
                        Forms\Components\Select::make('zone')
                            ->searchable(true)
                            ->preload(true)
                            ->options(fn() => Zones::pluck('AddresEn', 'id')),

                        Forms\Components\Select::make('Branch')
                            ->searchable(true)
                            ->preload(true)
                            ->options(fn() => Branche::pluck('AddresEn', 'id')),

                        TextInput::make('name'),
                        Forms\Components\Select::make('delivery_type')
                            ->options([
                                'personal_pickup' => 'Personal Pickup',
                                'delivery_address' => 'Delivery Address',
                            ]),
                        TextInput::make('phone_number'),
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                        DatePicker::make('del_from')->label('Delivery Form'),
                        DatePicker::make('del_until')->label('Delivery Until'),
                    ])->columnSpan(5)->columns(3)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query

                            ->when(
                                $data['zone'],
                                fn(Builder $query, $date): Builder => $query->where(
                                    'ZoneID',
                                    '=',
                                    $data['zone'],
                                ),
                            )

                            ->when(
                                $data['Branch'],
                                fn(Builder $query, $date): Builder => $query->where(
                                    'BranchID',
                                    '=',
                                    $data['Branch'],
                                ),
                            )

                            ->when(
                                $data['name'],
                                fn(Builder $query, $date): Builder => $query->where(
                                    'name',
                                    'LIKE',
                                    "%{$data['name']}%",
                                ),
                            )

                            ->when(
                                $data['phone_number'],
                                fn(Builder $query, $date): Builder => $query->where(
                                    'phone',
                                    'LIKE',
                                    "%{$data['phone_number']}%",
                                ),
                            )

                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })

            ], FiltersLayout::AboveContent)
            ->actions([
                // Tables\Actions\EditAction::make(),

                // Action::make('invoice')
                //     ->label('Invoice')
                //     ->button()
                //     ->color('info')
                //     ->icon('heroicon-o-check')
                //     ->modalHeading('Invoice Number')
                //     ->action(function ($record, array $data) {
                //         $record->update([
                //             'Status' => 'invoiced',
                //             // 'BranchID' => $data['branch_id'],
                //         ]);
                //     })
                //     ->form([
                //         TextInput::make('Invoice'),
                //     ])
                //     ->requiresConfirmation(),
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
            OrderDetailsRelationManager::class

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrderInvoiceds::route('/'),
            // 'create' => Pages\CreateOrderInvoiced::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }
}
