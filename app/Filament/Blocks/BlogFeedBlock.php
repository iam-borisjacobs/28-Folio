<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;

class BlogFeedBlock
{
    public static function make(): Block
    {
        return Block::make('blog_feed')
            ->label('Recent Blog Feed')
            ->icon('heroicon-m-newspaper')
            ->schema([
                TextInput::make('title')
                    ->label('Section Title')
                    ->default('Recent blog')
                    ->required(),

                TextInput::make('limit')
                    ->label('Number of posts to display')
                    ->numeric()
                    ->default(3)
                    ->required(),
            ]);
    }
}
