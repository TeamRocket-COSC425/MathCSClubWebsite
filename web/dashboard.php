<?php
    $title = "SU Math/CS Club Dashboard";
    include("includes/header.html");
    include("includes/sidenav.html");
    include("includes/topnav.php");
?>

<head>
	<title>Math CS Club - Dashboard</title>
</head>

<body>

<div id="main">
  <div id="content">

    <center>
      <img id="usericon" src = <?php
                    $img = $db->where('id', $_SESSION['user_id'])->getOne('users')['image'];
                    if (!$img) {
                      $img = "images/loginicon.jpg";
                    }
                    echo $img;
                 ?> />

      <h2> Welcome, <?php echo $db->where('id', $_SESSION['user_id'])->getOne('users')['name'] ?> </h2>
    </center>
<p>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum erat erat, pulvinar in arcu ut, sodales iaculis nisl. Suspendisse potenti. Quisque pretium interdum eros dapibus rutrum. Proin nulla diam, auctor vitae lorem vel, pretium pulvinar leo. Vivamus semper feugiat sem, vel fringilla purus commodo a. Donec ac blandit augue. Praesent scelerisque tristique pharetra. Nullam ac massa mattis, pretium erat in, lacinia tellus. Nam vestibulum erat sit amet ex egestas pellentesque. Aliquam at felis sagittis, blandit ante vel, convallis risus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
<p>
Pellentesque sapien turpis, faucibus ut metus id, auctor sodales diam. Aenean facilisis non tortor nec imperdiet. Vestibulum feugiat euismod ipsum at iaculis. Praesent vitae enim non lorem rhoncus varius. Integer a tortor urna. Donec tincidunt leo sed fringilla lobortis. Duis ac erat finibus, dapibus nisi sed, pretium eros. Curabitur quis accumsan leo, at dignissim elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Cras volutpat luctus augue, ornare sagittis risus tempor eu. Morbi vel pretium lorem.
<p>
Donec ut massa dictum mi tristique facilisis sed in ante. Nullam porttitor efficitur porta. Maecenas diam diam, tristique tincidunt mauris at, imperdiet elementum lorem. Phasellus eget neque ac enim molestie dignissim. Praesent quis sapien dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at molestie augue. Phasellus urna est, posuere sit amet enim id, commodo posuere lacus. Vivamus mattis eget mi non blandit.
<p>
Phasellus ut ante neque. Quisque accumsan ornare velit, quis varius velit aliquet ullamcorper. Curabitur nibh nunc, imperdiet at turpis et, euismod tincidunt eros. Quisque sit amet mauris id ipsum dictum dictum hendrerit et arcu. Morbi vel augue id ligula faucibus viverra porta eget ipsum. Cras eleifend euismod enim, non semper felis dignissim at. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam aliquet, quam vel vulputate finibus, elit dolor consectetur nisl, ut volutpat ipsum metus ut purus. Vestibulum bibendum, dui non pellentesque pellentesque, odio sem imperdiet sapien, sit amet ornare ex velit in leo. Nunc eleifend lobortis condimentum. Aliquam sed fringilla felis. Duis consequat at enim a suscipit. Sed eget felis nisl.
<p>
Morbi vestibulum venenatis nisl. Quisque pellentesque sapien risus, ac fringilla nisi mollis vel. Curabitur et lacus purus. Aliquam erat volutpat. Donec ac orci tincidunt, mattis enim vel, porttitor ante. Phasellus posuere, quam vitae pellentesque finibus, nisl odio elementum arcu, at rhoncus orci urna tincidunt enim. In porta non velit vitae tincidunt. Cras congue euismod mi, nec pellentesque justo auctor non. Sed varius rhoncus mi.
<p>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum erat erat, pulvinar in arcu ut, sodales iaculis nisl. Suspendisse potenti. Quisque pretium interdum eros dapibus rutrum. Proin nulla diam, auctor vitae lorem vel, pretium pulvinar leo. Vivamus semper feugiat sem, vel fringilla purus commodo a. Donec ac blandit augue. Praesent scelerisque tristique pharetra. Nullam ac massa mattis, pretium erat in, lacinia tellus. Nam vestibulum erat sit amet ex egestas pellentesque. Aliquam at felis sagittis, blandit ante vel, convallis risus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
<p>
Pellentesque sapien turpis, faucibus ut metus id, auctor sodales diam. Aenean facilisis non tortor nec imperdiet. Vestibulum feugiat euismod ipsum at iaculis. Praesent vitae enim non lorem rhoncus varius. Integer a tortor urna. Donec tincidunt leo sed fringilla lobortis. Duis ac erat finibus, dapibus nisi sed, pretium eros. Curabitur quis accumsan leo, at dignissim elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Cras volutpat luctus augue, ornare sagittis risus tempor eu. Morbi vel pretium lorem.
<p>
Donec ut massa dictum mi tristique facilisis sed in ante. Nullam porttitor efficitur porta. Maecenas diam diam, tristique tincidunt mauris at, imperdiet elementum lorem. Phasellus eget neque ac enim molestie dignissim. Praesent quis sapien dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at molestie augue. Phasellus urna est, posuere sit amet enim id, commodo posuere lacus. Vivamus mattis eget mi non blandit.
<p>
Phasellus ut ante neque. Quisque accumsan ornare velit, quis varius velit aliquet ullamcorper. Curabitur nibh nunc, imperdiet at turpis et, euismod tincidunt eros. Quisque sit amet mauris id ipsum dictum dictum hendrerit et arcu. Morbi vel augue id ligula faucibus viverra porta eget ipsum. Cras eleifend euismod enim, non semper felis dignissim at. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam aliquet, quam vel vulputate finibus, elit dolor consectetur nisl, ut volutpat ipsum metus ut purus. Vestibulum bibendum, dui non pellentesque pellentesque, odio sem imperdiet sapien, sit amet ornare ex velit in leo. Nunc eleifend lobortis condimentum. Aliquam sed fringilla felis. Duis consequat at enim a suscipit. Sed eget felis nisl.
<p>
Morbi vestibulum venenatis nisl. Quisque pellentesque sapien risus, ac fringilla nisi mollis vel. Curabitur et lacus purus. Aliquam erat volutpat. Donec ac orci tincidunt, mattis enim vel, porttitor ante. Phasellus posuere, quam vitae pellentesque finibus, nisl odio elementum arcu, at rhoncus orci urna tincidunt enim. In porta non velit vitae tincidunt. Cras congue euismod mi, nec pellentesque justo auctor non. Sed varius rhoncus mi.

</div>
</div>

</body>

</html>
