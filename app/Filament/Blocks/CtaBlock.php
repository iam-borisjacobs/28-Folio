<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class CtaBlock
{
    public static function make(): Block
    {
        return Block::make('cta')
            ->label('Call To Action / Contact')
            ->icon('heroicon-m-chat-bubble-oval-left-ellipsis')
            ->schema([
                TextInput::make('title')
                    ->label('Main Title')
                    ->default('Let\'s connect')
                    ->required(),
                
                \Filament\Forms\Components\Repeater::make('contact_info')
                    ->label('Contact Information Details (Right Side)')
                    ->schema([
                        \Filament\Forms\Components\FileUpload::make('icon_svg')
                            ->label('Upload Icon (SVG/PNG)')
                            ->image()
                            ->directory('cta-icons')
                            ->acceptedFileTypes(['image/svg+xml', 'image/png', 'image/jpeg'])
                            ->maxSize(2048)
                            ->nullable(),
                        TextInput::make('title')
                            ->label('Detail Title (e.g. Phone)')
                            ->required(),
                        TextInput::make('value')
                            ->label('Value (e.g. +1-123-456)')
                            ->required(),
                    ])
                    ->collapsible()
                    ->defaultItems(3),
            ]);
    }
}
