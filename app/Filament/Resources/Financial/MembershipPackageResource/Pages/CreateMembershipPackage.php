<?php

namespace App\Filament\Resources\Financial\MembershipPackageResource\Pages;

use App\Filament\Resources\Financial\MembershipPackageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMembershipPackage extends CreateRecord
{
    protected static string $resource = MembershipPackageResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Paket membership berhasil dibuat!';
    }
}
