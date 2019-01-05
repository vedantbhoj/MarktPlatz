<?php
	function store_visited_pages($pagename) {
		$cookie_name = "VISITED_PAGES";
		if(!isset($_COOKIE[$cookie_name])) {
			$value = array();
		}
		else {
			// Cookies is already set. Just read its value
			$value = json_decode($_COOKIE[$cookie_name]);
		}

		// Setting the cookie
		array_push($value, $pagename);
		$value = json_encode($value);
		setcookie($cookie_name, $value, time() + (86400 * 30), "/");
	}

	function drawTable($array) {
		foreach ($array as $item) {
			echo "<tr>";
			echo "<td>".$item."</td>";
			echo "</tr>";
		}
	}

	function display_visited_pages() {
		echo "<html>
				<head>
				<title>
						Visited pages!
				</title>
			</head>
			<body>";

				/* Draw table if cookie was se */
				$cookie_name = "VISITED_PAGES";
				if(!isset($_COOKIE[$cookie_name])) {
					echo "<br><b><h2>No pages visited yet!</h2><b>";
				}
				else {
					echo "<!-- table headers -->
						<br><table class='table table-striped' border='1'>
						<thread><tr style='font-size:15px;'><th>Pages</th></tr></thread><tbody>";
					// Cookies is already set. Just read its value
					$value = json_decode($_COOKIE[$cookie_name]);
					drawTable($value);
					echo "</tbody></table></body>";
				}
		echo "</html>";
		
	}
?>
