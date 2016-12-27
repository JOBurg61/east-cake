<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>

<html>

	<head>

		<title><?= h($this->fetch('title')) ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<?= $this->Html->css(['dropdown', 'wintergrass', 'div_layout', 'bootstrap.min','jquery-ui.min','jquery-ui.min', 'datepicker']); ?>
		<?= $this->Html->script(['hover', 'jquery-2.2.4.min', 'bootstrap.min','jquery-ui.min' ]); ?>

	</head>

<body>

	<div id="page" class="container-fluid">
		<div class="row">

		
			<?php
				if(in_array($this->request->session()->read('Auth.User.role'), ['coordinator','admin'])){
			?>		
				<div class="row">
				<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
					<div class="container">
					Auth toolbar
					</div>
				</nav>

			
				<h1><?= $this->request->session()->read('Auth.User.role') ?></h1>

			<?php
				}else{
			?>
			

			<?php
				}
			?>
		</div>
			<div class="row" id="main_body">
				<ul id="nav">	    
					<li class="top">
						<a href="http://wintergrass.com/volunteer.html" class="top_link">
						<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						</a>
					</li>        
					<li class="top"><a href="http://wintergrass.com/index.html" class="top_link"><span>Home</span></a></li>        
					<li class="top"><a href="http://wintergrass.com/lineup.html" class="top_link"><span class="down">2016 Lineup</span></a>		
						<ul class="sub">
							<li><a href="http://wintergrass.com/schedule.html">2016 Schedule</a></li>
							<li><a href="http://wintergrass.com/workshops.html">2016 Workshops</a></li>            
							<li><a href="http://wintergrass.com/lineup.html">2016 Lineup</a></li>		
						</ul>
					</li>	    
					<li class="top"><a href="http://wintergrass.com/tickets.html" class="top_link"><span class="down">Tickets</span></a>		
						<ul class="sub">			
							<li><a href="http://wintergrass.com/tickets.html">Tickets</a></li>            
							<li><a href="http://wintergrass.com/faq.html">FAQ</a></li>		
						</ul>	
					</li>	    
					<li class="top"><a href="http://wintergrass.com/learn.html" class="top_link"><span class="down">Learn</span></a>		
						<ul class="sub">			
							<li><a href="http://wintergrass.com/educators.html">2016 Educators Prog.</a></li>			
							<li><a href="http://wintergrass.com/intensives.html">2016 Intensives</a></li>			
							<li><a href="http://wintergrass.com/youth.html">2016 Youth Education</a></li>			
							<li><a href="http://wintergrass.com/workshops.html">2016 Workshops</a></li>            		
						</ul>	
					</li>	
					<li class="top"><a href="http://wintergrass.com/community.html" class="top_link"><span class="down">Connect</span></a>		
						<ul class="sub">			
							<li><a href="http://wintergrass.wordpress.com/">Blog</a></li>			
							<li><a href="http://www.patronmail.com/pmailweb/PatronSetup?oid=2007">Newsletter Signup</a></li>            
							<li><a href="http://www.facebook.com/home.php?#/pages/Wintergrass-Bluegrass-Festival/148067328938?ref=nf">Facebook</a></li>            
							<li><a href="http://twitter.com/wintergrass">Twitter</a></li>            
							<li><a href="http://wintergrass.com/faq.html">FAQ</a></li>	    
						</ul>    
					</li>     
					<li class="top"><a href="http://wintergrass.com/volunteer.html" class="top_link"><span>Volunteer</span></a></li>       
					<li class="top"><a href="http://wintergrass.com/hotels.html" class="top_link"><span class="down">Travel</span></a>		
						<ul class="sub">			
							<li><a href="http://wintergrass.com/hotels.html">Hotel &amp; Travel</a></li>			
							<li><a href="http://wintergrass.com/dining.html">Dining</a></li>			
							<li><a href="http://wintergrass.com/faq.html">FAQ</a></li>		
						</ul>	
					</li>    
					<li class="top"><a href="http://wintergrass.com/sponsors.html" class="top_link"><span class="down">Support</span></a>		
						<ul class="sub">            
							<li><a href="http://wintergrass.com/sponsors.html">Sponsors</a></li>            
							<li><a href="http://wintergrass.com/program.html">Program Ad Rates</a></li>			
							<li><a href="http://wintergrass.com/sponsorships.html">Sponsorship Info</a></li>            
							<li><a href="http://wintergrass.com/patron.html">Patron Program Info</a></li>            
							<li><a href="http://wintergrasstickets.com/index.php/product-category/donations">Donate</a></li>			
							<li><a href="http://wintergrass.com/volunteer.html">Volunteer</a></li>            
							<!-- <li><a href="raffle.html">Raffle Info</a></li> -->		
						</ul>	
					</li>    
					<li class="top"><a href="http://wintergrass.com/vendor.html" class="top_link"><span class="down">Exhibit</span></a>		
						<ul class="sub">			
							<li><a href="http://wintergrass.com/vendor.html">Vendor Info</a></li>			
							<li><a href="http://wintergrass.com/sponsorships.html">Sponsorship Info</a></li>            
							<li><a href="http://wintergrass.com/program.html">Program Ad Rates</a></li>		
						</ul>	
					</li>    
					<li class="top"><a href="http://wintergrass.com/about.html" class="top_link"><span class="down">About</span></a>		
						<ul class="sub">			
							<li><a href="http://wintergrass.com/about.html">Who Are We?</a></li>			
							<li><a href="http://wintergrass.com/contact.html">Contact Us</a></li>            
							<li><a href="http://wintergrass.com/faq.html">FAQ</a></li>		
						</ul>	
					</li>
				</ul>
				
				<div class="row" style="position: relative; width: 100%; padding-left: 10%; padding-right: 10%">
					<?= $this->fetch('content') ?>
				</div>	
			</div>
	</div>
</body>
</html>