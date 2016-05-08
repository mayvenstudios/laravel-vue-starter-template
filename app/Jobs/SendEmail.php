<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Models\User;
use Config;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendEmail extends Job implements ShouldQueue
{

    use InteractsWithQueue, SerializesModels;

    /**
     * template name from which an email should render
     *
     * @var string
     */
    protected $view;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var string
     */
    protected $to;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $from;


    /**
     * Create a new job instance.
     *
     * @param string $view template name from which an email should render
     * @param array $data additional parameters to be forwarded to the template
     * @param string $to receiver email
     * @param string $subject email subject
     * @param string|null $from sender email address
     */
    public function __construct($view, array $data, $to, $subject, $from = null)
    {
        $this->view = $view;
        $this->data = $data;
        $this->to = $to;
        $this->subject = $subject;
        $this->from = $from ? $from : Config::get('mail.from')['address'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /** @var User $user */
        $user = User::withTrashed()->where('email', $this->to)->first();

        // don't notify deleted users of anything
        if ($user && $user->trashed()) {
            return;
        }

        $receiver = $user ?
            ['name' => $user->name, 'email' => $user->email] :
            ['name' => null, 'email' => $this->to];

        if (!isProduction()) {
            $receiver['email'] = Config::get('mail.local_catch_all_email');
        }

        Mail::send($this->view, $this->data, function ($m) use ($receiver) {
            $m->from($this->from, Config::get('mail.from')['name']);

            $m->to($receiver['email'], $receiver['name'])
                ->subject($this->subject);
        });
    }
}
