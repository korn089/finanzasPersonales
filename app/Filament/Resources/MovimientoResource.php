<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovimientoResource\Pages;
use App\Filament\Resources\MovimientoResource\RelationManagers;
use App\Models\Categoria;
use App\Models\Movimiento;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MovimientoResource extends Resource
{
    protected static ?string $model = Movimiento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                    Forms\Components\Select::make('tipo')
                        ->required()
                        ->options([
                            'ingreso'=>'Ingreso',
                            'gasto'=>'Gasto'
                        ]),
                    Forms\Components\TextInput::make('monto')
                        ->required()
                        ->label('Monto')
                        ->numeric(),
                    Forms\Components\RichEditor::make('descripcion')
                        ->required()
                        ->label('Descripcion')
                        ->columnSpanFull(),
                    Forms\Components\FileUpload::make('foto')
                        ->label('Foto')
                        ->image()//tipo de archivo
                        ->disk('public')//donde se guardara en storage/public
                        ->directory('movimientos'),//nombre del directorio
                    Forms\Components\DatePicker::make('fecha')
                        ->required(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('Nro')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuario')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('categoria.nombre')
                    ->label('Categoria')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->label('Tipo de Movimiento')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('monto')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->limit(50)
                    ->html()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('foto')
                    ->searchable()
                    ->width(100)
                    ->height(100),
                Tables\Columns\TextColumn::make('fecha')
                    ->date()
                    ->sortable(),
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
                //filtros
                SelectFilter::make('tipo')
                    ->options([
                        'ingreso'=>'Ingreso',
                        'gasto'=>'Gasto'
                    ])
                    ->placeholder('Filtrar por Tipo')
                    ->label('Tipo'),
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
                    ->title('Movimiento Eliminado')
                    ->body('El movimiento fue eliminado exitosamente')
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
            'index' => Pages\ListMovimientos::route('/'),
            'create' => Pages\CreateMovimiento::route('/create'),
            'edit' => Pages\EditMovimiento::route('/{record}/edit'),
        ];
    }
}
