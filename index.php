

<?php
// Connect to the database
$conn =  mysqli_connect("localhost", "root", "", "link");

// Function to generate a random string for the shortened URL
function generate_random_string($length = 7) {
	global $conn;
    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFG!@$^HIJKLMNOPQRSTUVW()_XYZ0123-=456789";
    //$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $random_string = "";
    for ($i = 0; $i < $length; $i++) {
        $random_string .= $characters[rand(0, strlen($characters) - 1)];
    }
	$query=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `urls` WHERE short_url='$random_string'"));
    if($query>0)
    {
       generate_random_string();
    }
    return $random_string;
}

// Function to insert the original URL and its shortened version into the database
function insert_url($url) {
    global $conn;
    $short_url = generate_random_string();
    $stmt = $conn->prepare("INSERT INTO urls (short_url, original_url) VALUES (?, ?)");
    $stmt->bind_param("ss", $short_url, $url);
    $stmt->execute();
    return $short_url;
}

// Function to look up the original URL from the database using its shortened version
function lookup_url($short_url) {
    global $conn;
    $stmt = $conn->prepare("SELECT original_url FROM urls WHERE short_url = ?");
    $stmt->bind_param("s", $short_url);
    $stmt->execute();
    $stmt->bind_result($original_url);
    $stmt->fetch();
    return $original_url;
}

// Check if a URL has been submitted
if (isset($_POST["url"])) {
    $original_url = $_POST["url"];
    // Check if the URL is valid
    if (filter_var($original_url, FILTER_VALIDATE_URL)) {
        $shortened_url = insert_url($original_url);
    } else {
        $error_message = "Invalid URL";
    }
}
if (isset($_GET["url"])) {
    $short_url = $_GET["url"];
    $original_url = lookup_url($short_url);
    if ($original_url) {
        header("Location: " . $original_url);
        exit();
    } else {
        die("Shortened URL not found");
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-KNRHX0S1Y1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'G-KNRHX0S1Y1');
  </script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shortify</title>
  <meta property="og:url" content="https://shortify.live/">
  <meta name="image" property="og:image" content="img/peeknew.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1920">
  <meta property="og:image:height" content="1080">
  <meta property="og:locale" content="en_US">
  <meta property="og:type" content="website">
  <meta property="og:title" content="Shortify">
  <meta property="og:description" name="description"
    content="Shorten your URL's in a click! Use Shortify : Link Less, Say More
Shortify Your URLs">
  <meta name="twitter:card" content="summary_large_image">
  <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
  <!-- Tailwind -->
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
 
  <!-- Alpine -->
  <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
  <script nomodule src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>
  <!-- Motion CSS -->
  <link rel="stylesheet" href="css/mujcent2.css" />
  <!-- Custom style -->
  <link rel="stylesheet" href="css/mujcent.css" />
  <!-- Poppins font -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="antialiased" bgcolor="black">



 <!-- NAVBAR -->



  <div x-data="{ open: false }" class="w-full text-gray-700 bg-cover bg-center" style="background-color:rgb(0 0 0)">
    <div class="flex flex-col max-w-screen-xl px-8 mx-auto md:items-center md:justify-between md:flex-row">
      <div class="flex flex-row items-center justify-between py-2">
        <div class="relative md:mt-8 mt-4">
          <a href="index.php"><img class="relative md:w-1/4 w-2/5" src="img/nav_logo.png"
              alt="MUJ Central"></a>
        </div>
        <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
          <svg fill="White" viewBox="0 0 20 20" class="w-6 h-6">
            <path x-show="!open" fill-rule="evenodd"
              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
              clip-rule="evenodd"></path>
            <path x-show="open" fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
      <nav :class="{ 'transform md:transform-none': !open, 'h-full': open }"
        class="h-0 md:h-auto flex flex-col flex-grow md:items-center pb-4 md:pb-0 md:flex md:justify-end md:flex-row origin-top duration-300 scale-y-0">
        <a class="font-bold text-white whitespace-nowrap px-4 py-2 mt-2 text-lg bg-transparent rounded-lg md:mt-8 md:ml-4 hover:text-gray-900 focus:outline-none focus:shadow-outline"
          href="comingsoon.html"><span class='hover-underline-animation text-white'>Pricing</span></a>

        <a class="font-bold text-white whitespace-nowrap px-4 py-2 mt-2 text-lg bg-transparent rounded-lg md:mt-8 md:ml-4 hover:text-gray-900 focus:outline-none focus:shadow-outline"
          href="comingsoon.html"><span
            class='hover-underline-animation text-white'>Features</span></a>
        <a class="font-bold text-white whitespace-nowrap px-4 py-2 mt-2 text-lg bg-transparent rounded-lg md:mt-8 md:ml-4 hover:text-gray-900 focus:outline-none focus:shadow-outline"
          href="comingsoon.html"><span class='hover-underline-animation text-white'><span
              class='hover-underline-animation text-darken'>Other Tools</span></span></a>
        <a class="font-bold text-white whitespace-nowrap px-4 py-2 mt-2 text-lg bg-transparent rounded-lg md:mt-8 md:ml-4 hover:text-gray-900 focus:outline-none focus:shadow-outline"
          href="comingsoon.html"><span class='hover-underline-animation text-white'>Check URL</span></a>
          
        <a href="comingsoon.html">
          <a class="font-bold whitespace-nowrap px-10 py-3 mt-2 text-lg text-center bg-white text-black rounded-full md:mt-8 md:ml-4"
            href="comingsoon.html">
            Support</a></a>
      </nav>
    </div>
  </div>


 <!-- HERO SECTION -->



  <div>
    <div class="flex justify-center items-center bg-cover bg-center"
      style="height:80vh; background-image: linear-gradient(rgb(0 0 0 / 100%), rgb(0 0 0 / 50%), rgb(0 0 0 / 50%), rgb(0 0 0 / 50%), rgb(0 0 0 / 100%)), url('https://images.unsplash.com/photo-1550745165-9bc0b252726f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80')">



       <!-- LINK CARD -->


      <div class="space-y-5 p-5 pt-24 pb-24 md:pr-14 md:pl-14 mr-4 ml-4" style="/* From https://css.glass */
          background: rgba(255, 255, 255, 0.01);
          border-radius: 16px;
          box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
          backdrop-filter: blur(7.6px);
          -webkit-backdrop-filter: blur(7.6px);
          border: 1px solid rgba(255, 255, 255, 0.25);">
        <p class="text-white font-bold md:text-5xl text-3xl flex flex-col items-center">
          <span>Link Less, Say More<br /></span>
          <span>Shortify Your URLs</span>
        </p>
        <p class="text-white font-bold text-xl flex flex-col items-center">Enter a long URL to Shortify!</p>
        <div class="flex flex-row items-center justify-center">

         <!-- LINK INPUT -->
          
          <svg data-v-2895f6bc="" fill="white" data-v-55d0503f="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
            width="30" height="30" class="mr-2">
            <path data-v-2895f6bc=""
              d="M10.27,6.64l2.88-2.88A10,10,0,0,1,24.59,1.35a11.54,11.54,0,0,1,6.05,6.06,10,10,0,0,1-2.4,11.44l-2.88,2.89.07-6.15A5.88,5.88,0,0,0,26.71,9.1,7.48,7.48,0,0,0,22.9,5.29a5.86,5.86,0,0,0-6.48,1.28ZM3.76,13.15,6.3,10.6A3.76,3.76,0,0,0,7.38,13l1.31,1.3-1.9,1.9a5.91,5.91,0,0,0-1.5,6.71A7.48,7.48,0,0,0,9.1,26.71a5.91,5.91,0,0,0,6.71-1.5l1.91-1.91L19,24.61a3.53,3.53,0,0,0,1,.7h0a3.92,3.92,0,0,0,1.16.35l.24,0-2.55,2.55A10,10,0,0,1,7.41,30.65a11.54,11.54,0,0,1-6-6.06A10,10,0,0,1,3.76,13.15Z"
              class="a"></path>
            <path data-v-2895f6bc=""
              d="M17,19.21l-3.84,3.9c-2.5,2.54-6.7-1.89-4.27-4.35l3.83-3.9L9.22,11.3a1.07,1.07,0,0,1,0-1.5,1,1,0,0,1,.67-.31l11.35-.12a1,1,0,0,1,1.17,1.21l-.13,11.58a1,1,0,0,1-1.17.91,1.09,1.09,0,0,1-.6-.31Z"
              class="b"></path>
          </svg>
          <div class="mr-3 p-3 w-3/4 rounded-md bg-gradient-to-r from-blue-500 via-red-500 to-yellow-500 p-0.5">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
          <input type="url" placeholder="Enter a long URL"
            class="mr-3 p-3 font-semibold rounded-md focus:outline-none focus:ring-1 focus:ring-red-300 w-full" name="url" required/>
          </div>
          <button class="relative p-0.5 inline-flex items-center justify-center font-bold overflow-hidden group rounded-md bg-gradient-to-r from-blue-500 via-red-500 to-yellow-500" type="submit">
              <span
                class="relative px-3 py-2.5 transition-all ease-out bg-gray-900 rounded-md duration-400">
                <img src="img/nav_logo.png" alt="image" class="md:h-7 md:w-full h-6 w-32">
              </span>
        </form>
        </button>
        </div>

         <!-- LINK OUTPUT -->


        <div class="flex flex-row items-center justify-center">
          <svg data-v-55d0503f="" width="32" height="32" viewBox="0 0 24 24" fill="white"
            xmlns="http://www.w3.org/2000/svg" class="mr-2">
            <g clip-path="url(#clip0)">
              <path
                d="M16.28 4.71973C15.987 4.42676 15.5124 4.42676 15.2194 4.71973L0.21949 19.7197C-0.0734889 20.0127 -0.0734889 20.4872 0.21949 20.7802L3.21949 23.7802C3.36595 23.9267 3.55787 23.9999 3.74978 23.9999C3.94169 23.9999 4.13356 23.9267 4.28007 23.7802L19.28 8.78027C19.573 8.48729 19.573 8.01271 19.28 7.71973L16.28 4.71973ZM3.74973 22.1894L1.81031 20.25L11.9997 10.0606L13.9392 12C13.9392 12 3.74973 22.1894 3.74973 22.1894ZM14.9997 10.9395L13.0603 8.99999L15.7497 6.31056L17.6891 8.25002L14.9997 10.9395Z"
                fill="white"></path>
              <path
                d="M10.5 6C11.25 4.50002 12 3.75001 13.5 3C12 2.24999 11.25 1.50002 10.5 0C9.74999 1.49998 8.99992 2.24999 7.5 3C9.00002 3.75001 9.74999 4.50002 10.5 6Z"
                fill="white"></path>
              <path
                d="M22.5 10.5C22.125 11.25 21.7499 11.625 21 12C21.75 12.375 22.125 12.75 22.5 13.5C22.875 12.7499 23.25 12.375 24 12C23.25 11.625 22.875 11.25 22.5 10.5Z"
                fill="white"></path>
              <path
                d="M22.5 2.25096C21.375 1.68844 20.8125 1.12597 20.25 0.000976562C19.6875 1.12597 19.1249 1.68849 18 2.25096C19.125 2.81349 19.6875 3.37596 20.25 4.50095C20.8125 3.37596 21.375 2.81344 22.5 2.25096Z"
                fill="white"></path>
            </g>
            <defs>
              <clipPath id="clip0">
                <rect width="24" height="24" fill="white"></rect>
              </clipPath>
            </defs>
          </svg>
          <div class="mr-3 p-3 w-full rounded-md bg-gradient-to-r from-blue-500 via-red-500 to-yellow-500 p-0.5">
          <input value="<?php if (isset($shortened_url)) 
          {
             echo "http://localhost/link/".$shortened_url; 
          }
          else 
          {  
            if (isset($error_message)) 
            { 
                echo "$error_message";
            }
            else
            {
              
            }
          }
          ?>" type="text" placeholder="https://shortify.live/link" id="myInput"
            class="mr-3 p-3 font-semibold rounded-md focus:outline-none w-full" readonly/>
        </div>
		
          <button onclick="copylink()"><a href=""
              class="relative p-0.5 inline-flex items-center justify-center font-bold overflow-hidden group rounded-md bg-gradient-to-r from-blue-500 via-red-500 to-yellow-500">
          
              <span
                class="relative px-3 py-2.5 transition-all ease-out bg-gray-900 rounded-md duration-400">
                <svg width='27' height='27' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'
                  xmlns:xlink='http://www.w3.org/1999/xlink'>
                  <rect width='24' height='24' stroke='none' fill='#000000' opacity='0' />


                  <g transform="matrix(1.43 0 0 1.43 12 12)">
                    <path
                      style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;"
                      transform=" translate(-8, -8)"
                      d="M 7.5 1 C 6.871094 1 6.429688 1.445313 6.210938 2 L 3.5 2 C 2.675781 2 2 2.675781 2 3.5 L 2 12.5 C 2 13.324219 2.675781 14 3.5 14 L 6 14 L 6 13 L 3.5 13 C 3.21875 13 3 12.78125 3 12.5 L 3 3.5 C 3 3.21875 3.21875 3 3.5 3 L 5 3 L 5 5 L 10 5 L 10 3 L 11.5 3 C 11.78125 3 12 3.21875 12 3.5 L 12 7 L 13 7 L 13 3.5 C 13 2.675781 12.324219 2 11.5 2 L 8.789063 2 C 8.570313 1.445313 8.128906 1 7.5 1 Z M 7.5 2 C 7.78125 2 8 2.21875 8 2.5 L 8 3 L 9 3 L 9 4 L 6 4 L 6 3 L 7 3 L 7 2.5 C 7 2.21875 7.21875 2 7.5 2 Z M 7.5 8 C 7.222656 8 7 8.222656 7 8.5 C 7 8.777344 7.222656 9 7.5 9 C 7.777344 9 8 8.777344 8 8.5 C 8 8.222656 7.777344 8 7.5 8 Z M 9.5 8 C 9.222656 8 9 8.222656 9 8.5 C 9 8.777344 9.222656 9 9.5 9 C 9.777344 9 10 8.777344 10 8.5 C 10 8.222656 9.777344 8 9.5 8 Z M 11.5 8 C 11.222656 8 11 8.222656 11 8.5 C 11 8.777344 11.222656 9 11.5 9 C 11.777344 9 12 8.777344 12 8.5 C 12 8.222656 11.777344 8 11.5 8 Z M 13.5 8 C 13.222656 8 13 8.222656 13 8.5 C 13 8.777344 13.222656 9 13.5 9 C 13.777344 9 14 8.777344 14 8.5 C 14 8.222656 13.777344 8 13.5 8 Z M 7.5 10 C 7.222656 10 7 10.222656 7 10.5 C 7 10.777344 7.222656 11 7.5 11 C 7.777344 11 8 10.777344 8 10.5 C 8 10.222656 7.777344 10 7.5 10 Z M 13.5 10 C 13.222656 10 13 10.222656 13 10.5 C 13 10.777344 13.222656 11 13.5 11 C 13.777344 11 14 10.777344 14 10.5 C 14 10.222656 13.777344 10 13.5 10 Z M 7.5 12 C 7.222656 12 7 12.222656 7 12.5 C 7 12.777344 7.222656 13 7.5 13 C 7.777344 13 8 12.777344 8 12.5 C 8 12.222656 7.777344 12 7.5 12 Z M 13.5 12 C 13.222656 12 13 12.222656 13 12.5 C 13 12.777344 13.222656 13 13.5 13 C 13.777344 13 14 12.777344 14 12.5 C 14 12.222656 13.777344 12 13.5 12 Z M 7.5 14 C 7.222656 14 7 14.222656 7 14.5 C 7 14.777344 7.222656 15 7.5 15 C 7.777344 15 8 14.777344 8 14.5 C 8 14.222656 7.777344 14 7.5 14 Z M 9.5 14 C 9.222656 14 9 14.222656 9 14.5 C 9 14.777344 9.222656 15 9.5 15 C 9.777344 15 10 14.777344 10 14.5 C 10 14.222656 9.777344 14 9.5 14 Z M 11.5 14 C 11.222656 14 11 14.222656 11 14.5 C 11 14.777344 11.222656 15 11.5 15 C 11.777344 15 12 14.777344 12 14.5 C 12 14.222656 11.777344 14 11.5 14 Z M 13.5 14 C 13.222656 14 13 14.222656 13 14.5 C 13 14.777344 13.222656 15 13.5 15 C 13.777344 15 14 14.777344 14 14.5 C 14 14.222656 13.777344 14 13.5 14 Z"
                      stroke-linecap="round" />
                  </g>
                </svg>
              </span>
            </a></button>
            
        </div>
      </div>
    </div>

  <!-- AOS init -->
  <script src="js/aosmotion.js"></script>
  <script>
    AOS.init();
  </script>
  <script>
    function copylink() {
      // Get the text field
      var copyText = document.getElementById("myInput");
    
      // Select the text field
      copyText.select();
      copyText.setSelectionRange(0, 99999); // For mobile devices
      document.execCommand("copy");
    
      // Copy the text inside the text field
      navigator.clipboard.writeText(copyText.value);
      
      event.preventDefault()
    }
    </script>
    
</body>

</html>