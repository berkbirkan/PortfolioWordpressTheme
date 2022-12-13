<?php get_header() ?>
<body>

	<div id="portfolio5-about" class="animate-box">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center portfolio5-heading">
					<h2>About Me</h2>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-4">
					<ul class="info">
					<img src="<?php echo wp_get_attachment_image_src(unserialize(get_option("header_settings"))["header_image_upload"],"full")[0]; ?>" width="250" height="250">
						<li><span class="first-block">Full Name:</span><span class="second-block"><?php echo unserialize(get_option("portfolio_aboutme_settings"))["aboutme_fullname"];  ?></span></li>
						<li><span class="first-block">Phone:</span><span class="second-block"><?php echo unserialize(get_option("portfolio_aboutme_settings"))["aboutme_phone"];  ?></span></li>
						<li><span class="first-block">Email:</span><span class="second-block"><?php echo unserialize(get_option("portfolio_aboutme_settings"))["aboutme_email"];  ?></span></li>
						<li><span class="first-block">Website:</span><span class="second-block"><?php echo unserialize(get_option("portfolio_aboutme_settings"))["aboutme_website"];  ?></span></li>
						<li><span class="first-block">Address:</span><span class="second-block"><?php echo unserialize(get_option("portfolio_aboutme_settings"))["aboutme_address"];  ?></span></li>
						<p><a href="<?php echo wp_get_attachment_url(unserialize(get_option("portfolio_aboutme_settings"))["aboutme_cv"]); ?>" class="btn btn-default btn-lg">Download CV</a></p>
					</ul>
				</div>
				<div class="col-md-8">
					<h2><?php echo unserialize(get_option("portfolio_aboutme_settings"))["aboutme_title"];  ?></h2>
					<p><?php echo nl2br(unserialize(get_option("portfolio_aboutme_settings"))["aboutme_text"],false);  ?></p>
					<p>
						<ul class="portfolio5-social-icons">
                                    <li><a href="https://<?php echo unserialize(get_option("header_settings"))["header_twitter"];  ?>"><i class="icon-twitter2"></i></a></li>
									<li><a href="https://<?php echo unserialize(get_option("header_settings"))["header_facebook"];  ?>"><i class="icon-facebook2"></i></a></li>
									<li><a href="https://<?php echo unserialize(get_option("header_settings"))["header_linkedin"];  ?>"><i class="icon-linkedin2"></i></a></li>
									<li><a href="https://<?php echo unserialize(get_option("header_settings"))["header_youtube"];  ?>"><i class="icon-youtube"></i></a></li>
									<li><a href="https://<?php echo unserialize(get_option("header_settings"))["header_github"];  ?>"><i class="icon-github"></i></a></li>
						</ul>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div id="portfolio5-resume" class="portfolio5-bg-color">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center portfolio5-heading">
					<h2>My Resume</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-md-offset-0">
					<ul class="timeline"> 
						<?php 


						//MY RESUME - WORKS

						global $wpdb;
    					global $portfolio_admin_db_version;

    					$table_name = $wpdb->prefix . 'portfolio_myworks';
						$myeducation_table = $wpdb->prefix . 'portfolio_myeducations';
						$myworks = $wpdb->get_results("SELECT * FROM $table_name");
						$myeducation = $wpdb->get_results("SELECT * FROM $myeducation_table");

						

						
						if(count($myworks) != 0){
							echo '<li class="timeline-heading text-center animate-box">
						<div><h3>Work Experience</h3></div>
					</li>';
						}


					for($myworks_index = 0; $myworks_index < count($myworks); $myworks_index++){
						
						

						if($myworks_index % 2 == 0){
							echo '<li class="animate-box timeline-unverted">';
						}else{
							echo '<li class="timeline-inverted animate-box">';
						}

						
						
						echo '<div class="timeline-badge"><i class="icon-suitcase"></i></div>
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h3 class="timeline-title">';
						echo $myworks[$myworks_index]->company_department; 
						echo '</h3><span class="company">'; 
						echo $myworks[$myworks_index]->company_name;
						echo ' - ';
						echo $myworks[$myworks_index]->working_years;
						echo '</span></div>
								<div class="timeline-body">
									<p>';
						echo $myworks[$myworks_index]->working_details;
						echo '</p></div>
									</div>
								</li>';
						//echo $single_work; 
						
						
					} 

					if(count($myworks) != 0) {
						echo '<br>';
					}
					//MY RESUME - EDUCATION

					if(count($myeducation) != 0){
						echo '<li class="timeline-heading text-center animate-box">
						<div><h3>Education</h3></div></li>';
					}


					
					for($myeducation_index = 0; $myeducation_index < count($myeducation); $myeducation_index++){

						//echo count($myeducation);
						
						if($myeducation_index % 2 == 1){
							echo '<li class="animate-box timeline-unverted">';
						}else{
							echo '<li class="timeline-inverted animate-box">';
						}
						
						echo '<div class="timeline-badge"><i class="icon-graduation-cap"></i></div>
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h3 class="timeline-title">';
						echo $myeducation[$myeducation_index]->education_type; 
						echo '</h3><span class="company">'; 
						echo $myeducation[$myeducation_index]->college_name;
						echo ' - ';
						echo $myeducation[$myeducation_index]->education_years;
						echo '</span></div>
								<div class="timeline-body">
									<p>';
						echo $myeducation[$myeducation_index]->education_details;
						echo '</p></div>
									</div>
								</li>';
						//echo $single_work;
						
					}

					

					
						?>
						

						
						
						
			    	</ul>
				</div>
			</div>
		</div>
	</div>
	

	<div id="portfolio5-features" class="animate-box">
		<div class="container">
			<div class="services-padding">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center portfolio5-heading">
						<h2>My Services</h2>
					</div>
				</div>
				<?php 

				//MY SERVICES

				global $wpdb;
				global $portfolio_admin_db_version;

				$table_name = $wpdb->prefix . 'portfolio_myservices';

				$myservices = $wpdb->get_results("SELECT * FROM $table_name");

				//for loop for services
				for($myservices_index = 0; $myservices_index < count($myservices); $myservices_index++){

					if($myservices_index % 3 == 0){
						echo '<div class="row">';
					}

					echo '<div class="col-md-4 text-center">
					<div class="feature-left">
						<span class="icon">
							<i class="';
					echo $myservices[$myservices_index]->services_icon;
					echo '"></i>
					</span>
					<div class="feature-copy">
						<h3>';
					echo $myservices[$myservices_index]->services_name;
					echo '</h3>
						<p>';
					echo $myservices[$myservices_index]->services_details;
					echo '</p>
					</div></div>
					</div>';

					if($myservices_index % 3 == 2){
						echo '</div>';
					}
				}

				
				
				?>
				


				
			</div>
		</div>
	</div>

	<div id="portfolio5-skills" class="animate-box">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center portfolio5-heading">
					<h2>Skills</h2>
				</div>
			</div>

			<?php
			
			//MY SKILLS

			global $wpdb;
			global $portfolio_admin_db_version;

			$table_name = $wpdb->prefix . 'portfolio_myskills';

			$myskills = $wpdb->get_results("SELECT * FROM $table_name");

			$skill_count = count($myskills);
			$skills_half = $skill_count / 2;


			//charts

			echo '<div class="row">';

			
			for($myskills_index = 0; $myskills_index < count($myskills); $myskills_index++){
				echo '<div class="col-md-3 col-sm-6 col-xs-12 text-center">
				<div class="chart" data-percent="';
				echo $myskills[$myskills_index]->skills_percent;
				echo '"><span><strong>';
				echo $myskills[$myskills_index]->skills_name;
				echo'</strong>';
				echo $myskills[$myskills_index]->skills_percent;
				echo '%</span></div>
				</div>';
			}

			echo '</div>';


			//progress bar

			echo '<div class="row">
			<div class="col-md-6">';


			for($myskills_index = 0; $myskills_index < $skills_half; $myskills_index++){
				echo '<div class="progress-wrap">
				<h3><span class="name-left">';
				echo $myskills[$myskills_index]->skills_name;
				echo '</span><span class="value-right">';
				echo $myskills[$myskills_index]->skills_percent;
				echo '%</span></h3>
				<div class="progress">
				  <div class="progress-bar progress-bar progress-bar-striped active" role="progressbar"
				  aria-valuenow="';
				echo $myskills[$myskills_index]->skills_percent;
				echo '" aria-valuemin="0" aria-valuemax="100" style="width:';
				echo $myskills[$myskills_index]->skills_percent;
				echo '%">

				  </div>
				</div>
			</div>';
			}

			echo '</div>';

			echo '<div class="col-md-6">';

			for($myskills_index = $skills_half; $myskills_index < $skill_count; $myskills_index++){
				echo '<div class="progress-wrap">
				<h3><span class="name-left">';
				echo $myskills[$myskills_index]->skills_name;
				echo '</span><span class="value-right">';
				echo $myskills[$myskills_index]->skills_percent;
				echo '%</span></h3>
				<div class="progress">
				  <div class="progress-bar progress-bar progress-bar-striped active" role="progressbar"
				  aria-valuenow="';
				echo $myskills[$myskills_index]->skills_percent;
				echo '" aria-valuemin="0" aria-valuemax="100" style="width:';
				echo $myskills[$myskills_index]->skills_percent;
				echo '%">

				  </div>
				</div>
			</div>';

			}

			
			echo '</div>';


			

			


			
			?>
			
			
		</div>
	</div>

	<div id="portfolio5-work" class="portfolio5-bg-dark">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center portfolio5-heading">
					<h2>Work</h2>
				</div>
			</div>

			<div class="row">

			<?php 


			global $wpdb;
			global $portfolio_admin_db_version;

            $table_name = $wpdb->prefix . 'portfolio_myprojects';
			$myprojects = $wpdb->get_results("SELECT * FROM $table_name");
			//for loop for projects
			for ($myprojects_index = 0; $myprojects_index < count($myprojects); $myprojects_index++) {
	            echo '<div class="col-md-3 text-center col-padding animate-box">
				<a href="';
	            echo $myprojects[$myprojects_index]->projects_link;
	            echo '" class="work" style="background-image: url(';
				//echo wp_get_attachment_image_src(esc_attr($myprojects[$myprojects_index]->projects_image))[0]
				if(str_contains($myprojects[$myprojects_index]->projects_image ,"http")){
					echo $myprojects[$myprojects_index]->projects_image;
				}else{
					echo wp_get_attachment_image_src(esc_attr($myprojects[$myprojects_index]->projects_image),'full')[0];
				}
				
	            echo ');"><div class="desc">
				<h3>';
	            echo $myprojects[$myprojects_index]->projects_name;
	            echo '</h3>
				<span>';
	            echo $myprojects[$myprojects_index]->projects_category;
	            echo '</span>
				</div>
			</a>
		</div>';
            }

            echo '</div>';
			?>
			</div>




		</div>
	</div>


	

	<div id="portfolio5-blog">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center portfolio5-heading">
					<h2><?php echo unserialize(get_option("portfolio_mediumpost_options"))["medium_page_title"];  ?></h2>
					<p><?php echo unserialize(get_option("portfolio_mediumpost_options"))["medium_page_description"];  ?></p>
				</div>
			</div>
			<div class="row">
<?php

function first_sentence($content) {

    $content = html_entity_decode(strip_tags($content));
    $pos = strpos($content, '.');
       
    if($pos === false) {
        return $content;
    }
    else {
        return substr($content, 0, $pos+1);
    }
   
}
				

				$json = file_get_contents("https://api.rss2json.com/v1/api.json?rss_url=https://medium.com/feed/@" . unserialize(get_option("portfolio_mediumpost_options"))["medium_username"]);
				$data=array();
				$data = json_decode($json, true);

				$articles = $data['items'];

                $post_count = unserialize(get_option("portfolio_mediumpost_options"))["medium_post_count"];
				

				if(!$post_count){
					$post_count = 3;
				}

                for($articles_index = 0; $articles_index < count($articles); $articles_index++){
					if($articles_index == $post_count){
						break;
					}
					
					echo '<div class="col-md-4">
					<div class="portfolio5-blog animate-box">
						<a href="';

					echo $articles[$articles_index]['guid'];

	                echo '" class="blog-bg" style="background-image: url(';
					echo $articles[$articles_index]['thumbnail'];
	                echo ');"></a>
						<div class="blog-text">
							<span class="posted_on">';

					echo $articles[$articles_index]['pubDate'];

	                echo '</span>';

					echo '<h3><a href="';
					echo $articles[$articles_index]['guid'];
					echo '">';
					echo $articles[$articles_index]['title'];
					echo '</a></h3>
							<p>';
					echo first_sentence($articles[$articles_index]['description']);
					echo '</p>
							<ul class="stuff">
								
								<li><a href="';
					echo $articles[$articles_index]['guid'];
					echo '">Read More<i class="icon-arrow-right22"></i></a></li>
							</ul>
						</div></div>
						</div>';
						

	                
					

				}

				

                

               
				
				?>
				
				
			</div>
		</div>
	</div>
	
	<div id="portfolio5-started" class="portfolio5-bg-dark">
		<div class="overlay"></div>
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center portfolio5-heading">
					<h2><?php echo unserialize(get_option("portfolio_hireme_options"))["hireme_title"];  ?></h2>
					<p><?php echo unserialize(get_option("portfolio_hireme_options"))["hireme_description"];  ?></p>
					<p><a href="#" class="btn btn-default btn-lg">Contact Us</a></p>
				</div>
			</div>
		</div>
	</div>

	<div id="portfolio5-consult">
		<div class="video portfolio5-video" style="background-image: url(<?php bloginfo('template_url'); ?>/images/cover_bg_5.jpg);">
			<div class="overlay"></div>
		</div>

		
		<div class="choose animate-box">
			<h2>Contact</h2>
			<form method="post">
				<div class="row form-group">
					<div class="col-md-6">
						<input type="text" name="fname" id="fname" class="form-control" placeholder="Your firstname">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-6">
						<input type="text" name="lname" id="lname" class="form-control" placeholder="Your lastname">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-12">
						<input type="text" name="email" id="email" class="form-control" placeholder="Your email address">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-12">
						<input type="text" name="subject" id="subject" class="form-control" placeholder="Your subject of this message">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-12">
						<textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Say something about us"></textarea>
					</div>
				</div>
				<div class="form-group">
					<input type="submit" value="Send Message" class="btn btn-primary">
				</div>

			</form>	

			<?php

			if($_POST){
				// the message
				$msg = $_POST['message'];
				$user_email = $_POST['email'];
				$user_fullname = $_POST['fname'] . " " . $_POST['lname'];
				$subject = $_POST['subject'];

				$received_message = "A new message to your website " . get_bloginfo('name') . " ( " . get_bloginfo('wpurl') . ") from : \n" . $user_fullname . "User Email address : \n" . $user_email . "Subject: \n" . $subject . "Message: \n" . $msg . "\n portfolio5";
				// use wordwrap() if lines are longer than 70 characters
				$msg = wordwrap($msg,100000);
				$received_message = wordwrap($received_message,100000);
				// send email
				echo $received_message;
				mail(get_bloginfo('admin_email'),$_POST["subject"],$received_message);
			}
			?>
		</div>
	</div>

	<div id="map" class="portfolio5-map"></div>
	</div>
</body>
   <?php get_footer() ?>