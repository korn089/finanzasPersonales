<?php

namespace App\Filament\Resources\PresupuestoResource\Pages;

use App\Filament\Resources\PresupuestoResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreatePresupuesto extends CreateRecord
{
    protected static string $resource = PresupuestoResource::class;
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
        ->title('Presupuesto Creado')
        ->body('El Presupuesto fue creado exitosamente')
        ->success()
        ->send();
    }
    //modificar texto de botones
    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Registrar')
            ->color('success'),
            //$this->getCreateFormAction()->label('Guardar y Nuevo'),
            $this->getCreateFormAction()->label('Cancelar')
        ];
    }
}
