<!DOCTYPE html>
<html>
<head>
    <title>Course list</title>
    <meta charset="utf-8" />
    <link href="courses.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="header">
    <h1>Courses at CSE</h1>
<!-- Ex. 1: File of Courses -->
	<?php 

	$lines;
	$course_count; ?>
	
	<?php $filename=file("courses.tsv"); 
	$size=filesize("courses.tsv");
	?>
    <p>
        Course list has <?=count($filename)?> total courses
        and
        size of <?=$size?> bytes.
    </p>
</div>
<div class="article">
    <div class="section">
        <h2>Today's Courses</h2>
<!-- Ex. 2: Today’s Courses & Ex 6: Query Parameters -->
        <?php
		$numberOfCourses;
			if (isset($_GET["number_of_courses"]) && !empty($_GET["number_of_courses"])) {
				$numberOfCourses=$_GET["number_of_courses"];
			}
			else{
				$numberOfCourses=3;
			}
		
		$listOfCourses=array();
		$todaysCourses=array();
		foreach($filename as $lines){
			$listOfCourses[]=$lines;
		}
		//var_dump($listOfCourses);
            function getCoursesByNumber($listOfCourses, $numberOfCourses){
            $resultArray = array();
//                implement here.
			
			$resultArray= array();
			$key=array_rand ( $listOfCourses, $numberOfCourses );
			foreach($key as $k)
			{
				$resultArray[]=$listOfCourses[$k];
			}
			return $resultArray;
            }

			
			$todaysCourses = getCoursesByNumber($listOfCourses, $numberOfCourses);
		//var_dump($todaysCourses); 
        ?>
        <ol>
		<?php foreach ( $todaysCourses as $course) { ?>
            <li><?=$course?></li>
		<?php } ?>	
        </ol>
    </div>
	
    <div class="section">
        <h2>Searching Courses</h2>
<!-- Ex. 3: Searching Courses & Ex 6: Query Parameters -->
        <?php
		$startCharacter="A";
		
			if (isset($_GET["character"]) && !empty($_GET["character"])) {
				$startCharacter=$_GET["character"];
			}
			else{
				$startCharacter="C";
			}
		
		$searchedCourses=array();
            function getCoursesByCharacter($listOfCourses, $startCharacter){
                $resultArray = array();
//                implement here.
			foreach($listOfCourses as $course)
			{
				if(substr($course,0,1)==$startCharacter)
				{
					$resultArray[]=$course;
				}
			}
                return $resultArray;
            }
			$searchedCourses=getCoursesByCharacter($listOfCourses, $startCharacter);
			//var_dump($searchedCourses);
        ?>
        <p>
            Courses that started by <strong>'<?=$startCharacter?>'</strong> are followings :
        </p>
        <ol>
			<?php foreach ( $searchedCourses as $course) { ?>
				<li><?=$course?></li>
			<?php } ?>
        </ol>
    </div>
    <div class="section">
        <h2>List of Courses</h2>
<!-- Ex. 4: List of Courses & Ex 6: Query Parameters -->
        <?php
		$orderby;
			if (isset($_GET["orderby"]) && !empty($_GET["orderby"])) {
				$orderby=$_GET["orderby"];
			}
			else{
				$orderby="0";
			}
		$orderedCourses=array();
		$text;
				
            function getCoursesByOrder($listOfCourses, $orderby){
                $resultArray = $listOfCourses;
//                implement here.
			if($orderby==0)
			{   $text="alphabetical order";
				sort($listOfCourses);
			}
			else{
				$text="alphabetical reverse order";
				rsort($listOfCourses);
			}
                return $listOfCourses;
            }
			
		$orderedCourses=getCoursesByOrder($listOfCourses, $orderby);
		if($orderby==0)
			{   $text="alphabetical order";
				
			}
			else{
				$text="alphabetical reverse order";
			
			}
		
		//var_dump($orderedCourses);
        ?>
        <p>
            All of courses ordered by <strong><?=$text?></strong> are followings :
        </p>
        <ol>
			<?php 
			$i=0;
			foreach ( $orderedCourses as $course) { 
			if(strlen($course)-8>20){ $l="long";}
			else{$l="nothing";}
			?>
				<li class="<?=$l?>"><?=$course?></li>
				
			<?php $i++;} ?>

        </ol>
    </div>
    <div class="section">
        <h2>Adding Courses</h2>
<!-- Ex. 5: Adding Courses & Ex 6: Query Parameters -->
		<?php $newCourse;
		$codeOfCourse;
		
		if (isset($_GET["new_course"]) && !empty($_GET["new_course"])  && isset($_GET["code_of_course"]) && !empty($_GET["code_of_course"])) {
				$newCourse = $_GET["new_course"];
				$codeOfCourse=$_GET["code_of_course"];
				$current="\n$newCourse\t$codeOfCourse";
				file_put_contents("courses.tsv",$current,FILE_APPEND);
				// echo "Adding a course is success!";?>
				 <p>Adding a course is success!"</p>
				
		<?php		}
			else{
				$news_pages = 5;
				//echo "Input course or code of the course doesn't exist.";?>
				 <p>Input course or code of the course doesn't exist.</p>
		<?php	}
		?>
		
 
    </div>
</div>
<div id="footer">
    <a href="http://validator.w3.org/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-html.png" alt="Valid HTML5" />
    </a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-css.png" alt="Valid CSS" />
    </a>
</div>
</body>
</html>