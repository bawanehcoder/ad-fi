<?php

namespace App\Filament\Resources\SubCategoriesResource\RelationManagers;

use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'categories';

    protected static ?string $title = 'Sub Categories';


    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
            SpatieMediaLibraryFileUpload::make('image')->collection('categories'),

                Forms\Components\TextInput::make('Name')
                    ->required(),
                Forms\Components\TextInput::make('NameEN')
                    ->required(),
                Forms\Components\TextInput::make('ShortcutName')
                    ->required(),
                Forms\Components\TextInput::make('ShortcutNameEN')
                    ->required(),
                Forms\Components\TextInput::make('SortIndex')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('Visible')
                    ->label('Visible')
                    ->default(false),
            ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Name'),
                Tables\Columns\TextColumn::make('NameEN'),
                Tables\Columns\TextColumn::make('SortIndex')->sortable(),
                Tables\Columns\IconColumn::make('Visible')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Create New Sub Category'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('accept')
                    ->label('Move Category')
                    ->button()
                    ->color('success')
                    ->icon('heroicon-o-check')
                    ->modalHeading('Select Main Category')
                    ->action(function ($record, array $data) {
                       $cat = Category::find($record->id);
                       $cat->CatID = $data['CatID'];
                       $cat->save();
                    })
                    ->form([
                        Forms\Components\Select::make('CatID')
                            ->label('Main')
                            ->relationship('category','Name')
                            ->preload()
                            ->required()
                            ->searchable()
                            ->default(fn ($record) => $record->CatID)
                            ->placeholder('Select Main'),
                    ])
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}