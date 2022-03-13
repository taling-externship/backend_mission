<?php

namespace App\Console\Commands;

use App\Mail\AuthSandMailable;
use App\Models\AuthMailList;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthSandMailCron extends Command
{
    /** The name and signature of the console command. */
    protected $signature = 'authSandMail:cron';

    /** The console command description. */
    protected $description = '회원가입, 비밀번호 찾기에 대한 메일링';

    /** Create a new command instance. */
    public function __construct()
    {
        parent::__construct();
    }

    /** Execute the console command. */
    public function handle()
    {
        // https://dev.jaedong.kim/laravel-email-verification/ 추가 하기엔 늦음
        $mailLists = AuthMailList::where('is_send', false)->get();
        foreach ($mailLists as $mailList) {
            \Log::info($mailList->getUser);
            \Log::info($mailList->getUser->getRememberToken());
            $data = array(
                'to_email' => $mailList->getUser->email,
                'to_name' => $mailList->getUser->name,
                'from_email' => env('MAIL_FROM_ADDRESS', 'help@kspark.link'),
                'from_name' => env('MAIL_FROM_NAME', 'Kyungseo-Park'),
                'title' => $mailList->type,
                'content' => $mailList->getUser->getRememberToken(),
            );

            try {
                Mail::to($mailList->getUser->email)->send(new AuthSandMailable($data));
                DB::beginTransaction();
                AuthMailList::where('id', $mailList->id)->update(['is_send' => true]);
                User::where('id', $mailList->user_id)->update(['is_valid' => true]);
                DB::commit();
                \Log::info($mailList);
            } catch (\Throwable $e) {
                DB::rollBack();
                \Log::error($e->getMessage());
            }
        }
    }
}
