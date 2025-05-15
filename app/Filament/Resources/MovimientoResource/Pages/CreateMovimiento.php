<?php

namespace App\Filament\Resources\MovimientoResource\Pages;

use App\Filament\Resources\MovimientoResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateMovimiento extends CreateRecord
{
    protected static string $resource = MovimientoResource::class;
    protected function getRedirectUrl(): string
    {
        //redireccionamos al index
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return null;//evitamos q salga la notificacion por defecto
    }
    //creamos la notificacion
    protected function afterCreate(){
        Notification::make()
        ->title('Movimiento Creado')
        ->body('El Movimiento fue creado exitosamente')
        ->success()
        ->send();
    }
    //modificar texto de botones
    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Guardar')
            ->color('success'),
            //$this->getCreateFormAction()->label('Guardar y Nuevo'),
            $this->getCreateFormAction()->label('Cancelar')
        ];
    }
}
