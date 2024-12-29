<?php

namespace App\Filament\Resources\BlogPostResource\Pages;

use App\Enum\BlogPostStatus;
use App\Filament\Resources\BlogPostResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListBlogPosts extends ListRecords
{
    protected static string $resource = BlogPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'published' => Tab::make()
                ->modifyQueryUsing(fn ($query) => $query->where('status', BlogPostStatus::PUBLISHED)),
            'draft' => Tab::make()
                ->modifyQueryUsing(fn ($query) => $query->where('status', BlogPostStatus::DRAFT)),
            'archived' => Tab::make()
                ->modifyQueryUsing(fn ($query) => $query->where('status', BlogPostStatus::ARCHIVED)),
        ];
    }
}
