<?php 

namespace Src\Dto ;

class EventsDto {
    public string $event_name ;
    public string $event_location ;
    public string $start_date ;
    public string $end_date ;
    public int $max_attendees ;

    public function __construct(string $event_name, string $event_location, string $start_date, string $end_date, int $max_attendees) {
        $this->event_name = $event_name ;
        $this->event_location = $event_location ;
        $this->start_date = $start_date ;
        $this->end_date = $end_date ;
        $this->max_attendees = $max_attendees ;
    }
    /**
     * Get event as array
     * @return array
     */
    public function getEvent() : array {
        $event = [
            'event_name' => $this->event_name ,
            'event_location' => $this->event_location ,
            'start_date' => $this->start_date ,
            'end_date' => $this->end_date ,
            'max_attendees' => $this->max_attendees
        ];
        return $event ;
    }


}