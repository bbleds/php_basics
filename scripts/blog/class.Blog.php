<?php 
$root = realpath($_SERVER['DOCUMENT_ROOT']);
// require library class

/**
 * @author Ben Bledsoe
 * @copyright 2016, The A Group
 *
 * Provides operations for posting and interacting with blog entries
 */
class Blog {
	
	/**
	 * Blog::get_entries()
	 *
	 * Returns all blog entry records
	 *
	 * @access public
	 *
	 * @return array $resp
	 */	
	public static function get_entries() {
		$resp = /*library class*/::find('blog_entries', array(), array('date_posted'=>-1));

		return $resp;
	}
	
	/**
	 * Blog::get_single_entry()
	 *
	 * Returns a single blog entry by id
	 *
	 * @access public
	 * 
	 * @param string $id
	 *
	 * @return array $resp
	 */	
	public static function get_single_entry($id){
		
		$error_message = 'There was an error retrieving this page, invalid ID received, please try again later! <br/><a href="index.php">Go Back!</a>';
		
		// will die if $id is invalid
		$id = self::validate_mongo_id($id, $error_message);
		
		$resp = /*library class*/::findById('blog_entries',$id);
		
		if($resp['error']){
			die($error_message);
		}
		
		return $resp;
	}
	
	
	/**
	 * Blog::post_entry()
	 *
	 * Post a single blog entry
	 *
	 * @access public
	 * 
	 * @param array $postData
	 *
	 * @return array $resp
	 */	
	public static function post_entry($postData){
		 $resp = /*library class*/::insert('blog_entries', $postData);
		 
		 return $resp;
	}
	
	/**
	 * Blog::add_comment()
	 *
	 * Posts a comment to a blog entry by blog entry id
	 *
	 * @access public
	 * 
	 * @param string $id
	 * @param array $commentDetails
	 *
	 * @return array $resp
	 */	
	public static function add_comment($id, $commentDetails){
		
		$error_message = 'There was an error processing your comment, please try again later! <br/><a href="../index.php">Go Back!</a>';
		
		// will die if $id is invalid 
		$id = self::validate_mongo_id($id, $error_message);
	
		// insert new comment array
		$resp = /*library class*/::findAndModify('blog_entries', array('_id'=>$id), array('$push'=>array("comments" => $commentDetails)));
		
		return $resp;
	}
	
	/**
	 * Blog::get_comments()
	 *
	 * Returns all comments for a blog entry by blog entry id
	 *
	 * @access public
	 * 
	 * @param string $id
	 *
	 * @return array $comments
	 */	
	public static function get_comments($id){
		
		$error_message = 'There was an error processing your comment, please try again later! <br/><a href="index.php">Go Back!</a>';
		
		// will die if $id is invalid
		$id = self::validate_mongo_id($id, $error_message);
		
		$resp = /*library class*/::find('blog_entries', array('_id'=>$id), array('date_posted', 1));
		$comments = $resp['data']['rows'][0]['comments'];
		
		return $comments;	
	}
	
	/**
	 * Blog::print_session_val()
	 *
	 * Prints the session value for an input field if it exists
	 *
	 * @access public
	 *
	 * @param $sessionVar
	 *
	 * @return void
	 */
	public static function print_session_val($sessionVar){
		if( (isset($_SESSION[$sessionVar])) && (!empty($_SESSION[$sessionVar])) ){
			print $_SESSION[$sessionVar];
		}
	}
	
	/**
	 * Blog::get_total_blog_entries()
	 *
	 * Retrieves the total number of blog entries
	 *
	 * @access public
	 *
	 * @return int $total
	 */
	public static function get_total_blog_entries(){
		$resp = /*library class*/::count('blog_entries');
		
		$total = $resp['data']['count'];
		
		return $total;
	}
	
	/**
	 * Blog::count_blog_entry_comments()
	 *
	 * Returns the total number of comments for a specific blog entry
	 *
	 * @access public
	 * 
	 * @param string|object $id
	 *
	 * @return int $total
	 */
	public static function count_blog_entry_comments($id){
		$error_message = 'No ID given, please try again! <br/><a href="index.php">Go Back!</a>';
		
		// will die if invalid id
		$comments = self::get_comments($id);
		
		$total = count($comments);
		
		return $total;
	}
	
	/**
	 * Blog::validate_mongo_id()
	 *
	 * Validate that an id exists and is a valid MongoId object
	 *
	 * @access private
	 * 
	 * @param string|object $id
	 * @param string $errorMessage
	 *
	 * @return object $id
	 */
	public static function validate_mongo_id($id, $errorMessage){
		if( empty($id) ){
			die($errorMessage);
		}
		
		if( !is_object($id) ){
			try {
				$id = new MongoId($id);		
			}	catch (MongoException $e) {
				die($errorMessage);
			}
		}
		
		return $id;
	}
		
}

// connect to db
?>

