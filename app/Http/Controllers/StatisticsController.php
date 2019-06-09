<?php

namespace App\Http\Controllers;

use \Lava;
use App\MailStats;
use \Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function statistics()
    {
        $total_count = MailStats::count();
        // $stats = MailStats::orderBy('id')->all();
        $active_count = MailStats::where('subscr_status', 'active')->count();
        $inactive_count = MailStats::where('subscr_status', 'inactive')->count();

        $days_table = Lava::DataTable();
        $days_table->addDateColumn('Day')
                   ->addNumberColumn('Active')
                   ->addNumberColumn('Inactive');

        $stat_by_days = MailStats::groupBy(DB::raw('Date(created_at)'), 'subscr_status')
                                 ->orderBy(DB::raw('Date(created_at)'), 'DESC')
                                 ->get([
                                    DB::raw('Date(created_at) as "day"'),
                                    DB::raw('COUNT(*) as "sent_count"'),
                                    'subscr_status'
                                 ]);

        $stat_by_days_array = [];
        foreach ($stat_by_days as $stat) {
            $stat_by_days_array[$stat->day][$stat->subscr_status] = $stat->sent_count;
        }
        // add one empty day for start and for end of graph (because I have no time to learn Lavacharts)
        $graph_start = new Carbon(array_key_first($stat_by_days_array));
        $graph_end = new Carbon(array_key_last($stat_by_days_array));
        $days_table->addRow([$graph_start->addDays(-1), 0, 0]);
        $days_table->addRow([$graph_end->addDays(1), 0, 0]);
        //fill Lavachart
        foreach ($stat_by_days_array as $day => $stat) {
            $days_table->addRow([
                $day,
                isset($stat['active']) ? $stat['active'] : 0,
                isset($stat['inactive']) ? $stat['inactive'] : 0
            ]);
        }

        $chart = Lava::BarChart('Mail sent', $days_table, ['orientation' => 'horizontal']);

        return view('statistics', [
            'total' => $total_count,
            'active' => $active_count,
            'inactive' => $inactive_count,
        ]);
    }
}
