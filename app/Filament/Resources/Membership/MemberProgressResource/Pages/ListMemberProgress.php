<?php

namespace App\Filament\Resources\Membership\MemberProgressResource\Pages;

use App\Filament\Resources\Membership\MemberProgressResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMemberProgress extends ListRecords
{
    protected static string $resource = MemberProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
