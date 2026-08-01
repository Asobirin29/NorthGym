<?php

namespace App\Filament\Resources\Membership\MemberProgressResource\Pages;

use App\Filament\Resources\Membership\MemberProgressResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMemberProgress extends EditRecord
{
    protected static string $resource = MemberProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
