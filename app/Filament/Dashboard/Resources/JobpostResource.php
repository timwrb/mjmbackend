<?php

namespace App\Filament\Dashboard\Resources;

use App\Filament\Dashboard\Resources\JobpostResource\Pages;
use App\Filament\Dashboard\Resources\JobpostResource\RelationManagers;
use App\Models\Jobpost;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobpostResource extends Resource
{
    protected static ?string $model = Jobpost::class;

    protected function redirectAfterCreate($record): string
    {
        return redirect('/checkout-page');
    }

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $modelLabel = 'Jobpost';

    protected static ?string $navigationLabel = 'Stellenanzeigen';

    protected static ?string $navigationGroup = 'Stellenanzeigen';

    public static function form(Form $form): Form
    {
        $tags = \App\Models\tag::all()->pluck('tag', 'id')->toArray();

        return $form
            ->schema([
                Section::make('Beschreibung')
                    ->description('Die Stellenbeschreibung')
                    ->schema([
                        TextInput::make('title')->label('Titel')
                            ->required()
                            ->columnSpanFull()
                            ->maxLength(255),
                        MarkdownEditor::make('content')->label('Stellenbeschreibung')
                            ->required()
                            ->toolbarButtons([
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
                Section::make('Standort')
                    ->schema([
                        Select::make('job_state')->label('Bundesland')
                            ->required()
                            ->options([
                                'Baden-Württemberg' => 'Baden-Württemberg',
                                'Bayern' => 'Bayern',
                                'Berlin' => 'Berlin',
                                'Brandenburg' => 'Brandenburg',
                                'Bremen' => 'Bremen',
                                'Hamburg' => 'Hamburg',
                                'Hessen' => 'Hessen',
                                'Mecklenburg-Vorpommern' => 'Mecklenburg-Vorpommern',
                                'Niedersachsen' => 'Niedersachsen',
                                'Nordrhein-Westfalen' => 'Nordrhein-Westfalen',
                                'Rheinland-Pfalz' => 'Rheinland-Pfalz',
                                'Saarland' => 'Saarland',
                                'Sachsen' => 'Sachsen',
                                'Sachsen-Anhalt' => 'Sachsen-Anhalt',
                                'Schleswig-Holstein' => 'Schleswig-Holstein',
                                'Thüringen' => 'Thüringen',
                            ]),
                        TextInput::make('job_zip')->label('PLZ')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('job_city')->label('Stadt')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('job_street')->label('Straße')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('job_house_nr')->label('Hausnummer')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('job_address_addition')->label('Addition')
                            ->maxLength(255),

                    ])->columns(2),
                Section::make('Du kannst die anzeige auch verstecken, sodass sie nichtmehr sichtbar ist, ohne sie zu löschen.')
                    ->schema([
                Forms\Components\Toggle::make('visible')
                    ->label('Sichtbar')
                    ->required(),
                ]),

                Section::make('Tags')->schema([
                    Forms\Components\Select::make('tags')
                        ->relationship('tags', 'tag')
                        ->searchable()
                        ->multiple()
                        ->options($tags)
                        ->placeholder('Select Tags'),
                ]),
            ]);
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

//    public static function getNavigationBadge(): ?string
//    {
//        $companyId = auth()->user()->company_id;
//        return Jobpost::where('company_id', $companyId)->count();
//    }

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
