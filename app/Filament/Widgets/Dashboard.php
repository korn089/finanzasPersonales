<?php

namespace App\Filament\Widgets;

use App\Models\Categoria;
use App\Models\Movimiento;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Dashboard extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            //Stat::make('Usuarios',10)
            Stat::make('Usuarios',User::count())//cantidad de user
            ->description('Total de Usuarios registrados')
            ->icon('heroicon-o-users')
            ->color('success')
            ->chart([1,2,3,4,5,6,7,8,9,10]),//grafico

            Stat::make('Categorias',Categoria::count())
            ->description('Total de categorias disponibles')
            ->icon('heroicon-o-briefcase')
            ->color('primary')
            ->chart([1,5,10,15]),

            Stat::make('Movimientos',Movimiento::where('tipo','ingreso')->sum('monto').' $')
            ->description('Total Ingresos')
            ->icon('heroicon-o-currency-dollar')
            ->chart([1,2,5,8,3,9,12,18,3,25]),
        ];
    }
}
