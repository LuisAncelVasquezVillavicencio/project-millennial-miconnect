<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use DB;
class ReporteriaExport2 implements FromView
{
    use Exportable;
    
    private $reporteria2;
    
    public function __construct($reporteria2){
        $this->reporteria2 = $reporteria2;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.Reporteria02',["reporteria2"=>$this->reporteria2]);
    }
}