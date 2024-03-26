<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Filament\Resources\ScheduleResource\RelationManagers;
use App\Models\Schedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Sport')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Info')
                            ->schema([
                                Forms\Components\DatePicker::make('match_date')
                                    ->label('Date')
                                    ->required()
                                    ->native(false),
                                Forms\Components\Select::make('sport_id')
                                    ->label('Sport')
                                    ->relationship('sport', 'name', fn ($query) => $query->orderBy('name'))
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Forms\Components\TimePicker::make('start_time')
                                    ->native(false),
                                Forms\Components\TimePicker::make('end_time')
                                    ->native(false),
                            ])
                            ->columns(2),
                        Forms\Components\Tabs\Tab::make('Team')
                            ->schema([
                                Forms\Components\Select::make('team_a_id')
                                    ->label('Team A')
                                    ->relationship('team_a', 'name', fn ($query) => $query->orderBy('name'))
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\Select::make('team_b_id')
                                    ->label('Team B')
                                    ->relationship('team_b', 'name', fn ($query) => $query->orderBy('name'))
                                    ->searchable()
                                    ->preload(),
                            ]),
                        Forms\Components\Tabs\Tab::make('Result')
                            ->schema([
                                Forms\Components\TextInput::make('result_team_a')
                                    ->label('Result Team A')
                                    ->numeric(),
                                Forms\Components\TextInput::make('result_team_b')
                                    ->label('Result Team B')
                                    ->numeric(),
                                Forms\Components\Select::make('win_team_id')
                                    ->label('Win Team')
                                    ->relationship('win_team', 'name', fn ($query) => $query->orderBy('name'))
                                    ->searchable()
                                    ->preload()
                                    ->columnSpanFull()
                            ])
                            ->columns(2)
                    ])
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('match_date')
                    ->label('Date')
                    ->date('d/m/Y'),
                Tables\Columns\TextColumn::make('sport.name'),
                Tables\Columns\TextColumn::make('team_a.name')
                    ->label('Team A'),
                Tables\Columns\TextColumn::make('team_b.name')
                    ->label('Team B'),
                Tables\Columns\TextColumn::make('result_team_a')
                    ->label('Team A Score')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('result_team_b')
                    ->label('Team B Score')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('win_team.name')
                    ->label('Win Team')
                    ->badge()
                    ->color('success')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
            ])
            ->defaultSort('match_date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSchedules::route('/'),
        ];
    }
}
