<?php

namespace App\Filament\Resources\BlogComments;

use App\Filament\Resources\BlogComments\Pages\CreateBlogComment;
use App\Filament\Resources\BlogComments\Pages\EditBlogComment;
use App\Filament\Resources\BlogComments\Pages\ListBlogComments;
use App\Filament\Resources\BlogComments\Schemas\BlogCommentForm;
use App\Filament\Resources\BlogComments\Tables\BlogCommentsTable;
use App\Models\BlogComment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BlogCommentResource extends Resource
{
    protected static ?string $model = BlogComment::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-chat-bubble-left';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return BlogCommentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BlogCommentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBlogComments::route('/'),
            'create' => CreateBlogComment::route('/create'),
            'edit' => EditBlogComment::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes();
    }
    
    public static function getNavigationGroup(): ?string
    {
        return 'Content Management';
    }
}
