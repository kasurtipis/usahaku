<?php

namespace App\Filament\Resources\BlogComments\Schemas;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BlogCommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Blog Comment Information')
                    ->description('Fill in the blog comment details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('blog_id')
                                    ->relationship('blog', 'title')
                                    ->required()
                                    ->searchable()
                                    ->placeholder('Select blog'),
                                Select::make('reply')
                                    ->relationship('parent', 'title')
                                    ->placeholder('Select parent comment if replying')
                                    ->label('Reply to Comment'),
                                TextInput::make('username')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Enter username'),
                                TextInput::make('subdomain')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Enter subdomain'),
                                TextInput::make('title')
                                    ->maxLength(255)
                                    ->placeholder('Enter comment title'),
                                TextInput::make('slug')
                                    ->maxLength(255)
                                    ->placeholder('Enter slug'),
                                TextInput::make('phone')
                                    ->tel()
                                    ->maxLength(255)
                                    ->placeholder('Enter phone number'),
                                TextInput::make('email')
                                    ->email()
                                    ->maxLength(255)
                                    ->placeholder('Enter email address'),
                            ]),
                        Textarea::make('content')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull()
                            ->placeholder('Enter comment content'),
                    ]),
            ]);
    }
}
