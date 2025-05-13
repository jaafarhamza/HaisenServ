<?php

namespace App\Services;

use App\Repositories\Interfaces\MessageRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;

class MessageService
{
    protected $messageRepository;
    protected $userRepository;

    public function __construct(
        MessageRepositoryInterface $messageRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->messageRepository = $messageRepository;
        $this->userRepository = $userRepository;
    }

    public function getAllMessages()
    {
        return $this->messageRepository->getAllMessages();
    }

    public function getMessageById($id)
    {
        return $this->messageRepository->getMessageById($id);
    }

    public function getSentMessages($userId)
    {
        return $this->messageRepository->getSentMessages($userId);
    }

    public function getReceivedMessages($userId)
    {
        return $this->messageRepository->getReceivedMessages($userId);
    }

    public function getConversation($user1Id, $user2Id)
    {
        return $this->messageRepository->getConversation($user1Id, $user2Id);
    }

    public function getConversationParticipants($userId)
    {
        return $this->messageRepository->getConversationParticipants($userId);
    }

    public function createMessage(array $data)
    {
        // Validate that both sender and recipient exist
        $sender = $this->userRepository->getUserById($data['sender_id']);
        $recipient = $this->userRepository->getUserById($data['recipient_id']);
        
        if (!$sender || !$recipient) {
            throw new \Exception('Invalid sender or recipient for this message.');
        }
        
        // Create the message
        $message = $this->messageRepository->createMessage($data);
        
        // Handle any additional business logic, such as notifications, etc.
        
        return $message;
    }

    public function markAsRead($id)
    {
        return $this->messageRepository->markAsRead($id);
    }

    public function markConversationAsRead($userId, $otherUserId)
    {
        $conversation = $this->getConversation($userId, $otherUserId);
        
        foreach ($conversation as $message) {
            if ($message->recipient_id == $userId && !$message->read) {
                $this->markAsRead($message->id);
            }
        }
        
        return true;
    }

    public function deleteMessage($id)
    {
        return $this->messageRepository->deleteMessage($id);
    }

    public function deleteConversation($user1Id, $user2Id)
    {
        // Get all messages between these users
        $messages = $this->getConversation($user1Id, $user2Id);
        
        // Delete each message
        foreach ($messages as $message) {
            $this->deleteMessage($message->id);
        }
        
        return true;
    }

    public function getUnreadMessageCount($userId)
    {
        return $this->messageRepository->getUnreadMessageCount($userId);
    }
}
