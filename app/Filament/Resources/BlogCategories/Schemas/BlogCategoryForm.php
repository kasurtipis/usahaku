<?php

namespace App\Filament\Resources\BlogCategories\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BlogCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Blog Category Information')
                    ->description('Fill in the blog category details')
                    ->schema([
                        TextInput::make('username')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter username'),
                        TextInput::make('subdomain')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter subdomain'),
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter category title'),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter slug')
                            ->unique(ignoreRecord: true),
                    ])
                    ->columns(2),
            ]);
    }
}
