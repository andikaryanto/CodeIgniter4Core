<?php
  /**
   * This demo is partly based on a post by Anthony Sterling on the sitepoint forum.
   * It is partly based on a video by John Lebensold of killerphp.com
   * 
   * http://www.sitepoint.com/forums/showthread.php?t=636303
   * 
   * AnthonySterling
   * Twitter: @AnthonySterling
   * 
   * Here's a rather ridiculous, yet interesting way to use __call.
   * 
   * The original data-set could be an array of database entries-n-such.
   * 
   * Obviously not to be a practical object, for 2 reasons :
   * it's crafted wholly from my kitchen without testing and finally, it's rubbish.
   * 
   */

  /**
   * ===============================================
   *  USING __CALL INSTEAD OF __GET AND __SET
   * ===============================================
   * I would like to have a base class that provides inheritance, and which
   * uses __call for most generic method calls in order to get/set properties.
   * This is a small example of the concept. I have a working model that uses 
   * __set and __get that works very well, but...
   *
   * after watching a video by John Lebensold of killerphp.com
   * http://www.killerphp.com/tutorials/advanced-php/videos/advanced-php-6.php
   *
   * I realized that __call was a far better choice for what I wanted.
   * 
   * I have run into a small snag, and am hoping someone can help me solve it.
   *
   * In order to see the problem set $show_ugly_workaround to true at the end of 
   * the class, at the beginning of the demo portion.
   */

  class storage
  {
    protected $data;
    protected $aMessages = array();

    public function __construct($data)
    {
      $this->data = $data;
    }

    public function getBookArray($user_no, $book_no)
    {
      /**
       * This handles returning information about a book in the form of an array.
       * The __call method below handles getting and setting all properties, and can
       * be used set arrays as well, but for some reason I was not able to get
       * __call to return an array, in particular I could not make the next line work.
       *
       * $aObj = $storage->getUsers(5)->getBooks(1);
       *
       * As an ugly workaround I wrote this method which returns the books array, but
       * I would have preferred to have __call return the array.
       */
      return $this->data['users'][$user_no]['books'][$book_no];
    }
    
    public function __call($method, $arguments)
    {
      /**
      * __call as I have set it up below, can set variable primitive types, as well
      * as arrays, but can only return primitives (no arrays) as I currently have it 
      * setup. I did not want to use __set and __get, I wanted to use __call only.
      * 
      * looking at the colors property which contains a multi-dimensional array
      * 
      * Using __call overloading as defined here:
      * 
      * you can set a primitive using : $storage->setBr("<br>");
      * you can get a primitive using : echo $storage->getBr();
      * 
      * you can set an array such as $colors as shown on the next line:
      * $storage->setColors
      * (
      * array
      *   (
      *     'foreground' => array
      *     (
      *       "header"  => "black",
      *       "block"   => "orange",
      *       "body"    => "black",
      *       <snip> ... </snip>
      *     )
      *   )
      * );  // End of : $storage->setColors
      * 
      * you can get any of the elements in the multi-dimensional array as follows:
      * echo "$storage->getColors('foreground')->getBody();   // returns "black"
      * 
      * but  I cannot retrieve an entire array using __call, by calling:
      *
      * $aObj = $storage->getUsers(5)->getBooks(1);   // fails to return the array
      * $aArray = (array) $aObj;            // casting to array does not help
      * 
      * I had to create a specific method: public function getBookArray($user_no, $book_no)
      * in order to retrieve the entire array, something I did not want to do. I was hoping 
      * to be able to do both set/get using __call and only create specific methods whenever 
      * internal calculations, or changing other affected variables, or other actions need 
      * to be taken.
      * 
      * The $message_no's are temporary until I come up with a finished version.
      */
      
      $methodPrefix = substr($method, 0, 3);
      $methodProperty = strtolower($method[3]) . substr($method, 4);
      $number_of_arguments = count($arguments);
      $message = "$number_of_arguments arguments were provided for \\$methodProperty : $methodProperty";

      switch($methodPrefix)
      {
        case "get":
              if(true === array_key_exists($methodProperty, $this->data))
              {
                $message_no = "0001";
                $this->aMessages[ ] = "[" . $message_no . "] " . $message;
                if(is_array($this->data[$methodProperty]) && $number_of_arguments > 0)
                {
                  $message_no = "0002";
                  $this->aMessages[ ] = "[" . $message_no . "] " . $message;
                  if(true === array_key_exists($arguments[0], $this->data[$methodProperty]))
                  {
                    $message_no = "0003";
                    $this->aMessages[ ] = "[" . $message_no . "] " . $message;
                    return new self($this->data[$methodProperty][$arguments[0]]);
                  }
                }
                $message_no = "0004";
                $this->aMessages[ ] = "[" . $message_no . "] " . $message;
                return $this->data[$methodProperty];
              }
              break;
        case "set":
              if(true === array_key_exists($methodProperty, $this->data))
              {
                if(is_array($this->data[$methodProperty]) && $number_of_arguments > 0)
                {
                  $this->data[$methodProperty] = $arguments;
                  $message_no = "0005";
                }
                else
                {
                  $message_no = "0006";
                }
              }
              else
              {
                if($number_of_arguments > 1)
                {
                  $this->data[$methodProperty] = $arguments;
                  $message_no = "0007";
                }
                else if($number_of_arguments == 1)
                {

                  $this->data[$methodProperty] = $arguments[0];
                  $message_no = "0008";
                }
                else
                {
                  $message_no = "0009";
                  $this->aMessages[ ] = "[" . $message_no . "] " . $message;
                  throw new Exception($message);
                }
              }
              $this->aMessages[ ] = "[" . $message_no . "] " . $message;
              break;
        default:

      }

    }
  }   // End of class storage

  // ===============================================
  //  DEMO BEGIN
  // ===============================================
  $show_ugly_workaround = false;
  
  echo "<h3> The Results...</h3>";
  
  
  $data = array(
    'users' => array(
      1 => array(
        'name' => 'sample',
        'age' => 21
      ),
      5 => array(
        'name' => 'sample',
        'age' => 25,
        'books' => array(
          1 => array(
            'title' => 'Moby-Dick (Collectors Library)',
            'isbn_10' => '0393972836',
            'isbn_13' => '978-0393972832',
            'price' => '$9.95'
          )
        )
      )
    )
  );

  /**
   * var_dump limits resursion depth to 3 levels, so print_r works better here
   * var_dump($data);
   */


  echo "<pre>";
  $s = print_r($data, true);
  $s = str_replace("  ", "  ", $s);
  echo "\\$data : " . substr($s,5);
  echo "</pre>";
  

  $storage = new storage($data);

  $storage->setBr("<br>");
  $storage->setBr2("<br><br>");

//   $storage->setHr("<hr style=\\"width:50%;float:left;\\"><br>");

  echo $storage->getHr();

  $storage->setColors
  (
  array
    (
      'primary' => array
      (
        "red"     => "#FF0000",
        "green"   => "#00FF00",
        "blue"    => "#0066CC",
        "gray"    => "#999999"
      ),
      'foreground' => array
      (
        "header"  => "black",
        "block"   => "orange",
        "body"    => "black",
        "footer"  => "gray",
        "border"  => "#CCCCCC"
      ),
      'background' => array
      (
        "header"  => "#FFFFEE",
        "block"   => "#EEEEEE",
        "body"    => "#FFFFFF",
        "footer"  => "#DDEEFF"
      )
    )
  );  // End of : $storage->setColors

  echo "\\$storage->getColors('primary')->getBlue() : " . $storage->getColors("primary")->getBlue() . $storage->getBr();
  echo "\\$storage->getColors('foreground')->getBody() : " . $storage->getColors("foreground")->getBody() . $storage->getBr();       
  echo "\\$storage->getColors('background')->getBody() : " . $storage->getColors("background")->getBody() . $storage->getBr();       
  echo $storage->getHr();

  echo 'var_dump($storage->getColors());';
  var_dump($storage->getColors());
  echo $storage->getHr();

  echo "\\$storage->getUsers(1)->getAge() : " . $storage->getUsers(1)->getAge() . $storage->getBr();
  echo "\\$storage->getUsers(5)->getAge() : " . $storage->getUsers(5)->getAge() . $storage->getBr();

  echo $storage->getHr();

  /**
   * I can get the values individually, but I would rather get the key/values
   */

  echo "Title : " . $storage->getUsers(5)->getBooks(1)->getTitle() . $storage->getBr();
  echo "ISBN-10 : " . $storage->getUsers(5)->getBooks(1)->getIsbn_10() . $storage->getBr();
  echo "ISBN-13 : " . $storage->getUsers(5)->getBooks(1)->getIsbn_13() . $storage->getBr();
  echo "Price : " . $storage->getUsers(5)->getBooks(1)->getPrice() . $storage->getBr();

  echo "<h3> The Broken Part...</h3>";
  echo $storage->getHr();

  /**
   * EVERYTHING works great up to this point...
   * 
   * However, I am doing something terribly wrong here, and can't get this to work.
   * $aArray is a portion of the original object, and not an array, so I tried casting it
   * to an array, and it shows up in the debugger as an array containing two elements, 
   * each being an array, but when I click on the elements in the debug variables window 
   * they change to the null.   
   */

  echo '$aObj = $storage->getUsers(5)->getBooks(1);' . $storage->getBr();
  $aObj = $storage->getUsers(5)->getBooks(1);

  echo 'var_dump($aObj);';
  var_dump($aObj);

  echo $storage->getHr();
  /**
   * here I would like to get the books(1) array from the $storage object
   * I tried looping through the $aObj using foreach(...) below, and that 
   * got really screwed up
   */

  if ($show_ugly_workaround)
  {
    $user_no = 5;
    $book_no = 1;
    $aArray = $storage->getBookArray($user_no, $book_no);
  }
  else
  {
    echo'$aArray = (array) $aObj;' . $storage->getBr();
    $aArray = (array) $aObj;
    
    // $aArray = get_object_vars($aObj);
  }
  
  echo 'var_dump($aArray);';
  var_dump($aArray);

  echo "<h3> The Really Broken Part...</h3>";
  echo $storage->getHr();
  
  /**
   * does not work, obviously I don't have a grasp on OOP yet. I seem to be mixing
   * apples and carrots, and ending up with mush...
   */
  $i = 0;
  foreach($aArray as $key => $value)
  {
    echo "[" . $i++ . "] $key :  $value" . $storage->getBr();
  }

  /**
   * threw this next line in here in order to set a breakpoint in the debugger that 
   * lets me view the variables just prior to exit.
   */

  $x = 5; 
  // ===============================================
  //  DEMO END
  // ===============================================
?>