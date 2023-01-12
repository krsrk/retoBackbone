<?php

namespace App\Repositories;

use App\Helpers\StringConverter;
use App\Models\ZipCode;
use Illuminate\Support\Facades\Cache;

class ZipCodeRepository implements Repository
{
    const WITH_RELATIONS = ['settlements'];

    protected $model;

    public function __construct()
    {
        $this->model = ZipCode::class;
    }

    public function all($numberPaginatedRecords = self::NUMBER_PAGINATE_RECORDS)
    {
        // TODO: Implement all() method.
    }

    public function findById(string $id)
    {
        // TODO: Implement findById() method.
    }

    public function findBy(string $field, mixed $value)
    {
        return $this->model::with(self::WITH_RELATIONS)->where($field, '=', $value)->first();
    }

    public function toCache($data)
    {
        return Cache::remember('zip-codes', today()->endOfDay(), function () use($data) {
            return $data;
        });
    }

    public function store($data) : ZipCode
    {
        $fedEntName = mb_strtoupper($data['d_estado']);
        $fedEnt = [
            'key' => (int)$data['c_estado'],
            'name' => (new StringConverter($fedEntName))->toUpperCase(),
            'code' => (! empty($data['c_CP'])) ? $data['c_CP'] : null,
        ];

        $munName = mb_strtoupper($data['D_mnpio']);
        $municipality = [
            'key' => (int)$data['c_mnpio'],
            'name' => (new StringConverter($munName))->toUpperCase()
        ];

        return $this->model::updateOrCreate(
            ['zip_code' => $data['d_codigo']],
            [
                'locality' => (array_key_exists('d_ciudad', $data)) ? (new StringConverter($data['d_ciudad']))->toUpperCase() : '',
                'federal_entity' => json_encode($fedEnt),
                'municipality' => json_encode($municipality),
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );
    }

    public function update(string $id, $data)
    {
        // TODO: Implement update() method.
    }

    public function delete(string $id)
    {
        // TODO: Implement delete() method.
    }
}
