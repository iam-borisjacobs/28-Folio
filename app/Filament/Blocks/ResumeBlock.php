<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class ResumeBlock
{
    public static function make(): Block
    {
        return Block::make('resume')
            ->label('Resume / Timeline')
            ->icon('heroicon-m-briefcase')
            ->schema([
                TextInput::make('education_title')
                    ->label('Education Column Title')
                    ->default('Education')
                    ->required(),
                Repeater::make('education')
                    ->label('Education History')
                    ->schema([
                        TextInput::make('date')
                            ->label('Date Range (e.g. 2018 - 2022)')
                            ->required(),
                        TextInput::make('degree')
                            ->label('Degree / Title')
                            ->required(),
                        TextInput::make('organization')
                            ->label('School / Organization'),
                        Textarea::make('description')
                            ->label('Description')
                            ->rows(2),
                    ])
                    ->collapsible()
                    ->defaultItems(2),

                TextInput::make('experience_title')
                    ->label('Experience Column Title')
                    ->default('Experience')
                    ->required(),
                Repeater::make('experience')
                    ->label('Experience History')
                    ->schema([
                        TextInput::make('date')
                            ->label('Date Range (e.g. 2022 - Present)')
                            ->required(),
                        TextInput::make('role')
                            ->label('Job Role / Title')
                            ->required(),
                        TextInput::make('company')
                            ->label('Company / Organization'),
                        Textarea::make('description')
                            ->label('Description')
                            ->rows(2),
                    ])
                    ->collapsible()
                    ->defaultItems(2),
            ]);
    }
}
