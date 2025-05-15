<?php

namespace App\Filament\Resources\MovimientoResource\Pages;

use App\Filament\Resources\MovimientoResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditMovimiento extends EditRecord
{
    protected static string $resource = MovimientoResource::class;

    protected function getRedirectUrl(): string
    {
        //redireccionamos al index
        return $this->getResource()::getUrl('index');
    }
    protected function getSavedNotification(): ?Notification
    {
        return null;//evitamos q salga la notificacion por defecto
    }
    //creamos la notificacion
    protected function afterSave(){
        Notification::make()
        ->title('Movimiento Actualizado')
        ->body('El Movimiento fue actualizado exitosamente')
        ->success()
        ->send();
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->successNotification(
                Notification::make()
                ->title('Movimiento Eliminado')
                ->body('El Movimiento fue eliminado exitosamente')
                ->success()
            ),
        ];
    }
}
