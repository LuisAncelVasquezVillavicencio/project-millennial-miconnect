<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use DB;
class ReporteriaExport1 implements FromView
{
    use Exportable;
    
    private $reporteria1;
    
    public function __construct($reporteria1){
        $this->reporteria1 = $reporteria1;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.Reporteria01',["reporteria1"=>$this->reporteria1]);
    }
}