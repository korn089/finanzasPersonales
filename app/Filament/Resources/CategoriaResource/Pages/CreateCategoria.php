<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateCategoria extends CreateRecord
{
    protected static string $resource = CategoriaResource::class;

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
        ->title('Categoria Creada')
        ->body('La Categoria fue creada exitosamente')
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
