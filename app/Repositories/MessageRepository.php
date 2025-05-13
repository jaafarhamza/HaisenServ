<?php

namespace App\Repositories;

use App\Models\Message;
use App\Models\User;
use App\Repositories\Interfaces\MessageRepositoryInterface;
use Illuminate\Support\Facades\DB;

class MessageRepository implements MessageRepositoryInterface
{
    public function getAllMessages()
    {
        return Message::with(['sender', 'recipient'])->latest()->get();
    }

    public function getMessageById($id)
    {
        return Message::with(['sender', 'recipient'])->findOrFail($id);
    }

    public function getSentMessages($userId)
    {
        return Message::where('sender_id', $userId)
            ->with('recipient')
            ->latest()
            ->get();
    }

    public function getReceivedMessages($userId)
    {
        return Message::where('recipient_id', $userId)
            ->with('sender')
            ->latest()
            ->get();
    }

    public function getConversation($user1Id, $user2Id)
    {
        return Message::where(function ($query) use ($user1Id, $user2Id) {
                $query->where('sender_id', $user1Id)
                    ->where('recipient_id', $user2Id);
            })
            ->orWhere(function ($query) use ($user1Id, $user2Id) {
                $query->where('sender_id', $user2Id)
                    ->where('recipient_id', $user1Id);
            })
            ->with(['sender', 'recipient'])
            ->orderBy('send_date', 'asc')
            ->get();
    }

    public function getConversationParticipants($userId)
    {
        $senderIds = Message::where('recipient_id', $userId)
            ->select('sender_id')
            ->distinct()
            ->pluck('sender_id');
            
        $recipientIds = Message::where('sender_id', $userId)
            ->select('recipient_id')
            ->distinct()
            ->pluck('recipient_id');
            
        $participantIds = $senderIds->merge($recipientIds)->unique();
        
        return User::whereIn('id', $participantIds)->get();
    }

    public function createMessage(array $data)
    {
        if (!isset($data['send_date'])) {
            $data['send_date'] = now();
        }
        
        if (!isset($data['read'])) {
            $data['read'] = false;
        }
        
        return Message::create($data);
    }

    public function markAsRead($id)
    {
        $message = $this->getMessageById($id);
        $message->read = true;
        $message->save();
        return $message;
    }

    public function deleteMessage($id)
    {
        $message = $this->getMessageById($id);
        $message->delete();
        return true;
    }

    public function getUnreadMessageCount($userId)
    {
        return Message::where('recipient_id', $userId)
            ->where('read', false)
            ->count();
    }
}
