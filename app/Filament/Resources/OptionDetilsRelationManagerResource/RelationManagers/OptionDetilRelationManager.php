<?php

namespace App\Filament\Resources\OptionDetilsRelationManagerResource\RelationManagers;

use App\Models\OptionDetil;
use App\Models\SubOption;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class OptionDetilRelationManager extends RelationManager
{
    protected static string $relationship = 'optionDetil';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('ItemID')
                    ->default($this->ownerRecord->id), // تعيين ItemID تلقائيًا
                Forms\Components\Select::make('POptID')
                    ->relationship('option', 'Name') // Assuming 'Name' is the field to display
                    ->required()
                    ->reactive()  // تحديد الحقل على أنه تفاعلي
                    ->afterStateUpdated(fn($set) => $set('OptID', null)),

                Forms\Components\Select::make('OptID')
                    ->relationship('subOption', 'Name') // Assuming 'Name' is the field to display
                    ->options(function (callable $get) {
                        $cityId = $get('POptID');  // الحصول على معرف المدينة المختارة
                        if (!$cityId) {
                            return [];  // إذا لم تكن هناك مدينة مختارة، لا تعرض شيئًا
                        }
                        return SubOption::where('OptID', $cityId)->pluck('name', 'id');  // جلب الزون المرتبطة بالمدينة
                    })
                    ->required(),





                Forms\Components\TextInput::make('AdditionalValue')
                    ->label('Additional Value'),
                // Forms\Components\TextInput::make('blob')
                //     ->label('Blob'),
            ]);
    }

   

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('option.Name')->label('Option Name'),
                Tables\Columns\TextColumn::make('subOption.Name')->label('Sub Option Name'),
                Tables\Columns\TextColumn::make('AdditionalValue')->label('Additional Value'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Action::make('accept')
                    ->label('Bulk Add')
                    ->button()
                    ->color('success')
                    // ->icon('heroicon-o-check')
                    ->modalHeading('Select Option')
                    ->action(function ($record, array $data) {
                        // dd($data['OptID']);

                        $record = $this->ownerRecord; // الحصول على السجل المحفوظ
                        // جلب جميع الخيارات الفرعية المرتبطة بـ POptID
                        $subOptions = SubOption::where('OptID', $data['OptID'])->get();
        
                        // إضافة كل خيار فرعي بالقيمة الافتراضية 0
                        foreach ($subOptions as $subOption) {
                            OptionDetil::create([
                                'POptID' => $data['OptID'],
                                'ItemID' => $this->ownerRecord->id,
                                'OptID' => $subOption->id,
                                'AdditionalValue' => 0, // القيمة الافتراضية
                            ]);
                        }
        
                    })
                    ->form([
                        Forms\Components\Select::make('OptID')
                            ->label('Item Option')
                            ->options(fn() => \App\Models\ItemOption::pluck('Name', 'id'))
                            ->required()
                            ->searchable()
                            ->placeholder('Select Option'),
                    ])
                    ->requiresConfirmation(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
