<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class TestimonialsBlock
{
    public static function make(): Block
    {
        return Block::make('testimonials')
            ->label('Client Testimonials')
            ->icon('heroicon-m-star')
            ->schema([
                TextInput::make('title')
                    ->label('Section Title')
                    ->default('Client Testimonials')
                    ->required(),
                TextInput::make('subtitle')
                    ->label('Section Subtitle')
                    ->default('What people are saying about my work.'),
                Repeater::make('testimonials')
                    ->label('Testimonials')
                    ->schema([
                        TextInput::make('name')
                            ->label('Client Name')
                            ->required(),
                        TextInput::make('role')
                            ->label('Client Role / Company'),
                        Textarea::make('quote')
                            ->label('Testimonial Quote')
                            ->required()
                            ->rows(3),
                    ])
                    ->grid(2)
                    ->collapsible()
                    ->defaultItems(2),
            ]);
    }
}
