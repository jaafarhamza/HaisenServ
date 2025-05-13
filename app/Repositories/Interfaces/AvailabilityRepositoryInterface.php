<?php

namespace App\Repositories\Interfaces;

interface AvailabilityRepositoryInterface
{
    public function getAllAvailabilities();
    public function getAvailabilityById($id);
    public function getAvailabilitiesByService($serviceId);
    public function createAvailability(array $data);
    public function updateAvailability($id, array $data);
    public function deleteAvailability($id);
    public function checkAvailability($serviceId, $dateTime);
    public function getAvailableTimeSlots($serviceId, $date);
}
