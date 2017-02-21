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
                        {--daysleft=21}';
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
        foreach($certificates as $certificate) {
            $certowner = $certificate->user_id;
            $user = User::where('userid', '=', $certowner);

            if ($certificate->count() == 0) continue;
            $total++;
            $data = [
                'user' => $user,
                'certificate' => $certificate,
            ];
            \Mail::send('emails.60reminder', $data, function ($m) use ($user) {
                $m->from('certivel@minibrary.com', 'Certivel');
                $m->to($user->email, $user->name)->subject('Your Certificate expires');
            });
            $this->info("$user->email 에게 알림 메일 전송");    //4
        }
        $this->info($total .' 건의 알림 메일 전송 완료');
    }
}
