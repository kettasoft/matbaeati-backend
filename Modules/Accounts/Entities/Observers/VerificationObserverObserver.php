<?php

namespace Modules\Accounts\Entities\Observers;

use Modules\Accounts\Entities\VerificationObserver;

class VerificationObserverObserver
{
    /**
     * Handle the VerificationObserver "created" event.
     */
    public function created(VerificationObserver $verificationobserver): void
    {
        //
    }

    /**
     * Handle the VerificationObserver "updated" event.
     */
    public function updated(VerificationObserver $verificationobserver): void
    {
        //
    }

    /**
     * Handle the VerificationObserver "deleted" event.
     */
    public function deleted(VerificationObserver $verificationobserver): void
    {
        //
    }

    /**
     * Handle the VerificationObserver "restored" event.
     */
    public function restored(VerificationObserver $verificationobserver): void
    {
        //
    }

    /**
     * Handle the VerificationObserver "force deleted" event.
     */
    public function forceDeleted(VerificationObserver $verificationobserver): void
    {
        //
    }
}
