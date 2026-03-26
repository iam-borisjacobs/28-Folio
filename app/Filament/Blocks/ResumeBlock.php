<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

use Filament\Forms\Components\FileUpload;

class ResumeBlock
{
    public static function make(): Block
    {
        return Block::make('resume')
            ->label('Resume / Experience')
            ->icon('heroicon-m-academic-cap')
            ->schema([
                TextInput::make('passion_text')
                    ->label('Left Header Title')
                    ->default('+12 years of passion for programming techniques'),
                
                Repeater::make('logos')
                    ->label('Brand Logos (Left Side)')
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->directory('resume-logos')
                            ->required(),
                        TextInput::make('name')
                            ->label('Brand Name')
                            ->required(),
                        TextInput::make('years')
                            ->label('Years / Subtext (e.g. 2014 - 2024)')
                    ])
                    ->collapsible()
                    ->grid(2),

                Repeater::make('background_experience')
                    ->label('Background Experience List (Right Side)')
                    ->schema([
                        TextInput::make('title')
                            ->label('List Item Text')
                            ->required()
                    ])
                    ->collapsible()
                    ->grid(2),

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
                    ->label('Experience Timeline (Bottom Right)')
                    ->schema([
                        TextInput::make('year')->label('Year Range (e.g. 2022 - Present)')->required(),
                        TextInput::make('title')->label('Job Title')->required(),
                        TextInput::make('company')->label('Company / Organization')->required(),
                        Textarea::make('description')->label('Short Description')->rows(2),
                    ])
                    ->collapsible()
                    ->defaultItems(2),
            ]);
    }
}
