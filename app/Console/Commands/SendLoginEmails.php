<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendLoginEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
{
    $users = User::select('users.id', 'users.full_name', 'users.email', 'users.phone_number', 'users.username', 'users.address', 'ru.role_id')
        ->join('role_users as ru', 'ru.user_id', '=', 'users.id')
        ->join('roles as ro', 'ro.id', '=', 'ru.role_id')
        ->groupBy('users.id', 'ru.role_id')
        ->with('roles')
        ->where('ro.id', 13)
        ->orderBy('users.id', 'DESC')
        ->get();

    foreach ($users as $user) {
        // Check if the user has already received the email within the last 5 days
        $lastEmailSentDate = $user->last_email_sent_date; // Assuming you have a column named 'last_email_sent_date' in your users table
        $currentDate = now();

        if ($lastEmailSentDate === null || $lastEmailSentDate->diffInDays($currentDate) >= 5) {
            // Generate and store the login token for the user
            $loginToken = Str::random(60); // Generate a random login token
            $user->login_token = $loginToken;
            $user->save();

            // Send the email with the login link
            $loginLink = route('login.auto', ['token' => $loginToken]);
            $data = [
                'loginLink' => $loginLink,
                'user' => $user,
            ];
            Mail::to($user->email)->send(new \App\Mail\LoginLinkMail($data));

            // Update the last email sent date for the user
            $user->last_email_sent_date = $currentDate;
            $user->save();
        }
    }

    // Check if all data in legal_professional_views table have non-null comment column
    // $allDataCommented = LegalProfessionalView::whereNull('comment')->doesntExist();
    
     $allDataCommented = Petition::where('petitions.petition_session_id', $petition_session_id)
    ->whereIn('admit_as', ['PRACTISING', 'NON_PRACTISING', 'NON_PROFIT'])
    ->whereNotIn('petitions.id', function ($query) {
        $query->select('petition_id')
            ->from('legal_professional_views');
    })
    ->leftJoin('legal_professional_views', 'petitions.id', '=', 'legal_professional_views.petition_id')
    ->whereNull('legal_professional_views.comment')
    ->orderBy('petitions.created_at', 'desc')->doesntExist();

    if ($allDataCommented) {
        // All data have non-null comment column, so stop sending emails
        $this->info('All data in legal_professional_views table have been commented. Stopping email sending.');
        return;
    }

    // Schedule the command to run again in 5 days
    $this->callSilent('schedule:run');
}

}
