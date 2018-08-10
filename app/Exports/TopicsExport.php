<?php

namespace App\Exports;

use App\Models\Topic;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TopicsExport implements Responsable, FromQuery, WithMapping, WithHeadings, WithTitle, ShouldAutoSize, WithMultipleSheets
{
	use Exportable;

	private $fileName = 'tpoics.xlsx';

    protected $days;

    public function withinDays(int $days)
    {
        $this->days = $days;
        $this->fileName = 'topics-withinDays-'.$this->days.'.xlsx';
        return $this;
    }

    public function query()
    {
        return Topic::whereDate('created_at', '>=', now()->subDays($this->days))
            ->with('category');
    }

    public function map($topic): array
    {
        return [
            $topic->id,
            $topic->title,
            route('topics.show', $topic),
            $topic->user_id,
            $topic->category->name,
            $topic->category_id,
            $topic->view_count,
            $topic->created_at,
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            '标题',
            '链接',
            '用户id',
            '分类名称',
            '分类id',
            '阅读次数',
            '创建时间'
        ];
    }

    public function title(): string
    {
        return 'topics';
    }

    public function sheets(): array
    {
        return [
            (new self())->withinDays($this->days),
            (new UsersExport())->withinDays($this->days),
        ];
    }
}
