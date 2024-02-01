<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Production\MachineManteinance;
use \Carbon\Carbon;


class ExpiringMachineManteinanceCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expiringMachineManteinance:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->manteinance_expiring_days = config('values.DAYS_ALERT_MANTEINANCE');
        $this->email = config('values.EMAIL_ALERT_MANTEINANCE');

    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        $manteinances = MachineManteinance::whereDate('expire_date', '<=', \Carbon\Carbon::now()->addDay($this->manteinance_expiring_days))
                      ->whereHas('status', function($q){
                        return $q->where('position',1);
                      })
                        ->orderBy('expire_date', 'ASC')->get();

        $subject = 'Manutenzioni in scadenza nei prossimi '.$this->manteinance_expiring_days.' giorni';
        $body =  '<style>
                      #manteinances {
                        font-family: Arial, Helvetica, sans-serif;
                        border-collapse: collapse;
                        width: 100%;
                      }

                      #manteinances td, #manteinances th {
                        border: 1px solid #ddd;
                        padding: 8px;
                      }

                      #manteinances tr:nth-child(even){background-color: #f2f2f2;}

                      #manteinances tr:hover {background-color: #ddd;}

                      #manteinances th {
                        padding-top: 12px;
                        padding-bottom: 12px;
                        text-align: left;
                        background-color: #04AA6D;
                        color: white;
                      }
                  </style>

                  <p style="margin-top:20px">
                    Elenco delle attrezzature con manutenzione in scadenza nei prossimi '.$this->manteinance_expiring_days.' giorni:
                  </p>
                  <table id="manteinances">
                      <tr>
                        <th>Tipologia</th>
                        <th>Attrezzatura</th>
                        <th>Seriale</th>
                        <th>Manutenzione</th>
                        <th>Scadenza</th>
                      </tr>
                      <tbody>';
                        foreach($manteinances as $manteinance){
                          $str='<tr>
                                    <td>'.$manteinance->machine->type->name.'</td>
                                    <td>'.$manteinance->machine->name.'</td>
                                    <td>'.$manteinance->machine->serial_number.'</td>
                                    <td>'.$manteinance->type->name.'</td>
                                    <td>'.formatDate($manteinance->expire_date, 'd/m/Y').'</td>
                                </tr>';
                          $body.=$str;
                        }
        $body.='    </tbody>
                </table>';


        $data = [
                    'address' => $this->email ,
                    'subject' => $subject,
                    'sender' => config('values.MAIL_FROM_ADDRESS'),
                    'body' => $body,
                ];
      //email

      if($manteinances->count() > 0){
        dispatch(new \App\Jobs\SendEmailJob($data));
      }

      return 1;
    }
}
