<?php

$path_daily = './tagesimpuls';
$path_holiday = './feiertage';

class Song
{
    public ?string $path;
    public ?string $name;
    public ?string $title;
    public ?string $author;
    public ?string $tags;
    public ?string $day;

    public function __construct(?string $path)
    {
        $regex = "/(?'title'\w+|KW\d+-\d)-(?'day'\d+)_+(?'author'[a-zA-Z]+_[a-zA-Z]+)_+(?'tags'\w+)/";
        $this->path = $path;
        $this->name = basename($path, ".mp3");

        $matches = array();
        preg_match_all($regex, $this->name, $matches);
        if ($matches && !empty($matches)) {
            $this->title = $matches["title"][0];
            $this->day = $matches["day"][0];
            $this->author = str_replace("_", " ", $matches["author"][0]);
            $this->tags = str_replace("_", " ", $matches["tags"][0]);
        }
    }
}

function dailySong()
{
    $holiday = isHoliday();
    if ($holiday) {
        $song = getMatchingSong($GLOBALS["path_holiday"], $holiday);
        if ($song) {
            return $song;
        }
    }
    $pattern = todayPattern();
    $song = getMatchingSong($GLOBALS["path_daily"], $pattern);
    return $song;
}

function getMatchingSong($folder, $pattern)
{
    $path = $folder . '/' . $pattern . '*.mp3';
    $matches = glob($path);
    if (!$matches || empty($matches)) {
        return false;
    }
    return new Song($matches[0]);
}

function todayPattern()
{
    $weekNumber = date('W');
    $dayNumber = date('N');
    return "KW$weekNumber-$dayNumber";
}

function isHoliday()
{
    $today = date("m-d");
    $today = "04-10";

    if ($today == "12-31") {
        return "Sylvester";
    }
    if ($today == "01-01") {
        return "Neujahr";
    }
    if ($today == "01-06") {
        return "DreiKoenige";
    }
    if ($today == "05-01") {
        return "TagderArbeit";
    }
    if ($today == "08-01") {
        return "Bundesfeiertag";
    }
    if ($today == "12-24") {
        return "Heiligabend";
    }
    if ($today == "12-25") {
        return "Weihnachten";
    }
    if ($today == "12-26") {
        return "Stephanstag";
    }
    if ($today == date("m-d", strtotime('-7 days', easter_date()))) {
        return "Palmsonntag";
    }
    if ($today == date("m-d", strtotime('-3 days', easter_date()))) {
        return "Gründonnerstag";
    }
    if ($today == date("m-d", strtotime('-2 days', easter_date()))) {
        return "Karfreitag";
    }
    if ($today == date("m-d", easter_date())) {
        return "Ostern";
    }
    if ($today == date("m-d", strtotime('+1 days', easter_date()))) {
        return "Ostermontag";
    }
    if ($today == date("m-d", strtotime('+39 days', easter_date()))) {
        return "Auffahrt";
    }
    if ($today == date("m-d", strtotime('+49 days', easter_date()))) {
        return "Pfingsten";
    }
    if ($today == date("m-d", strtotime('+50 days', easter_date()))) {
        return "Pfingstmontag";
    }
    return false;
}

$song = dailySong();
?>

<div>
    <h4><?php echo $song->title; ?> <?php echo $song->author; ?>: <?php echo $song->tags; ?></h4>
    <audio controls>
        <source src="<?php echo $song->path; ?>" type="audio/mpeg">
    </audio>
</div>