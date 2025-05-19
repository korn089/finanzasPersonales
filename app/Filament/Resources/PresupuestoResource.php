<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PresupuestoResource\Pages;
use App\Filament\Resources\PresupuestoResource\RelationManagers;
use App\Models\Categoria;
use App\Models\Presupuesto;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PresupuestoResource extends Resource
{
    protected static ?string $model = Presupuesto::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Llene los campos del formulario')
                ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Usuarios')
                            ->required()
                            ->options(User::all()->pluck('name','id')),//liste todos los users y agarre el id y muestre el valor
                        Forms\Components\Select::make('categoria_id')
                            ->label('Categorias')
                            ->required()
                            ->options(Categoria::all()->pluck('nombre','id')),//liste todos los users y agarre el id y muestre el valor
                        Forms\Components\TextInput::make('monto_asignado')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('monto_gastado')
                            ->required()
                            ->numeric()
                            ->default(0.00)
                            ->disabled(),
                        Forms\Components\TextInput::make('mes')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('anio')
                            ->label('Año')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2)
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('categoria.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('monto_asignado')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('monto_gastado')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mes')
                    ->searchable(),
                Tables\Columns\TextColumn::make('anio')
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
                Tables\Actions\EditAction::make()
                ->button()
                ->color('success'),
                Tables\Actions\DeleteAction::make()
                ->button()
                ->color('danger')
                ->successNotification(
                    Notification::make()
                    ->title('Presupuesto Eliminado')
                    ->body('El presupuesto fue eliminado exitosamente')
                    ->success()
                ),
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
            'index' => Pages\ListPresupuestos::route('/'),
            'create' => Pages\CreatePresupuesto::route('/create'),
            'edit' => Pages\EditPresupuesto::route('/{record}/edit'),
        ];
    }
}
