<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\EmployeeResource;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'This Week' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('date_hired', '>', now()->subWeek() )),
            'This Month' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('date_hired', '>', now()->subMonth() )),
            'This Year' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('date_hired', '>', now()->subYear() )),
        ];

    }
}
