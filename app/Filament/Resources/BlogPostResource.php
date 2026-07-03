<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Post Details')
                ->schema([
                    TextInput::make('title')->required()->maxLength(255),
                    TextInput::make('category')->required()->maxLength(255),
                    TextInput::make('author_name')->required()->maxLength(255),
                    TextInput::make('cover_image')->label('Cover image path')->maxLength(255)->columnSpanFull(),
                    Select::make('status')
                        ->options([
                            'draft' => 'Draft',
                            'published' => 'Published',
                        ])
                        ->required()
                        ->default('draft'),
                    DateTimePicker::make('published_at'),
                    TextInput::make('excerpt')
                        ->maxLength(500)
                        ->columnSpanFull(),
                ])
                ->columns(2),
            Section::make('Content')
                ->schema([
                    RichEditor::make('content')->columnSpanFull(),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category')->toggleable(),
                Tables\Columns\TextColumn::make('author_name')->toggleable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'draft',
                        'success' => 'published',
                    ]),
                Tables\Columns\TextColumn::make('published_at')->dateTime('M j, Y')->toggleable(),
            ])
            ->actions([
                Tables\Actions\Action::make('toggleStatus')
                    ->label(fn (BlogPost $record): string => $record->status === 'published' ? 'Move to Draft' : 'Publish')
                    ->icon(fn (BlogPost $record): string => $record->status === 'published' ? 'heroicon-o-archive-box-x-mark' : 'heroicon-o-megaphone')
                    ->color(fn (BlogPost $record): string => $record->status === 'published' ? 'gray' : 'success')
                    ->action(function (BlogPost $record): void {
                        $record->update([
                            'status' => $record->status === 'published' ? 'draft' : 'published',
                            'published_at' => $record->status === 'published' ? null : now(),
                        ]);
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
