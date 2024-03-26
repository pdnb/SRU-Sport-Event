<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistrationResource\Pages;
use App\Filament\Resources\RegistrationResource\RelationManagers;
use App\Models\Position;
use App\Models\Registration;
use App\Models\Sport;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegistrationResource extends Resource
{
    protected static ?string $model = Registration::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Registration')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Basic')
                            ->schema([
                                Forms\Components\Grid::make(3)
                                    ->schema([
                                        Forms\Components\TextInput::make('prefix')
                                            ->required(),
                                        Forms\Components\TextInput::make('first_name')
                                            ->required(),
                                        Forms\Components\TextInput::make('last_name')
                                            ->required(),
                                    ]),
                                Forms\Components\Select::make('university_id')
                                    ->label('University')
                                    ->relationship('university', 'name', fn ($query) => $query->orderBy('name'))
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->columnSpanFull(),
                                Forms\Components\FileUpload::make('photo')
                                    ->image()
                                    ->previewable()
                                    ->openable()
                                    ->imagePreviewHeight(200)
                                    ->downloadable()
                                    ->columnSpanFull(),
                                Forms\Components\FileUpload::make('id_card')
                                    ->label('ID Card')
                                    ->image()
                                    ->previewable()
                                    ->openable()
                                    ->downloadable()
                                    ->imagePreviewHeight(200)
                                    ->columnSpanFull(),
                                Forms\Components\FileUpload::make('staff_card')
                                    ->label('Staff Card')
                                    ->image()
                                    ->previewable()
                                    ->openable()
                                    ->downloadable()
                                    ->imagePreviewHeight(200)
                                    ->columnSpanFull(),
                                Forms\Components\Radio::make('status')
                                    ->inline()
                                    ->options([
                                        'pending' => 'Pending',
                                        'approved' => 'Approved'
                                    ])
                                    ->default('pending')
                                    ->columnSpanFull()
                            ]),
                        Forms\Components\Tabs\Tab::make('Details')
                            ->schema([
                                Forms\Components\Repeater::make('roles')
                                    ->relationship()
                                    ->hiddenLabel()
                                    ->columns(2)
                                    ->addActionLabel('Add to details')
                                    ->schema([
                                        Forms\Components\Select::make('sport_id')
                                            ->label('Sport')
                                            ->required()
                                            ->native(false)
                                            ->options(Sport::query()->orderBy('name')->pluck('name', 'id')),
                                        Forms\Components\Select::make('position_id')
                                            ->label('Role')
                                            ->required()
                                            ->native(false)
                                            ->options(Position::query()->orderBy('name')->pluck('name', 'id'))
                                    ])
                                    ->deleteAction(
                                        fn ($action) => $action->requiresConfirmation(),
                                    )
                                    ->rules([
                                        function ($component) {
                                            return function (string $attribute, $value, Closure $fail) use ($component) {
                                                $items = $component->getContainer()->getParentComponent()->getState();
                                                $roles = collect($items['roles']);

                                                if(count($items['roles']) != $roles->unique(fn ($item) => "{$item['sport_id']}-{$item['position_id']}")->count())
                                                {
                                                    $fail('มีรายการข้อมูลซ้ำซ้อน โปรดตรวจสอบอีกครั้ง');
                                                }
                                            };
                                        }
                                    ])
                            ])
                    ])
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('prefix')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('university.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn ($record) => $record->status == 'approved' ? 'success' : 'warning')
                    ->formatStateUsing(fn ($state) => ucfirst($state)),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Registered Date')
                    ->date('d/m/Y')
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('university')
                    ->relationship('university', 'name', fn ($query) => $query->orderBy('name'))
                    ->preload()
                    ->multiple(),
                Tables\Filters\SelectFilter::make('status')
                    ->multiple()
                    ->native(false)
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved'
                    ])
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageRegistrations::route('/'),
        ];
    }
}
