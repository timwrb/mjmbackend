<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobpostResource\Pages;
use App\Models\Jobpost;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class JobpostResource extends Resource
{
    protected static ?string $model = Jobpost::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    protected static ?string $modelLabel = 'Jobpost';

    protected static ?string $navigationLabel = 'Stellenanzeigen';

    protected static ?string $navigationGroup = 'Plattformressourcen';

    protected static ?int $navigationSort = -2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }


    public static function form(Form $form): Form
    {
        $tags = \App\Models\tag::all()->pluck('tag', 'id')->toArray();

        return $form
            ->schema([
                Forms\Components\Section::make('Anzeige erstellen')
                ->description('Gestalte deine individuelle Stellenanzeige')
                ->schema([
                Forms\Components\TextInput::make('title')->label('Titel')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('content')->label('Stellenbeschreibung')
                    ->required()
                    ->toolbarButtons([
                        'blockquote',
                        'bold',
                        'bulletList',
                        'heading',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'undo', ])
                    ->columnSpanFull(),
                ]),
                Forms\Components\Section::make('Adresse')
                    ->schema([
                        Forms\Components\TextInput::make('job_zip')
                            ->label('PLZ')
                            ->required(),
                        Forms\Components\TextInput::make('job_city')
                            ->label('Stadt')
                            ->required(),
                        Forms\Components\TextInput::make('job_state')
                            ->label('State')
                            ->required(),
                        Forms\Components\TextInput::make('job_street')
                            ->label('Straße')
                            ->required(),
                        Forms\Components\TextInput::make('job_house_nr')
                            ->label('Hausnummer')
                            ->required(),
                        Forms\Components\TextInput::make('job_address_addition')
                            ->label('Addition')

                    ]),

    Section::make('Tags')->schema([
        Forms\Components\Select::make('tags')
            ->relationship('tags', 'tag')
            ->searchable()
            ->multiple()
            ->options($tags)
            ->placeholder('Select Tags'),
    ]),

                Forms\Components\Toggle::make('visible')
                    ->required(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Typ')
                    ->colors([
                        'primary',
                        'warning' => static fn ($state): bool => $state === 'intern',
                        'primary' => static fn ($state): bool => $state === 'job',
                    ])
                    ->icon('heroicon-o-clipboard')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_id')
                    ->label('Unternehmen')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Titel')
                    ->searchable(),
                Tables\Columns\TextColumn::make('job_state')
                    ->label('Bundesland')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('job_city')
                    ->label('Stadt')
                    ->searchable(),
                Tables\Columns\TextColumn::make('job_zip')
                    ->label('PLZ')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('job_house_nr')
                    ->label('Hausnummer')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('job_address_addition')
                    ->label('Adresszusatz')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('job_street')
                    ->label('Straße')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('visible')
                    ->label('Sichtbar')
                    ->falseIcon('heroicon-o-eye-slash')
                    ->trueIcon('heroicon-o-eye')
                    ->boolean(),
                Tables\Columns\IconColumn::make('payed')
                    ->label('Bezahlt')
                    ->falseIcon('heroicon-o-no-symbol')
                    ->trueIcon('heroicon-o-shield-check')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Erstellt')
                    ->since()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Zuletzt bearbeitet')
                    ->since()
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
            'index' => Pages\ListJobposts::route('/'),
            'create' => Pages\CreateJobpost::route('/create'),
            'view' => Pages\ViewJobpost::route('/{record}'),
            'edit' => Pages\EditJobpost::route('/{record}/edit'),
        ];
    }
}

