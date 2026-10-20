<?php
namespace App\Services;

class KatalogService
{
    public function all(): array
    {
        return [
            ['kode' => 'IF301', 'nama' => 'Pengembangan Web'],
            ['kode' => 'IF302', 'nama' => 'Basis Data'],
            ['kode' => 'IF303', 'nama' => 'Rekayasa Perangkat Lunak'],
            ['kode' => 'IF304', 'nama' => 'Algoritma dan Pemrograman'],
            ['kode' => 'IF305', 'nama' => 'Jaringan Komputer'],
        ];
    }

    public function find(string $kode): ?array
    {
        foreach ($this->all() as $item) {
            if (strcasecmp($item['kode'], $kode) === 0) {
                return $item;
            }
        }
        return null;
    }
}