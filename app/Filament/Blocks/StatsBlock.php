<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

class StatsBlock
{
    public static function make(): Block
    {
        return Block::make('stats')
            ->label('Statistics Grid')
            ->icon('heroicon-m-chart-bar')
            ->schema([
                Repeater::make('stat_items')
                    ->label('Statistics Items')
                    ->schema([
                        TextInput::make('number')
                            ->label('Big Number (e.g. 12)')
                            ->required(),
                        TextInput::make('symbol')
                            ->label('Symbol (e.g. + or %)')
                            ->default('+'),
                        TextInput::make('label_prefix')
                            ->label('Label Prefix (e.g. Years)')
                            ->placeholder('Years'),
                        TextInput::make('label_highlight')
                            ->label('Highlighted Label (e.g. Experience)')
                            ->placeholder('Experience'),
                        TextInput::make('icon_svg')
                            ->label('SVG Code for Icon')
                            ->helperText('Paste inline SVG here for the icon')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->minItems(2)
                    ->maxItems(4)
                    ->collapsible()
                    ->defaultItems(4),
            ]);
    }
}
