<?php

namespace App\Filament\Resources\PresupuestoResource\Pages;

use App\Filament\Resources\PresupuestoResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditPresupuesto extends EditRecord
{
    protected static string $resource = PresupuestoResource::class;

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
        ->title('Presupuesto Actualizado')
        ->body('El Presupuesto fue actualizado exitosamente')
        ->success()
        ->send();
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->successNotification(
                Notification::make()
                ->title('Presupuesto Eliminado')
                ->body('El Presupuesto fue eliminado exitosamente')
                ->success()
            ),
        ];
    }
}
