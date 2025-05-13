<?php

namespace App\Repositories\Interfaces;

interface MessageRepositoryInterface
{
    public function getAllMessages();
    public function getMessageById($id);
    public function getSentMessages($userId);
    public function getReceivedMessages($userId);
    public function getConversation($user1Id, $user2Id);
    public function getConversationParticipants($userId);
    public function createMessage(array $data);
    public function markAsRead($id);
    public function deleteMessage($id);
    public function getUnreadMessageCount($userId);
}
