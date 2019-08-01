class Tweet implements \JsonSerializable {
use ValidateDate;
use ValidateUuid;
/**
* id for this Tweet; this is the primary key
* @var Uuid $tweetId
**/
private $tweetId;
/**
* id of the Profile that sent this Tweet; this is a foreign key
* @var Uuid $tweetProfileId
**/
private $tweetProfileId;
/**
* actual textual content of this Tweet
* @var string $tweetContent
**/
private $tweetContent;
/**
* date and time this Tweet was sent, in a PHP DateTime object
* @var \DateTime $tweetDate
**/
private $tweetDate;

/**
* constructor for this Tweet
*
* @param string|Uuid $newTweetId id of this Tweet or null if a new Tweet
* @param string|Uuid $newTweetProfileId id of the Profile that sent this Tweet
* @param string $newTweetContent string containing actual tweet data
* @param \DateTime|string|null $newTweetDate date and time Tweet was sent or null if set to current date and time
* @throws \InvalidArgumentException if data types are not valid
* @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
* @throws \TypeError if data types violate type hints
* @throws \Exception if some other exception occurs
* @Documentation https://php.net/manual/en/language.oop5.decon.php
**/
public function __construct($newTweetId, $newTweetProfileId, string $newTweetContent, $newTweetDate = null) {
try {
$this->setTweetDate($newTweetDate);
$this->setTweetId($newTweetId);
$this->setTweetProfileId($newTweetProfileId);
$this->setTweetContent($newTweetContent);
}

//determine what exception type was thrown
catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
$exceptionType = get_class($exception);
throw(new $exceptionType($exception->getMessage(), 0, $exception));
}
}

/**
* gets all Tweets
* @param \PDO $pdo PDO connection object
* @return \SplFixedArray SplFixedArray of Tweets found or null if not found
* @throws \PDOException when mySQL related errors occur
* @throws \TypeError when variables are not the correct data type
**/
public static function getAllTweets(\PDO $pdo) : \SPLFixedArray {
// create query template
$query = "SELECT tweetId, tweetProfileId, tweetContent, tweetDate FROM tweet";
$statement = $pdo->prepare($query);
$statement->execute();

// build an array of tweets
$tweets = new \SplFixedArray($statement->rowCount());
$statement->setFetchMode(\PDO::FETCH_ASSOC);
while(($row = $statement->fetch()) !== false) {
try {
$tweet = new Tweet($row["tweetId"], $row["tweetProfileId"], $row["tweetContent"], $row["tweetDate"]);
$tweets[$tweets->key()] = $tweet;
$tweets->next();
} catch(\Exception $exception) {
// if the row couldn't be converted, rethrow it
throw(new \PDOException($exception->getMessage(), 0, $exception));
}
}
return ($tweets);
}