<?php

$basepath = 'resources/';

class Song
{
    public ?string $path;
    public ?string $name;
    public ?string $author;
    public ?string $tags;
    public int $week;
    public int $day;

    public function __construct(?string $path)
    {
        $this->path = $path;
        $this->name = basename($path, ".mp3");
    }
}

function dailySong()
{
    $holiday = isHoliday();
    if($holiday) {
        echo $holiday;
    } else {
    }

    return new Song($GLOBALS["basepath"] . 'test.mp3');
}

function todayPattern() {
    $weekNumber = date('W');
    $dayNumber = date('N');
    return "KW$weekNumber-$dayNumber";
}

function isHoliday() {
    $today = date("m-d");
    #$today = "12-24";

    if($today == "12-31") {
        return "Sylvester";
    }
    if($today == "01-01") {
        return "Neujahrstag";
    }
    if($today == "01-06") {
        return "Heilige_Drei_Könige";
    }
    if($today == "05-01") {
        return "Tag_der_Arbeit";
    }
    if($today == "08-01") {
        return "Bundesfeier";
    }
    if($today == "12-24") {
        return "Heiliger_Abend";
    }
    if($today == "12-25") {
        return "Weihnachtstag";
    }
    if($today == "12-26") {
        return "Stephanstag";
    }
    if($today == date("m-d", strtotime('-3 days', easter_date()))) {
        return "Gründonnerstag";
    }
    if($today == date("m-d", strtotime('-2 days', easter_date()))) {
        return "Karfreitag";
    }
    if($today == date("m-d", easter_date())) {
        return "Ostersonntag";
    }
    if($today == date("m-d", strtotime('+1 days', easter_date()))) {
        return "Ostermontag";
    }
    if($today == date("m-d", strtotime('+39 days', easter_date()))) {
        return "Auffahrt";
    }
    if($today == date("m-d", strtotime('+49 days', easter_date()))) {
        return "Pfingstsonntag";
    }
    if($today == date("m-d", strtotime('+50 days', easter_date()))) {
        return "Pfingstmontag";
    }
    return false;
}

$song = dailySong();
?>

<div>
    <h4><?php echo $song->name; ?></h4>
    <audio controls>
        <source src="<?php echo $song->path; ?>" type="audio/mpeg">
    </audio>
</div>