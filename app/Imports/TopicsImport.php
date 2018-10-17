<?php

namespace App\Imports;

use App\Models\Topic;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\Importable;

class TopicsImport implements ToModel, WithHeadingRow, WithMultipleSheets, WithChunkReading, WithBatchInserts
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $topic = new Topic([
            'title' => $row['标题'],
            'category_id' => (int)$row['分类id'],
            'body' => '',
            'excerpt' => '',
        ]);

        $topic->user_id = (int)$row['用户id'];

        return $topic;
    }

    public function sheets(): array
    {
        return [
            'topics' => new self(),
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function batchSize(): int
    {
        return 3;
    }
}
