<?php

namespace App\Http\Controllers;

use \Lava;
use App\MailStats;
use App\PagesStats;
use \Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function mail_statistics()
    {
        $total_count = MailStats::count();
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

        return view('mail_statistics', [
            'total' => $total_count,
            'active' => $active_count,
            'inactive' => $inactive_count,
        ]);
    }

    public function pages_statistics()
    {
        $stats = PagesStats::all();
        $stats_total = $stats->count();
        $stats_per_page = [];
        for ($i=1;$i<4;$i++) {
            $stats_per_page[$i] = $stats->where('target_number', $i)->count();
        }

        $days_table = Lava::DataTable();
        $days_table->addDateColumn('Day')
                   ->addNumberColumn('1')
                   ->addNumberColumn('2')
                   ->addNumberColumn('3');

        $stat_by_days = PagesStats::groupBy(DB::raw('Date(created_at)'), 'target_number')
                                  ->orderBy(DB::raw('Date(created_at)'), 'DESC')
                                  ->get([
                                    DB::raw('Date(created_at) as "day"'),
                                    DB::raw('COUNT(*) as "view_count"'),
                                    'target_number'
                                  ]);

        $stat_by_days_array = [];
        foreach ($stat_by_days as $stat) {
            $stat_by_days_array[$stat->day][$stat->target_number] = $stat->view_count;
        }
        // add one empty day for start and for end of graph (because I have no time to learn Lavacharts)
        $graph_start = new Carbon(array_key_first($stat_by_days_array));
        $graph_end = new Carbon(array_key_last($stat_by_days_array));
        $days_table->addRow([$graph_start->addDays(-1), 0, 0, 0]);
        $days_table->addRow([$graph_end->addDays(1), 0, 0, 0]);
        // fill Lavachart
        foreach ($stat_by_days_array as $day => $stat) {
            $days_table->addRow([
                $day,
                isset($stat['1']) ? $stat['1'] : 0,
                isset($stat['2']) ? $stat['2'] : 0,
                isset($stat['3']) ? $stat['3'] : 0
            ]);
        }

        $chart = Lava::BarChart('Page views', $days_table, ['orientation' => 'horizontal']);

        return view('pages_statistics', [
            'total' => $stats_total,
            'page_1' => $stats_per_page[1],
            'page_2' => $stats_per_page[2],
            'page_3' => $stats_per_page[3]
        ]);
    }
}
