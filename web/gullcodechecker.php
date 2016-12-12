<?php
    $title = "SU Math/CS Club GullCode";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
    require_once("classes/EditableContent.php");
    require_once("classes/Login.php");
    require_once("classes/Utils.php");
    $login = new Login();
?>
<head>
  <title>Math CS Club - GullCode</title>
    <link rel="stylesheet" href="css/gullcode.css"/>
</head>

<body>

<div id="main">

<div id="content" class = "center">

<header>
<h1><code><center> GullCode </center></code></h1>
</header>

<br>

<div class="col3">
  <div>
  <img src="images/gullcode/gullcode_sp2014.jpg" class="gullcodepic">
  </div>
  <div class="block">
  <?php (new EditableContent("gullcodeTime"))->getContent(); ?>
  </div>
  <div>
  <img src="images/gullcode/gullcode_fa2015.jpg" class="gullcodepic">
</div>
</div>

<hr>

<?php (new EditableContent("gullCodeDescription"))->getContent(); ?>

<?php
  if($login->isUserLoggedIn()) {

    $control = $db->where("admin_controls", "gullcode_register")->getone("admin_controls");
    if($control["switch"] == 1) {
      include("views/GC-MC-Register.html");
    }
  }
?>


</div>
<section id="s-faq">
  <h1>FAQ</h1>
  <div id="faq-wrap" class="section-text">
    <div class="faq-group">
      <h3> Who is eligible for GullCode? </h3>
      <p style="display: none; opacity: 0;">Salisbury Students and alumni</p>
    </div>
    <div class="faq-group">
      <h3> Can Salisbury alumni attend? </h3>
        <p>Bury' alumni are eligible to attend the event to mentor and speak with other students.To register as an gullcode alumni visit our alumni page.</a>
        </p>
    </div>
    <div class="faq-group">
      <h3> What is the acceptance criteria? </h3>
        <p>Only for Non-MATH/CS students, as much as we want to take everyone, we can only accept a limited number of the participants due to the limited amount of space we have on campus. We think that the fairest way to accept candidates is to ask the candidates to tell us about their previous classes and coding experiences, so that we can invite people who have demonstrated interest and skill.</p>
    </div>
    <div class="faq-group">
      <h3> Will my travel be reimbursed? </h3>
        <p> We do not have any travel reimbursments. There may be car pool options available</p>
    </div>
    <div class="faq-group">
      <h3> What external sources can I use? </h3>
        <p style="display: none; opacity: 0;"> We allow classroom notes and textbooks, but the wifi and internet will be closed.</p>
    </div>
    <div class="faq-group">
      <h3> What about teams? </h3>
        <p style="display: none; opacity: 0;">You don't have to form a team before GullCode, but you must register as a Free Agent. At the start of GullCode we will provide plenty of time to break out and form a new one if you choose to. Teams will be limited to 3 students.</p>
    </div>
    <div class="faq-group">
      <h3> Will there be prizes? </h3>
        <p>We will have prizes for 1st, 2nd, 3rd place, as well as several other company sponsored prizes through ticket drawings.</p>
    </div>
    <div class="faq-group">
      <h3> Will there be free food? </h3>
        <p> Yes! We will provide catered meals during the event along with free caffeine!</p>
    </div>
    <div class="faq-group">
      <h3> What if I'm not very experienced? </h3>
        <p style="display: none; opacity: 0;">We will try our best to point students in the right direction and use tools and languages that allow rapid development with the least amount of frustration. There will also be upperclassmen/alumni participating in the competition who can help you out. Furthermore, you can look up tutorials and sample code through our website.</p>
    </div>
    <div class="faq-group">
      <h3> What do I need to bring? </h3>
        <p>Please bring a student ID so we can verify and register you on-site! You'll also need to bring a computer, whatever software you feel might be necessary for coding. We also recommend that you bring power strips for convenience. Teammates are free to share equipment with each other.</p>
    </div>
    <div class="faq-group">
      <h3> Do I need to stay the entire time? </h3>
        <p style="display: none; opacity: 0;">Yes, the competition will be lock-in. We realize that 4 hours is a long time, and that some students will need the restroom which will be a designated area. There will be pictures at the end as well as the prizes, So hold your horses! </p>
    </div>
    <div class="faq-group">
      <h3> Mentoring Program? </h3>
        <p>We’ve set up a mentoring program for the MATH/CS club that you can access by going to that page  and clicking on Request a Mentor.  This is a useful tool to gain the upperhand on competiiton.
        </p>
    </div>
    <div class="faq-group">
      <h3> More questions? </h3>
      <p style="display: none; opacity: 0;"> Send an email to Chelsea.</p>
    </div>
  </div>
</section>
</div>



<script>
$(document).ready(function(){

  // initialize variables
  var menuActive = false;
  var faqHeight = $('#s-faq').outerHeight();
  var breakpoint = 860;



  // navbar animations
  function animateNavBar(w) {
    if ($('#nav').width() >= breakpoint) {
      // animate colors if non-mobile
      if (w.scrollTop() > 1) {
        // bg-color
        $('#nav').css({'background-color':'#FFFCF9'});
        // link-style
        $('#nav a').addClass('nav-scroll');
        $('#nav a').removeClass('nav-top');
        // menu button color
        $('.st0').css({'fill':'#F2AE6A'});
        $('.st0').css({'stroke':'#F2AE6A'});
        // logo style
        $('.logo-b').show();
        $('.logo-w').hide();
      } else {
        // bg-color
        $('#nav').css({'background-color':'transparent'});
        // link-style
        $('#nav a').removeClass('nav-scroll');
        $('#nav a').addClass('nav-top');
        // menu button color
        $('.st0').css({'fill':'#FFFFFF'});
        $('.st0').css({'stroke':'#FFFFFF'});
        // logo style
        $('.logo-w').show();
        $('.logo-b').hide();
      }
    } else {
      // otherwise set colors if mobile
      $('#nav').css({'background-color':'#FFFCF9'});
      $('#nav a').addClass('nav-scroll');
      $('#nav a').removeClass('nav-top');
      $('.st0').css({'fill':'#F2AE6A'});
      $('.st0').css({'stroke':'#F2AE6A'});
      $('.logo-b').show();
      $('.logo-w').hide();
    }
  }

  // update DOM elements
  function updateProperties() {
    // update heights for scroll navigation
    faqHeight = $('#s-faq').outerHeight();
  }
  
  // click actions
  function clickActions() {
    // faq
    $('.faq-group').click(function() {
      if ($('p', this).css('display') === 'none') {
        $('p', this).css({'display': 'block'});
        $('p', this).css({'opacity': '1'});
      } else {
        $('p', this).css({'display': 'none'});
        $('p', this).css({'opacity': '0'});
      }
    });
  }

  // init methods
  animateNavBar($(window));
  updateProperties();
  clickActions();

  // on resize
  $(window).resize(function() {
    // update size-dependent properties
    updateProperties();

    // animate nav bar
    animateNavBar($(window));

    // normalize initial menu status
    if (docWidth >= breakpoint) {
      menuActive = false;
      toggleMenu();
    } else {
      menuActive = true;
      toggleMenu();
    }
  });


  
});

</script>
</body>

</html>
