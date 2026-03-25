<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;

class PortfolioBlock
{
    public static function make(): Block
    {
        return Block::make('portfolio')
            ->label('Featured Portfolio')
            ->icon('heroicon-m-photo')
            ->schema([
                TextInput::make('title')
                    ->label('Section Title')
                    ->default('Featured Projects')
                    ->required(),
                TextInput::make('subtitle')
                    ->label('Section Subtitle')
                    ->default('check out some of my latest work.'),
                TextInput::make('button_text')
                    ->label('View All Button Text')
                    ->default('View All &rarr;'),
                TextInput::make('button_link')
                    ->label('View All Link (e.g. /projects)')
                    ->default('/projects'),
                TextInput::make('limit')
                    ->label('Number of projects to show')
                    ->numeric()
                    ->default(4)
                    ->required(),
            ]);
    }
}
