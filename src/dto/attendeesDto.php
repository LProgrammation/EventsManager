<?php 
        
namespace Src\Dto;  

class AttendeesDto {
    public $first_name;
    public $last_name;
    public $registration_date;
    public function __construct(string $first_name, string $last_name, string|null $registration_date) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->registration_date = $registration_date;
    }
    /**
     * Get attendee as array
     * @return array
     */
        public function getAttendee() : array {
        $attendee = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'registration_date' => $this->registration_date
        ];
        return $attendee ;
    }

}
