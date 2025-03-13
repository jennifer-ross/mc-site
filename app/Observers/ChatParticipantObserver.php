<?php

namespace App\Observers;

use App\Models\ChatParticipant;
use Psr\SimpleCache\InvalidArgumentException;

class ChatParticipantObserver
{
    /**
     * Handle the ChatParticipant "created" event.
     */
    public function created(ChatParticipant $chatParticipant): void
    {
		$chatParticipant->cache();
    }

    /**
     * Handle the ChatParticipant "updated" event.
     */
    public function updated(ChatParticipant $chatParticipant): void
    {
		$chatParticipant->cache();
    }

	/**
	 * Handle the ChatParticipant "deleted" event.
	 * @throws InvalidArgumentException
	 */
    public function deleted(ChatParticipant $chatParticipant): void
    {
		$chatParticipant->removeCache();
    }

    /**
     * Handle the ChatParticipant "restored" event.
     */
    public function restored(ChatParticipant $chatParticipant): void
    {
		$chatParticipant->cache();
    }

	/**
	 * Handle the ChatParticipant "force deleted" event.
	 * @throws InvalidArgumentException
	 */
    public function forceDeleted(ChatParticipant $chatParticipant): void
    {
		$chatParticipant->removeCache();
    }
}
