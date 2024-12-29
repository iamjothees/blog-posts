<?php

namespace App\Filament\Resources;

use App\Enum\BlogPostStatus;
use App\Filament\Resources\BlogPostResource\Pages;
use App\Filament\Resources\BlogPostResource\RelationManagers;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'icon-article';

    public static function getNavigationBadge(): ?string
    {
        return cache(
            'blog_posts_count', 
            static::getModel()::toBase()
                ->when(!auth()->user()->isAdmin(),
                fn ($q) => $q->where('user_id', auth()->user()->id)
            )->count()
        );
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->default(auth()->user()->id)
                    ->visible(auth()->user()->isAdmin())
                    ->columnSpanFull(),
                Forms\Components\Radio::make('status')
                    ->options(BlogPostStatus::class)
                    ->inline()
                    ->inlineLabel(false)
                    ->required()
                    ->columnSpanFull()
                    ->default(BlogPostStatus::DRAFT),
                Forms\Components\Section::make('Identifiers')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->afterStateUpdated(function ($get, $set, ?string $state) {
                                if (! $get('is_slug_changed_manually') && filled($state)) {
                                    $set('slug', str($state)->slug());
                                }
                            })
                            ->live(onBlur: true),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('excerpt')
                            ->columnSpanFull(),
                        Forms\Components\Select::make('category_id')
                            ->relationship('category',  'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('tags')
                            ->relationship('tags', 'name')
                            ->multiple()
                            ->required()
                            ->searchable()
                            ->createOptionForm(TagResource::formSchema())
                            ->columnSpanFull()
                            ->preload(config('app.env') === 'local'),
                    ]),
                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('featured_image')
                    ->image()
                    ->columnStart(1)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(20)
                    ->description(fn ($record) => $record->category->name),
                Tables\Columns\TextColumn::make('user.name')
                    ->icon('icon-user')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status')
                    ->options(BlogPostStatus::class),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->when(!auth()->user()->isAdmin(),
                fn ($q) => $q->where('user_id', auth()->user()->id)
            );
    }
}
