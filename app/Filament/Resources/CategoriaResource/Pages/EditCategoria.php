<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditCategoria extends EditRecord
{
    protected static string $resource = CategoriaResource::class;
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
        ->title('Categoria Actualizada')
        ->body('La Categoria fue actualizada exitosamente')
        ->success()
        ->send();
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->successNotification(
                Notification::make()
                ->title('Categoria Eliminada')
                ->body('La Categoria fue eliminada exitosamente')
                ->success()
            ),
        ];
    }
}
