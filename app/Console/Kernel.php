<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\User;
use App\Models\Masterdata\Appearance;
use App\Models\Masterdata\PetitionSession;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

            Commands\SendLoginEmails::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
//   protected function schedule(Schedule $schedule)
// {
//     $schedule->call(function () {
//         // Add your logic here to check the conditions and send the email
//         $applications = Appearance::where('petition_session_id', $petition_session_id)
//            ->whereDate('appear_date', '<', Carbon::today())->latest('appear_date')->value('appear_date');

//         $users = User::select('users.id', 'users.full_name', 'users.email', 'users.phone_number', 'users.username', 'users.address', 'ru.role_id')
//         ->join('role_users as ru', 'ru.user_id', '=', 'users.id')
//         ->join('roles as ro', 'ro.id', '=', 'ru.role_id')
//         ->groupBy('users.id', 'ru.role_id')
//         ->with('roles')
//         ->where('ro.id', 13)
//         ->orderBy('users.id', 'DESC')
//         ->get();   
//         // This code should be similar to the code you provided in the question

//         // Check if $applications exist and if $users is not empty
//         if ($applications && !$users->isEmpty()) {
//             foreach ($users as $user) {
//                 // Generate and store the login token for the user
//                 $loginToken = Str::random(60);
//                 $user->login_token = $loginToken;
//                 $user->save();

//                 // Send the email with the login link
//                 $loginLink = route('login.auto', ['token' => $loginToken]);
//                 $data = [
//                     'loginLink' => $loginLink,
//                     'user' => $user,
//                 ];

//                 \Mail::to($user->email)->send(new \App\Mail\LoginLinkMail($data));
//             }
//         }
//     })->daily();
// }


protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        $petition_session_id = PetitionSession::where('active', true)->first()->id;  
        // Add your logic here to check the conditions and send the email
        $applications = Appearance::where('petition_session_id', $petition_session_id)
            ->whereDate('appear_date', '<', Carbon::today())->latest('appear_date')->value('appear_date');

        $users = User::select('users.id', 'users.full_name', 'users.email', 'users.phone_number', 'users.username', 'users.address', 'ru.role_id')
            ->join('role_users as ru', 'ru.user_id', '=', 'users.id')
            ->join('roles as ro', 'ro.id', '=', 'ru.role_id')
            ->groupBy('users.id', 'ru.role_id')
            ->with('roles')
            ->where('ro.id', 13)
            ->orderBy('users.id', 'DESC')
            ->get();

        // This code should be similar to the code you provided in the question

        // Check if $applications exist and if $users is not empty
        if ($applications && !$users->isEmpty()) {
            foreach ($users as $user) {
                // Generate and store the login token for the user
                $loginToken = Str::random(60);
                $user->login_token = $loginToken;
                $user->save();

                // Send the email with the login link after 30 seconds
                $loginLink = route('login.auto', ['token' => $loginToken]);
                $data = [
                    'loginLink' => $loginLink,
                    'user' => $user,
                ];

                \Illuminate\Support\Facades\Mail::to($user->email)
                    ->later(now()->addSeconds(30), new \App\Mail\LoginLinkMail($data));
            }
        }
    });
}



    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
