<?php

namespace App\Filament\Resources\Financial\MembershipPackageResource\Pages;

use App\Filament\Resources\Financial\MembershipPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMembershipPackage extends EditRecord
{
    protected static string $resource = MembershipPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->requiresConfirmation(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Paket membership berhasil diupdate!';
    }
}
