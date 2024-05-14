<?php

namespace App\Filament\Dashboard\Resources\JobpostResource\Pages;

use App\Filament\Dashboard\Resources\JobpostResource;
use Closure;
use Filament\Actions;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class CreateJobpost extends CreateRecord
{

    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = JobpostResource::class;

    protected static ?string $navigationLabel = 'Stellenanzeige Erstellen';


    public function form(Form $form): Form
    {
        $tags = \App\Models\tag::all()->pluck('tag', 'id')->toArray();
        return $form->schema([
            Wizard::make([
                Wizard\Step::make('Beschreibung')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Section::make('Was für eine Stelle wird gesucht?')
                            ->schema([
                                Radio::make('type')
                                    ->label('Type')
                                    ->options([
                                        'intern' => 'Praktikum',
                                        'job' => 'Job',
                                    ])
                                    ->reactive()
                                    ->required(),
                                TextInput::make('duration')
                                    ->label('Duration')
                                    ->nullable()
                                    ->hidden(fn ($get) => $get('type') !== 'intern')
                                    ->required(fn ($get) => $get('type') === 'intern')
                            ])->columns(2),
                        Section::make('Anzeige Beschreiben')
                            ->description('Gestalte deine individuelle Stellenanzeige')
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
                    ]),
                Wizard\Step::make('Adresse')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
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

                        ])->columns(2)
                    ]),
                Wizard\Step::make('Tags')
                    ->icon('heroicon-o-tag')
                    ->schema([
                        Section::make('Tags')->schema([
                            Select::make('tags')
                                ->relationship('tags', 'tag')
                                ->searchable()
                                ->multiple()
                                ->options($tags)
                                ->placeholder('Select Tags'),
                        ]),
                    ]),
                                    Wizard\Step::make('Bezahlung')
                                    ->icon('heroicon-o-credit-card')
                                    ->schema([
                                        Section::make('Welches Angebot nehmen sie?')->schema([
                                            Radio::make('payment')
                                                ->options([
                                                    'unpaid' => 'Später Zahlen',
                                                    'paid1' => 'Plan 1',
                                                    'paid2' => 'Plan 2',
                                                    'paid3' => 'Plan 3',
                                                ])
                                        ]),

            ])

        ])->persistStepInQueryString()
                ->submitAction(new HtmlString(Blade::render(<<<BLADE
                <x-filament::button
                   type="submit"
                    size="sm"
                    >
                    Erstellen
                </x-filament::button>
                BLADE)))
                ->columnSpanFull(),
        ]);
    }
    }



