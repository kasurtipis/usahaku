<?php

namespace App\Filament\Resources\BlogCategories\Schemas;

use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BlogCategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Blog Category Information')
                    ->schema([
                        TextEntry::make('username'),
                        TextEntry::make('subdomain'),
                        TextEntry::make('title'),
                        TextEntry::make('slug'),
                        TextEntry::make('created_at')
                            ->dateTime(),
                        TextEntry::make('updated_at')
                            ->dateTime(),
                    ])
                    ->columns(2),
            ]);
    }
}
