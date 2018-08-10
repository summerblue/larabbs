<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromQuery, WithHeadings, WithMapping,WithTitle, ShouldAutoSize, WithEvents
{
    use Exportable;

    private $fileName = 'users.xlsx';

    protected $days;

    public function withinDays(int $days)
    {
        $this->days = $days;
        $this->fileName = 'users-published-topics-within-'.$this->days.'.xlsx';
        return $this;
    }

    public function query()
    {
        return User::query()->whereHas('topics', function($query) {
            $query->whereDate('created_at', '>=', now()->subDays($this->days));
        });
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->phone,
            $user->email,
            ($user->weixin_unionid || $user->weixin_openid) ? '是' : '否',
            $user->created_at,
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            '姓名',
            '手机',
            '邮箱',
            '是否绑定微信',
            '注册时间'
        ];
    }

    public function title(): string
    {
        return 'users';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getColumnDimension('C')->setAutoSize(false)->setWidth(10);
                $event->sheet->getColumnDimension('E')->setAutoSize(false)->setWidth(15);
            }
        ];
    }
}