<?php

namespace App\Filament\Resources;

use App\Events\MyEvent;
use App\Filament\Resources\OrderResource\RelationManagers\OrderDetailsRelationManager;
use App\Filament\Resources\SupportOrderResource\Pages;
use App\Filament\Resources\SupportOrderResource\RelationManagers;
use App\Models\Branche;
use App\Models\Order;
use App\Models\Permission;
use App\Models\SupportOrder;
use App\Models\User;
use App\Models\Zones;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use HusamTariq\FilamentTimePicker\Forms\Components\TimePickerField;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Str;
use Filament\Notifications\Notification;


class SupportOrderResource extends Resource implements HasShieldPermissions
{

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
            'accept',
            'reject'
        ];
    }
    protected static ?string $model = SupportOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Orders';
    protected static ?string $navigationLabel = 'Call Center';

    protected static ?int $navigationSort = 16;


    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('status', 0)->where('callc', 1)->orderBy('id', 'desc');
    }
    public static function getNavigationBadge(): ?string
    {
        return count(Order::where('status', 0)->where('callc', 1)->get());
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
                            if (empty($options)) {
                                $options = Order::where('Phone', 'like', '%' . $state . '%')
                                    ->limit(20)
                                    ->pluck('Phone')
                                    ->toarray();
                            }
                            //send options to datalist
            
                        }
                        return $options;
                    })
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state) {

                        $user = User::where('phone', $state)->first();

                        // dd($user?->name);
            
                        if ($user?->name == null) {

                            $user2 = Order::where('Phone', $state)->first();
                        }

                        // dd($state);
                        if ($user) {

                            $set('Name', $user?->name); // ضبط الاسم بناءً على الهاتف المختار
                        }
                        if ($user?->name == null) {

                            if ($user2) {

                                $set('Name', $user2?->Name); // ضبط الاسم بناءً على الهاتف المختار
                            }
                        }


                        if ($state == '') {
                            $set('Name', '');
                        }
                    }),

                Forms\Components\TextInput::make('Name')
                    ->required(),


                Hidden::make('UserID')->default(state: auth()->user()->id),
                Hidden::make('callc')->default(1),
                Hidden::make('Source')->default(4),
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
                                            <span>{$item->AddresAr}</span>-
                                            <span>{$item->AddresEn}</span>
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
                        $set('ZonePrice', $z->delivery);

                    })
                    ->visible(fn(callable $get) => $get('delivery_type') === 'delivery_address'), // يظهر إذا كان نوع الطلب delivery_address

                Forms\Components\Select::make('BranchID')
                    ->label('Branch')

                    ->options(Branche::all()->pluck('AddresAr', 'id'))

                    ->required()
                    ->searchable()
                    ->getOptionLabelUsing(fn($value): ?string => Branche::find($value)?->AddresAr)
                    ->getSearchResultsUsing(function (string $search) {

                        return Branche::where('AddresEn', 'LIKE', '%' . $search . '%')

                            ->orWhere('AddresAr', 'LIKE', '%' . $search . '%')
                            ->get()
                            ->mapWithKeys(function ($item) {
                                return [
                                    $item->id => "<div style='display: flex; align-items: center;'>
                                            <span>{$item->AddresAr}</span>-
                                            <span>{$item->AddresEn}</span>
                                            
                                          </div>",
                                ];
                            })->toArray();
                    })->allowHtml()
                    ->visible(fn(callable $get) => $get('delivery_type') === 'personal_pickup'), // يظهر إذا كان نوع الطلب personal_pickup
                Forms\Components\DatePicker::make('OrderDate')
                    ->native(false)
                    ->minDate(today())
                    ->required(),

                Forms\Components\TimePicker::make('DeliveryTime')
                    ->native(true)
                    ->displayFormat('H:i')
                    ->required(),
            // TimePicker ::make('DeliveryTime')->label('time')->okLabel("Confirm")->cancelLabel("Cancel"),



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
                Forms\Components\Hidden::make('ZonePrice')
                    ->label('delivery')
                    ->default(0),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('5s')
            ->columns([
                Tables\Columns\TextColumn::make('id')->searchable(),

                // Tables\Columns\TextColumn::make('user.name')->label('User ID'),
                // Tables\Columns\TextColumn::make('zone.name')->label('Zone ID'),
                // Tables\Columns\TextColumn::make('delivery_type')->label('Delivery Type'),
                Tables\Columns\TextColumn::make('OrderDate')->label('Order Date'),
                Tables\Columns\TextColumn::make('DeliveryTime')->label('Delivery Time'),
                Tables\Columns\TextColumn::make('Name')->label('Customer Name'),
                Tables\Columns\TextColumn::make('Phone')->label('Phone'),
                Tables\Columns\TextColumn::make('user.name')->label('By'),
                // Tables\Columns\TextColumn::make('Phone2')->label('Alternate Phone'),
                // Tables\Columns\TextColumn::make('address')->label('Address'),
                // Tables\Columns\TextColumn::make('ZonePrice')->label('Zone Price'),
                Tables\Columns\TextColumn::make('Total')->label('Total Amount'),
                Tables\Columns\TextColumn::make('Source')->label('Source'),
                Tables\Columns\TextColumn::make('Status')->label('Status'),
                Tables\Columns\TextColumn::make('PaymentMethod')->label('Payment Method'),
                // Tables\Columns\TextColumn::make('PaymentStatus')->label('Payment Status'),
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

                Action::make('accept')
                    ->label('Accept')
                    ->button()
                    ->hidden(!auth()->user()->can('accept_support::order', Permission::class))
                    ->color('success')
                    ->icon('heroicon-o-check')
                    ->modalHeading('Select Branch')
                    ->action(function ($record, array $data) {

                        event(new MyEvent($data['branch_id']));

                        $record->update([
                            'Status' => 'accepted',
                            'BranchID' => $data['branch_id'],
                        ]);

                        $users = User::where('branch_id', $data['branch_id'])->get();
                        // \Log::info('Syncing categories');
                        foreach ($users as $recipient) {
                            \Log::info($recipient->toArray());
                            Notification::make()
                                ->title('New Order #' . $record->id)
                                ->sendToDatabase($recipient);
                        }
                    })
                    ->form([
                        Forms\Components\Select::make('branch_id')
                            ->label('Branch')
                            ->options(fn() => \App\Models\Branche::pluck('AddresEn', 'id'))
                            ->required()
                            ->searchable()
                            ->placeholder('Select Branch'),
                    ])
                    ->requiresConfirmation(),

                Action::make('reject')
                    ->label('Reject')
                    ->hidden(!auth()->user()->can('reject_support::order', Permission::class))

                    ->button()
                    ->color('danger')
                    ->icon('heroicon-o-exclamation-triangle')
                    // ->modalHeading('Select Branch')
                    ->action(function ($record, array $data) {
                        $record->update([
                            'Status' => 'rejected',
                            'Note' => $data['Note'],
                        ]);
                    })
                    ->form([
                        Textarea::make('Note')
                    ])
                    ->requiresConfirmation(),
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
            'index' => Pages\ListSupportOrders::route('/'),
            'create' => Pages\CreateSupportOrder::route('/create'),
            'edit' => Pages\EditSupportOrder::route('/{record}/edit'),
        ];
    }
}
