<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class HeroBlock
{
    public static function make(): Block
    {
        return Block::make('hero')
            ->label('Hero Banner')
            ->icon('heroicon-m-sparkles')
            ->schema([
                TextInput::make('pre_title')
                    ->label('Small text above title')
                    ->placeholder('Hello, I am...')
                    ->required(),
                ColorPicker::make('pre_title_color')
                    ->label('Small Text Color')
                    ->default('#ec4899'),
                TextInput::make('title')
                    ->label('Main Title')
                    ->placeholder('Your name or main headline')
                    ->required(),
                TextInput::make('highlight_text')
                    ->label('Highlighted Word/Phrase')
                    ->placeholder('e.g. {Full Stack}'),
                ColorPicker::make('highlight_color')
                    ->label('Highlight Color')
                    ->default('#22c55e'),
                ColorPicker::make('title_cursor_color')
                    ->label('Cursor Color')
                    ->default('#ec4899'),
                Textarea::make('description')
                    ->label('Short Biography/Description')
                    ->rows(3),
                FileUpload::make('profile_image')
                    ->label('Profile / Hero Image')
                    ->image()
                    ->directory('hero-images'),
                TextInput::make('button_text')
                    ->label('Primary Button Text')
                    ->default('Download CV'),
                TextInput::make('button_link')
                    ->label('Primary Button Link')
                    ->default('#'),
                ColorPicker::make('button_text_color')
                    ->label('Button Text Color')
                    ->default('#ffffff'),
                ColorPicker::make('button_bg_color')
                    ->label('Button Background Color')
                    ->default('#38bdf8'),
                Repeater::make('tech_stack')
                    ->label('Tech Stack Icons')
                    ->schema([
                        FileUpload::make('icon_url')
                            ->label('Upload Icon Image')
                            ->image()
                            ->directory('tech-icons')
                            ->required(),
                    ])
                    ->grid(3)
                    ->collapsible(),
            ]);
    }
}
