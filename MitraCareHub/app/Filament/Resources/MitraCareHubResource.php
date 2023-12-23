<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MitraCareHubResource\Pages;
use App\Filament\Resources\MitraCareHubResource\RelationManagers;
use App\Models\MitraCareHub;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MitraCareHubResource extends Resource
{
    protected static ?string $model = MitraCareHub::class;

    protected static ?string $navigationLabel = 'Daftar Keluhan';

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Radio::make('status')
                    ->boolean()
                    ->inline()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('name')->label(__('Nama Pelapor'))->sortable()->searchable(),
               TextColumn::make('mitra')->label(__('Nama Mitra IKR'))->sortable()->searchable(),
               TextColumn::make('description')->label(__('Deskripsi Laporan Keluhan'))->words(7),
               TextColumn::make('file'),
               IconColumn::make('status')
               ->boolean()->sortable()->searchable(),
               TextColumn::make('created_at')
                ->dateTime('d M Y')
            ])
            ->filters([
                // Filter::make('Selesai')
                //     ->query(fn (Builder $query): Builder => $query->where('status', true)),
                // Filter::make('Belum Selesai')
                //     ->query(fn (Builder $query): Builder => $query->where('status', false)),

                // SelectFilter::make('Selesai')->relationship('status', 'name'),

                SelectFilter::make('status')
                    ->multiple()
                    ->options([
                            '1' => 'Selesai',
                            '0' => 'Belum Selesai',

                        ])
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            TextEntry::make('name'),
            TextEntry::make('mitra'),
            TextEntry::make('description'),
            TextEntry::make('file'),
            IconEntry::make('status')->boolean(),
            TextEntry::make('created_at'),
        ]);
}

    public static function getRelations(): array
    {
        return [
            //
        ];
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMitraCareHubs::route('/'),
            // 'create' => Pages\CreateMitraCareHub::route('/create'),
            // 'edit' => Pages\EditMitraCareHub::route('/{record}/edit'),
        ];
    }
}
