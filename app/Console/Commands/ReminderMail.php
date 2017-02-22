<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Certificate;
use App\User;

class ReminderMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:mail
                        {--daysleft=}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Expiry Reminder Emails';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $daysleft = $this->option('daysleft');
        $certificates = Certificate::all()->where('daysleft', '=', $daysleft);
        $total = 0;
        foreach($certificates as $certificate)
        {
          if ($certificate->count() == 0) continue;
          $total++;
            foreach($certificate->user()->get() as $user)
            {
              $data = [
                  'user' => $user,
                  'certificate' => $certificate,
              ];
              \Mail::send('emails.60reminder', $data, function ($m) use ($user, $certificate, $daysleft) {
                  $m->from('certivel@minibrary.com', 'Certivel');
                  $m->to($user->email, $user->name)->subject("Certivel Alert: Certificate of " . $certificate->fqdn . " will be expired in " . $daysleft .  " days!");
              });
              $this->info("$user->email 에게 알림 메일 전송");    //4
            }
        }
        $this->info($total .' 건의 알림 메일 전송 완료');
    }
}
