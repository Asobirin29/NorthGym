<?php

namespace App\Filament\Resources\Financial\MembershipPackageResource\Pages;

use App\Filament\Resources\Financial\MembershipPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMembershipPackages extends ListRecords
{
    protected static string $resource = MembershipPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Buat Paket Baru')
                ->icon('heroicon-o-plus'),
        ];
    }
}
