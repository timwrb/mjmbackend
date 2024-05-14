<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationBadgeTooltip = 'Anzahl der Unternehmen';
    protected static ?string $modelLabel = 'Unternehmen';
    protected static ?string $navigationLabel = 'Unternehmen';
    protected static ?string $navigationGroup = 'Plattformressourcen';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    Section::make('Anzeigename')
                        ->description('Gib gerne eine Beschreibung ab, um dich vorzustellen')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->label('Unternehmens Titel'),
                            Textarea::make('desc')
                                ->label('Beschreibung (Optional)'),
                            FileUpload::make('Logo')
                                ->image(),
                        ])->columnSpanFull(),

                    Section::make('Unternehmensdaten')
                        ->description('Fülle die folgenden Felder aus, um dein Unternehmen zu registrieren')
                        ->schema([
                            TextInput::make('legal_form')
                                ->required()
                                ->label('Rechtsform'),
                            TextInput::make('tax_id')
                                ->required()
                                ->label('Steuer-Identifikationsnummer'),
                            TextInput::make('industry')
                                ->required(),
                        ])->columnSpanFull(),


                Section::make('Kontaktdaten')
                    ->description('Diese Daten werden Benutzern angezeigt, die sich für deine Stellenanzeigen interessieren.')
                    ->schema([
                        TextInput::make('contact_email')
                            ->email(),
                        TextInput::make('contat_phone')
                            ->label('Telefonnummer')
                            ->required(),
                    ])->columns(2),


                Section::make('Adresse')
                    ->schema([
                        TextInput::make('company_zip')->label('PLZ')
                            ->required(),
                        TextInput::make('company_city')->label('Stadt')
                            ->required(),
                        TextInput::make('company_state')->label('State')
                            ->required(),
                        TextInput::make('company_street')->label('Straße')
                            ->required(),
                        TextInput::make('company_house_nr')->label('Hausnummer')
                            ->required(),
                        TextInput::make('company_address_addition')->label('Addition'),

                    ]),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('legal_form')
                    ->searchable()
                    ->icon('heroicon-o-book-open'),
                Tables\Columns\TextColumn::make('tax_id')
                    ->searchable()
                    ->label('Steuer-ID'),
                Tables\Columns\ImageColumn::make('logo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('industry')
                    ->badge()
                    ->searchable()
                    ->label('Branche'),
                Tables\Columns\TextColumn::make('contact_email')
                    ->searchable()
                    ->label('E-Mail'),
                Tables\Columns\TextColumn::make('contat_phone')
                    ->searchable()
                    ->label('Telefon')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('company_state')
                    ->label('Bundesland')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('company_zip')
                    ->label('PLZ')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('company_city')
                    ->label('Stadt')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('company_street')
                    ->label('Straße')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('company_house_nr')
                    ->label('Hausnummer')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('company_address_addition')
                    ->label('Adresszusatz')
                    ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'view' => Pages\ViewCompany::route('/{record}'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
