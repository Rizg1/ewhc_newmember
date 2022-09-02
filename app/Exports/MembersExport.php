<?php

namespace App\Exports;


use App\Member;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MembersExport implements FromQuery, WithHeadings
{
    protected $from_date;

    protected $end_date;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($from_date, $end_date) {
        $this->from_date = $from_date;
        $this->end_date = $end_date;
    }   

    public function query()
        {
            $data = Member::query()->whereDate('created_at','>=',$this->from_date)->whereDate('created_at','<=',$this->end_date)
                        ->select( 'name','company','date_avail', 'provider', 'type_avail','amount','batch_num', 'check_num', 'check_am','check_date')
                        ->orderBy('id', 'desc');
    
             return $data;
        }

        public function headings(): array
        {
            return [
                'Name of Patient',
                'Name of Company',
                'Date of Availment',
                'Name of Provider',
                'Type of Availment',
                'Type of Test Done',
                'Amount',
                'Batch Number',
                'Check Number',
                'Check Amount',
                'Check Date',
                
            ];
        }
}
