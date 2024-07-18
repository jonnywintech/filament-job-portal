<?php

namespace App\Filament\Resources\EmployeeResource\RelationManagers;

use Filament\Forms;
use App\Models\City;
use Filament\Tables;
use App\Models\State;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class EmployeeRelationManager extends RelationManager
{
    protected static string $relationship = 'employee';

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make('User Name')
                ->description('Put the user name details in.')
                ->schema([
                    Forms\Components\TextInput::make('first_name')->label('First Name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('last_name')->label('Last Name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('middle_name')->label('Middle Name')
                        ->maxLength(255),
                ])->columns(3),
            Section::make('User Address')
                ->schema([
                    Forms\Components\Select::make('country_id')->label('Country')
                        ->relationship('country', 'name')
                        ->live()
                        ->afterStateUpdated(function (Set $set) {
                            $set('city_id', null);
                            $set('state_id', null);
                        })
                        ->searchable()
                        ->preload()
                        ->required(),
                    Forms\Components\Select::make('state_id')->label('State')
                        ->options(fn (Get $get): Collection => State::query()
                            ->where('country_id', $get('country_id'))
                            ->pluck('name', 'id'))
                        ->afterStateUpdated(fn (Set $set) => $set('city_id', null))
                        ->searchable()
                        ->live()
                        ->preload()
                        ->required(),
                    Forms\Components\Select::make('city_id')->label('City')
                        ->options(fn (Get $get): Collection => City::query()
                            ->where('state_id', $get('state_id'))
                            ->pluck('name', 'id'))
                        ->live()
                        ->searchable()
                        ->preload()
                        ->required(),
                    Forms\Components\TextInput::make('zip_code')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('address')
                        ->required()
                        ->maxLength(255)->columnSpan(2),

                ])->columns(3),
            Section::make('Section')->schema([
                Forms\Components\Select::make('department_id')->label('Department')
                    ->relationship('department', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]),


            Section::make('Date')->schema([
                Forms\Components\DatePicker::make('date_of_birth')
                    ->required(),
                Forms\Components\DatePicker::make('date_hired')
                    ->required(),
            ])->columns(2),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                ->label('First Name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
