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
                    ->default('Have a project in mind?')
                    ->required(),
                Textarea::make('subtitle')
                    ->label('Subtitle / Description')
                    ->default('I am available for freelance work. Connect with me via email or phone.')
                    ->rows(2),
                TextInput::make('button_text')
                    ->label('Button Text')
                    ->default('Contact Me'),
                TextInput::make('button_link')
                    ->label('Button Link (e.g. /contact)')
                    ->default('/contact'),
            ]);
    }
}
