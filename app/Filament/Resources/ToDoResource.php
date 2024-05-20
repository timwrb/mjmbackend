<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ToDoResource\Pages;
use App\Filament\Resources\ToDoResource\RelationManagers;
use App\Models\ToDo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ToDoResource extends Resource
{
    protected static ?string $model = ToDo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'To-Do';

    protected static ?string $navigationLabel = 'Programmieren';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Kategorie')
            ->schema([
                Forms\Components\Select::make('category')
                    ->options([
                        'frontend' => 'Frontend',
                        'backend' => 'Backend',
                        'ui' => 'UI',
                        'api' => 'API',
                        'Front & Backend' => 'Front & Backend',
                    ])
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'open' => 'Offen',
                        'in_progress' => 'In Bearbeitung',
                        'completed' => 'Abgeschlossen',
                    ])
                    ->required(),
                ]),

                Forms\Components\Fieldset::make('Details')
                    ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Titel')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Titel...')
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('description')
                    ->label('Beschreibung')
                    ->placeholder('Beschreibung...')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'open' => 'gray',
                        'in_progress' => '#f6993f',
                        'completed' => 'green',
                    ])
                    ->icon('heroicon-o-ellipsis-horizontal-circle')
                    ->sortable()
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListToDos::route('/'),
            'create' => Pages\CreateToDo::route('/create'),
            'view' => Pages\ViewToDo::route('/{record}'),
            'edit' => Pages\EditToDo::route('/{record}/edit'),
        ];
    }
}
