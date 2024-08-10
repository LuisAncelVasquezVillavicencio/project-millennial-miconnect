<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use DB;
class ReporteriaExport3 implements FromView
{
    use Exportable;
    
    private $reporteria3;
    
    public function __construct($reporteria3){
        $this->reporteria3 = $reporteria3;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.Reporteria03',["reporteria3"=>$this->reporteria3]);
    }
}