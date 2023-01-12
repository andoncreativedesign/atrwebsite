<?php

$display = isset($s_array['display']) ? $s_array['display'] : 'columns';
$title_column_class = 'col-md-4';
$space_class = 'col-md-2';
$items_container_class = '';
$items_class = 'col-md-6';
$item_class = 'col-sm-6';

if ($display == 'grid') {
    $title_column_class = 'col-12';
    $space_class = 'd-none';
    $items_container_class = 'mt-4 mt-md-5';
    $items_class = 'col-12';

    $services_count = count($s_array['services']);
    if ($services_count == 2) {
        $item_class = 'col-md-6';
    } elseif ($services_count % 3 == 0) {
        $item_class = 'col-md-4';
    } else {
        $item_class = 'col-md-6 col-lg-3';
    }
}
/*echo '<pre>';
print_r($s_array['services']);
echo '</pre>';*/
ob_start();

?>

<style type="text/css">
  $dark-blue : #16354e;
  $light-blue : #4696d1;
  $gray : #8f9da9;

  %gibson-light{
    font-family: canada-type-gibson,sans-serif;
    font-weight: 200;
    font-style: normal;
  }

  %gibson-book{
    font-family: canada-type-gibson,sans-serif;
    font-weight: 300;
    font-style: normal;
  }

  %gibson-regular{
    font-family: canada-type-gibson,sans-serif;
    font-weight: 400;
    font-style: normal;
  }

  %gibson-medium{
   font-family: canada-type-gibson,sans-serif;
    font-weight: 500;
    font-style: normal;
  }

  /*html, body, div, span, applet, object, iframe,
  h1, h2, h3, h4, h5, h6, p, blockquote, pre,
  a, abbr, acronym, address, big, cite, code,
  del, dfn, em, img, ins, kbd, q, s, samp,
  small, strike, strong, sub, sup, tt, var,
  b, u, i, center,
  dl, dt, dd, ol, ul, li,
  fieldset, form, label, legend,
  table, caption, tbody, tfoot, thead, tr, th, td,
  article, aside, canvas, details, embed, 
  figure, figcaption, footer, header, hgroup, 
  menu, nav, output, ruby, section, summary,
  time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
  }*/
  /* HTML5 display-role reset for older browsers */
  article, aside, details, figcaption, figure, 
  footer, header, hgroup, menu, nav, section, main {
    display: block;
  }
  /*body {
    line-height: 1;
    overflow:hidden;
  }*/
  /*@media screen and (max-height: 700px) {
    body {
      overflow : visible;
    }
  }

  @media screen and (max-width: 550px) {
    body {
      overflow : visible;
    }
  }
*/
  .ol_history {
    list-style: none;
  }
  blockquote, q {
    quotes: none;
  }
  blockquote:before, blockquote:after,
  q:before, q:after {
    content: '';
    content: none;
  }
  table {
    border-collapse: collapse;
    border-spacing: 0;
  }

  /* -------------------------------- 

  Primary style

  -------------------------------- */
  *, *::after, *::before {
    box-sizing: border-box;
  }

  /*html {
    font-size: 62.5%;
  }

  body {
    font-size: 1.6rem;
    font-family: "Fira Sans", sans-serif;
    color: #383838;
    background-color: #ffffff;
  }*/

  .a_history {
    padding-left: 22px;
    text-decoration: none !important;
  }

  /* -------------------------------- 

  Main Components 

  -------------------------------- */
  .cd-horizontal-timeline .ol_history {
   padding-left:0;
  }
  .cd-horizontal-timeline .ol_history img {
    max-width:100% !important;
  }
  .cd-horizontal-timeline {
    opacity: 0;
    margin: 5vh auto;
    -webkit-transition: opacity 0.2s;
    -moz-transition: opacity 0.2s;
    transition: opacity 0.2s;
  }
  .cd-horizontal-timeline::before {
    /* never visible - this is used in jQuery to check the current MQ */
    content: 'mobile';
    display: none;
  }
  .cd-horizontal-timeline.loaded {
    /* show the timeline after events position has been set (using JavaScript) */
    opacity: 1;
  }
  .cd-horizontal-timeline .timeline {
    position: relative;
    height: 150px;
    width: 90%;
    max-width: 1065px;
    margin: 0 auto;
  }
  .cd-horizontal-timeline .events-wrapper {
    position: relative;
    height: 100%;
    overflow: hidden;
  }
  /*.cd-horizontal-timeline .events-wrapper::after, .cd-horizontal-timeline .events-wrapper::before {
   
    content: '';
    position: absolute;
    z-index: 2;
    top: 0;
    height: 100%;
    width: 20px;
  }
  .cd-horizontal-timeline .events-wrapper::before {
    left: 0;
    background-image: -webkit-linear-gradient( left , #f8f8f8, rgba(248, 248, 248, 0));
    background-image: linear-gradient(to right, #f8f8f8, rgba(248, 248, 248, 0));
  }
  .cd-horizontal-timeline .events-wrapper::after {
    right: 0;
    background-image: -webkit-linear-gradient( right , #f8f8f8, rgba(248, 248, 248, 0));
    background-image: linear-gradient(to left, #f8f8f8, rgba(248, 248, 248, 0));
  }*/
  .cd-horizontal-timeline .events {
    /* this is the grey line/timeline */
    position: absolute;
    z-index: 1;
    left: 0;
    top: 30px;
    height: 3px;
    /* width will be set using JavaScript */
    background: #4696d1;
    -webkit-transition: -webkit-transform 0.4s;
    -moz-transition: -moz-transform 0.4s;
    transition: transform 0.4s;
  }
  .cd-horizontal-timeline .filling-line {
    /* this is used to create the green line filling the timeline */
    position: absolute;
    z-index: 1;
    left: 0;
    top: 0;
    height: 100%;
    width: 100%;
    background-color: #4696d1;
    -webkit-transform: scaleX(0);
    -moz-transform: scaleX(0);
    -ms-transform: scaleX(0);
    -o-transform: scaleX(0);
    transform: scaleX(0);
    -webkit-transform-origin: left center;
    -moz-transform-origin: left center;
    -ms-transform-origin: left center;
    -o-transform-origin: left center;
    transform-origin: left center;
    -webkit-transition: -webkit-transform 0.3s;
    -moz-transition: -moz-transform 0.3s;
    transition: transform 0.3s;
  }
  .cd-horizontal-timeline .events a {
    position: absolute;
    width : 82px;
    height : 50px; 
    line-height : 20px;
    bottom: -80px;
    z-index: 2;
    transform : translateX(-250%) !important; 
    text-align: left;
    font-size: 15px;
    color: gray;
    /* @extend %gibson-book;*/
    /* fix bug on Safari - text flickering while timeline translates */
    -webkit-transform: translateZ(0);
    -moz-transform: translateZ(0);
    -ms-transform: translateZ(0);
    -o-transform: translateZ(0);
    transform: translateZ(0);
     transform-origin: center center;
  }
  .cd-horizontal-timeline .events a::before {
    /* this is used to create the event spot */
    content: '';
    position: absolute;
    right: auto;
    left : 50%;
    -webkit-transform: translateX(-50%);
    -moz-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    -o-transform: translateX(-50%);
    transform: translateX(-50%);
    bottom: 69px;
    height: 24px;
    width: 24px;
    border-radius: 50%;
    border: 4px solid #4D858D;
    background-color: #ffffff;
    -webkit-transition: background-color 0.6s, border-color 0.6s;
    -moz-transition: background-color 0.6s, border-color 0.6s;
    transition: background-color 0.6s, border-color 0.6s;
  }
  .cd-horizontal-timeline .events a::after {
    content: '';
    
  position: absolute;
  /* right: auto; */
  left : calc(50% - 16px);
  -webkit-transform: scale(0) translateX(-50%);
  -moz-transform: scale(0) translateX(-50%);
  -ms-transform: scale(0) translateX(-50%);
  -o-transform: scale(0);
  transform: scale(0);
  bottom: 65px;
  height: 32px;
  width: 32px;
  border-radius: 50%;
  /* border: 4px solid blue; */
  background-color: #4D858D;
  transform-origin: center center;
  -webkit-transition: transform 0.5s ease-in-out;
  -moz-transition: transform 0.5s ease-in-out;
  transition: transform 0.5s ease-in-out;
}
  .no-touch .cd-horizontal-timeline .events a:hover::before {
    /*background-color: #4D858D ;*/
    border-color: #4D858D ;
  }
  .cd-horizontal-timeline .events a.selected {
    pointer-events: none;
    color : #16354e;
  }
  .cd-horizontal-timeline .events a.selected::before {
    
    border-color: #4D858D ;
  }
  .cd-horizontal-timeline .events a.selected::after {
    transform: scale(1);
    transform-origin: center center;
}
  .cd-horizontal-timeline .events a.older-event::before {
    border-color: #4D858D;
  }
  @media only screen and (min-width: 1100px) {
    .cd-horizontal-timeline {
      margin: 8vh auto;
    }
    .cd-horizontal-timeline::before {
      /* never visible - this is used in jQuery to check the current MQ */
      content: 'desktop';
    }
  }
  @media only screen and (max-width: 990px) {
  .cd-horizontal-timeline .events-content {
   margin-top:0;
  }
  .cd-horizontal-timeline .events-content { 
    min-height:auto !important;
  }
  .cd-horizontal-timeline {
    margin-bottom:0;
  }
  }
  @media only screen and (max-width: 768px) {
  .cd-horizontal-timeline .timeline {
  height:50px;

  }
  .cd-timeline-navigation a {
    top:270px !important;
  }
}
  .cd-timeline-navigation a {
    // these are the left/right arrows to navigate the timeline 
    position: absolute;
    z-index: 16;
    top: 130%;
    bottom: auto;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    //border-radius: 50%;
    //border: 2px solid $gray;
    //replace text with an icon 
    overflow: hidden;
    //color: #000;
    text-indent: 5%;
    white-space: nowrap;
    -webkit-transition: border-color 0.3s;
    -moz-transition: border-color 0.3s;
    transition: border-color 0.3s;
  }
  .cd-timeline-navigation a::after {
    //arrow icon
    content: '';
    position: absolute;
    height: 16px;
    width: 16px;
    left: 50%;
    top: 50%;
    bottom: auto;
    right: auto;
    -webkit-transform: translateX(-50%) translateY(-50%);
    -moz-transform: translateX(-50%) translateY(-50%);
    -ms-transform: translateX(-50%) translateY(-50%);
    -o-transform: translateX(-50%) translateY(-50%);
    transform: translateX(-50%) translateY(-50%);
    background: url('https://www.dropbox.com/s/hg4lwkjuc6t8qo8/method-draw-image.svg?dl=0') no-repeat 0 0;
  }
  .cd-timeline-navigation a.prev {
    left: 0;
    /*-webkit-transform: translateY(-50%) rotate(180deg); 
    -moz-transform: translateY(-50%) rotate(180deg);
    -ms-transform: translateY(-50%) rotate(180deg);
    -o-transform: translateY(-50%) rotate(180deg);
    transform: translateY(-50%) rotate(180deg);*/
  }
  .cd-timeline-navigation a.next {
    right: 0;
  }
  .no-touch .cd-timeline-navigation a:hover {
    border-color: #4696d1;
  }
  .cd-timeline-navigation a.inactive {
    cursor: not-allowed;
  }
  .cd-timeline-navigation a.inactive::after {
    background-position: 0 -16px;
  }
  .no-touch .cd-timeline-navigation a.inactive:hover {
    border-color: #dfdfdf;
  }

  .cd-horizontal-timeline .events-content {
    position: relative;
    width: 100%;
    height : auto; 
    margin: 70px auto 20px;
    //overflow: hidden;
    -webkit-transition: height 0.4s;
    -moz-transition: height 0.4s;
    transition: height 0.4s;
    text-align : center;
    min-height:300px;
  }
  .cd-horizontal-timeline .events-content li {
    position: absolute;
    z-index: 1;
    width: 100%;
    left: 0;
    top: 0;
    -webkit-transform: translateX(-100%);
    -moz-transform: translateX(-100%);
    -ms-transform: translateX(-100%);
    -o-transform: translateX(-100%);
    transform: translateX(-100%);
    padding: 0 5% 3vh;
    opacity: 0;
    -webkit-animation-duration: 0.8s;
    -moz-animation-duration: 0.8s;
    animation-duration: 0.8s;
    /*cubic-bezier(0.9, 0.5, 0.5, .9)*/
    -webkit-animation-timing-function: cubic-bezier(0.8,0.8,0.55,0.95);
    -moz-animation-timing-function: cubic-bezier(0.8,0.8,0.55,0.95);
    animation-timing-function: cubic-bezier(0.8,0.8,0.55,0.95);
     animation-timing-function:cubic-bezier(0.8,0.8,0.55,0.95);
  }
  .cd-horizontal-timeline .events-content li.selected {
    /* visible event content */
    position: relative;
    z-index: 2;
    opacity: 1;
    -webkit-transform: translateX(0);
    -moz-transform: translateX(0);
    -ms-transform: translateX(0);
    -o-transform: translateX(0);
    transform: translateX(0);
  }
  .cd-horizontal-timeline .events-content li.enter-right, .cd-horizontal-timeline .events-content li.leave-right {
    -webkit-animation-name: cd-enter-right;
    -moz-animation-name: cd-enter-right;
    animation-name: cd-enter-right;
  }
  .cd-horizontal-timeline .events-content li.enter-left, .cd-horizontal-timeline .events-content li.leave-left {
    -webkit-animation-name: cd-enter-left;
    -moz-animation-name: cd-enter-left;
    animation-name: cd-enter-left;
  }
  .cd-horizontal-timeline .events-content li.leave-right, .cd-horizontal-timeline .events-content li.leave-left {
    -webkit-animation-direction: reverse;
    -moz-animation-direction: reverse;
    animation-direction: reverse;
  }
  .cd-horizontal-timeline .events-content li > * {
    max-width: 800px;
    margin: 0 auto;
  }

  // EVENT TITLE
  .cd-horizontal-timeline .events-content .event-title {
    color : #16354e;
    font-size: 24px;
    @extend %gibson-book;
  }

  // EVENT DATE (deleted from html)
  .cd-horizontal-timeline .events-content em {
    display: block;
    font-style: italic;
    margin: 10px auto;
  }
  .cd-horizontal-timeline .events-content em::before {
    content: '- ';
  }

  //EVENT CONTENT
  .cd-horizontal-timeline .events-content p {
    font-size: 19px;
    color: #16354e;
    @extend %gibson-book;
    padding-top : 10px;
  }
  .cd-horizontal-timeline .events-content em, .cd-horizontal-timeline .events-content p, .cd-horizontal-timeline .events-content .event-title {
    line-height: 28px;
  }
  @media only screen and (min-width: 768px) {
    //TITLE
    .cd-horizontal-timeline .events-content .event-title {
      font-size: 24px;
    }
    //DATE (deleted in html)
    .cd-horizontal-timeline .events-content em {
      font-size: 2rem;
    }
    //CONTENT
    .cd-horizontal-timeline .events-content p {
      font-size: 19px;
    }
  }

  @-webkit-keyframes cd-enter-right {
    0% {
      opacity: 0;
      -webkit-transform: translateX(100%);
    }
    100% {
      opacity: 1;
      -webkit-transform: translateX(0%);
    }
  }
  @-moz-keyframes cd-enter-right {
    0% {
      opacity: 0;
      -moz-transform: translateX(100%);
    }
    100% {
      opacity: 1;
      -moz-transform: translateX(0%);
    }
  }
  @keyframes cd-enter-right {
    0% {
      opacity: 0;
      -webkit-transform: translateX(100%);
      -moz-transform: translateX(100%);
      -ms-transform: translateX(100%);
      -o-transform: translateX(100%);
      transform: translateX(100%);
    }
    100% {
      opacity: 1;
      -webkit-transform: translateX(0%);
      -moz-transform: translateX(0%);
      -ms-transform: translateX(0%);
      -o-transform: translateX(0%);
      transform: translateX(0%);
    }
  }
  @-webkit-keyframes cd-enter-left {
    0% {
      opacity: 0;
      -webkit-transform: translateX(-100%);
    }
    100% {
      opacity: 1;
      -webkit-transform: translateX(0%);
    }
  }
  @-moz-keyframes cd-enter-left {
    0% {
      opacity: 0;
      -moz-transform: translateX(-100%);
    }
    100% {
      opacity: 1;
      -moz-transform: translateX(0%);
    }
  }
  @keyframes cd-enter-left {
    0% {
      opacity: 0;
      -webkit-transform: translateX(-100%);
      -moz-transform: translateX(-100%);
      -ms-transform: translateX(-100%);
      -o-transform: translateX(-100%);
      transform: translateX(-100%);
    }
    100% {
      opacity: 1;
      -webkit-transform: translateX(0%);
      -moz-transform: translateX(0%);
      -ms-transform: translateX(0%);
      -o-transform: translateX(0%);
      transform: translateX(0%);
    }
  }



  .intro{
    text-align : center;
    width : 650px;
    margin : 0 auto;
    color : #16354e;
	}
    .intro-title{
    @extend %gibson-medium;
    font-size : 45px;
    letter-spacing : 1px;
    }
    .intro-content{
    @extend %gibson-book;
    font-size : 19px;
    line-height : 26px;
    padding : 60px;
    }
  }
  @media screen and (max-width: 700px) {
    .intro {
      width : 90vw;
    }
  }

  .cd-timeline-navigation a.prev {
    -webkit-transform: translateY(-50%) rotate(-135deg); 
    -moz-transform: translateY(-50%) rotate(-135deg);
    -ms-transform: translateY(-50%) rotate(-135deg);
    -o-transform: translateY(-50%) rotate(-135deg);
    transform: translateY(-50%) rotate(-135deg);
  }
  .cd-timeline-navigation a.next {
    -webkit-transform: translateY(-50%) rotate(-135deg); 
    -moz-transform: translateY(-50%) rotate(45deg);
    -ms-transform: translateY(-50%) rotate(45deg);
    -o-transform: translateY(-50%) rotate(45deg);
    transform: translateY(-50%) rotate(45deg);
  }

  .cd-timeline-navigation a {
    height: 40px;
    width: 40px; 
    border-radius : 3px;
    border-right : 3px solid #4696d1;
    border-top : 3px solid #4696d1;
    transform : rotate(30%);
    color: #fff; //White to fit background and make the arrows "disappear" ; might need a better solution
  }
  .cd-timeline-navigation{
    list-style-type: none;
  }
  .history_angle:before{
    content: none;
  }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<div class="container" id="ct-cd-horizontal-timeline">
	<div class="carousel_custom_h2_wrapper">
		<p class="pxp-text-light" style="color:#4D858D;font-weight: 700; "><?php the_field('company_timeline_title');?></p>

		<h1 class="pxp-section-h2 carousel_custom_h2">			
      <?php the_field('company_timeline_sub_title');?>
		</h1>
	</div>
</div>




<section class="cd-horizontal-timeline">

  <div class="timeline">
    <div class="events-wrapper">
      <div class="events">
        <ol class="ol_history">
          <?php
          foreach ($s_array['services'] as $key => $service) { ?>
            <li><a href="#0" data-date="01/<?php echo sprintf("%02d", $key+1); ?>/2000" class="a_history <?php echo ($key == 0 ? 'selected' : ''); ?>"><?php echo $service['title']; ?></a></li>
            <?php
          } ?>
        </ol>

        <span class="filling-line" aria-hidden="true"></span>
      </div>
    </div> <!-- .events-wrapper -->
      
    <ul class="cd-timeline-navigation">
      <li><a href="#0" class="history_angle prev fa fa-angle-right fa-lg " style="position: absolute;"></a></li>
      <li><a href="#0" class="next fa fa-angle-left fa-lg" style="position: absolute;"></a></li>
    </ul> <!-- .cd-timeline-navigation -->
  </div>

  <div class="events-content container">
    <ol class="ol_history">
    	<?php
			foreach ($s_array['services'] as $key => $service) { 
        //print_r($service);
        ?>
	      <li class="<?php echo ($key == 0 ? 'selected' : ''); ?>" data-date="01/<?php echo sprintf("%02d", $key+1); ?>/2000">
	        <h2 class="pxp-section-h2 carousel_custom_h2 pxp-in"><?php echo $service['title']; ?></h2>
	        <p><?php echo $service['text']; ?></p>
          <?php if($service['bgsrc'] != '') { ?><img src="<?php echo $service['bgsrc']?>"/><?php  } ?>
	      </li>
      	<?php
			} ?>
    </ol>
  </div> <!-- .events-content -->
  
</section>
  
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function($){
    var timelines = $('.cd-horizontal-timeline'),
      eventsMinDistance = 120; // !*WAS 60*!

    (timelines.length > 0) && initTimeline(timelines);

    function initTimeline(timelines) {
      timelines.each(function(){
        var timeline = $(this),
          timelineComponents = {};
        //cache timeline components 
        timelineComponents['timelineWrapper'] = timeline.find('.events-wrapper');
        timelineComponents['eventsWrapper'] = timelineComponents['timelineWrapper'].children('.events');
        timelineComponents['fillingLine'] = timelineComponents['eventsWrapper'].children('.filling-line');
        timelineComponents['timelineEvents'] = timelineComponents['eventsWrapper'].find('a');
        timelineComponents['timelineDates'] = parseDate(timelineComponents['timelineEvents']);
        timelineComponents['eventsMinLapse'] = minLapse(timelineComponents['timelineDates']);
        timelineComponents['timelineNavigation'] = timeline.find('.cd-timeline-navigation');
        timelineComponents['eventsContent'] = timeline.children('.events-content');

        //assign a left postion to the single events along the timeline
        setDatePosition(timelineComponents, eventsMinDistance);
        //assign a width to the timeline
        var timelineTotWidth = setTimelineWidth(timelineComponents, eventsMinDistance);
        //the timeline has been initialize - show it
        timeline.addClass('loaded');

        //detect click on the next arrow
        timelineComponents['timelineNavigation'].on('click', '.next', function(event){
          // alert(0)
          if(window.innerWidth < 1170){
            event.preventDefault();
            updateSlide(timelineComponents, timelineTotWidth, 'next');
          }
          else{
            event.preventDefault();
            showNewContent(timelineComponents, timelineTotWidth, 'next');
          }
        });
        
        //detect click on the prev arrow
        timelineComponents['timelineNavigation'].on('click', '.prev', function(event){
          if(window.innerWidth < 1170){
            event.preventDefault();
            updateSlide(timelineComponents, timelineTotWidth, 'prev');
          }
          else{
            event.preventDefault();
            showNewContent(timelineComponents, timelineTotWidth, 'prev');
          }
        });
        
        //detect click on the a single event - show new event content
        timelineComponents['eventsWrapper'].on('click', 'a', function(event){
          event.preventDefault();
          timelineComponents['timelineEvents'].removeClass('selected');
          $(this).addClass('selected');
          updateOlderEvents($(this));
          updateFilling($(this), timelineComponents['fillingLine'], timelineTotWidth);
          updateVisibleContent($(this), timelineComponents['eventsContent']);
        });

        //on swipe, show next/prev event content
        timelineComponents['eventsContent'].on('swipeleft', function(){
          var mq = checkMQ();
          ( mq == 'mobile' ) && showNewContent(timelineComponents, timelineTotWidth, 'next');
        });
        timelineComponents['eventsContent'].on('swiperight', function(){
          var mq = checkMQ();
          ( mq == 'mobile' ) && showNewContent(timelineComponents, timelineTotWidth, 'prev');
        });

        //keyboard navigation
        $(document).keyup(function(event){
          if(event.which=='37' && elementInViewport(timeline.get(0)) ) {
            showNewContent(timelineComponents, timelineTotWidth, 'prev');
          } else if( event.which=='39' && elementInViewport(timeline.get(0))) {
            showNewContent(timelineComponents, timelineTotWidth, 'next');
          }
        });
      });
    }
    
    function updateSlide(timelineComponents, timelineTotWidth, string) {
      //retrieve translateX value of timelineComponents['eventsWrapper']
      var translateValue = getTranslateValue(timelineComponents['eventsWrapper']),
        wrapperWidth = Number(timelineComponents['timelineWrapper'].css('width').replace('px', ''));
      //translate the timeline to the left('next')/right('prev') 
      (string == 'next') 
        ? translateTimeline(timelineComponents, translateValue - wrapperWidth + eventsMinDistance, wrapperWidth - timelineTotWidth)
        : translateTimeline(timelineComponents, translateValue + wrapperWidth - eventsMinDistance);
    }

    function showNewContent(timelineComponents, timelineTotWidth, string) {
      //go from one event to the next/previous one
      var visibleContent =  timelineComponents['eventsContent'].find('.selected'),
        newContent = ( string == 'next' ) ? visibleContent.next() : visibleContent.prev();

      if ( newContent.length > 0 ) { //if there's a next/prev event - show it
        var selectedDate = timelineComponents['eventsWrapper'].find('.selected'),
          newEvent = ( string == 'next' ) ? selectedDate.parent('li').next('li').children('a') : selectedDate.parent('li').prev('li').children('a');
        
        updateFilling(newEvent, timelineComponents['fillingLine'], timelineTotWidth);
        updateVisibleContent(newEvent, timelineComponents['eventsContent']);
        newEvent.addClass('selected');
        selectedDate.removeClass('selected');
        updateOlderEvents(newEvent);
        updateTimelinePosition(string, newEvent, timelineComponents);
      }
    }

    function updateTimelinePosition(string, event, timelineComponents) {
      //translate timeline to the left/right according to the position of the selected event
      var eventStyle = window.getComputedStyle(event.get(0), null),
        eventLeft = Number(eventStyle.getPropertyValue("left").replace('px', '')),
        timelineWidth = Number(timelineComponents['timelineWrapper'].css('width').replace('px', '')),
        timelineTotWidth = Number(timelineComponents['eventsWrapper'].css('width').replace('px', ''));
      var timelineTranslate = getTranslateValue(timelineComponents['eventsWrapper']);

          if( (string == 'next' && eventLeft > timelineWidth - timelineTranslate) || (string == 'prev' && eventLeft < - timelineTranslate) ) {
            translateTimeline(timelineComponents, - eventLeft + timelineWidth/2, timelineWidth - timelineTotWidth);
          }
    }

    function translateTimeline(timelineComponents, value, totWidth) {
      var eventsWrapper = timelineComponents['eventsWrapper'].get(0);
      value = (value > 0) ? 0 : value; //only negative translate value
      value = ( !(typeof totWidth === 'undefined') &&  value < totWidth ) ? totWidth : value; //do not translate more than timeline width
      setTransformValue(eventsWrapper, 'translateX', value+'px');
      //update navigation arrows visibility
      (value == 0 ) ? timelineComponents['timelineNavigation'].find('.prev').addClass('inactive') : timelineComponents['timelineNavigation'].find('.prev').removeClass('inactive');
      (value == totWidth ) ? timelineComponents['timelineNavigation'].find('.next').addClass('inactive') : timelineComponents['timelineNavigation'].find('.next').removeClass('inactive');
    }

    function updateFilling(selectedEvent, filling, totWidth) {
      //change .filling-line length according to the selected event
      var eventStyle = window.getComputedStyle(selectedEvent.get(0), null),
        eventLeft = eventStyle.getPropertyValue("left"),
        eventWidth = eventStyle.getPropertyValue("width");
      eventLeft = Number(eventLeft.replace('px', '')) + Number(eventWidth.replace('px', ''))/2;
      var scaleValue = eventLeft/totWidth;
      setTransformValue(filling.get(0), 'scaleX', scaleValue);
    }

    function setDatePosition(timelineComponents, min) {
      for (i = 0; i < timelineComponents['timelineDates'].length; i++) { 
          var distance = daydiff(timelineComponents['timelineDates'][0], timelineComponents['timelineDates'][i]),
            distanceNorm = Math.round(distance/timelineComponents['eventsMinLapse']) + 1.8; // !*WAS 2*!
          timelineComponents['timelineEvents'].eq(i).css('left', distanceNorm*min+'px');
      }
    }

    function setTimelineWidth(timelineComponents, width) {
      var timeSpan = daydiff(timelineComponents['timelineDates'][0], timelineComponents['timelineDates'][timelineComponents['timelineDates'].length-1]),
        timeSpanNorm = timeSpan/timelineComponents['eventsMinLapse'],
        timeSpanNorm = Math.round(timeSpanNorm) + 1, // !*WAS +4*!
        totalWidth = timeSpanNorm*width;
      timelineComponents['eventsWrapper'].css('width', totalWidth+'px');
      updateFilling(timelineComponents['eventsWrapper'].find('a.selected'), timelineComponents['fillingLine'], totalWidth);
      updateTimelinePosition('next', timelineComponents['eventsWrapper'].find('a.selected'), timelineComponents);
    
      return totalWidth;
    }

    function updateVisibleContent(event, eventsContent) {
      var eventDate = event.data('date'),
        visibleContent = eventsContent.find('.selected'),
        selectedContent = eventsContent.find('[data-date="'+ eventDate +'"]'),
        selectedContentHeight = selectedContent.height();

      if (selectedContent.index() > visibleContent.index()) {
        var classEnetering = 'selected enter-right',
          classLeaving = 'leave-left';
      } else {
        var classEnetering = 'selected enter-left',
          classLeaving = 'leave-right';
      }

      selectedContent.attr('class', classEnetering);
      visibleContent.attr('class', classLeaving).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(){
        visibleContent.removeClass('leave-right leave-left');
        selectedContent.removeClass('enter-left enter-right');
      });
      eventsContent.css('height', selectedContentHeight+'px');
    }

    function updateOlderEvents(event) {
      event.parent('li').prevAll('li').children('a').addClass('older-event').end().end().nextAll('li').children('a').removeClass('older-event');
    }

    function getTranslateValue(timeline) {
      var timelineStyle = window.getComputedStyle(timeline.get(0), null),
        timelineTranslate = timelineStyle.getPropertyValue("-webkit-transform") ||
              timelineStyle.getPropertyValue("-moz-transform") ||
              timelineStyle.getPropertyValue("-ms-transform") ||
              timelineStyle.getPropertyValue("-o-transform") ||
              timelineStyle.getPropertyValue("transform");

          if( timelineTranslate.indexOf('(') >=0 ) {
            var timelineTranslate = timelineTranslate.split('(')[1];
          timelineTranslate = timelineTranslate.split(')')[0];
          timelineTranslate = timelineTranslate.split(',');
          var translateValue = timelineTranslate[4];
          } else {
            var translateValue = 0;
          }

          return Number(translateValue);
    }

    function setTransformValue(element, property, value) {
      element.style["-webkit-transform"] = property+"("+value+")";
      element.style["-moz-transform"] = property+"("+value+")";
      element.style["-ms-transform"] = property+"("+value+")";
      element.style["-o-transform"] = property+"("+value+")";
      element.style["transform"] = property+"("+value+")";
    }

    //based on http://stackoverflow.com/questions/542938/how-do-i-get-the-number-of-days-between-two-dates-in-javascript
    function parseDate(events) {
      var dateArrays = [];
      events.each(function(){
        var singleDate = $(this),
          dateComp = singleDate.data('date').split('T');
        if( dateComp.length > 1 ) { //both DD/MM/YEAR and time are provided
          var dayComp = dateComp[0].split('/'),
            timeComp = dateComp[1].split(':');
        } else if( dateComp[0].indexOf(':') >=0 ) { //only time is provide
          var dayComp = ["2000", "0", "0"],
            timeComp = dateComp[0].split(':');
        } else { //only DD/MM/YEAR
          var dayComp = dateComp[0].split('/'),
            timeComp = ["0", "0"];
        }
        var newDate = new Date(dayComp[2], dayComp[1]-1, dayComp[0], timeComp[0], timeComp[1]);
        dateArrays.push(newDate);
      });
        return dateArrays;
    }

    function daydiff(first, second) {
        return Math.round((second-first));
    }

    function minLapse(dates) {
      //determine the minimum distance among events
      var dateDistances = [];
      for (i = 1; i < dates.length; i++) { 
          var distance = daydiff(dates[i-1], dates[i]);
          dateDistances.push(distance);
      }
      return Math.min.apply(null, dateDistances);
    }

    /*
      How to tell if a DOM element is visible in the current viewport?
      http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
    */
    function elementInViewport(el) {
      var top = el.offsetTop;
      var left = el.offsetLeft;
      var width = el.offsetWidth;
      var height = el.offsetHeight;

      while(el.offsetParent) {
          el = el.offsetParent;
          top += el.offsetTop;
          left += el.offsetLeft;
      }

      return (
          top < (window.pageYOffset + window.innerHeight) &&
          left < (window.pageXOffset + window.innerWidth) &&
          (top + height) > window.pageYOffset &&
          (left + width) > window.pageXOffset
      );
    }

    function checkMQ() {
      //check if mobile or desktop device
      return window.getComputedStyle(document.querySelector('.cd-horizontal-timeline'), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "");
    }
    
  });  
</script>

<?php

$return_string  = ob_get_clean();


$return_string .= '';
?>