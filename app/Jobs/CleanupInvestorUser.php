<?php

namespace App\Jobs;

use App\Models\Entrepreneur;
use App\Models\Investor;
use Illuminate\Bus\Queueable;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CleanupInvestorUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Cleanup Job: Starting cleanup process', [
            'user_id' => $this->userId,
            'job_started_at' => now()->toDateTimeString(),
        ]);

        $user = User::find($this->userId);

        if (!$user) {
            Log::info('Cleanup Job: User not found - already deleted or never existed', [
                'user_id' => $this->userId,
            ]);
            return;
        }

        // SAFETY CHECK: Make sure user was created at least 25 minutes ago
        if ($user->created_at->addMinutes(25) > now()) {
            Log::info('Cleanup Job: User too recent, skipping cleanup', [
                'user_id' => $user->id,
                'user_created_at' => $user->created_at,
                'current_time' => now(),
                'will_retry_later' => true,
            ]);

            // Reschedule for later
            static::dispatch($this->userId)->delay(now()->addMinutes(10));
            return;
        }

        Log::info('Cleanup Job: Checking user status', [
            'user_id' => $user->id,
            'email' => $user->email,
            'role' => $user->role,
            'is_verified' => $user->is_verified,
            'created_at' => $user->created_at,
        ]);

        // Check if user is verified
        if ($user->is_verified != 1) {
            Log::info('Cleanup Job: User not verified within time limit, deleting', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
                'created_at' => $user->created_at,
                'minutes_since_creation' => $user->created_at->diffInMinutes(now()),
            ]);
            $user->delete();
            return;
        }

        $shouldDelete = false;
        $reason = '';

        // Check based on role
        if ($user->role === 'investor') {
            $investorExists = Investor::where('user_id', $user->id)->exists();
            if (!$investorExists) {
                $shouldDelete = true;
                $reason = 'Investor profile not completed within time limit';
            }
        } elseif ($user->role === 'entrepreneur') {
            $entrepreneurExists = Entrepreneur::where('user_id', $user->id)->exists();
            if (!$entrepreneurExists) {
                $shouldDelete = true;
                $reason = 'Entrepreneur profile not completed within time limit';
            }
        }

        if ($shouldDelete) {
            Log::info('Cleanup Job: Deleting user - profile not completed', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
                'reason' => $reason,
                'verified_at' => $user->updated_at,
                'minutes_since_verification' => $user->updated_at->diffInMinutes(now()),
                'deleted_at' => now()->toDateTimeString(),
            ]);
            $user->delete();
        } else {
            Log::info('Cleanup Job: User profile completed, not deleting', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
                'has_profile' => true,
            ]);
        }

    }
}