<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

class SkillsBlock
{
    public static function make(): Block
    {
        return Block::make('skills')
            ->label('My Skills Dashboard')
            ->icon('heroicon-m-rectangle-group')
            ->schema([
                TextInput::make('title')
                    ->label('Section Title')
                    ->default('My Skills')
                    ->required(),

                Repeater::make('icons')
                    ->label('Floating Skill Icons (Left Side Grid)')
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->directory('skills-icons')
                            ->required(),
                        TextInput::make('name')
                            ->label('Alt Text / Name')
                    ])
                    ->collapsible()
                    ->grid(3),

                Repeater::make('categories')
                    ->label('Skill Categories Text List (Right Side)')
                    ->schema([
                        TextInput::make('category_name')
                            ->label('Category (e.g. Frontend)')
                            ->required(),
                        TextInput::make('skills_list')
                            ->label('Comma Separated Skills (e.g. HTML, CSS, React)')
                            ->required()
                    ])
                    ->collapsible()
            ]);
    }
}
