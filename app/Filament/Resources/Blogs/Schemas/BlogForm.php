<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Blog Information')
                    ->description('Fill in the blog details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Enter slug')
                                    ->unique(ignoreRecord: true),
                                TextInput::make('subdomain')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Enter subdomain'),
                                TextInput::make('username')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Enter username'),
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Enter blog title'),
                                Select::make('blog_category_id')
                                    ->relationship('category', 'title')
                                    ->required()
                                    ->placeholder('Select category'),
                                TextInput::make('author')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Enter author name'),
                                TextInput::make('meta_title')
                                    ->maxLength(255)
                                    ->placeholder('Enter meta title'),
                                TextInput::make('visitor')
                                    ->numeric()
                                    ->minValue(0)
                                    ->placeholder('0'),
                                TextInput::make('tag')
                                    ->maxLength(255)
                                    ->placeholder('Enter tags, separated by commas'),
                            ]),
                        FileUpload::make('image')
                            ->image()
                            ->imageEditor()
                            ->directory('blogs')
                            ->visibility('public')
                            ->maxSize(10240) // 10MB
                            ->placeholder('Upload blog image'),
                        RichEditor::make('content')
                            ->required()
                            ->columnSpanFull()
                            ->placeholder('Enter blog content'),
                        Textarea::make('meta_description')
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->placeholder('Enter meta description'),
                    ]),
            ]);
    }
}
